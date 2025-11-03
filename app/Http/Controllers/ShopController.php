<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index()
    {
        // here to add products later 
        return view('pages.shop.index');
    }
}
