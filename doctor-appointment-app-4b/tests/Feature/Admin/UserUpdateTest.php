<?php
use App\Models\User;

test('un administrador puede editar un usuario existente', function () {
    // 1) Preparación: Crear Admin, Usuario a editar y un Rol
    $admin = User::factory()->create(['id_number' => 'ADM-01', 'phone' => '1111111111']);
    $user = User::factory()->create(['name' => 'Nombre Antiguo', 'id_number' => 'USR-01', 'phone' => '2222222222']);

    // Necesitamos un rol real en la base de datos de prueba
    $role = \Spatie\Permission\Models\Role::create(['name' => 'editor']);

    // 2) DEFINIR LA VARIABLE (Esto es lo que faltaba)
    $newData = [
        'name' => 'Nombre Actualizado',
        'email' => $user->email, // Mantenemos el mismo email
        'id_number' => 'ID-NUEVO-99',
        'phone' => '3333333333',
        'address' => 'Nueva Dirección 456',
        'role_id' => $role->id,
    ];

    // 3) Ejecución: Hacer la petición PUT
    $response = $this->actingAs($admin)
        ->put(route('admin.users.update', $user), $newData);

    // 4) Verificaciones
    $response->assertRedirect(route('admin.users.edit', $user));

    // Comprobar que en la base de datos el nombre cambió realmente
    $this->assertDatabaseHas('users', [
        'id' => $user->id,
        'name' => 'Nombre Actualizado',
        'address' => 'Nueva Dirección 456'
    ]);
});
