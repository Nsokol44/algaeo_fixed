<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Recommendation;
use App\Models\Crop;

class RecommendationController extends Controller
{
    /**
     * POST /api/v1/recommendations
     *
     * expected JSON body (all fields optional):
     * {
     *   "soil":  "clay"  | 2,
     *   "crop":  "tomato" | 4,
     *   "issue": "drought stress" | 3
     * }
     */
    public function index(Request $request)
    {
        // API KEY AUTH
        $authHeader = $request->header('Authorization');
        $token = null; 

        if ($authHeader && preg_match('/Bearer\s+(.+)/i', $authHeader, $matches)) {
            $token = trim($matches[1]); 
        }

        $expected = config('services.algaeo.api_key');

        if (!$token || !$expected || !hash_equals($expected, $token)) {
            return response()->json([
                'status' => 'error', 
                'message' => 'Unauthorized',
            ], 401);
        }
        // end api key auth check

        // now read from JSON body (still works with query string too)
        $soil  = $request->input('soil');   // can be name or id
        $crop  = $request->input('crop');   // can be name or id
        $issue = $request->input('issue');  // can be name or id

        $query = Recommendation::with([
            'product.microbes',
            'soils',
            'crops',
            'issues',
        ]);

        // soil filter
        if ($soil) {
            $query->where(function ($q) use ($soil) {
                $q->whereHas('soils', function ($q2) use ($soil) {
                    // allow id OR name
                    if (is_numeric($soil)) {
                        $q2->where('soils.id', $soil); // id
                    } else {
                        // case insensitive match on name 
                        $q2->whereRaw('LOWER(soils.name) = ?', [strtolower($soil)]);
                    }
                })
                // "any soil" recommendations (no pivot rows)
                ->orWhereDoesntHave('soils');
            });
        }
        
        // crop filter with category/variety fallback
        if ($crop) {
            $query->where(function ($q) use ($crop) {
                $cropIds = [];

                if (is_numeric($crop)) {
                    // if front end ever passes an id directly
                    $cropIds[] = (int) $crop;
                } else {
                    // look up the crop row by name (case-insensitive)
                    $cropModel = Crop::whereRaw('LOWER(name) = ?', [strtolower($crop)])->first();

                    if ($cropModel) {
                        // always include the specific crop row
                        $cropIds[] = $cropModel->id;

                        // if child with a parent category, include that parent
                        if ($cropModel->parent_id) {
                            $cropIds[] = $cropModel->parent_id;
                        }

                        // if category, include all its children
                        if ($cropModel->is_category) {
                            $childIds = $cropModel->children()->pluck('id')->all();
                            $cropIds  = array_merge($cropIds, $childIds);
                        }
                    }
                }

                $cropIds = array_values(array_unique($cropIds));

                if (!empty($cropIds)) {
                    $q->whereHas('crops', function ($q2) use ($cropIds) {
                        $q2->whereIn('crops.id', $cropIds);
                    })
                    // plus recommendations that apply to any crop
                    ->orWhereDoesntHave('crops');
                } else {
                    // else "any crop" recs
                    $q->whereDoesntHave('crops');
                }
            });
        }

        // issue filter
        if ($issue) {
            $query->where(function ($q) use ($issue) {
                $q->whereHas('issues', function ($q2) use ($issue) {
                    if (is_numeric($issue)) {
                        $q2->where('issues.id', $issue);
                    } else {
                        $q2->whereRaw('LOWER(issues.name) = ?', [strtolower($issue)]);
                    }
                })
                // "any issue" recommendations
                ->orWhereDoesntHave('issues');
            });
        }

        // ordered by rank score 
        $recommendations = $query
            ->orderByDesc('rank_score')
            ->get(); 

        $usedFallback = false; 

        // fallback query if nothing matched (global only)
        if ($recommendations->isEmpty()) {
            $usedFallback = true; 

            $recommendations = Recommendation::with([
                'product.microbes',
                'soils',
                'crops',
                'issues',
            ])
            ->whereDoesntHave('soils')
            ->whereDoesntHave('crops')
            ->whereDoesntHave('issues')
            ->orderByDesc('rank_score')
            ->get();
        }

        // transform to front end contract
        $results = [];
        $rank    = 1;

        foreach ($recommendations as $rec) {
            $product = $rec->product;

            if (!$product) {
                continue; // skip malformed rows
            }

            // is this recommendation "global" (no pivots)?
            $isGlobalRec = $rec->soils->isEmpty()
                && $rec->crops->isEmpty()
                && $rec->issues->isEmpty();

            // how many filters user gave vs how many this rec matches exactly
            $totalFilters = 0;
            $exactFilters = 0;

            if ($soil) {
                $totalFilters++;
                if ($rec->soils->isNotEmpty()) {
                    $exactFilters++;
                }
            }
            if ($crop) {
                $totalFilters++;
                if ($rec->crops->isNotEmpty()) {
                    $exactFilters++;
                }
            }
            if ($issue) {
                $totalFilters++;
                if ($rec->issues->isNotEmpty()) {
                    $exactFilters++;
                }
            }

            // classify match_type / is_fallback
            if ($usedFallback || ($isGlobalRec && $totalFilters > 0)) {
                $isFallback = true;
                $matchType  = 'fallback';
            } else {
                $isFallback = false;

                if ($totalFilters === 0) {
                    $matchType = 'exact'; // no filters -> just "top" recs
                } elseif ($exactFilters === $totalFilters) {
                    $matchType = 'exact';
                } elseif ($exactFilters > 0) {
                    $matchType = 'partial';
                } else {
                    $matchType = 'fallback'; // safety net
                }
            }

            // build human-readable reason
            $criteriaParts = [];
            if ($soil)  $criteriaParts[] = "{$soil} soil";
            if ($crop)  $criteriaParts[] = "{$crop} crop";
            if ($issue) $criteriaParts[] = $issue;

            $criteriaString = $criteriaParts ? implode(' and ', $criteriaParts) : null;

            if ($criteriaString) {
                $reason = "Recommended because you selected {$criteriaString}";
            } else {
                $reason = "Recommended as a general-purpose product for a wide range of conditions";
            }

            $primaryMicrobe = $product->microbes->first();
            if ($primaryMicrobe && $primaryMicrobe->function_summary) {
                $reason .= ", and its microbes " . lcfirst($primaryMicrobe->function_summary) . ".";
            } else {
                $reason .= ".";
            }

            // microbe_consortia array – **just microbe info**
            $microbeConsortia = $product->microbes->map(function ($microbe) {
                return [
                    'name'         => $microbe->name,
                    'common_name'  => $microbe->common_name,
                    'function'     => $microbe->function_summary,
                    'benefit_tags' => $microbe->benefit_tags
                        ? array_map('trim', explode(',', $microbe->benefit_tags))
                        : [],
                ];
            })->values()->all();

            // push one product entry into $results
            $results[] = [
                'rank'                  => $rank,
                'product_name'          => $product->name,
                'product_slug'          => $product->slug,
                'dosing_rate'           => $product->dosing_rate,
                'application_method'    => $rec->application_method,
                'application_frequency' => $rec->application_frequency,
                'trial_guidance'        => $rec->trial_guidance,
                'recommendation_notes'  => $rec->notes,
                'is_fallback'           => $isFallback,
                'match_type'            => $matchType,  // "exact" | "partial" | "fallback"
                'match_score'           => (float) $rec->rank_score,
                'reason'                => $reason,
                'microbe_consortia'     => $microbeConsortia,
                'matched_criteria'      => [
                    'soil'  => $soil,
                    'crop'  => $crop,
                    'issue' => $issue,
                ],
            ];

            $rank++;
        }
        // final response
        return response()->json([
            'status' => 'success',
            'filters' => [
                'soil'  => $soil,
                'crop'  => $crop,
                'issue' => $issue,
            ],
            'count' => count($results),
            'recommended_products'  => $results,
        ]);
    }
}
