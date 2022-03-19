<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Price;

class PriceController extends Controller
{
    /**
     * Get Prices
     */
    public function index()
    {
        $prices = Price::all();
        return view('price', compact('prices'));
    }
}
