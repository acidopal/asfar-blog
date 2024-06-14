<?php
    
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Gate;
    
class RoleController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public static function middleware(): array
    {
        return [
            new Middleware('permission:role-list|role-create|role-edit|role-delete', only: ['index', 'store']),
            new Middleware('permission:role-create', only: ['create', 'store']),
            new Middleware('permission:role-edit', only: ['edit', 'update']),
            new Middleware('permission:role-delete', only: ['destroy']),
        ];
    }

     /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        Gate::authorize('role-list');

        $roles = Role::orderBy('id','ASC')->paginate(10);
        return view('roles.index',compact('roles'));
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create(){
        Gate::authorize('role-create');

        $permission = Permission::get();
        return view('roles.create', compact('permission'));
    }
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request){
        Gate::authorize('role-create');

        $request->validate([
            'name' => 'required|unique:roles,name',
            'permission' => 'required',
        ]);

        $permissionsID = array_map(
            function($value) { return (int)$value; },
            $request->input('permission')
        );
    
        $role = Role::create(['name' => $request->input('name')]);
        $role->syncPermissions($permissionsID);
    
        return redirect()->route('roles.index')
                        ->with('success','Role created successfully');
    }
    
    /**
     * Display the specified resource.
     */
    public function show(Role $role){
        Gate::authorize('role-list', $user);

        $rolePermissions = Permission::join("role_has_permissions","role_has_permissions.permission_id","=","permissions.id")
            ->where("role_has_permissions.role_id",$role->id)
            ->get();
    
        return view('roles.show',compact('role','rolePermissions'));
    }
    
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role){
        Gate::authorize('role-edit');

        $permission = Permission::get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id", $role->id)
            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
            ->all();
    
        return view('roles.edit',compact('role','permission','rolePermissions'));
    }
    
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role){
        Gate::authorize('role-edit');

        $request->validate([
            'name' => 'required',
            'permission' => 'required',
        ]);
    
        $role->name = $request->input('name');
        $role->save();

        $permissionsID = array_map(
            function($value) { return (int)$value; },
            $request->input('permission')
        );
    
        $role->syncPermissions($permissionsID);
    
        return redirect()->route('roles.index')
                        ->with('success','Role updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role){
        Gate::authorize('role-delete');

        DB::table("roles")->where('id',$role->id)->delete();
        return redirect()->route('roles.index')
                        ->with('success','Role deleted successfully');
    }
}