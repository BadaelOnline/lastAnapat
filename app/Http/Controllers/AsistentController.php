<?php

namespace App\Http\Controllers;

use App\Exports\AssistantExport;
use App\Exports\CursoExport;
use Illuminate\Http\Request;

use App\Models\{Asistent,
    Carnet,
    Certificado,
    Cursos,
    EntidadesFormadoreas,
    Examen,
    Formadores,
    Operadores,
    Pcategory,
    Practica,
    Teoria,
    Tipo_De_Curso,
    Tipo_Maquina};
use Maatwebsite\Excel\Facades\Excel;

class AsistentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $asistent = Asistent::orderBy('id', 'desc')->get();
        $operador = Operadores::orderBy('id', 'desc')->get();

        return view('admin.asistent.index', compact('asistent', 'operador'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $user = auth()->user();
        if ($user->perfil == 'Administrador') {
            $operador = Operadores::select('id', 'nombre', 'apellidos')->get();
        } else {
            $operador = Operadores::select('id', 'nombre', 'apellidos')->where('entidad', '=', $user->entidad)->get();
        }
        $curso = Cursos::select('id', 'codigo')->get();
        $cursos = Cursos::orderBy('id', 'desc')->get();

        $tipo_carnet = Teoria::select('id', 'formacion')->get();
        $tipo = Tipo_Maquina::orderBy('id', 'desc')->get();
        $corse = Cursos::where('id', $id)->first();
        $x =Asistent::select('orden')->orderBy('id','desc')->latest()->get();
        if(count($x) > 0){
            $orden = $x[0]->orden +1;
        }else{
            $orden = 1;
        }

        $tipo_1 = $corse->tipo_maquina_1;
        $tipo_2 = $corse->tipo_maquina_2;
        $tipo_3 = $corse->tipo_maquina_3;
        $tipo_4 = $corse->tipo_maquina_4;
        $tipos = [$tipo_1,$tipo_2,$tipo_3,$tipo_4];
        return view('admin.asistent.create', compact('curso','orden', 'id', 'operador', 'tipo_carnet', 'tipo', 'cursos', 'tipos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        dd($request);
        $request->validate([
            'curso' => 'required',
            'orden' => 'required|max:7',
            'operador' => 'required',
            'tipo_carnet' => 'required',
            'nota_t' => 'required|numeric',
            'nota_p' => 'required|numeric',
            'tipo_1' => 'required',
        ]);
//dd($request);

        $asistent = new Asistent($request->except('_token'));
        if (!$request->tipo_2) {
            $asistent->tipo_2 = 0;
        }
        if (!$request->tipo_3) {
            $asistent->tipo_3 = 0;
        }
        if (!$request->tipo_4) {
            $asistent->tipo_4 = 0;
        }

        $examen_t_pdf = $request->file('examen_t_pdf');
        if ($examen_t_pdf) {
            $examen_t_pdf_path = $examen_t_pdf->store('asistent/', 'public');

            $asistent->examen_t_pdf = $examen_t_pdf_path;
        } else {
            $asistent->examen_t_pdf = '';
        }
        $examen_p_pdf = $request->file('examen_p_pdf');
        if ($examen_p_pdf) {
            $examen_p_pdf_path = $examen_p_pdf->store('asistent/', 'public');

            $asistent->examen_p_pdf = $examen_p_pdf_path;
        } else {
            $asistent->examen_p_pdf = '';
        }
        $operador = Operadores::findOrFail((int)$request->operador);
        $asistent->emision = $operador->fecha;
        $asistent->vencimiento = $operador->fecha_nacimiento;
        $cursos = Cursos::findOrFail($request->curso);
        $entidad = EntidadesFormadoreas::select('id', 'nombre')->get();
        $formador = Formadores::select('id', 'nombre')->get();
        $tipo_maquina = Tipo_Maquina::select('id', 'tipo_maquina')->get();
        $tipo_curso = Tipo_De_Curso::select('id', 'tipo_curso')->get();
        $examen_t = Examen::select('id', 'nombre')->where('tipo', 1)->get();
        $examen_p = Examen::select('id', 'nombre')->where('tipo', 2)->get();
        $formadors = Formadores::select('id', 'nombre')->get();
        $formadors2 = Formadores::select('id', 'nombre')->get();
        $formadors3 = Formadores::select('id', 'nombre')->get();

        if ($asistent->save()) {
            if ($operador->carnett != null){

                $carnet = $operador->carnett;
                $carnet->curso = $cursos->id;
                $carnet->estado = 1;
                $carnet->fecha_de_alta = $asistent->vencimiento;
                $carnet->fecha_de_emision = $asistent->emision;
//                $carnet->

                $carnet->save();
                if ($cursos->tipo_maquina_1 != null){
                    $carnet->Tipo_Maquinas()->attach($cursos->tipo_maquina_1);
                }
                if ($cursos->tipo_maquina_2 != null){
                    $carnet->Tipo_Maquinas()->attach($cursos->tipo_maquina_2);
                }
                if ($cursos->tipo_maquina_3 != null){
                    $carnet->Tipo_Maquinas()->attach($cursos->tipo_maquina_3);
                }
                if ($cursos->tipo_maquina_4 != null){
                    $carnet->Tipo_Maquinas()->attach($cursos->tipo_maquina_4);
                }
            }
            else{
                $carnet = new Carnet();

                if ($operador->carnet != null){
                    $carnet->numero = $operador->carnet;
                }else{
                    $carnet->numero = substr(md5(microtime()),rand(0,26),8) ;
                }

//                $carnet->numero = $operador->carnet;
                $carnet->operador = $operador->id;
                $carnet->fecha_de_alta = $asistent->vencimiento;
                $carnet->fecha_de_emision = $asistent->emision;
                $carnet->foto = $operador->foto;
                $carnet->curso = $cursos->id;
                $carnet->estado = 1 ;
//                dd($carnet);
                $carnet->save();
                if ($cursos->tipo_maquina_1 != null){
                    $carnet->Tipo_Maquinas()->attach($cursos->tipo_maquina_1);
                }
                if ($cursos->tipo_maquina_2 != null){
                    $carnet->Tipo_Maquinas()->attach($cursos->tipo_maquina_2);
                }
                if ($cursos->tipo_maquina_3 != null){
                    $carnet->Tipo_Maquinas()->attach($cursos->tipo_maquina_3);
                }
                if ($cursos->tipo_maquina_4 != null){
                    $carnet->Tipo_Maquinas()->attach($cursos->tipo_maquina_4);
                }
            }
            $certificado = new Certificado();
            $asi_fecha = date('Y', strtotime($asistent->created_at));
            $asi_fecham = date('m', strtotime($asistent->created_at));
            $asi_fechad = date('d', strtotime($asistent->created_at));
            $asi_fechah = date('h', strtotime($asistent->created_at));
            $asi_fechai = date('i', strtotime($asistent->created_at));
            $asi_fechas = date('s', strtotime($asistent->created_at));
            $asi_orden = $asistent->orden;
            $cert_numero = $asi_fecha . "" . $asi_fecham . "" . $asi_fechad . "" . $asi_fechah . "" . $asi_fechai . "" . $asi_fechas . "" . $operador->dni;
            $certificado->numero = $cert_numero;
            $certificado->cer_apellidos = $operador->apellidos;
            $certificado->cer_nombre = $operador->nombre;
            $certificado->operador = $operador->id;
            if ($operador->entidad != 0){
                $certificado->entidad = $operador->entidad;
                $certificado->entidad_nombre = $operador->entidades_formadoreas->nombre;
            }else{
                $certificado->entidad = 0;
                $certificado->entidad_nombre = "";
            }
            $certificado->curso = $asistent->curso;
            $certificado->emision = $asistent->emision;
            $certificado->vencimiento = $asistent->vencimiento;
            $certificado->observaciones = $asistent->observaciones;
            $certificado->dni = $operador->dni;
            if ($cursos != null){
                if ($cursos->tipo_curso == 1){
                    $certificado->cer_type_course = 'Básico';
                    $certificado->tipos_carnet = $asistent->tipos_carnet;
                }else{
                    $certificado->cer_type_course = 'Renovación';
                    $certificado->tipos_carnet = $asistent->tipos_carnet;
                }
                $certificado->fecha_alta = $cursos->fecha_alta;
            }else{
                $certificado->cer_type_course = '-';
                $certificado->tipos_carnet = '-';
                $certificado->fecha_alta = null;
            }
            if ($asistent->tipo_1 != 0){
                $tipo_1 =Tipo_Maquina::findOrFail($asistent->tipo_1);

                if($tipo_1 != null){
                    $certificado->tipo_1 = $tipo_1->tipo_maquina;

                }else{
                    $certificado->tipo_1 = '-----';
                }
            }else{
                $certificado->tipo_1 = '-----';
            }
            if ($asistent->tipo_2 != 0) {
                $tipo_2 = Tipo_Maquina::findOrFail($asistent->tipo_2);
                if ($tipo_2 != null) {
                    $certificado->tipo_2 = $tipo_2->tipo_maquina;

                } else {
                    $certificado->tipo_2 = '-----';
                }
            }else{
                $certificado->tipo_2 = '-----';
            }
            if ($asistent->tipo_3 != 0){
                $tipo_3 =Tipo_Maquina::findOrFail($asistent->tipo_3);
                if($tipo_3 != null){
                    $certificado->tipo_3 = $tipo_3->tipo_maquina;
                }else{
                    $certificado->tipo_3 = '-----';
                }
            }else{
                $certificado->tipo_3 = '-----';
            }
            if ($asistent->tipo_4 != 0) {
                $tipo_4 = Tipo_Maquina::findOrFail($asistent->tipo_4);
                if ($tipo_4 != null) {
                    $certificado->tipo_4 = $tipo_4->tipo_maquina;
                } else {
                    $certificado->tipo_4 = '-----';
                }
            } else {
                $certificado->tipo_4 = '-----';
            }
            if ($operador->carnett != null){
                $certificado->carnet = $operador->carnett->numero;
            }
            $certificado->save();


            return redirect()->route('admin.cursos.edit', $cursos->id)->with('cursos', 'entidad', 'formador', 'tipo_maquina', 'tipo_curso', 'examen_t', 'examen_p', 'formadors', 'formadors2', 'formadors3');

        } else {

            return redirect()->route('admin.asistent.create')->with('error', 'Data failed to add');

        }
    }

    public function export()
    {
        return Excel::download(new AssistantExport(), 'asistent.xlsx');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = auth()->user();
        if ($user->perfil == 'Administrador') {
            $operador = Operadores::select('id', 'nombre', 'apellidos')->get();
        } else {
            $operador = Operadores::select('id', 'nombre', 'apellidos')->where('entidad', '=', $user->entidad)->get();
        }
        $asistent = Asistent::findOrFail($id);
        $curso = Cursos::select('id', 'codigo')->get();
        $tipo_carnet = Teoria::select('id', 'formacion')->get();
        $tipo = Tipo_Maquina::orderBy('id', 'desc')->get();
        $corse = Cursos::where('id', $asistent->curso)->first();
        $tipo_1 = $corse->tipo_maquina_1;
        $tipo_2 = $corse->tipo_maquina_2;
        $tipo_3 = $corse->tipo_maquina_3;
        $tipo_4 = $corse->tipo_maquina_4;
        $tipos = [$tipo_1,$tipo_2,$tipo_3,$tipo_4];
//        dd($tipos);

        return view('admin.asistent.edit', compact('asistent', 'curso', 'operador', 'tipo_carnet', 'tipo','tipos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
//        dd($request);
//        \Validator::make($request->all(), [
//            "category" => "required",
//            "desc" => "required"
//        ])->validate();
        $request->validate([
            'curso' => 'required',
            'orden' => 'required',
            'operador' => 'required',
            'tipo_carnet' => 'required',
            'nota_t' => 'required',
            'nota_p' => 'required',
            'tipo_1' => 'required',
        ]);
        $asistent = Asistent::findOrFail($id);
        $asistent->curso = $request->curso;
        $asistent->orden = $request->orden;
        $asistent->operador = $request->operador;
        $asistent->tipos_carnet = $request->tipos_carnet;
        $asistent->nota_t = $request->nota_t;
        $asistent->nota_p = $request->nota_p;
        $asistent->observaciones = $request->observaciones;
        $operador = Operadores::findOrFail((int)$request->operador);
        $asistent->emision = $operador->fecha;
        $asistent->vencimiento = $request->vencimiento;
        $asistent->tipo_1 = $request->tipo_1;
        if (!$request->tipo_2) {
            $asistent->tipo_2 = 0;
        } else {
            $asistent->tipo_2 = $request->tipo_2;
        }
        if (!$request->tipo_3) {
            $asistent->tipo_3 = 0;
        } else {
            $asistent->tipo_3 = $request->tipo_3;
        }
        if (!$request->tipo_4) {
            $asistent->tipo_4 = 0;
        } else {
            $asistent->tipo_4 = $request->tipo_4;
        }


        $examen_t_pdf = $request->file('examen_t_pdf');

        if ($examen_t_pdf) {
            if ($asistent->examen_t_pdf && file_exists(storage_path('app/public/' . $asistent->examen_t_pdf))) {
                \Storage::delete('public/' . $asistent->examen_t_pdf);
            }

            $examen_t_pdf_path = $examen_t_pdf->store('images/asistent', 'public');

            $asistent->examen_t_pdf = $examen_t_pdf_path;

        }
        $examen_p_pdf = $request->file('examen_p_pdf');

        if ($examen_p_pdf) {
            if ($asistent->examen_p_pdf && file_exists(storage_path('app/public/' . $asistent->examen_p_pdf))) {
                \Storage::delete('public/' . $asistent->examen_p_pdf);
            }

            $examen_p_pdf_path = $examen_p_pdf->store('images/asistent', 'public');

            $asistent->examen_p_pdf = $examen_p_pdf_path;

        }


        if ($asistent->save()) {

            $cursos = Cursos::findOrFail($request->curso);
            if ($operador->carnett != null){

                $carnet = $operador->carnett;

                $carnet->curso = $cursos->id;
                $carnet->estado = 1;
                $carnet->fecha_de_alta = $asistent->vencimiento;
                $carnet->fecha_de_emision = $asistent->emision;
//                $carnet->

                $carnet->save();
                if ($cursos->tipo_maquina_1 != null){
                    $carnet->Tipo_Maquinas()->attach($cursos->tipo_maquina_1);
                }
                if ($cursos->tipo_maquina_2 != null){
                    $carnet->Tipo_Maquinas()->attach($cursos->tipo_maquina_2);
                }
                if ($cursos->tipo_maquina_3 != null){
                    $carnet->Tipo_Maquinas()->attach($cursos->tipo_maquina_3);
                }
                if ($cursos->tipo_maquina_4 != null){
                    $carnet->Tipo_Maquinas()->attach($cursos->tipo_maquina_4);
                }
            }
            else{
                $carnet = new Carnet();
                if ($operador->carnet != null){
                    $carnet->numero = $operador->carnet;
                }else{
                    $carnet->numero = substr(md5(microtime()),rand(0,26),8) ;
                }
//                if ($operador->carnet)
//                $carnet->numero = $operador->carnet;
                $carnet->operador = $operador->id;
                $carnet->fecha_de_alta = $asistent->vencimiento;
                $carnet->fecha_de_emision = $asistent->emision;
//                dd($cursos->tipo_maquina_1);


                $carnet->foto = $operador->foto;

                $carnet->curso = $cursos->id;
                $carnet->estado = 1 ;
//                dd($carnet);
                $carnet->save();
                if ($cursos->tipo_maquina_1 != null){
                    $carnet->Tipo_Maquinas()->attach($cursos->tipo_maquina_1);
                }
                if ($cursos->tipo_maquina_2 != null){
                    $carnet->Tipo_Maquinas()->attach($cursos->tipo_maquina_2);
                }
                if ($cursos->tipo_maquina_3 != null){
                    $carnet->Tipo_Maquinas()->attach($cursos->tipo_maquina_3);
                }
                if ($cursos->tipo_maquina_4 != null){
                    $carnet->Tipo_Maquinas()->attach($cursos->tipo_maquina_4);
                }
            }
            if ($operador->certificado()->where('curso' , $cursos->id)->first() != null){
                $certificado = $operador->certificado()->where('curso' , $cursos->id)->first();
//                dd($certificado);
            }else{
                $certificado = new Certificado();
//                dd('2222222222');
            }

            $asi_fecha = date('Y', strtotime($asistent->created_at));
            $asi_fecham = date('m', strtotime($asistent->created_at));
            $asi_fechad = date('d', strtotime($asistent->created_at));
            $asi_fechah = date('h', strtotime($asistent->created_at));
            $asi_fechai = date('i', strtotime($asistent->created_at));
            $asi_fechas = date('s', strtotime($asistent->created_at));
            $asi_orden = $asistent->orden;
            $cert_numero = $asi_fecha . "" . $asi_fecham . "" . $asi_fechad . "" . $asi_fechah . "" . $asi_fechai . "" . $asi_fechas . "" . $operador->dni;
            $certificado->numero = $cert_numero;
            $certificado->cer_apellidos = $operador->apellidos;
            $certificado->cer_nombre = $operador->nombre;
            $certificado->operador = $operador->id;
            if ($operador->entidad != 0){
                $certificado->entidad = $operador->entidad;
                $certificado->entidad_nombre = $operador->entidades_formadoreas->nombre;
            }else{
                $certificado->entidad = 0;
                $certificado->entidad_nombre = "";
            }
            $certificado->curso = $asistent->curso;
            $certificado->emision = $asistent->emision;
            $certificado->vencimiento = $asistent->vencimiento;
            $certificado->observaciones = $asistent->observaciones;
            $certificado->dni = $operador->dni;
            if ($cursos != null){
                if ($cursos->tipo_curso == 1){
                    $certificado->cer_type_course = 'Básico';
                    $certificado->tipos_carnet = $asistent->tipos_carnet;
                }else{
                    $certificado->cer_type_course = 'Renovación';
                    $certificado->tipos_carnet = $asistent->tipos_carnet;
                }
                $certificado->fecha_alta = $cursos->fecha_alta;
            }else{
                $certificado->cer_type_course = '-';
                $certificado->tipos_carnet = '-';
                $certificado->fecha_alta = null;
            }
            if ($asistent->tipo_1 != 0){
                $tipo_1 =Tipo_Maquina::findOrFail($asistent->tipo_1);

                if($tipo_1 != null){
                    $certificado->tipo_1 = $tipo_1->tipo_maquina;

                }else{
                    $certificado->tipo_1 = '-----';
                }
            }else{
                $certificado->tipo_1 = '-----';
            }
            if ($asistent->tipo_2 != 0) {
                $tipo_2 = Tipo_Maquina::findOrFail($asistent->tipo_2);
                if ($tipo_2 != null) {
                    $certificado->tipo_2 = $tipo_2->tipo_maquina;

                } else {
                    $certificado->tipo_2 = '-----';
                }
            }else{
                $certificado->tipo_2 = '-----';
            }
            if ($asistent->tipo_3 != 0){
                $tipo_3 =Tipo_Maquina::findOrFail($asistent->tipo_3);
                if($tipo_3 != null){
                    $certificado->tipo_3 = $tipo_3->tipo_maquina;
                }else{
                    $certificado->tipo_3 = '-----';
                }
            }else{
                $certificado->tipo_3 = '-----';
            }
            if ($asistent->tipo_4 != 0) {
                $tipo_4 = Tipo_Maquina::findOrFail($asistent->tipo_4);
                if ($tipo_4 != null) {
                    $certificado->tipo_4 = $tipo_4->tipo_maquina;
                } else {
                    $certificado->tipo_4 = '-----';
                }
            } else {
                $certificado->tipo_4 = '-----';
            }
            if ($operador->carnett != null){
                $certificado->carnet = $operador->carnett->numero;
            }
            $certificado->save();


            return redirect()->route('admin.cursos.edit', [$asistent->curso])->with('success', 'Data updated successfully');

        } else {

            return redirect()->route('admin.asistent.edit')->with('error', 'Data failed to update');

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $asistent = Asistent::findOrFail($id);
        $curso = $asistent->curso;
        $asistent->delete();

        return redirect()->route('admin.cursos.edit', [$curso])->with('success', 'Data deleted successfully');
    }
}
