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
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ],[
            'name.required' => 'Enter your Name',
            'email.required' => 'Enter Your email',
            'password.required' => 'Enter your password'
        ]);
        $manager = new User;
        $manager->name=$request->name;
        $manager->email=$request->email;
        $manager->password=bcrypt($request->password);
        $manager->phone_number=$request->phone_number;
        $manager->role_id=config('roles.role.manager');
        $manager->save();
        return redirect()->route('managers.index');
    }
    public function index()
    {
        $model = User::orderBy('id','DESC')->paginate(5);
        return View::make('backend.manager.index',['model' =>$model]);

    }
    public function edit($id)
    {
        $data = User :: find($id);
        return View::make('backend.admin.edit',['data' => $data]);
    }
    public function update()
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
        $update->role_id=config('roles.role.manager');
        $update->update();
        return redirect()->route('managers.index');
    }
    public function destroy($id)
    {
        $delete = User :: find($id);
        $delete->delete();
        return redirect()->route('managers.index')->with("success","Done");
    }
}
