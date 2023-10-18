<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

/**
* @OA\Info(
*             title="API Books", 
*             version="1.0",
*             description="Requisitos para Ejecutar la API Laravel 10: PHP 8 o Superior: Asegúrate de tener PHP versión 8.0 o superior instalado en tu sistema. Puedes verificar la versión de PHP ejecutando php -v. Composer: Instala Composer, una herramienta esencial para gestionar las dependencias de Laravel. Puedes descargar Composer desde getcomposer.org. Base de Datos MySQL:  Esta API Laravel utiliza MySQL como base de datos. Debes tener una instancia de MySQL configurada y accesible. Asegúrate de tener los detalles de conexión a la base de datos, como la dirección, el nombre de usuario y la contraseña."
* )
*
* @OA\Server(url="http://localhost:8000/")
*/
class BookController extends Controller
{
    
/**
     * Mostrar Lista de Books
     * @OA\Get (
     *     path="/api/books",
     *     tags={"Book"},
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 type="array",
     *                 property="rows",
     *                 @OA\Items(
     *                     type="object",
     *                     @OA\Property(
     *                         property="id",
     *                         type="number",
     *                         example="1"
     *                     ),
     *                     @OA\Property(
     *                         property="title",
     *                         type="string",
     *                         example="100 años de Soledad"
     *                     ),
     *                     @OA\Property(
     *                         property="author",
     *                         type="string",
     *                         example="Gabriel García Marquez"
     *                     ),
     *                     @OA\Property(
     *                         property="gender",
     *                         type="string",
     *                         example="Novela"
     *                     ),
     *                     @OA\Property(
     *                         property="Synopsis",
     *                         type="string",
     *                         example="Cien años de soledad es una obra maestra de la literatura escrita por Gabriel García Márquez. La novela narra la historia de la familia Buendía a lo largo de varias generaciones en el pueblo ficticio de Macondo. Combina elementos de realismo mágico con una narrativa envolvente para explorar temas de amor, soledad, poder y destino. A lo largo de la historia, los personajes enfrentan desafíos extraordinarios en un mundo donde lo cotidiano y lo sobrenatural se entrelazan. La obra es un viaje a través del tiempo y la memoria de una familia, una comunidad y un continente, y es considerada una de las obras más influyentes de la literatura en español del siglo XX."
     *                     ),
     *                     @OA\Property(
     *                         property="any_publication",
     *                         type="string",
     *                         example="1967"
     *                     ),
     *                     @OA\Property(
     *                         property="create_at",
     *                         type="string",
     *                         example="2023-10-18 14:19:40"
     *                     ),
     *                      @OA\Property(
     *                         property="update_at",
     *                         type="string",
     *                         example="2023-10-18 14:19:40"
     *                     ),
     *                    
     *                 )
     *             )
     *         )
     *     )
     * )
     */
    public function index()
    {
        return Book::all();
    }

        /**
     * Registrar la información de un nuevo Book
     * @OA\Post (
     *     path="/api/books",
     *     tags={"Book"},
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                      type="object",
     *                      @OA\Property(
     *                          property="title",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="author",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="gender",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="synopsis",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="any_publication",
     *                          type="string"
     *                      )
     *                 ),
     *                 example={
     *                     "title":"100 años de Soledad",
     *                     "author":"Gabriel García Márquez",
     *                     "gender":"Novela",
     *                     "synopsis":"Cien años de soledad es una obra maestra de la literatura escrita por Gabriel García Márquez. La novela narra la historia de la familia Buendía a lo largo de varias generaciones en el pueblo ficticio de Macondo. Combina elementos de realismo mágico con una narrativa envolvente para explorar temas de amor, soledad, poder y destino. A lo largo de la historia, los personajes enfrentan desafíos extraordinarios en un mundo donde lo cotidiano y lo sobrenatural se entrelazan. La obra es un viaje a través del tiempo y la memoria de una familia, una comunidad y un continente, y es considerada una de las obras más influyentes de la literatura en español del siglo XX.",
     *                     "any_publication":"1967"
     *                }
     *             )
     *         )
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="CREATED",
     *          @OA\JsonContent(
     *              @OA\Property(property="id", type="number", example=1),
     *              @OA\Property(property="title", type="string", example="100 años de Soledad"),
     *              @OA\Property(property="author", type="string", example="Gabriel García Márquez"),
     *              @OA\Property(property="gender", type="string", example="Novela"),
     *              @OA\Property(property="any_publication", type="string", example="1967"),
     *              @OA\Property(property="created_at", type="string", example="2023-10-18 14:19:40"),
     *              @OA\Property(property="updated_at", type="string", example="2023-10-18 14:19:40")
     *          )
     *      )
     *      
     * )
     */
    public function store(Request $request)
{
    $book = new Book();
    $book->title = $request->title;
    $book->author = $request->author;
    $book->gender = $request->gender;
    $book->synopsis = $request->synopsis;
    $book->any_publication = $request->any_publication;
    $book->save();

    // Retornar una redirección con un mensaje de éxito
    return redirect('/api/books')->with('success', 'Libro creado correctamente');
}


