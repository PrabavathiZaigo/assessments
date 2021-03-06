<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Http\Request;

class ManagerController extends Controller
{
    public function create()
    {
        return View::make('backend.manager.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3|max:10',
            'email' => 'required|unique:users',
            'password' => 'required',
            'phone_number' => 'required|digits:10',
        ],[
            'name.required' => 'Enter your Name',
            'name.min' => 'Name should be atleast :min characters',
            'name.max' => 'Name should not be greater than :max characters',
            'email.required' => 'Enter Your email',
            'password.required' => 'Enter your password',
            'phone_number.required' => 'Enter your phone number',
        ]);
        $manager = new User;
        $manager->name=$request->name;
        $manager->email=$request->email;
        $manager->password=bcrypt($request->password);
        $manager->phone_number=$request->phone_number;
        $manager->role_id=config('roles.role.manager');
        $manager->save();
        return redirect()->route('managers.index')->with("success","Done");
    }
    public function index()
    {
        $model = User::orderBy('id','DESC')->where('role_id',config('roles.role.manager'))->paginate(config('roles.pagination'));
        return View::make('backend.manager.index',['model' =>$model]);

    }
    public function edit($id)
    {
        $data = User::find($id);
        return View::make('backend.manager.edit',['data' => $data]);
    }
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3|max:10',
            'email' => 'required|unique:users,email,'.$request->id,
            'password' => 'required',
            'phone_number' => 'required|digits:10',
        ],[
            'name.required' => 'Enter your Name',
            'name.min' => 'Name should be atleast :min characters',
            'name.max' => 'Name should not be greater than :max characters',
            'email.required' => 'Enter Your email',
            'password.required' => 'Enter your password',
            'phone_number.required' => 'Enter your phone number',
        ]);
        $update = User::find($request->id);
        $update->name=$request->name;
        $update->email=$request->email;
        $update->password=bcrypt($request->password);
        $update->phone_number=$request->phone_number;
        $update->role_id=config('roles.role.manager');
        $update->update();
        return redirect()->route('managers.index')->with("success","Done");
    }
    public function destroy($id)
    {
        $delete = User::find($id);
        if(!empty($delete)){
        $delete->delete();
        }
        return redirect()->route('managers.index')->with("success","Done");
    }
}
