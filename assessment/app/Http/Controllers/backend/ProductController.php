<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function create()
    {
        return View::make('backend.product.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'product_name' => 'required|min:3|max:10',
            'sku' =>'required',
            'quantity' => 'required',
            'product_image' => 'required|mimes:jpg,png,gif,svg,jpeg|max:2048'
        ],[
            'product_name.required' => 'Enter your ProductName',
            'product_name.min' => 'ProductName should be atleast :min characters',
            'product_name.max' => 'ProductName should not be greater than :max characters',
            'sku.required' => 'Enter your Sku',
            'quantity.required' => 'Enter Your Quantity',
            'product_image.required' => 'Please Upload the Image',
            'product_image.mimes' => 'supported files are PDF,docx,xlsx,xls',
        ]);
        $timeStamp=Carbon::now()->format('Y_m_d_H_i_s');
        $fileExtension=$request->product_image->extension();
        $fileName = $timeStamp.'.'.$fileExtension;
        $request->product_image->storeAs('public/images', $fileName);
        $product = new Product;
        $product->product_name=$request->product_name;
        $product->sku=$request->sku;
        $product->quantity=$request->quantity;
        $product->product_image=$fileName;
        $product->save();
        return redirect()->route('products.index')->with("success","Done");
    }
    public function index()
    {
        $product = Product::orderBy('id','DESC')->paginate(config('roles.pagination'));
        return View::make('backend.product.index',['product' =>$product]);
    }
    public function edit($id)
    {
        $data = Product::find($id);
        return View::make('backend.product.edit',['data' => $data]);
    }
    public function update(Request $request)
    {
        $request->validate([
            'product_name' => 'required|min:3|max:10',
            'sku' =>'required',
            'quantity' => 'required',
            'product_image' => 'required|mimes:jpg,png,gif,svg,jpeg|max:2048'
        ],[
            'product_name.required' => 'Enter your ProductName',
            'product_name.min' => 'ProductName should be atleast :min characters',
            'product_name.max' => 'ProductName should not be greater than :max characters',
            'sku.required' => 'Enter your Sku',
            'quantity.required' => 'Enter Your Quantity',
            'product_image.required' => 'Please Upload the Image',
            'product_image.mimes' => 'supported files are PDF,docx,xlsx,xls',
        ]);
        $timeStamp=Carbon::now()->format('Y_m_d_H_i_s');
        $fileExtension=$request->product_image->extension();
        $fileName = $timeStamp.'.'.$fileExtension;
        $request->product_image->storeAs('public/images', $fileName);
        $product = Product::find($request->id);
        $product->product_name=$request->product_name;
        $product->sku=$request->sku;
        $product->quantity=$request->quantity;
        $product->product_image=$fileName;
        $product->update();
        return redirect()->route('products.index')->with("success","Done");

    }
    public function destroy($id)
    {
        $delete = Product::find($id);
        if(!empty($delete)){
        $delete->delete();
        }
        return redirect()->route('products.index')->with("success","Done");
    }
}
