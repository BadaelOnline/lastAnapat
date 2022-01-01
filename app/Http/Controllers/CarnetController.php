<?php

namespace App\Http\Controllers;

use App\Models\Carnet;
use App\Models\Cursos;
use App\Models\Operadores;
use Illuminate\Http\Request;

class CarnetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        if($user->perfil=='Responsable_de_Formacion' || $user->perfil=='Formador')

            $operadors = Operadores::orderBy('id','desc')->where('entidad','=',$user->entidad)->get();

        else
            $operadors = Operadores::orderBy('id','desc')->get();
        $carnets = Carnet::orderBy('id','desc')->get();
        return view('admin.carnet.index',compact('operadors','carnets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = auth()->user();
        if($user->perfil=='Responsable_de_Formacion' || $user->perfil=='Formador')

            $operadores = Operadores::orderBy('id','desc')->where('entidad','=',$user->entidad)->get();

        else
            $operadores = Operadores::orderBy('id','desc')->get();
        $cursos = Cursos::orderBy('id','desc')->get();
        return view('admin.carnet.create',compact('operadores','cursos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $carnet = new Carnet($request->except('_token','estado'));
        if($request->estado == null){
            $carnet->estado = 0;
        }else{
            $carnet->estado = 1;
        }
        $foto = $request->file('foto');
        if($foto){
            $foto_path = $foto->store('Carnet/'.$request->numero, 'public');

            $carnet->foto = $foto_path;
        }else{
            $carnet->foto ='';
        }
        if ( $carnet->save()) {

            return redirect()->route('admin.carnet')->with('success', 'Data added successfully');

        } else {

            return redirect()->route('admin.carnet.create')->with('error', 'Data failed to add');

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
        $carnet = Carnet::findOrFail($id);
        $cursos=Cursos::select('id','codigo')->get();
        $user = auth()->user();
        if($user->perfil=='Responsable_de_Formacion' || $user->perfil=='Formador')

            $operadores = Operadores::orderBy('id','desc')->where('entidad','=',$user->entidad)->get();

        else
            $operadores = Operadores::orderBy('id','desc')->get();

        return view('admin.carnet.edit',compact('carnet','cursos','operadores'));
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
        $carnet = Carnet::findOrFail($id);
        $carnet->numero = $request->numero;
        $carnet->operador = $request->operador;
        $carnet->fecha_de_alta = $request->fecha_de_alta;
        $carnet->fecha_de_emision = $request->fecha_de_emision;
        $carnet->tipos_de_pemp = $request->tipos_de_pemp;
        $carnet->curso = $request->curso;
        $carnet->examen_teorico_realizado = $request->examen_teorico_realizado;

        if($request->estado == null){
            $carnet->estado = 0;
        }else{
            $carnet->estado = 1;
        }

        $foto = $request->file('foto');

        if($foto){
            if($carnet->foto && file_exists(storage_path('app/public/' . $carnet->foto))){
                \Storage::delete('public/'. $carnet->foto);
            }

            $foto_path = $foto->store('Carnet/'.$request->numero, 'public');

            $carnet->foto = $foto_path;
        }

        if ( $carnet->save()) {

            return redirect()->route('admin.carnet')->with('success', 'Data added successfully');

        } else {

            return redirect()->route('admin.carnet.edit',$carnet->id)->with('error', 'Data failed to add');

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
        $carnet = Carnet::findOrFail($id);

        $carnet->delete();

        return redirect()->route('admin.carnet')->with('success', 'Data deleted successfully');
    }
}
