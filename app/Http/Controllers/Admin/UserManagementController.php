<?php

namespace App\Http\Controllers\Admin;
use App\Models\User;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class UserManagementController extends Controller
{

    public function index(Request $request)
    {
        return view('admin.user-management.index', [
            'users' => User::when($request->role, function ($query) use ($request) {
                return $query->where('role', $request->role);
            })->when($request->status, function ($query) use ($request) {
                return $query->where('status', $request->status);
            })->when($request->email, function ($query) use ($request) {
                return $query->where('email', $request->email);
            })->orderby("id", "desc")->paginate(20),
        ]);
    }

    public function create(){
        return view('admin.user-management.create');
    }

    public function store(Request $request) {

        $request->validate([
            'email' => 'required|email|unique:users,email',
        ]);

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->role = $request->role;
        $user->status = $request->status;
        $user->save();

        return redirect()->route('admin.user.index')->with('message', 'User has been added successfully.');
    }

    public function edit($id){
        $user = User::where('id',$id)->first();

        return view('admin.user-management.edit',['user'=> $user]);

     }

    public function update(Request $request,$id){
        $user = User::where('id',$id)->first();

        $user->name = $request->name;
        $user->email = $request->email;
        $user->status = $request->status;
        // $user->password = $request->password;

        $user->save();


        return redirect()->route('admin.user.index')->with('message', 'User has been updated successfully.');
    }

    public function destroy($id){
        $user = User::where('id',$id)->first();
         $user->delete();

         return redirect()->route('admin.user.index')->with('message', 'User has been Deleted successfully.');

     }




}
