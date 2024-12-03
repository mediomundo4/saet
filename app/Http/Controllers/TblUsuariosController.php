<?php

namespace App\Http\Controllers;

use App\Models\tbl_usuarios;
use App\Models\tbl_perfiles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TblUsuariosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    //funcion principal. envia toda la infor de una conslta para crear una tabla de consulta
    public function index()
    {
        $perfiles = tbl_perfiles::get();
        return view('usuario.formulario', compact('perfiles'));        
    }

    /**
     * Show the form for creating a new resource.
     */
    //funcion para insertar datos a la bd
    public function create()
    {
        
        /*
        $usuarios = new tbl_usuarios();//instancia (copia) al modelo de usuarios

        */ 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //dd($request);
        $request->validate([
            'nombre' => 'required',
            'apellido' => 'required',
            'cedula' => 'required',
            'usuario' => 'required',
            'clave' => 'required',
            'correo' => 'required',
            'id_perfil' => 'required',
            'ruta_foto' => 'required',
        ]);
        $usuarios = new tbl_usuarios();        
        $usuarios->nombre = $request->get('nombre');
        $usuarios->apellido = $request->get('apellido');
        
        $cedula = $request->get('cedula');        
        $usuarios->cedula = $cedula;
        
        $usr = $request->get('usuario');
        $usuarios->usuario = $usr;
        $usuarios->clave = $request->get('clave');
        $usuarios->correo = $request->get('correo');
        
        $foto = $request->file('ruta_foto');
        $nombre = $usr.".".$foto->getClientOriginalExtension();
        $destino = public_path('archivos/usuarios');
        $request->ruta_foto->move($destino, $nombre);        
        $usuarios->ruta_foto = $nombre;

        $usuarios->id_perfil = $request->get('id_perfil');
        $usuarios->save();
        return back()->with('success', 'Usuario registrado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $usuario = DB::table('tbl_usuarios')
        ->where('usuario', '=', $request->usuario)
        ->where('clave', '=', $request->clave)
        ->first(); //consulta a la bd 
        //dd($usuario); //imprime en pantalla 
        if($usuario !== null){   
            $nombre =  $usuario->nombre;
            $apellido = $usuario->apellido;
            $no = explode(' ', $nombre);
            $ap = explode(' ', $apellido);

            $name = $no[0].' '.$ap[0];
            session([
                'nombre_completo' => $name,
                'usuario' => $usuario->usuario,
                'perfil'  => $usuario->id_perfil,
                'foto' => $usuario->ruta_foto
            ]);              
            return redirect('/principal'); 
        }else{
            return back()->with('error','Usuario o Clave erronea..');
        }
    }

    public function cerrarsession(Request $request)
    {
        $request->session()->forget('nombre_completo');
        return redirect('/');
    }

    public function buscarcedula(Request $request){
        //dd($request);
        $usuario = DB::table('tbl_usuarios')
        ->where('cedula', '=', $request->cedula)
        ->first();
        if($usuario != null){
            $retorna['estado'] = 'encontrado';   
            $retorna['msj'] = 'Cedula ya registrada';   
        }
        echo json_encode($retorna);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(tbl_usuarios $tbl_usuarios)
    {
        $usuarios = DB::table('tbl_usuarios')
        ->join('tbl_perfiles', 'tbl_usuarios.id_perfil', 'tbl_perfiles.id_perfil')
        ->get();
        return view('usuario.listar', compact('usuarios'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, tbl_usuarios $tbl_usuarios)
    {
        
        $usuarios = DB::table('tbl_usuarios')
        ->where('usuario', '=', $request->usuario)
        ->first(); //consulta a la bd 
        $id_usuario = $usuarios->id_usuario;
        $usuario = tbl_usuarios::find($id_usuario);
        //dd($usr);

        $usr = $request->get('usuario');
        $foto = $request->file('ruta_foto');
        $nombre = $usr.".".$foto->getClientOriginalExtension();
        $destino = public_path('archivos/usuarios');
        $request->ruta_foto->move($destino, $nombre);        
        $usuario->ruta_foto = $nombre;  
        $usuario->save();
        $rt = $usuario->ruta_foto;
        if($rt == ''){
            return back()->with('errorfoto', 'Error al subir la imagen.');
        }else{
            session([                
                'foto' => $usuario->ruta_foto
            ]); 
            return back()->with('successfoto', 'Imagen subida correctamente.');
        }
    }


    public function update2(Request $request, tbl_usuarios $tbl_usuarios)
    {
        //dd($request);
        $user = $request->usuario;
        $datos = DB::table('tbl_usuarios')
        ->where('usuario', '=', $user)
        ->first();
        //dd($datos);
        $id = $datos->id_usuario;
        $usuario = tbl_usuarios::find($id);
        $usuario->clave = $request->clave;
        $usuario->save();
        $retorna["estado"] = "actualizado";
        $retorna["msj"] = "Clave Modificada.";
        echo json_encode($retorna);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(tbl_usuarios $tbl_usuarios)
    {
        //
    }
}
