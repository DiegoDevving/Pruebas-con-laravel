<?php
use App\Models\User;
test('un administrador puede ver el listado de usuarios', function () {
    // 1) Crear un administrador y otros usuarios
    $admin = User::factory()->create();
    $user = User::factory()->create(['name' => 'Gato Curandero']);

    // 2) Actuar como admin y visitar el index
    $response = $this->actingAs($admin)
        ->get(route('admin.users.index'));

    // 3) Verificar éxito y que el nombre aparece en pantalla
    $response->assertStatus(200);
    $response->assertSee('Gato Curandero');
});
