@extends('backend.layouts.app')

@section('content')
<h2>List</h2>
<form action="{{route('products.create')}}" method="">
@csrf
<input type="submit" value="add product" class="btn btn-info mb-3"/>
</form>
<table border='2'>
    <tr>
        <th>Id</th>
        <th>Product Name</th>
        <th>Sku</th>
        <th>Quantity</th>
        <th>Product Image</th>
        <th>Operation</th>
        <th>Operation</th>
    </tr>
@forelse($product as $k => $products) 

<tr>
    <td>{{$products->id}}</td>
    <td>{{$products->product_name}}</td>
    <td>{{$products->sku}}</td>
    <td>{{$products->quantity}}</td>
    <td>
    @if(strpos($products->product_image, '.jpg') !== false || strpos($products->product_image, '.gif') !== false || strpos($products->product_image, '.png') !== false || strpos($products->product_image, '.jpeg') !== false || strpos($products->product_image, '.svg') !== false)
    <img  src="{{ asset('storage/images/'.$products->product_image) }}" style="width:10%;  height:30px; border-radius: 50%"/>
    @endif
    </td>
    <td><a href="{{route('products.edit',['id' => $products['id']])}}">Edit</a></td>
    <td><form action="{{route('products.destroy',['id' => $products['id']])}}" method="post">
    @csrf
    @method('DELETE')
    <input type="submit" value="delete" /></form></td></tr>
    </tr>
    
    @empty
    
@endforelse
</table>

{{$product -> links()}}
@endsection
