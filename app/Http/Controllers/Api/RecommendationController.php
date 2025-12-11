<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Recommendation;

class RecommendationController extends Controller
{
    public function index(Request $request)
    {
        // /api/recommend?soil=clay&crop=tomato&issue=drought+stress
        $soil  = $request->query('soil');   // can be name or id
        $crop  = $request->query('crop');   // can be name or id
        $issue = $request->query('issue');  // can be name or id

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
                ->orWhereDoesntHave('soils');
            });
        }
        
        // crop filter 
        if ($crop) {
            $query->where(function ($q) use ($crop) {
                $q->whereHas('crops', function ($q2) use ($crop) {
                    if (is_numeric($crop)) {
                        $q2->where('crops.id', $crop); 
                    } else {
                        $q2->whereRaw('LOWER(crops.name) = ?', [strtolower($crop)]);
                    }
                })
                ->orWhereDoesntHave('crops');
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
                ->orWhereDoesntHave('issues');
            });
        }

        // ordered by rank score 
        $recommendations = $query
            ->orderByDesc('rank_score')
            ->get(); 

        // fallback query if nothing matched
        if ($recommendations->isEmpty()) {
            $recommendations = Recommendation::with([
                'product.microbes',
                'soils',
                'crops',
                'issues',
            ])
            ->whereDoesntHave('soils')
            ->whereDoesntHave('crops')
            ->whereDoesntHave('issues')
            ->whereDoesntHave('rank_score')
            ->get();
        }

        return response()->json([
            'filters' => [
                'soil' => $soil,
                'crop' => $crop,
                'issue' => $issue,
            ],
            'count' => $recommendations->count(),
            'data' => $recommendations,
        ]);
    }
}
