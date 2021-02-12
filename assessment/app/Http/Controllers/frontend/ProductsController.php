<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index()
    {
        $product = Product::orderBy('id','DESC')->paginate(config('roles.pagination'));
        return View::make('frontend.products',['product' =>$product]);
    }
    public function create()
    {
       return View::make('frontend.create');
    }
}
