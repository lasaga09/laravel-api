<?php

namespace App\Http\Controllers;

use App\Usuario;
use App\Categoria;
use App\CategoriaUsuario;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;



class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $dato = Usuario::all();
         $rs=['results'=>$dato];
         return response()->json($rs);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
             $dato = new Usuario();
    
            $dato->usuario = $request->usuario;
            $dato->password = $request->password;
            $dato->id_empresa = $request->id_empresa;
             $query = Usuario::select('usuario')
            ->where('id_empresa', $request->id_empresa)
            ->where('usuario',$request->usuario)->get();
              if(!$query->isEmpty()){
                 $rs = [
                "status" => "400",
                "data"=> "el usuario ya existe"
                ];
            }else{
             $dato->save();
             $ultimoid = $dato->idusuarios;
           
             $categorias= Categoria::all()->where('id_empresa',$request->id_empresa);
        
             $categoria=$request->categoria;
     
             $cont=0;/*contador para el bucle*/

        /*condicion para el array de categoria que viene po request*/
        while($cont < count($categoria)){
           $datos = new CategoriaUsuario();
           $datos->id_usuario=$ultimoid;
           $datos->id_categoria=$categoria[$cont];
           $datos->save();
           $cont=$cont+1;

        }

        $rs=['status'=>200];


            }
          
            
       
        return response()->json($rs);
    
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Usuario::find($id);
        $rs = ["results"=> $data];

       return response()->json($rs);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function edit(Usuario $usuario)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
            $dato = Usuario::find($id);
    
            $dato->usuario = $request->usuario;
            $dato->password = $request->password;
             $query = Usuario::select('usuario')
            ->where('id_empresa', $dato->id_empresa)
            ->where('usuario',$request->usuario)->get();
              if(!$query->isEmpty()){
                 $rs = [
                "status" => "400",
                "data"=> "el usuario ya existe"
                ];
            }else{
             $dato->save();
           
           
             $categorias= Categoria::all()->where('id_empresa',$request->id_empresa);
        
             $categoria=$request->categoria;
     
             $cont=0;/*contador para el bucle*/
             $del = 0;/*para eliminar*/


              $usuariocate=CategoriaUsuario::select('id','id_categoria')->where('id_usuario', $dato->idusuarios)->get();
        
            
           if($del < count($categoria)){
              foreach ($usuariocate as $value) {
               
               $value->delete();
                  
              }
               /*condicion para el array de categoria que viene po request*/
               while($cont < count($categoria)){
               
               $datos = new CategoriaUsuario();
               $datos->id_usuario=$dato->idusuarios;
               $datos->id_categoria=$categoria[$cont];
               $datos->save();
               $cont=$cont+1;
               
               }


           }
     

        $rs=['status'=>200];


            }   
       
        return response()->json($rs);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $dato = Usuario::find($id);
       
         $usuariocate=CategoriaUsuario::select('id','id_categoria')
         ->where('id_usuario', $dato->idusuarios)->get();

        
            
       
              foreach ($usuariocate as $value) {
               
                 $value->delete();
                  
                 }
                  $dato->delete();

          $rs = [
            "status" => "200",
            "data"=> "Eliminado"
            ];
         return response()->json($rs);
    
}

}