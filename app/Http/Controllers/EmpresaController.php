<?php

namespace App\Http\Controllers;

use App\Empresa;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class EmpresaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dato = Empresa::all();
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
         $dato = new Empresa();
    
            $dato->empresa = $request->empresa;
        
           $query = Empresa::select('empresa')
            ->where('empresa',$request->empresa)->get();
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
     * Display the specified resource.
     *
     * @param  \App\Empresa  $empresa
     * @return \Illuminate\Http\Response
     */
    public function show($id)

    {
        //
        $data = Empresa::find($id);
        $rs = ["results"=> $data];
       return response()->json($rs);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Empresa  $empresa
     * @return \Illuminate\Http\Response
     */
    public function edit(Empresa $empresa)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Empresa  $empresa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
              $dato = Empresa::find($id);
              $dato->empresa = $request->empresa;
              $query = Empresa::select('empresa')
              ->where('empresa',$request->empresa)->get();
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
     * @param  \App\Empresa  $empresa
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)

    {
         $dato = Empresa::find($id);
         $dato->delete();
          $rs = [
            "status" => "200",
            "data"=> "Eliminado"
            ];
         return response()->json($rs);
        
    }
}
