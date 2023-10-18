<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Book; // Asegúrate de importar la clase Book
use Illuminate\Database\Eloquent\Factories\Factory; // Asegúrate de importar la clase Factory


class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function testPuedeMostrarListaDeBooks()
    {
        $response = $this->get('/api/books');
        $response->assertStatus(200);
    }

    public function testPuedeRegistrarUnBook()
    {
        $bookData = [
            "title" => "Prueba",
            "author" => "Autor de Prueba",
            "gender" => "Género de Prueba",
            "synopsis" => "Sinopsis de Prueba",
            "any_publication" => "2023",
        ];

        $response = $this->post('/api/books', $bookData);
        $response->assertStatus(201);
        $response->assertJson($bookData);
    }

    public function testPuedeMostrarUnBook()
    {
        $book = Book::factory()->create();
        $response = $this->get('/api/books/' . $book->id);
        $response->assertStatus(200);
        $response->assertJson($book->toArray());
    }

    public function testPuedeActualizarUnBook()
    {
        $book = new Book([
            'title' => 'Nuevo título',
            'author' => 'Nuevo autor',
            'gender' => 'Género',
            'synopsis' => 'Descripción',
            'any_publication' => 2023,
        ]);
    
        $book->save();
    
        $updatedData = [
            'title' => 'Título actualizado',
            'author' => 'Autor actualizado',
            'gender' => 'Género actualizado',
            'synopsis' => 'Descripción actualizada',
            'any_publication' => 2023,
        ];
    
        $response = $this->put('/api/books/' . $book->id, $updatedData);
    
        $response->assertStatus(200);
        $response->assertJson($updatedData);
    }
    
    

    public function testPuedeEliminarUnBook()
    {
        $book = Book::factory()->create();
        $response = $this->delete('/api/books/' . $book->id);
        $response->assertStatus(204);
        $this->assertDatabaseMissing('books', ['id' => $book->id]);
    }
}
