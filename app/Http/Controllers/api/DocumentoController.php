<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Documento;
use App\Models\Seccion;
use Illuminate\Http\Request;

class DocumentoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $secciones_padre = Seccion::where('padre',-1)->get();
        //dd($secciones_padre);
        //$ids_nodo = $this->getIdsNodo($id);
        $response = [];
        foreach ($secciones_padre as $seccion){
            $result = $this->getArbol($this->getIdsNodo($seccion->id));
            $response[$seccion->nombre] = $result;
        }

        //dd($response);
        return response()->json([
            'data'=> $response
        ]);
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

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
