<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Book;

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
        $book = Book::factory()->create();
        $updatedData = [
            "title" => "Título actualizado",
            "author" => "Autor actualizado",
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
