
<?php

class BookModel
{
    private $db;

    public function __construct()
    {
        // Obtener la conexión a la base de datos desde la clase Database
        $db = new Database();

        $this->db = $db->getConnection();
    }

    public function getAllBooks()
    {
        // Consulta SQL para obtener todos los libros
        $query = "SELECT * FROM books";

        // Preparar la consulta
        $stmt = $this->db->prepare($query);

        // Ejecutar la consulta
        $stmt->execute();

        // Obtener y devolver todos los libros como un arreglo asociativo
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createNewBook($data)
    {

        // Validar y sanitizar los datos de entrada
        $errors = [];

        // Validación del título (ejemplo: campo obligatorio y longitud máxima)
        if (empty($data['title'])) {
            $errors[] = 'El título es obligatorio.';
        } elseif (strlen($data['title']) > 255) {
            $errors[] = 'El título no puede superar los 255 caracteres.';
        }

        // Validación del autor (ejemplo: campo obligatorio y longitud máxima)
        if (empty($data['author'])) {
            $errors[] = 'El autor es obligatorio.';
        } elseif (strlen($data['author']) > 100) {
            $errors[] = 'El nombre del autor no puede superar los 100 caracteres.';
        }

        // Validación de la sinopsis (ejemplo: longitud máxima)
        if (strlen($data['synopsis']) > 1000) {
            $errors[] = 'La sinopsis no puede superar los 1000 caracteres.';
        }

        // Validación del género (ejemplo: campo obligatorio)
        if (empty($data['gender'])) {
            $errors[] = 'El género es obligatorio.';
        }

        // Validación del año de publicación (ejemplo: formato de año válido y no es una fecha futura)
        if (!empty($data['any_publication'])) {
            if (!preg_match('/^\d{4}$/', $data['any_publication'])) {
                $errors[] = 'El año de publicación debe ser un año válido en formato de cuatro dígitos.';
            } else {
                $currentYear = date('Y'); // Obtener el año actual
                if ($data['any_publication'] > $currentYear) {
                    $errors[] = 'El año de publicación no puede ser una fecha futura.';
                }
            }
        }

        // Verificar si hubo errores de validación
        if (!empty($errors)) {
            // Si hay errores, puedes devolverlos para su manejo en el controlador
            return $errors;
        }


        // Consulta SQL para insertar un nuevo libro
        $query = "INSERT INTO books (title, author, synopsis, gender, any_publication) VALUES (:title, :author, :synopsis, :gender, :any_publication)";

        // Preparar la consulta
        $stmt = $this->db->prepare($query);

        // Enlazar los parámetros
        $stmt->bindParam(':title', $data['title']);
        $stmt->bindParam(':author', $data['author']);
        $stmt->bindParam(':synopsis', $data['synopsis']);
        $stmt->bindParam(':gender', $data['gender']);
        $stmt->bindParam(':any_publication', $data['any_publication']);


        // Ejecutar la consulta
        if ($stmt->execute()) {
            return true; // Éxito al crear el libro
        } else {
            return false; // Error al crear el libro
        }
    }

    public function updateBook($id, $data)
    {
        // Validar y sanitizar los datos de entrada

        $errors = [];

        // Validación del título (ejemplo: campo obligatorio y longitud máxima)
        if (empty($data['title'])) {
            $errors[] = 'El título es obligatorio.';
        } elseif (strlen($data['title']) > 255) {
            $errors[] = 'El título no puede superar los 255 caracteres.';
        }
    
        // Validación del autor (ejemplo: campo obligatorio y longitud máxima)
        if (empty($data['author'])) {
            $errors[] = 'El autor es obligatorio.';
        } elseif (strlen($data['author']) > 100) {
            $errors[] = 'El nombre del autor no puede superar los 100 caracteres.';
        }
    
        // Validación de la sinopsis (ejemplo: longitud máxima)
        if (strlen($data['synopsis']) > 1000) {
            $errors[] = 'La sinopsis no puede superar los 1000 caracteres.';
        }
    
        // Validación del género (ejemplo: campo obligatorio)
        if (empty($data['gender'])) {
            $errors[] = 'El género es obligatorio.';
        }
    
        // Validación del año de publicación (ejemplo: formato de año válido y no es una fecha futura)
        if (!empty($data['any_publication'])) {
            if (!preg_match('/^\d{4}$/', $data['any_publication'])) {
                $errors[] = 'El año de publicación debe ser un año válido en formato de cuatro dígitos.';
            } else {
                $currentYear = date('Y'); // Obtener el año actual
                if ($data['any_publication'] > $currentYear) {
                    $errors[] = 'El año de publicación no puede ser una fecha futura.';
                }
            }
        }
    
        // Verificar si hubo errores de validación
        if (!empty($errors)) {
            // Si hay errores, puedes devolverlos para su manejo en el controlador
            return $errors;
        }




        // Consulta SQL para actualizar un libro por su ID
        $query = "UPDATE books SET title = :title, author = :author, synopsis = :synopsis, gender = :gender, any_publication = :any_publication WHERE id = :id";

        // Preparar la consulta
        $stmt = $this->db->prepare($query);

        // Enlazar los parámetros
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':title', $data['title']);
        $stmt->bindParam(':author', $data['author']);
        $stmt->bindParam(':synopsis', $data['synopsis']);
        $stmt->bindParam(':gender', $data['gender']);
        $stmt->bindParam(':any_publication', $data['any_publication']);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            return true; // Éxito al actualizar el libro
        } else {
            return false; // Error al actualizar el libro
        }
    }

    public function deleteBook($id)
    {
        // Consulta SQL para eliminar un libro por su ID
        $query = "DELETE FROM books WHERE id = :id";

        // Preparar la consulta
        $stmt = $this->db->prepare($query);

        // Enlazar el parámetro
        $stmt->bindParam(':id', $id);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            return true; // Éxito al eliminar el libro
        } else {
            return false; // Error al eliminar el libro
        }
    }


    public function getBookById($id)
    {
        // Consulta SQL para obtener un libro por su ID
        $query = "SELECT * FROM books WHERE id = :id";
    
        // Preparar la consulta
        $stmt = $this->db->prepare($query);
    
        // Enlazar el parámetro
        $stmt->bindParam(':id', $id);
    
        // Ejecutar la consulta
        $stmt->execute();
    
        // Obtener y devolver el libro como un arreglo asociativo
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    





}


?>