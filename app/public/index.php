<?php
// public/index.php

// Obtén el método de solicitud (GET, POST, PUT, DELETE)
$method = $_SERVER['REQUEST_METHOD'];

// Obtén la URL actual
$requestUri = $_SERVER['REQUEST_URI'];

// Divide la URL en partes
$uriParts = explode('/', $requestUri);

// Definir un controlador predeterminado
$controller = 'BooksController'; // Controlador de libros por defecto

// Verifica el método de solicitud y la URL para determinar la acción
if ($method === 'GET') {
    if ($uriParts[1] === 'api') {
        if ($uriParts[2] === 'books') {
            if (isset($uriParts[3]) && is_numeric($uriParts[3])) {
                // Llamada a la acción para obtener un libro por ID
                $action = 'getBook';
            } else {
                // Llamada a la acción para listar todos los libros
                $action = 'listBooks';
            }
        } elseif ($uriParts[2] === 'users') {
            // Llamada a la acción para listar usuarios
            $controller = 'UsersController'; // Cambiar al controlador de usuarios
            $action = 'listUsers';
        }
    }
} elseif ($method === 'POST') {
    if ($uriParts[1] === 'api') {
        if ($uriParts[2] === 'books') {
            // Llamada a la acción para crear un nuevo libro
            $action = 'createBook';
        } elseif ($uriParts[2] === 'users') {
            // Llamada a la acción para crear un nuevo usuario
            $controller = 'UsersController'; // Cambiar al controlador de usuarios
            $action = 'createUser';
        }
    }
}

// Resto del código para incluir el controlador y llamar a la acción

// Incluye el archivo del controlador
require_once('../app/controllers/' . $controller . '.php');

// Crea una instancia del controlador y llama a la acción
$controllerInstance = new $controller();
$controllerInstance->$action();
