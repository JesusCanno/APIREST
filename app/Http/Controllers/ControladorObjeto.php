<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Objeto;
use Illuminate\Support\Facades\Validator;

class ControladorObjeto extends Controller
{

    private function filtrarCategoria(string $categoria){
        $objeto = Objeto::where("categoria",$categoria)->get();
        return response()->json( $objeto,200);
    }
    
    public function index(Request $request){
        if(isset($request->categoria)){
            return $this->filtrarCategoria($request->categoria);
        }
        $objeto = Objeto::all();


        if($objeto->isEmpty()){
            $data = [
                'message' => 'No se han encontrado objetos',
                'status'=> 404,
            ];
            return response()->json($data,404);
        }
        return response()->json( $objeto,200);
    }

    public function store(Request $request){

        $validator = Validator::make($request->all(), [ //validar los elmentos que vamos a crear
            "nombre" => 'required',
            "precio" => 'required',
            "categoria" => 'required',
            "imagenes"=> 'nullable' //mirar como lo tengo en jarekina
        ]);

        if($validator->fails()){
            $data = [
                'message'=> 'Error en la validacion de datos',
                'error'=> $validator->errors(),
                'status'=> 400,
            ];
            return response()->json($data,400);
        }

        $objeto = Objeto::create([
            'nombre'=> $request->nombre, //Ponerlo igual que en la tabla e igual en el thunder client para cuando creemos uno
            'precio'=> $request->precio,
            'categoria'=> $request->categoria,
            'imagenes'=> $request->imagenes
        ]);

        if(!$objeto){
            $data = [
                'message'=> 'Error al crear estudiante',
                'error'=> $validator->errors(),
                'status'=> 500,
            ];
            return response()->json($data,500);
        }

        $data = [
            'objeto'=> $objeto,
            'status'=>201,
        ];
        return response()->json($data,201);
    }


    public function show($id){
        $objeto = Objeto::find($id);

        if(!$objeto){
            $data = [
                'message'=> 'Objeto no encontrado',
                'status'=> 404
            ];
            return response()->json($data,404);

        }    

        $data = [
            'objeto'=> $objeto,
            'status'=> 200
        ];
            return response()->json($data,200);
    }

    public function destroy($id){
        $objeto = Objeto::find($id);

        if(!$objeto){
            $data = [
                'message'=> 'Objeto no encontrado',
                'status'=> 404
            ];
                return response()->json($data,404);
        }
        $objeto->delete();

        $data = [
            'message'=> $objeto,
            'status'=> 200
        ];

        return response()->json($data,200);
    }


    public function update(Request $request, $id){
        $objeto = Objeto::find($id);

        if(!$objeto){
            $data = [
                'message'=> 'Objeto no encontrado',
                'status'=> 404
            ];
                return response()->json($data,404);
        }

        $validator = Validator::make($request->all(), [ //validar los elmentos que vamos a crear
            "nombre" => 'required',
            "precio" => 'required',
            "categoria" => 'required',
            "imagenes"=> 'nullable' //mirar como lo tengo en jarekina
        ]);

        if($validator->fails()){
            $data = [
                'message'=> 'Error en la validacion de datos',
                'error'=> $validator->errors(),
                'status'=> 400,
            ];
            return response()->json($data,400);
        }

            $objeto->nombre = $request->nombre; //actualizamos los datos
            $objeto->precio = $request->precio;
            $objeto->categoria = $request->categoria;
            $objeto->imagenes = $request->imagenes;

            $objeto->update($request->all());

            $data = [
                'message'=> 'Objeto actualizado correctamente',
                'objeto'=> $objeto,
                'status'=> 200
            ];
            return response()->json($data,200);
    }

    public function updatePartial( Request $request, $id){
        $objeto = Objeto::find($id);

        if(!$objeto){
            $data = [
                'message'=> 'Objeto no encontrado',
                'status'=> 404
            ];
                return response()->json($data,404);
        }

        
        $validator = Validator::make($request->all(), [
            "nombre" => 'max:255',
            "precio" => 'max:255',
            "categoria" => 'max:255',
            "imagenes"=> 'nullable'
        ]);

        if($validator->fails()){
            $data = [
                'message'=> 'Error en la validacion de datos',
                'error'=> $validator->errors(),
                'status'=> 400,
            ];
            return response()->json($data,400);
        }

        if($request->has("nombre")){
            $objeto->nombre = $request->nombre;
        }

        if($request->has("precio")){
            $objeto->precio = $request->precio;
        }

        if($request->has("categoria")){
            $objeto->categoria = $request->categoria;
        }

        if($request->has("imagenes")){
            $objeto->imagenes = $request->imagenes;
        }

        $objeto->update($request->all());

        $data = [
            'message'=> 'Objeto actualizado correctamente',
            'objeto'=> $objeto,
            'status'=> 200
        ];
        return response()->json($data,200);
    }
}

    