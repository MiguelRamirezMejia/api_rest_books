<?php
class UserModel
{
    private $db;

    public function __construct()
    {
        // Obtiene la conexión a la base de datos desde la clase Database
        $db = new Database();
        $this->db = $db->getConnection();
    }

    public function getAllUsers()
    {
        // Lógica para obtener todos los usuarios de la base de datos
    }

    public function createNewUser($data)
    {
        // Lógica para crear un nuevo usuario en la base de datos
    }

    public function updateUser($id, $data)
    {
        // Lógica para actualizar un usuario en la base de datos por su ID
    }

    public function deleteUser($id)
    {
        // Lógica para eliminar un usuario de la base de datos por su ID
    }
}
?>
