<?php

namespace App\Http\Controllers;


use App\Models\EntidadesFormadoreas;
use App\Models\Operadores;
use Illuminate\Http\Request;

class OperadoresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $operadores = Operadores::orderBy('id','desc')->get();

        return view('admin.operadores.index',compact('operadores'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $entidad=EntidadesFormadoreas::select('id','nombre')->get();
        return view('admin.operadores.create',compact('entidad'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {



        $operadores = new operadores($request->except('_token'));

        $foto = $request->file('foto');
        $dni_img = $request->file('dni_img');
        if($foto){
            $fotopath = $foto->store('operadoe/'.$request->nombre, 'public');

            $operadores->foto = $fotopath;
        }else{
            $operadores->dni_img ='';
        }
        if($dni_img){
            $dni_imgpath = $dni_img->store('operadoe/'.$request->nombre, 'public');

            $operadores->dni_img = $dni_imgpath;
        }else{
            $operadores->dni_img ='';
        }


        if ( $operadores->save()) {

            return redirect()->route('admin.operadores')->with('success', 'Data added successfully');

        } else {

            return redirect()->route('admin.operadores.create')->with('error', 'Data failed to add');

        }
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $operadores = Operadores::findOrFail($id);
        $entidad=EntidadesFormadoreas::select('id','nombre')->get();

        return view('admin.operadores.edit',compact('operadores','entidad'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {


        $operadores = Operadores::findOrFail($id);
        $operadores->dni = $request->dni;
        $operadores->apellidos = $request->apellidos;
        $operadores->nombre = $request->nombre;
        $operadores->entidad = $request->entidad;
        $operadores->fecha_nacimiento = $request->fecha_nacimiento;
        $operadores->provincia = $request->provincia;
        $operadores->ciudad = $request->ciudad;
        $operadores->direccion = $request->direccion;
        $operadores->codigo_postal = $request->codigo_postal;
        $operadores->mail = $request->mail;
        $operadores->carnet = $request->carnet;
        $operadores->fecha = $request->fecha;
        $operadores->estado = $request->estado;

        $foto = $request->file('foto');
        $dni_img = $request->file('dni_img');
        if($foto){
            if($operadores->foto && file_exists(storage_path('app/public/' . $operadores->foto))){
                \Storage::delete('public/'. $operadores->foto);
            }

            $foto_path = $foto->store('operadore/'.$request->nombre, 'public');

            $operadores->foto = $foto_path;
        }
        if($dni_img){
            if($operadores->dni_img && file_exists(storage_path('app/public/' . $operadores->dni_img))){
                \Storage::delete('public/'. $operadores->dni_img);
            }

            $dni_img_path = $dni_img->store('operadore/'.$request->nombre, 'public');

            $operadores->dni_img = $dni_img_path;
        }


        if ( $operadores->save()) {

            return redirect()->route('admin.operadores')->with('success', 'Data added successfully');

        } else {

            return redirect()->route('admin.operadores.create')->with('error', 'Data failed to add');

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $operadores = Operadores::findOrFail($id);

        $operadores->delete();

        return redirect()->route('admin.operadores')->with('success', 'Data deleted successfully');
    }
}
