<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UserEditRequest;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users = DB::table('users')->paginate(15);
        return view('users.index', ['users' => $users]);
    }

    public function getUsers(): View
    {
        $users = DB::table('users')->paginate(15);
        return view('users.index', ['users' => $users]);
    }

    public function createUserPage()
    {
        return view('users.create');
    }

    public function createUser(UserRequest $request)
    {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role ?? 'cashier',
            'password' => Hash::make($request->password)
        ]);

        return redirect('/admin/users')->with('status', [
            'type' => 'success',
            'message' => 'User successfully created'
        ]);
    }

    public function editUserPage($id)
    {
        $user = User::where('id', $id)->get();
        return view('users.edit', ['user' => $user]);
    }

    public function updateUser(UserEditRequest $request)
    {
        User::find($request->id)->update($request->all());
        return redirect('/admin/users')->with('status', [
            'type' => 'success',
            'message' => 'User successfully updated'
        ]);
    }

    public function deleteUser($id)
    {
        DB::table('users')->delete($id);
        return back()->with('status', [
            'type' => 'success',
            'message' => 'User successfully deleted'
        ]);
    }
}
