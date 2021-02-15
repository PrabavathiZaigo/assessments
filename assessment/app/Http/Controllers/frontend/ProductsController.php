<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\User;
use App\Models\Address;
use Carbon\Carbon;
use Auth;
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
    public function store(Request $request)
    {
        //$product = User::all();
        //$id = Auth::user()->id;
        $id=auth()->user()->id;
        $product = new Address;
        $product->user_id=$id;
        $product->address=$request->address;
        $product->save();
        return redirect()->route('index')->with("success","Done"); 
    }
}
