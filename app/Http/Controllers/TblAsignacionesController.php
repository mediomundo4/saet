<?php

namespace App\Http\Controllers;

use App\Models\tbl_asignaciones;
use App\Models\tbl_funcionarios;
use App\Models\tbl_estatus_asignaciones;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TblAsignacionesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $funcionarios = DB::table('tbl_funcionarios')
        ->join('tbl_dependencias', 'tbl_funcionarios.id_dependencia', 'tbl_dependencias.id_dependencia')
        ->join('tbl_departamentos', 'tbl_funcionarios.id_departamento', 'tbl_departamentos.id_departamento')
        ->join('tbl_pisos', 'tbl_funcionarios.id_piso', 'tbl_pisos.id_piso')
        ->join('tbl_cargos', 'tbl_funcionarios.id_cargo', 'tbl_cargos.id_cargo')
        ->get();

        $inventarios = DB::table('tbl_inventarios_equipos')
        ->leftjoin('tbl_procesadores', 'tbl_inventarios_equipos.id_procesador', 'tbl_procesadores.id_procesador')
        ->leftjoin('tbl_unidades_discos', 'tbl_inventarios_equipos.id_unidad_disco', 'tbl_unidades_discos.id_unidad_disco')
        ->leftjoin('tbl_sistemas_operativos', 'tbl_inventarios_equipos.id_sistema_operativo', 'tbl_sistemas_operativos.id_sistema_operativo')
        ->join('tbl_modelos', 'tbl_inventarios_equipos.id_modelo', 'tbl_modelos.id_modelo')
        ->join('tbl_marcas', 'tbl_modelos.id_marca', 'tbl_marcas.id_marca')
        ->join('tbl_tipos_equipos', 'tbl_modelos.id_tipo_equipo', 'tbl_tipos_equipos.id_tipo_equipo')
        ->get();

        $estatus = tbl_estatus_asignaciones::all();

        return view('asignacion.formulario', compact('funcionarios', 'inventarios', 'estatus'));
    }

    public function buscarfun(Request $request){
        //dd($request);
        $id = $request->id_funcionario;

        $funcionario = DB::table('tbl_funcionarios')
        ->join('tbl_dependencias', 'tbl_funcionarios.id_dependencia', 'tbl_dependencias.id_dependencia')
        ->join('tbl_departamentos', 'tbl_funcionarios.id_departamento', 'tbl_departamentos.id_departamento')
        ->join('tbl_pisos', 'tbl_funcionarios.id_piso', 'tbl_pisos.id_piso')
        ->join('tbl_cargos', 'tbl_funcionarios.id_cargo', 'tbl_cargos.id_cargo')
        ->where('id_funcionario', '=', $id)
        ->get();
        echo json_encode($funcionario);
    }

    public function buscarinvequipo(Request $request){
        $inventarios = DB::table('tbl_inventarios_equipos')
        ->leftjoin('tbl_procesadores', 'tbl_inventarios_equipos.id_procesador', 'tbl_procesadores.id_procesador')
        ->leftjoin('tbl_unidades_discos', 'tbl_inventarios_equipos.id_unidad_disco', 'tbl_unidades_discos.id_unidad_disco')
        ->leftjoin('tbl_sistemas_operativos', 'tbl_inventarios_equipos.id_sistema_operativo', 'tbl_sistemas_operativos.id_sistema_operativo')
        ->join('tbl_modelos', 'tbl_inventarios_equipos.id_modelo', 'tbl_modelos.id_modelo')
        ->join('tbl_marcas', 'tbl_modelos.id_marca', 'tbl_marcas.id_marca')
        ->join('tbl_tipos_equipos', 'tbl_modelos.id_tipo_equipo', 'tbl_tipos_equipos.id_tipo_equipo')
        ->get();
        echo json_encode($inventarios);
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
        $asignasiones = new tbl_asignaciones();
        //dd($request->fecha_asignacion);
        $request->validate([
            'id_funcionario' => 'required',
            'id_invequipo' => 'required',
            'fecha_asignacion' => 'required',
            'cantidad_asignacion' => 'required',
            'id_estatu_asignacion' => 'required',        
            'usuario' => 'required',
        ]);
        

        $asignasiones->id_funcionario = $request->id_funcionario;
        $asignasiones->id_invequipo = $request->id_invequipo;
        $asignasiones->fecha_asignacion = $request->fecha_asignacion;
        $asignasiones->cantidad_asignacion = $request->cantidad_asignacion;
        $asignasiones->id_estatu_asignacion = $request->id_estatu_asignacion;
        $asignasiones->usuario = $request->usuario;
        
        $asignasiones->save();
        
        return back()->with('success', 'Asignacion registrada correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(tbl_asignaciones $tbl_asignaciones)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(tbl_asignaciones $tbl_asignaciones)
    {
        $asignaciones = $inventarios = DB::table('tbl_asignaciones')
        ->join('tbl_estatus_asignaciones', 'tbl_asignaciones.id_estatu_asignacion', 'tbl_estatus_asignaciones.id_estatu_asignacion')
        ->join('tbl_funcionarios', 'tbl_asignaciones.id_funcionario', 'tbl_funcionarios.id_funcionario')
        ->join('tbl_dependencias', 'tbl_funcionarios.id_dependencia', 'tbl_dependencias.id_dependencia')
        ->join('tbl_departamentos', 'tbl_funcionarios.id_departamento', 'tbl_departamentos.id_departamento')
        ->join('tbl_pisos', 'tbl_funcionarios.id_piso', 'tbl_pisos.id_piso')
        ->join('tbl_inventarios_equipos', 'tbl_asignaciones.id_invequipo', 'tbl_inventarios_equipos.id_invequipo')
        ->leftjoin('tbl_procesadores', 'tbl_inventarios_equipos.id_procesador', 'tbl_procesadores.id_procesador')
        ->leftjoin('tbl_unidades_discos', 'tbl_inventarios_equipos.id_unidad_disco', 'tbl_unidades_discos.id_unidad_disco')
        ->leftjoin('tbl_sistemas_operativos', 'tbl_inventarios_equipos.id_sistema_operativo', 'tbl_sistemas_operativos.id_sistema_operativo')
        ->join('tbl_modelos', 'tbl_inventarios_equipos.id_modelo', 'tbl_modelos.id_modelo')
        ->join('tbl_marcas', 'tbl_modelos.id_marca', 'tbl_marcas.id_marca')
        ->join('tbl_tipos_equipos', 'tbl_modelos.id_tipo_equipo', 'tbl_tipos_equipos.id_tipo_equipo')
        ->get();

        return view('asignacion.listar', compact('asignaciones'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, tbl_asignaciones $tbl_asignaciones)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(tbl_asignaciones $tbl_asignaciones)
    {
        //
    }
}
