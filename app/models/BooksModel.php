<?php
class BookModel
{
    private $db;

    public function __construct()
    {
        // Obtiene la conexión a la base de datos desde la clase Database
        $db = new Database();
        $this->db = $db->getConnection();
    }

    public function getAllBooks()
    {
        // Lógica para obtener todos los libros de la base de datos
    }

    public function createNewBook($data)
    {
        // Lógica para crear un nuevo libro en la base de datos
    }

    public function updateBook($id, $data)
    {
        // Lógica para actualizar un libro en la base de datos por su ID
    }

    public function deleteBook($id)
    {
        // Lógica para eliminar un libro de la base de datos por su ID
    }
}
?>
