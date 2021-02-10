
@extends('backend.layouts.app')

@section('content')
<h2>List</h2>
<form action="{{route('customers.create')}}" method="">
@csrf
<input type="submit" value="add customer" class="btn btn-info mb-3"/>
</form>
<table border='2'>
    <tr>
        <th>Id</th>
        <th>Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Role Id</th>
        <th>Operation</th>
        <th>Operation</th>
    </tr>
@forelse($model as $k => $model1) 

<tr>
    <td>{{$model1->id}}</td>
    <td>{{$model1->name}}</td>
    <td>{{$model1->email}}</td>
    <td>{{$model1->phone_number}}</td>
    <td>{{$model1->role_id}}</td>
    <td><a href="{{route('managers.edit',['id' => $model1['id']])}}">Edit</a></td>
    <td><form action="{{route('managers.destroy',['id' => $model1['id']])}}" method="post">
    @csrf
    @method('DELETE')
    <input type="submit" value="delete" /></form></td></tr>
    </tr>
    
    @empty
    
@endforelse
</table>

{{$model -> links()}}
@endsection
  


    