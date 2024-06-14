<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Hash;
use Spatie\Permission\Models\Role;
use DB;
use Illuminate\Support\Arr;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public static function middleware(): array
    {
        return [
            new Middleware('permission:user-list|user-create|user-edit|user-delete', only: ['index', 'store']),
            new Middleware('permission:user-create', only: ['create', 'store']),
            new Middleware('permission:user-edit', only: ['edit', 'update']),
            new Middleware('permission:user-delete', only: ['destroy']),
        ];
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('user-list');

        $users = User::latest()->paginate(10);
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('user-create');
        $roles = Role::pluck('name','name')->all();
    
        return view('users.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Gate::authorize('user-create');

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'roles' => 'required'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        $user->assignRole($request->input('roles'));

        return redirect()
            ->route('users.index')
            ->with('message', 'New user created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        Gate::authorize('user-list', $user);

        $user = User::find($id);
        return view('users.show',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        Gate::authorize('user-edit', $user);

        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();
    
        return view('users.edit',compact('user','roles','userRole'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        Gate::authorize('user-edit', $user);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
            'roles' => 'required'
        ]);

        $user->name = $request->name;
        $user->email = $request->email;

        if (! empty($request->get('password'))) {
            $user->password = Hash::make($request->password);
        }
        $user->save();

        DB::table('model_has_roles')->where('model_id',$user->id)->delete();
        $user->assignRole($request->input('roles'));

        return redirect()
            ->route('users.index')
            ->with('message', 'User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        Gate::authorize('user-delete', $user);

        $user->delete();
        return redirect()
            ->route('users.index')
            ->with('message', 'User deleted successfully');
    }
}
