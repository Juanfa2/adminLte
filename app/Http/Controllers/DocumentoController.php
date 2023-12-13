<?php

namespace App\Http\Controllers;

use App\Models\Documento;
use App\Models\Seccion;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;

class DocumentoController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function index(){

        $secciones_padre = Seccion::where('padre',-1)->pluck('nombre','id');

        return view('documentos.index', compact('secciones_padre',));
    }

    public function showSeccion($id){
        $name = Seccion::find($id)->nombre;

        $ids_nodo = $this->getIdsNodo($id);
        $result = $this->getArbol($ids_nodo);
        return view('documentos.show', compact('result','name'));
    }

    private function getIdsNodo($id){
        return Seccion::join('secciones as s', 's.padre', '=', 'secciones.id')->where('s.padre',$id)->get();
    }

    private function getArbol($items, $padre = -1){
        $arbol=[];
        foreach ($items as $item){
            if($item->padre != $padre){
                $hijos = $this->getArbol($this->getIdsNodo($item->id));
                if(!empty($hijos)){
                    $item->hijos = $hijos;
                }else{
                    $documento = Documento::where('seccion', $item->id)->first();
                    $item->link = $documento;
                }
                $arbol[] = $item;
            }
        }
        return $arbol;
    }

}
