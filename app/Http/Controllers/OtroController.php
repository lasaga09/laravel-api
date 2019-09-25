<?php

namespace App\Http\Controllers;


use App\Usuario;
use App\Empresa;
use App\Categoria;
use App\CategoriaUsuario;
use Illuminate\Http\Request;


class OtroController extends Controller
{
    function items(Request $request,$id=null){

    	if($id==null){
    		
    		$emp=Empresa::all();
    		$rs=['results:'=>$emp];
    		return response()->json($rs);

    	}else{
    		$emp=Empresa::find($id);
    		$u=Usuario::select('usuario','password')->where('id_empresa',$emp->idempresas)->get();
    		$rs=['empresa:'=>$emp,
    			 'usuarios:'=>$u];
    		return response()->json($rs);
    	}


    
}


    function itemsdos(Request $request,$id=null, $pk=null){

    	if(!$pk==null){
    		
    		$emp=Empresa::find($id);
    		$u=Usuario::find($pk);
    		$cate = CategoriaUsuario::select('categorias.idcategorias','categorias.categoria')->join('categorias','categorias.idcategorias','=','usuarios_categorias.id_categoria')->where('id_usuario',$pk)->get();
    		$rs=['empresa:'=>$emp,
    			 'usuario:'=>$u,
    			 'categorias del usuario:'=>$cate];
    		return response()->json($rs);

    	}else{
    		$emp=Empresa::find($id);
    		$u=Usuario::select('idusuarios','usuario','password')->where('id_empresa',$id)->get();
    		$rs=['empresa:'=>$emp,
    			 'usuarios:'=>$u];
    		return response()->json($rs);

    	}

    
}

}