    /**
     * Mostrar la información de un book
     * @OA\Get (
     *     path="/api/books/{id}",
     *     tags={"Book"},
     *     @OA\Parameter(
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(
     *              @OA\Property(property="id", type="number", example=1),
     *              @OA\Property(property="title", type="string", example="100 años de Soledad"),
     *              @OA\Property(property="author", type="string", example="Gabriel García Márquez"),
     *              @OA\Property(property="gender", type="string", example="Novela"),
     *              @OA\Property(property="any_publication", type="string", example="1967"),
     *              @OA\Property(property="created_at", type="string", example="2023-10-18 14:19:40"),
     *              @OA\Property(property="updated_at", type="string", example="2023-10-18 14:19:40")
     *         )
     *     ),
     *      @OA\Response(
     *          response=404,
     *          description="NOT FOUND",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="No query results for model [App\\Models\\Book] #id"),
     *          )
     *      )
     * )
     */
    public function show(Book $book)
    {
        return $book;
    }

    /**
     * Actualizar la información de un Book
     * @OA\Put (
     *     path="/api/books/{id}",
     *     tags={"Book"},
     *     @OA\Parameter(
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *      @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                      type="object",
     *                      @OA\Property(
     *                          property="title",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="author",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="gender",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="synopsis",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="any_publication",
     *                          type="string"
     *                      )
     *                 ),
     *                  example={
     *                     "title":"100 años de Soledad",
     *                     "author":"Gabriel García Márquez",
     *                     "gender":"Novela",
     *                     "synopsis":"Cien años de soledad es una obra maestra de la literatura escrita por Gabriel García Márquez. La novela narra la historia de la familia Buendía a lo largo de varias generaciones en el pueblo ficticio de Macondo. Combina elementos de realismo mágico con una narrativa envolvente para explorar temas de amor, soledad, poder y destino. A lo largo de la historia, los personajes enfrentan desafíos extraordinarios en un mundo donde lo cotidiano y lo sobrenatural se entrelazan. La obra es un viaje a través del tiempo y la memoria de una familia, una comunidad y un continente, y es considerada una de las obras más influyentes de la literatura en español del siglo XX.",
     *                     "any_publication":"1967"
     *                }
     *             )
     *         )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="id", type="number", example=1),
     *              @OA\Property(property="title", type="string", example="100 años de Soledad"),
     *              @OA\Property(property="author", type="string", example="Gabriel García Márquez"),
     *              @OA\Property(property="gender", type="string", example="Novela"),
     *              @OA\Property(property="any_publication", type="string", example="1967"),
     *              @OA\Property(property="created_at", type="string", example="2023-10-18 14:19:40"),
     *              @OA\Property(property="updated_at", type="string", example="2023-10-18 14:19:40")
     *          )
     *      )
     *      
     * )
     */
    public function update(Request $request, Book $book)
{
    $request->validate([
        'title' => 'required',
        'author' => 'required',
        'gender' => 'required',  // Asegúrate de que 'gender' sea requerido
        'synopsis' => 'required',
        'any_publication' => 'required',
    ]);

    $book->title = $request->title;
    $book->author = $request->author;
    $book->gender = $request->gender;
    $book->synopsis = $request->synopsis;
    $book->any_publication = $request->any_publication;
    $book->update();

    return $book;
}

    /**
     * Eliminar un book
     * @OA\Delete (
     *     path="/api/books/{id}",
     *     tags={"Book"},
     *     @OA\Parameter(
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="NO CONTENT"
     *     ),
     *      @OA\Response(
     *          response=404,
     *          description="NOT FOUND",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="No se pudo realizar correctamente la eliminación"),
     *          )
     *      )
     * )
     */
    public function destroy($id)
    {
        $book = Book::find($id);

        if(is_null($book))
        {
            return response()->json(['message' => 'No se pudo realizar correctamente la eliminación'],404);
        }

        $book->delete();

        return response()->noContent();
    }
}