<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    public function testUserCanLogin()
    {
        // Datos de inicio de sesión
        $credentials = [
            'email' => 'lesujuca@gmail.com',
            'password' => 'password',
        ];

        // Hacer una solicitud POST a la ruta de inicio de sesión
        $response = $this->post('/api/login', $credentials);

        // Verificar que el usuario fue autenticado y redirigido
        $response->assertStatus(302);
        $this->assertAuthenticatedAs($user);
    }
}