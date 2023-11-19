<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PanaderiaAPIController extends Controller
{
    private $database;

    public function __construct()
    {
        $this->database = \App\Services\FirebaseService::connect();
    }

    public function registrarPan(Request $request)
    {
   
        $nombre = $request->input('nombre');
        $precio = $request->input('precio');
        $descripcion = $request->input('descripcion');    


        // Creamos una lista con los datos a enviar
        $datos=[

            'nombre'=>$nombre,
            'precio'=>$precio,
            'descripcion'=>$descripcion 

        ];
   

        $firebase = $this->database->getReference('panederia/panes'); // Le indicamos el nodo a enviar
        $panRef = $firebase->push()->set($datos); // enviamos la informacion 
  

        return response()->json(['success' => true]); // le indicamos que todo fue enviado
   

    }

    public function listarPanes(Request $request)
    {

        $firebase = $this->database->getReference('panederia/panes')->getValue();

        return response()->json($firebase);

    }

    public function actualizarPanes(Request $request, $clave)
    {

        $firebase = $this->database->getReference('panederia/panes/'.$clave);

        $nombre = $request->input('nombre');
        $precio = $request->input('precio');
        $descripcion = $request->input('descripcion');    


        // Creamos una lista con los datos a enviar
        $datos=[

            'nombre'=>$nombre,
            'precio'=>$precio,
            'descripcion'=>$descripcion 

        ];

        $firebase->update($datos);
        return response()->json(['success' => true]);

    }

    public function eliminarPanes(Request $request, $clave)
    {
        $firebase = $this->database->getReference('panederia/panes/'.$clave);


        $firebase->remove($firebase);

        return response()->json(['success' => true]);

    }
}
