<?php

namespace App\Http\Controllers;

use App\Models\reportes;
use App\Models\tbl_asignaciones;
use App\Models\tbl_estatus_asignaciones;

use App\Models\tbl_funcionarios;
use App\Models\tbl_dependencias;
use App\Models\tbl_departamentos;
use App\Models\tbl_pisos;
use App\Models\tbl_cargos;

use App\Models\tbl_inventarios;
use App\Models\tbl_marcas;
use App\Models\tbl_modelos;
use App\Models\tbl_procesadores;
use App\Models\tbl_unidades_discos;
use App\Models\tbl_tipos_equipos;
use App\Models\tbl_sistemas_operativos;

use PDF;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function reporte_por_departamento(Request $request)
    {
        $dependencias = tbl_dependencias::all();
        return view('reportes.form_pdpto', compact('dependencias'));
    }      

    /**
     * Show the form for creating a new resource.
     */
    public function reporte_por_dependencia()
    {
        $departamentos = tbl_departamentos::all();
        return view('reportes.form_pdependencia', compact('departamentos'));
    }    

    /**
     * Store a newly created resource in storage.
     */
    public function generar_reprte_pordepartamento(Request $request)
    {
        $id = $request->id_dependencia;
        $dependencias = DB::table('tbl_asignaciones')
        ->join('tbl_estatus_asignaciones', 'tbl_asignaciones.id_estatu_asignacion','tbl_estatus_asignaciones.id_estatu_asignacion' )
        ->join('tbl_inventarios_equipos', 'tbl_asignaciones.id_invequipo', 'tbl_inventarios_equipos.id_invequipo' )
        ->leftjoin('tbl_procesadores', 'tbl_inventarios_equipos.id_procesador', 'tbl_procesadores.id_procesador')
        ->leftjoin('tbl_unidades_discos', 'tbl_inventarios_equipos.id_unidad_disco', 'tbl_unidades_discos.id_unidad_disco')
        ->leftjoin('tbl_sistemas_operativos', 'tbl_inventarios_equipos.id_sistema_operativo', 'tbl_sistemas_operativos.id_sistema_operativo')
        ->join('tbl_modelos', 'tbl_inventarios_equipos.id_modelo', 'tbl_modelos.id_modelo')
        ->join('tbl_marcas', 'tbl_modelos.id_marca', 'tbl_marcas.id_marca')
        ->join('tbl_tipos_equipos', 'tbl_modelos.id_tipo_equipo', 'tbl_tipos_equipos.id_tipo_equipo')
        ->join('tbl_funcionarios', 'tbl_asignaciones.id_funcionario', 'tbl_funcionarios.id_funcionario')
        ->join('tbl_dependencias', 'tbl_funcionarios.id_dependencia', 'tbl_dependencias.id_dependencia')
        ->join('tbl_departamentos', 'tbl_funcionarios.id_departamento', 'tbl_departamentos.id_departamento')
        ->join('tbl_pisos', 'tbl_funcionarios.id_piso', 'tbl_pisos.id_piso')
        ->join('tbl_cargos', 'tbl_funcionarios.id_cargo', 'tbl_cargos.id_cargo')
        ->where('tbl_funcionarios.id_dependencia', '=', $id)
        ->get();
        $pdf = PDF::loadView('reportes.reporte_por_departamento', compact('dependencias'));
        $pdf->setPaper('legal', 'landscape');
        // return $pdf->download('reporte_por_deppartamentos.pdf');
        return $pdf->download('Reporte_por_Departamento.pdf');
    }

    public function generar_reprte_pordependencia(Request $request)
    {
        $id = $request->id_departamento;
        $dependencias = DB::table('tbl_asignaciones')
        ->join('tbl_estatus_asignaciones', 'tbl_asignaciones.id_estatu_asignacion','tbl_estatus_asignaciones.id_estatu_asignacion' )
        ->join('tbl_inventarios_equipos', 'tbl_asignaciones.id_invequipo', 'tbl_inventarios_equipos.id_invequipo' )
        ->leftjoin('tbl_procesadores', 'tbl_inventarios_equipos.id_procesador', 'tbl_procesadores.id_procesador')
        ->leftjoin('tbl_unidades_discos', 'tbl_inventarios_equipos.id_unidad_disco', 'tbl_unidades_discos.id_unidad_disco')
        ->leftjoin('tbl_sistemas_operativos', 'tbl_inventarios_equipos.id_sistema_operativo', 'tbl_sistemas_operativos.id_sistema_operativo')
        ->join('tbl_modelos', 'tbl_inventarios_equipos.id_modelo', 'tbl_modelos.id_modelo')
        ->join('tbl_marcas', 'tbl_modelos.id_marca', 'tbl_marcas.id_marca')
        ->join('tbl_tipos_equipos', 'tbl_modelos.id_tipo_equipo', 'tbl_tipos_equipos.id_tipo_equipo')
        ->join('tbl_funcionarios', 'tbl_asignaciones.id_funcionario', 'tbl_funcionarios.id_funcionario')
        ->join('tbl_dependencias', 'tbl_funcionarios.id_dependencia', 'tbl_dependencias.id_dependencia')
        ->join('tbl_departamentos', 'tbl_funcionarios.id_departamento', 'tbl_departamentos.id_departamento')
        ->join('tbl_pisos', 'tbl_funcionarios.id_piso', 'tbl_pisos.id_piso')
        ->join('tbl_cargos', 'tbl_funcionarios.id_cargo', 'tbl_cargos.id_cargo')
        ->where('tbl_funcionarios.id_departamento', '=', $id)
        ->get();
        $pdf = PDF::loadView('reportes.reporte_por_dependencia', compact('dependencias'));
        $pdf->setPaper('legal', 'landscape');
        // return $pdf->download('reporte_por_deppartamentos.pdf');
        return $pdf->download('Reporte_por_Dependencia.pdf');
    }

    public function generar_reprte_por_rango_fecha(Request $request)
    {
        $fecha1 = $request->desde;
        $fecha2 = $request->hasta;
        $dependencias = DB::table('tbl_asignaciones')
        ->join('tbl_estatus_asignaciones', 'tbl_asignaciones.id_estatu_asignacion','tbl_estatus_asignaciones.id_estatu_asignacion' )
        ->join('tbl_inventarios_equipos', 'tbl_asignaciones.id_invequipo', 'tbl_inventarios_equipos.id_invequipo' )
        ->leftjoin('tbl_procesadores', 'tbl_inventarios_equipos.id_procesador', 'tbl_procesadores.id_procesador')
        ->leftjoin('tbl_unidades_discos', 'tbl_inventarios_equipos.id_unidad_disco', 'tbl_unidades_discos.id_unidad_disco')
        ->leftjoin('tbl_sistemas_operativos', 'tbl_inventarios_equipos.id_sistema_operativo', 'tbl_sistemas_operativos.id_sistema_operativo')
        ->join('tbl_modelos', 'tbl_inventarios_equipos.id_modelo', 'tbl_modelos.id_modelo')
        ->join('tbl_marcas', 'tbl_modelos.id_marca', 'tbl_marcas.id_marca')
        ->join('tbl_tipos_equipos', 'tbl_modelos.id_tipo_equipo', 'tbl_tipos_equipos.id_tipo_equipo')
        ->join('tbl_funcionarios', 'tbl_asignaciones.id_funcionario', 'tbl_funcionarios.id_funcionario')
        ->join('tbl_dependencias', 'tbl_funcionarios.id_dependencia', 'tbl_dependencias.id_dependencia')
        ->join('tbl_departamentos', 'tbl_funcionarios.id_departamento', 'tbl_departamentos.id_departamento')
        ->join('tbl_pisos', 'tbl_funcionarios.id_piso', 'tbl_pisos.id_piso')
        ->join('tbl_cargos', 'tbl_funcionarios.id_cargo', 'tbl_cargos.id_cargo')
        ->whereBetween('fecha_asignacion', [$fecha1, $fecha2])
        ->get();
        $pdf = PDF::loadView('reportes.reporte_por_rangofecha', compact('dependencias'));
        $pdf->setPaper('legal', 'landscape'); //orientacion de la pagina. oficio(legal) y horizontal(landscape)
        // return $pdf->download('reporte_por_deppartamentos.pdf');
        return $pdf->download('Reporte_por_Dependencia.pdf');
    }

    public function grafico_por_estatus(){
        $en_espera = DB::table('tbl_asignaciones')
        ->join('tbl_estatus_asignaciones', 'tbl_asignaciones.id_estatu_asignacion','tbl_estatus_asignaciones.id_estatu_asignacion' )        
        ->where('tbl_asignaciones.id_estatu_asignacion', '=', 1)
        ->count();
        // dd($en_espera);

        $procesado = DB::table('tbl_asignaciones')
        ->join('tbl_estatus_asignaciones', 'tbl_asignaciones.id_estatu_asignacion','tbl_estatus_asignaciones.id_estatu_asignacion' )        
        ->where('tbl_asignaciones.id_estatu_asignacion', '=', 2)
        ->count();
        // dd("procesados ".$procesado);

        $en_proceso = DB::table('tbl_asignaciones')
        ->join('tbl_estatus_asignaciones', 'tbl_asignaciones.id_estatu_asignacion','tbl_estatus_asignaciones.id_estatu_asignacion' )        
        ->where('tbl_asignaciones.id_estatu_asignacion', '=', 3)
        ->count();
        // dd('en_proceso '.$en_proceso);
        return view('reportes.grafico_por_estatus', compact('en_espera', 'procesado', 'en_proceso'));
    }

    /**
     * Display the specified resource.
     */
    public function show(reportes $reportes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(reportes $reportes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, reportes $reportes)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(reportes $reportes)
    {
        //
    }
}
