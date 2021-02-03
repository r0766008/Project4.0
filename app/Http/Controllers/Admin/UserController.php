<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\Truck;
use App\Models\User;
use App\Models\UserTruck;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::with('role')->paginate(10);

        return view('admin.users.index', compact('users'))
            ->with('i', (request()->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'license_plate' => ['required', 'string'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'role_id' => ['required'],
        ]);

        $validator->after(function($validator) {
            $truck = Truck::where('license_plate', request()->license_plate)->get();
            if ($truck->count() == 0) {
                $validator->errors()->add('license_plate', 'This license plate is non-existent in our database.');
            }
        });

        if ($validator->fails()) {
            return redirect('admin/users/create')
                ->withErrors($validator)
                ->withInput();
        }
        $truck = Truck::where('license_plate', request()->license_plate)->get();

        $user = User::create([
            'name' => request()->name,
            'email' => request()->email,
            'role_id' => request()->role_id,
            'password' => Hash::make(request()->password),
        ]);

        UserTruck::create([
            'user_id' => $user->id,
            'truck_id' => $truck[0]->id,
            'created_at' => now()
        ]);

        return redirect()->route('users.index')
            ->with('success', 'User has successfully been created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $roles = Role::all();
        return view('admin.users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$user->id],
            'role_id' => ['required'],
        ]);

        $user->update($request->all());

        return redirect()->route('users.index')
            ->with('success', 'User has successfully been updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index')
            ->with('success', 'User has successfully been deleted.');
    }
}
