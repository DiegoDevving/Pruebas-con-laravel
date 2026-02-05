<?php
use App\Models\User;

test('un administrador puede crear un nuevo usuario', function () {
    $admin = User::factory()->create();
    $role = \Spatie\Permission\Models\Role::create(['name' => 'admin']);

    $userData = [
        'name' => 'Nuevo Usuario',
        'email' => 'nuevo@ejemplo.com',
        'password' => 'password123',
        'password_confirmation' => 'password123',
        'id_number' => '987654321',
        'phone' => '555123456',
        'address' => 'Calle Falsa 123',
        'role_id' => $role->id,
    ];

    $response = $this->actingAs($admin)
        ->post(route('admin.users.store'), $userData);

    // Verificar redirección y existencia en BD
    $response->assertRedirect(route('admin.users.index'));
    $this->assertDatabaseHas('users', ['email' => 'nuevo@ejemplo.com']);
});
