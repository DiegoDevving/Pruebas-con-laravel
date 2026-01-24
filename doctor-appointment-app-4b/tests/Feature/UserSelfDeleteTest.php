<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

//Usamos la cualidad para refrescar DB entre test
uses(RefreshDatabase::class);

test('Un usuario no puede eliminarse a si mismo', function () {
    //1) Crear un usuario de prueba
    $user = User::factory()->create();

    //2) Simulamos que inicio sesion
    $this->actingAs($user, 'web');

    //3) Simulamos una peticion http delete
    $response = $this->delete(route('admin.users.destroy', $user));

    //4) Esperamos que el servidor bloquee la accion
    $response->assertStatus(403);

    //5) Verificar que el usuario sigue existiendo en BD
    $this->assertDatabaseHas('users', [
        'id' => $user->id
    ]);

});
