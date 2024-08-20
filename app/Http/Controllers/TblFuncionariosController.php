<?php

namespace App\Http\Controllers;

use App\Models\tbl_funcionarios;
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
        //
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

        dd($request);             
        $cedula = $request->get('cedulafun');

        $funcionarios->cedulafun = $cedula;
        $funcionarios->nombrefun = $request->get('nombrefun');
        $funcionarios->apellidofun = $request->get('apellidofun');
        $funcionarios->usuario_dominio = $request->get('usuario_dominio');
        $funcionarios->telefono = $request->get('telefono');
        $funcionarios->correo_personal = $request->get('correo_personal');
        $funcionarios->correo_inst = $request->get('correo_inst');

        $funcionarios->save();
        
        return back()->with('success', 'Funcionario insertado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $cedula = $request->get('cedulafun');
        $funcionarios = DB::table('tbl_funcionarios')->get();
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
