<?php

namespace App\Http\Controllers;

use App\Models\Asistent;
use App\Models\Carnet;
use App\Models\Certificado;
use App\Models\Cursos;
use App\Models\EntidadesFormadoreas;
use App\Models\Operadores;
use App\Models\Tipo_Maquina;
use Illuminate\Http\Request;

class CertificadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        $now = now().date('');
        if($user->perfil=='Responsable_de_Formacion' || $user->perfil=='Formador')

            $operadors = Operadores::orderBy('id','desc')->where('entidad','=',$user->entidad)->get();

        else
            $operadors = Operadores::orderBy('id','desc')->get();
        $certificados = Certificado::orderBy('id','desc')->whereDate('vencimiento' , '>' ,$now )->get();
        return view('admin.certificado.index',compact('operadors','certificados'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index2()
    {
        $user = auth()->user();
        $now = now().date('');
        if($user->perfil=='Responsable_de_Formacion' || $user->perfil=='Formador')

            $operadors = Operadores::orderBy('id','desc')->where('entidad','=',$user->entidad)->get();

        else
            $operadors = Operadores::orderBy('id','desc')->get();
        $certificados = Certificado::orderBy('id','desc')->whereDate('vencimiento' , '<=' ,$now )->get();
        return view('admin.certificado.index',compact('operadors','certificados'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = auth()->user();
        if($user->perfil=='Responsable_de_Formacion' || $user->perfil=='Formador'){
            $entidad=EntidadesFormadoreas::select('id','nombre')->where('id','=',$user->entidad)->get();
            $operadores = Operadores::orderBy('id','desc')->where('entidad','=',$user->entidad)->where('estado','=',0)->get();
        }else{
            $operadores = Operadores::orderBy('id','desc')->where('estado','=',0)->get();
            $entidad=EntidadesFormadoreas::select('id','nombre')->get();
        }

        $cursos = Cursos::orderBy('id','desc')->get();
        $tipos =Tipo_Maquina::orderBy('id','desc')->get();
        return view('admin.certificado.create',compact('operadores','cursos','tipos','entidad'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'operador' => 'required',
        ]);

//        $certificado = new Certificado($request->except('_token','tipos_de_pemp'));
//        $ope_id = (int)$request->operador;
//        $curso_id = (int)$request->curso;
//        $entidad_id = (int)$request->entidad;
//        $entidad = EntidadesFormadoreas::findOrFail($entidad_id);
//        $operador = Operadores::findOrFail($ope_id);
//        $curso = Cursos::findOrFail($curso_id);
//        $certificado->entidad_nombre = $entidad->nombre;
//        $certificado->cer_apellidos = $operador->apellidos;
//        $certificado->cer_nombre = $operador->nombre;
//        $certificado->dni = $operador->dni;
//        if ($curso->tipo_curso == 1){
//            $certificado->cer_type_course = 'Básico';
//            $certificado->tipos_carnet = 'B';
//        }elseif ($curso->tipo_curso == 2){
//            $certificado->cer_type_course = 'Renovación';
//            $certificado->tipos_carnet = 'R';
//        }else{
//            $certificado->cer_type_course = null;
//            $certificado->tipos_carnet = null;
//        }
//        $certificado->fecha_alta = $curso->fecha_alta;
//
////        dd($operador);
//
//        if ( $certificado->save()) {
////            dd($carnet);
//            $certificado->Tipo_Maquinas()->attach(request('tipos_de_pemp'));
//            return redirect()->route('admin.certificado')->with('success', 'Data added successfully');
//
//        } else {
//
//            return redirect()->route('admin.certificado.create')->with('error', 'Data failed to add');
//
//        }
        $id = $request->operador;
        $operador = Operadores::findOrFail($id);
        $asistents = Asistent::where('operador', $id)->get();
        $activeAsistent = null;
        $curso = null;
        $cert_numero = null;
//        if ($activeAsistent != null) {
        foreach ($asistents as $asistent) {
            $curso = Cursos::findOrFail($asistent->curso);
            if ($curso->estado == 1) {
                $activeAsistent = $asistent;
//                    dd($asistent);
            }
        }
//        dd($activeAsistent);



//        }
//        dd($activeAsistent);

        $tipos = Tipo_Maquina::orderBy('id', 'asc')->get();
        if ($activeAsistent != null)
            $cer = Certificado::where('operador',$id)->where('curso',$activeAsistent->curso)->get();
//        dd($cer);
        $certificado = new Certificado();
        $asi_fecha = date('Y', strtotime($activeAsistent->created_at));
        $asi_orden = $activeAsistent->orden;
        $cert_numero = $asi_fecha . "" . $asi_orden . "" . $operador->dni;

        if ($activeAsistent != null && $operador->entidad != 0 &&$curso != null && $cert_numero != null && count($cer) == 0){
            $certificado = new Certificado();
            $asi_fecha = date('Y', strtotime($activeAsistent->created_at));
            $asi_orden = $activeAsistent->orden;
            $cert_numero = $asi_fecha . "" . $asi_orden . "" . $operador->dni;
            $certificado->numero = $cert_numero;
            $certificado->cer_apellidos = $operador->apellidos;
            $certificado->cer_nombre = $operador->nombre;
            $certificado->operador = $id;
            if ($operador->entidad != 0){
                $certificado->entidad = $operador->entidad;
                $certificado->entidad_nombre = $operador->entidades_formadoreas->nombre;
            }else{
                return redirect()->route('admin.certificado.create')->with('error', 'Data failed to add the operador must be in entidad');
            }

            if ($activeAsistent != null){
                $certificado->curso = $activeAsistent->curso;
                $certificado->emision = $activeAsistent->emision;
                $certificado->vencimiento = $activeAsistent->vencimiento;
                $certificado->observaciones = $activeAsistent->observaciones;
            }

            $certificado->dni = $operador->dni;
            if ($curso != null){
                if ($curso->tipo_curso == 1){
                    $certificado->cer_type_course = 'Básico';
                    $certificado->tipos_carnet = 'B';
                }else{
                    $certificado->cer_type_course = 'Renovación';
                    $certificado->tipos_carnet = 'R';
                }
                $certificado->fecha_alta = $curso->fecha_alta;
            }





            if ($operador->carnett != null)
                $certificado->carnet = $operador->carnett->id;
            $certificado->save();
            return view('admin.operadores.certificado', compact('operador', 'curso', 'tipos', 'cert_numero', 'activeAsistent'));
        }else{
            return redirect()->route('admin.certificado.create')->with('error', 'Data failed to add ,The operador must be asistent and must have entidad');
        }

//        $certificado->cer_fecha = $activeAsistent->observaciones;
//        dd($operador->carnett);
//        dd($cert_numero);


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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
