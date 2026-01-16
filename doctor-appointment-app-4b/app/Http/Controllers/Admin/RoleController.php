<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.roles.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.roles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        /**Validar que se cree bien**/
        $request->validate(['name' => 'required|unique:roles,name']);
        /** Si pasa la validacion, creara el rol */
        Role::create(['name' => $request->name]);

        /** Variable de un solo uso para alerta */
        return redirect()->route('admin.roles.index')->with('swal', [
            'icon' => 'success',
            'title' => 'Rol creado correctamente',
            'text' => 'El rol ha sido creado exitosamente'
        ]);
        /**session()->flash('swal',
        [
           'icon' => 'success',
           'title' => 'Role creado correctamente',
           'text' => 'El rol ha sido creado exitosamente'
        ]);*/

        /** Rediccionara a la tabla principal
        return redirect()->route('admin.roles.index')
            ->with('success','Role created succesfully');
         */
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
