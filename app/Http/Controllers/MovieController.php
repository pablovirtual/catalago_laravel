<?php



namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Movie; // Importar el modelo Movie

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
        $movie = Movie::create($request->all());//Crea una nueva película con los datos enviados
        return response()->json($movie, 201);
    }
    //Metodo para obtener una película por su ID
    public function show($id){
        return Movie::findOrFail($id);
    }


}
