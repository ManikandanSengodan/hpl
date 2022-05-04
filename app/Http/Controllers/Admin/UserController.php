<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserRequest;
use App\Http\Requests\Auth\ChangePasswordRequest;
use App\Models\User;
use App\Models\Admin_address;
use DB;



use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(Request $request)
    {
//      $users = User::desc()->withTrashed();
      $users = User::desc();
      $users = $users->paginate(config("motorTraders.paginate.perPage"));

      return view("users.index", compact("users"));
    }

    public function create()
    {   
        return view("users.create");
    }

    public function store(UserRequest $request)
    {

        $user = User::create($request->all());
        $result = Admin_address::Insert(array(
            'admin_id' => $user->id,
            'fullname' => $request->name,
            'flatno' => $request->flatno,
            'apartment' => $request->apartment,
            'landmark' => $request->landmark,
            'area' => $request->area,
            'city' => $request->city,
            'state' => $request->state,
            'country' => $request->country,
            'zipcode' => $request->zipcode,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ));
       
        return redirect()
            ->route("users.index")
            ->with("success", "Admin created successfully.");
    }

    public function show(User $user)
    {
        $address = Admin_address::where('admin_id',$user->id)->first();
        return view("users.show", compact("user","address"));
    }

    public function edit(User $user)
    {
        $address = Admin_address::where('admin_id',$user->id)->first();
        return view("users.edit", compact("user","address"));
    }

    public function update(UserRequest $request, User $user)
    {
        $user->update($request->all());
        
        $result = Admin_address::where('admin_id', $user->id)->update(array(
            'fullname' => $request->name,
            'flatno' => $request->flatno,
            'apartment' => $request->apartment,
            'landmark' => $request->landmark,
            'area' => $request->area,
            'city' => $request->city,
            'state' => $request->state,
            'country' => $request->country,
            'zipcode' => $request->zipcode,
            'updated_at' => date('Y-m-d H:i:s')
        ));
        return redirect()
            ->route("users.index")
            ->with("warning", "Admin updated successfully");
    }

    public function destroy(User $user)
    {
        $user->delete(); 
        return redirect()
            ->route("users.index")
            ->with("danger", "Admin deleted successfully");
    }

    public function showChangePasswordForm()
    {
        $user = Auth::getUser();
        return view("users.change_password", compact("user"));
    }

    public function changePassword(ChangePasswordRequest $request)
    {
        $user = Auth::getUser();
        $user->update([
            "password" => $request->password,
        ]);

        return redirect()
            ->route("home")
            ->with(["info" => "Password changed successfully!"]);
    }
}
