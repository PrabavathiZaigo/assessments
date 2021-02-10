<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function create()
    {
        return View::make('backend.customer.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ],[
            'name.required' => 'Enter your Name',
            'email.required' => 'Enter Your email',
            'password.required' => 'Enter your password'
        ]);
        $customer = new User;
        $customer->name=$request->name;
        $customer->email=$request->email;
        $customer->password=bcrypt($request->password);
        $customer->phone_number=$request->phone_number;
        $customer->role_id=config('roles.role.user');
        $customer->save();
        return redirect()->route('customers.index');
    }
    public function index()
    {
        $model = User::orderBy('id','DESC')->paginate(5);
        return View::make('backend.customer.index',['model' =>$model]);

    }
    public function edit($id)
    {
        $data = User :: find($id);
        return View::make('backend.customer.edit',['data' => $data]);
    }
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ],[
            'name.required' => 'Enter your Name',
            'email.required' => 'Enter Your email',
            'password.required' => 'Enter your password'
        ]);
        $update = User :: find($request->id);
        $update->name=$request->name;
        $update->email=$request->email;
        $update->password=bcrypt($request->password);
        $update->phone_number=$request->phone_number;
        $update->role_id=config('roles.role.user');
        $update->update();
        return redirect()->route('customers.index');
    }
    public function destroy($id)
    {
        $delete = User :: find($id);
        $delete->delete();
        return redirect()->route('customers.index')->with("success","Done");
    }
}
