<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions; // Cambia esto
use App\Models\Proyecto;

class ProyectoTest extends TestCase
{
    use DatabaseTransactions; // Y esto

    /** @test */
    public function it_creates_a_project()
    {
        $data = [
            'nombre_proyecto' => 'Nuevo Proyecto',
            'descripcion_proyecto' => 'Descripción del proyecto',
        ];

        $response = $this->post('/api/proyectos', $data);

        $response->assertStatus(201);
        $this->assertDatabaseHas('proyectos', $data);
    }
}
