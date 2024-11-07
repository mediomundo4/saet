<?php

namespace App\Http\Controllers;
use App\Models\tbl_funcionarios;

use App\Models\tbl_dependencias;
use App\Models\tbl_departamentos;
use App\Models\tbl_pisos;
use App\Models\tbl_cargos;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class TblFuncionariosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $dependencias = tbl_dependencias::all();
        $departamentos = tbl_departamentos::all();
        $pisos = tbl_pisos::all();
        $cargos = tbl_cargos::all();
        return view('funcionario.formulario', compact('dependencias','departamentos','pisos','cargos'));
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
        $funcionarios = new Tbl_funcionarios();

        //dd($request);             
        $cedula = $request->get('cedulafun');
        $request->validate([
            'cedulafun' => 'required| unique:tbl_funcionarios',
            'nombrefun' => 'required',
            'apellidofun' => 'required',
            'usuario_dominio' => 'required',
            'telefono' => 'required',
            'correo_personal' => 'required',
            'correo_inst' => 'required',
            'id_dependencia' => 'required',
            'id_departamento' => 'required',
            'id_piso' => 'required',
            'id_cargo' => 'required'
        ]);

        $funcionarios->cedulafun = $cedula;
        $funcionarios->nombrefun = $request->get('nombrefun');
        $funcionarios->apellidofun = $request->get('apellidofun');
        $funcionarios->usuario_dominio = $request->get('usuario_dominio');
        $funcionarios->telefono = $request->get('telefono');
        $funcionarios->correo_personal = $request->get('correo_personal');
        $funcionarios->correo_inst = $request->get('correo_inst');        
        $funcionarios->id_dependencia = $request->get('id_dependencia');
        $funcionarios->id_departamento = $request->get('id_departamento');
        $funcionarios->id_piso = $request->get('id_piso');
        $funcionarios->id_cargo = $request->get('id_cargo');
        
        $funcionarios->save(); 
        
        return back()->with('success', 'Funcionario registrado correctamente.');
    }

    public function storedpto(Request $request){
        //dd($request);
        $dpto = new tbl_departamentos();       
        $departamento = $request->departamento;
        
        $dpto->id_dependencia = $request->iddependencia;
        $dpto->departamento = $departamento;
        $dpto->save();
        $id = $dpto->id_departamento;
        if($id != ''){
            $retorna['estado'] = 'insertado';
            $retorna['msj'] = 'Datos almacenados correctamente.';
            $retorna['id'] = $id;
            $retorna['departamento'] = $departamento;
        }else{
            $retorna['estado'] = 'no insertado';
            $retorna['msj'] = 'Error. Datos no almacenados.';
        }
        echo json_encode($retorna);
    }

    public function storedpdnc(Request $request){
        //dd($request);
        $dpdnc = new tbl_dependencias();
        $dependencia = $request->dependencia;

        $dpdnc->dependencia = $dependencia;
        $dpdnc->id_piso = $request->id_piso;;
        $dpdnc->save();
        $id = $dpdnc->id_dependencia;
        if($id != ''){
            $retorna['estado'] = 'insertado';
            $retorna['msj'] = 'Datos almacenados correctamente.';
            $retorna['id'] = $id;
            $retorna['dependencia'] = $dependencia;
        }else{
            $retorna['estado'] = 'no insertado';
            $retorna['msj'] = 'Error. Datos no almacenados.';
        }
        echo json_encode($retorna);
    }
    

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $cedula = $request->get('cedulafun');
        $funcionarios = DB::table('tbl_funcionarios')
        ->join('tbl_dependencias', 'tbl_funcionarios.id_dependencia', 'tbl_dependencias.id_dependencia')
        ->join('tbl_departamentos', 'tbl_funcionarios.id_departamento', 'tbl_departamentos.id_departamento')
        ->join('tbl_pisos', 'tbl_funcionarios.id_piso', 'tbl_pisos.id_piso')
        ->join('tbl_cargos', 'tbl_funcionarios.id_cargo', 'tbl_cargos.id_cargo')
        ->get();
        return view('funcionario.listar', compact('funcionarios'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        $funcionario = DB::table('tbl_funcionarios')
        ->where('id_funcionario', '=', $request->get('id_funcionario'))
        ->get();
        echo json_encode($funcionario);
    }

    public function buscar(Request $request)
    {
        $funcionario = DB::table('tbl_funcionarios')
        ->where('cedulafun', '=', $request->get('cedulafun'))
        ->get();
        echo json_encode($funcionario);
    }

    public function buscar_dependencia(Request $request){
        $id = $request->id_dependencia;
        $dpdnc = DB::table('tbl_departamentos')
        ->where('id_dependencia', '=', $id)
        ->get();        
        echo json_encode($dpdnc);
    }

    public function buscar_piso(Request $request){
        $id = $request->id_piso;
        $dpdnc = DB::table('tbl_dependencias')
        ->where('id_piso', '=', $id)
        ->get();        
        echo json_encode($dpdnc);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        //dd($request->nombrefun);             
        $funcionarios = new Tbl_funcionarios();

        $cedula = $request->cedulafun;
        $id = $request->id_funcionario;
        
        $fun = $funcionarios->findOrFail($id);
        $fun->cedulafun = $cedula;
        $fun->nombrefun = $request->get('nombrefun');
        $fun->apellidofun = $request->get('apellidofun');
        $fun->usuario_dominio = $request->get('usuario_dominio');
        $fun->telefono = $request->get('telefono');
        $fun->correo_personal = $request->get('correo_personal');
        $fun->correo_inst = $request->get('correo_inst');

        $fun->save();
        
        return back()->with('success', 'Funcionario Actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $funcionario = $funcionarios = new Tbl_funcionarios();
        $id = $request->id_funcionario;
        $fun =  $funcionarios->findOrFail($id);
        $fun->delete();
        $retorna['msj'] = "Funcionario Eliminado correctamente.";
        $retorna['estado'] = "eliminado";        
        echo json_encode($retorna);
    }
}
