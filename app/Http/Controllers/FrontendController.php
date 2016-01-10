<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class FrontendController extends Controller
{
    public function index()
    {
        $products = Product::getAllProduct(IS_PAGINATE);

        return view('front.index', compact('products'));
    }
}
