<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie; // Importar el modelo Movie
use Exception;
use Illuminate\Support\Facades\Validator;

class MovieController extends Controller
{
    //Metodo para obtener todas las películas
    public function index(){
        try{
            return response()->json(Movie::all());
        }catch(Exception $e){
            return response()->json(['error' => 'Error al obtener las películas' . $e->getMessage()], 500);
        }
    }
    //Metodo para agregar una nueva pelicula
    public function store(Request $request){
        try {
            // Validar los datos recibidos
            $validator = Validator::make($request->all(), [
                'title' => 'required|string|max:255',
                'synopsis' => 'required|string',
                'year' => 'required|integer|min:1900|max:' . date('Y'),
                'cover' => 'required|string|max:255',
            ]);

            // Si la validación falla, devolver los errores
            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Error de validación',
                    'errors' => $validator->errors()
                ], 422);
            }

            // Crear la película en la base de datos
            $movie = Movie::create($request->all());
            
            // Devolver respuesta exitosa
            return response()->json([
                'status' => 'success',
                'message' => 'Película creada con éxito',
                'data' => $movie
            ], 201);
        } catch (Exception $e) {
            // Devolver respuesta de error
            return response()->json([
                'status' => 'error',
                'message' => 'Error al crear la película',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    //Metodo para obtener una película por su ID
    public function show($id){
        try {
            $movie = Movie::findOrFail($id);
            return response()->json([
                'status' => 'success',
                'data' => $movie
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'No se encontró la película con ID: ' . $id,
                'error' => $e->getMessage()
            ], 404);
        }
    }

    //Metodo para actualizar una película
    public function update(Request $request, $id){
        try {
            //Buscar la pelicula
            $movie = Movie::findOrFail($id);

            //Validar los datos recibidos
            $validator = validator::make($request->all(), [
                'title' => 'string|max:255' ,
                'synopsis' => 'string',
                'year' => 'integer|min:1900|max:' . date('Y'),
                'cover' => 'string|max:255',
            ]);

            //si la validacion falla, devolver los errores
            if($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Error de validación',
                    'errors' => $validator->errors()
                ], 422);
            }

            //Actualizar la pelicula
            $movie->update($request->all());

            //Devolver la respuesta existosa
            return response()->json([
                'status' => 'success',
                'message' => 'Pelicula actualizada con exito',
                'data' => $movie
            ], 200);
        } catch (Exception $e) {
            //Devolver respuesta de error
            return response()->json([
                'status' => 'error',
                'message' => 'Error al actualizar la película',
                'error' => $e->getMessage()
            ], $e instanceof \Illuminate\Database\Eloquent\ModelNotFoundException ? 404 : 500);
        }
    }
}



