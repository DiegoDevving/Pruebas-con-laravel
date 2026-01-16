<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User; // si usas el modelo por defecto
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all(); // puedes paginar más adelante
        return view('admin.users.index', compact('users'));
    }
    //Cosas pegadas de role controller aqui abajo
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();
        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|min:3|max:255',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'id_number' => 'required|string|min:5|max:20|regex:/^[A-Za-z0-9\-]+$/|unique:users',
            'phone' => 'required|digits_between:7,15',
            'address' => 'required|string|min:3|max:255',
            'role_id' => 'required|exists:roles,id'
        ]);
        $user =User::create($data);
        $user->roles()->attach($data['role_id']);

        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Usuario creado',
            'text' => 'El usuario ha sido creado exitosamente'
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User created successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        /** Restrigir la accion para los primeros 4 roles fijos */
        if ($role->id <=4){
            session()->flash('swal',
                [
                    'icon' => 'error',
                    'title' => 'Error',
                    'text' => 'No puedes editar este rol.'
                ]);
            return redirect()->route('admin.roles.index');
        }
        return view('admin.roles.edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        /**Validar que se inserte bien */
        $request->validate(['name' => 'required|unique:roles,name,' . $role->id]);

        /** SI el campo no cambio, no actualices */
        if($role->name === $request->name){
            session()->flash('swal',
                [
                    'icon' => 'info',
                    'title' => 'Sin cambios',
                    'text' => 'No se detectaron modificaciones.'
                ]);
            /** redireccion al mismo lugar */
            return redirect()->route('admin.roles.edit', $role);
        }
        /** Si pasa la validacion, editara el rol */
        $role->update(['name'=> $request->name]);

        /** Variable de un solo uso para alerta */
        return redirect()->route('admin.roles.index')->with('swal', [
            'icon' => 'success',
            'title' => 'Rol actualizado correctamente',
            'text' => 'El rol ha sido actualizado exitosamente'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        /** Restrigir la accion para los primeros 4 roles fijos */
        if ($role->id <=4){
            session()->flash('swal',
                [
                    'icon' => 'error',
                    'title' => 'Error',
                    'text' => 'No puedes eliminar este rol.'
                ]);
            return redirect()->route('admin.roles.index');
        }

        /** Borrar el elemento */
        $role->delete();

        /** Alerta */
        session()->flash('swal',
            [
                'icon' => 'success',
                'title' => 'Role eliminado correctamente',
                'text' => 'El rol ha sido eliminado exitosamente.'
            ]);

        /** redireccion al mismo lugar */
        return redirect()->route('admin.roles.index');
    }
}
