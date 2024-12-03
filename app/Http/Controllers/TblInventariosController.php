<?php

namespace App\Http\Controllers;

use App\Models\tbl_inventarios;
use App\Models\tbl_marcas;
use App\Models\tbl_modelos;
use App\Models\tbl_procesadores;
use App\Models\tbl_unidades_discos;
use App\Models\tbl_tipos_equipos;
use App\Models\tbl_sistemas_operativos;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class TblInventariosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $marcas = tbl_marcas::all();
        $modelos = tbl_modelos::all();
        $procesadores = tbl_procesadores::all();
        $unidades_discos = tbl_unidades_discos::all();
        $tipos = tbl_tipos_equipos::all();
        $sistemas = tbl_sistemas_operativos::all();
        return view('inventario.formulario', compact('marcas', 'modelos', 'procesadores', 'unidades_discos', 'tipos', 'sistemas'));
    }

    public function indexptipo(Request $request){
        $tipos = tbl_tipos_equipos::all();
        return view('inventario.consulta_portipo', compact('tipos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //dd($request);
        $inventario = new tbl_inventarios();
        //dd($request->fecha_invequipo);
        $id_tipo = $request->id_tipo_equipo;
        if($id_tipo == 1 or $id_tipo == 2 or $id_tipo == 12){
            $request->validate([
                'id_tipo_equipo' => 'required',
                'id_marca' => 'required',
                'id_modelo' => 'required',
                'id_procesador' => 'required',
                'memoria' => 'required',
                'id_unidad_disco' => 'required',
                'id_sistema_operativo' => 'required',
                'fecha_invequipo' => 'required',
                'nserial' => 'required',
                'bien_nacional' => 'required',
                'stock_invequipo' => 'required',
                'mac_invequipo' => 'required',
                'ip_invequipo' => 'required'  
            ]);

            $inventario->id_modelo = $request->id_modelo;
            $inventario->id_procesador  = $request->id_procesador;
            $inventario->memoria = $request->memoria;
            $inventario->id_unidad_disco  = $request->id_unidad_disco;
            $inventario->id_sistema_operativo  = $request->id_sistema_operativo;
            $inventario->fecha_invequipo = $request->fecha_invequipo;
            $inventario->nserial = $request->nserial;
            $inventario->bien_nacional = $request->bien_nacional;
            $inventario->stock_invequipo = $request->stock_invequipo;
            if($request->mac_invequipo != '' and $request->ip_invequipo != ''){
                $inventario->mac_invequipo = $request->mac_invequipo;
                $inventario->ip_invequipo = $request->ip_invequipo;
            }
        }else{
            $request->validate([
                'id_tipo_equipo' => 'required',
                'id_marca' => 'required',
                'id_modelo' => 'required',                
                'fecha_invequipo' => 'required',
                'nserial' => 'required',
                'bien_nacional' => 'required',
            ]); 

            $inventario->id_modelo = $request->id_modelo;
            $inventario->fecha_invequipo = $request->fecha_invequipo;
            $inventario->nserial = $request->nserial;
            $inventario->bien_nacional = $request->bien_nacional;
            $inventario->mac_invequipo = $request->mac_invequipo;
            $inventario->ip_invequipo = $request->ip_invequipo;
        }
        
        
        $inventario->save();
        $id = $inventario->id_invequipo;
        if($id == null){
            return back()->with('error', 'Error al Guardar la Información.');
        }else{
            return back()->with('success', 'Información guardada correctamente.');
        }
    }

    public function storecpu(Request $request)
    {
        $procesador = new tbl_procesadores();
        $cpu = $request->procesador; 
        $procesador->procesador = $cpu;
        $procesador->save();        
        $id = $procesador->id_procesador;
        if($id == null){
            $retorna['estado'] = 'no insertado';
            $retorna['msj'] = 'Error al registrar el procesador.';
        }else{
            $retorna['estado'] = 'insertado';
            $retorna['msj'] = 'Procesador registrado correctamente.';
            $retorna['procesador'] = $cpu;
            $retorna['id'] = $id;
        }
        echo json_encode($retorna);
        
    }

    public function storehdisk(Request $request)
    {
        $unidisk = new tbl_unidades_discos();
        $disk = $request->unidad_disco; 
        $unidisk->unidad_disco = $disk;
        $unidisk->save(); //guardo en BD        
        $id = $unidisk->id_unidad_disco; //obtengo el id del registro que se inserto
        if($id == null){ //si $id es nulo o vacio
            $retorna['estado'] = 'no insertado';
            $retorna['msj'] = 'Error al registrar la unidad de disco.';
        }else{
            $retorna['estado'] = 'insertado';
            $retorna['msj'] = 'Unidad de Disco registrado correctamente.';
            $retorna['unidad_disco'] = $disk;
            $retorna['id'] = $id;
        }
        echo json_encode($retorna);
    }

    public function storemodel(Request $request){
        //dd($request);
        $modelo = new tbl_modelos();
        $mdlo = $request->modelo;
        $modelo->id_tipo_equipo = $request->idtipoequipo;
        $modelo->id_marca = $request->idmarca;
        $modelo->modelo = $mdlo;
        $modelo->save();
        $id = $modelo->id_modelo;
        if($id == null){
            $retorna['estado'] = 'no insertado';
            $retorna['msj'] = 'Error. No se pudo registrar el modelo.';            
        }else{
            $retorna['estado'] = 'insertado';
            $retorna['msj'] = 'Unidad de Disco registrado correctamente.';
            $retorna['id'] = $id;
            $retorna['modelo'] = $mdlo;
        }
        echo json_encode($retorna);
    }
    /**
     * Display the specified resource.
     */ 
    public function show(tbl_inventarios $tbl_inventarios)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(tbl_inventarios $tbl_inventarios, Request $request)
    {
        $inventarios = DB::table('tbl_inventarios_equipos')
        ->leftjoin('tbl_procesadores', 'tbl_inventarios_equipos.id_procesador', 'tbl_procesadores.id_procesador')
        ->leftjoin('tbl_unidades_discos', 'tbl_inventarios_equipos.id_unidad_disco', 'tbl_unidades_discos.id_unidad_disco')
        ->leftjoin('tbl_sistemas_operativos', 'tbl_inventarios_equipos.id_sistema_operativo', 'tbl_sistemas_operativos.id_sistema_operativo')
        ->join('tbl_modelos', 'tbl_inventarios_equipos.id_modelo', 'tbl_modelos.id_modelo')
        ->join('tbl_marcas', 'tbl_modelos.id_marca', 'tbl_marcas.id_marca')
        ->join('tbl_tipos_equipos', 'tbl_modelos.id_tipo_equipo', 'tbl_tipos_equipos.id_tipo_equipo')
        ->get();
        return view('inventario.listar', compact('inventarios'));
    }

    public function editptipo(tbl_inventarios $tbl_inventarios, Request $request)
    {
        $id_tipo = $request->id_tipo_equipo;
        $inventarios = DB::table('tbl_inventarios_equipos')
        ->leftjoin('tbl_procesadores', 'tbl_inventarios_equipos.id_procesador', 'tbl_procesadores.id_procesador')
        ->leftjoin('tbl_unidades_discos', 'tbl_inventarios_equipos.id_unidad_disco', 'tbl_unidades_discos.id_unidad_disco')
        ->leftjoin('tbl_sistemas_operativos', 'tbl_inventarios_equipos.id_sistema_operativo', 'tbl_sistemas_operativos.id_sistema_operativo')
        ->join('tbl_modelos', 'tbl_inventarios_equipos.id_modelo', 'tbl_modelos.id_modelo')
        ->join('tbl_marcas', 'tbl_modelos.id_marca', 'tbl_marcas.id_marca')
        ->join('tbl_tipos_equipos', 'tbl_modelos.id_tipo_equipo', 'tbl_tipos_equipos.id_tipo_equipo')
        ->where('tbl_modelos.id_tipo_equipo', '=', $id_tipo)
        ->get();
        return view('inventario.listar2', compact('inventarios'));
    }

    public function buscar_modelo(tbl_modelos $tbl_inventarios, Request $request)
    {
        $modelos = DB::table('tbl_modelos')
        ->where('id_tipo_equipo', '=', $request->id_tipo_equipo)
        ->where('id_marca', '=', $request->id_marca)
        ->get();
        // dd($modelos);
        // if(empty($modelos)){
        //     $retorna['estado'] = 'no encontrado';
        //     $retorna['msj'] = 'No existen modelos con esas referencias.';
        // }else{
        //     $retorna['estado'] = 'encontrado';
        //     $retorna['datos'] = $modelos;
        //     $retorna['msj'] = 'No existen modelos con esas referencias.';
        // }
        echo json_encode($modelos);
    }

    public function buscar_marca(tbl_modelos $tbl_inventarios, Request $request)
    {
        $modelos = DB::table('tbl_modelos')
        ->join('tbl_marcas', 'tbl_modelos.id_marca', 'tbl_marcas.id_marca')
        ->distinct('marca')
        ->where('id_tipo_equipo', '=', $request->id_tipo_equipo)
        ->get();
        //dd($modelos);
        echo json_encode($modelos);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, tbl_inventarios $tbl_inventarios)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(tbl_inventarios $tbl_inventarios)
    {
        //
    }
}
