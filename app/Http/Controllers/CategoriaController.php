<?php

namespace App\Http\Controllers;

use App\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $dato = Categoria::all();
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
    public function store(Request $request)
    {
            $dato = new Categoria();
    
            $dato->categoria = $request->categoria;
            $dato->id_empresa = $request->id_empresa;
            $query = Categoria::select('categoria')
            ->where('id_empresa', $request->id_empresa)
            ->where('categoria',$request->categoria)->get();
            if(!$query->isEmpty()){
             $rs = [
            "status" => "400",
            "data"=> "la categoria ya existe"
            ];
            }else{
            $dato->save();
            
             $rs = [
            "status" => "200",
            "data"=> $dato
            ];

            }
       
        return response()->json($rs);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Categoria::find($id);
        $rs = ["results"=> $data];

       return response()->json($rs);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function edit(Categoria $categoria)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $dato = Categoria::find($id);
              $dato->categoria = $request->categoria;
              $query = Categoria::select('categoria','id_empresa')
              ->where('categoria',$request->categoria)
              ->where('id_empresa',$dato->id_empresa)->get();
             
            if(!$query->isEmpty()){
             $rs = [
            "status" => "400",
            "data"=> "la empresa ya existe"
            ];
            }else{
            $dato->save();
            
             $rs = [
            "status" => "200",
            "data"=> $dato
            ];

            }
              return response()->json($rs);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
          $dato = Categoria::find($id);
         $dato->delete();
          $rs = [
            "status" => "200",
            "data"=> "Eliminado"
            ];
         return response()->json($rs);
    }
}
