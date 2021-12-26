<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\{Asistent,
    Cursos,
    EntidadesFormadoreas,
    Examen,
    Formadores,
    Horario,
    Operadores,
    Pcategory,
    Tipo_De_Curso,
    Tipo_Maquina};

class CursosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cursos = Cursos::orderBy('id','desc')->where('estado',1)->get();

        return view('admin.cursos.index',compact('cursos'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index2()
    {
        $cursos = Cursos::orderBy('id','desc')->where('estado',0)->get();

        return view('admin.cursos.index',compact('cursos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $entidad=EntidadesFormadoreas::select('id','nombre')->get();
        $formador=Formadores::select('id','nombre')->get();
        $tipo_maquina=Tipo_Maquina::select('id','tipo_maquina')->get();
        $tipo_curso=Tipo_De_Curso::select('id','tipo_curso')->get();
        $examen_t=Examen::select('id','nombre')->where('tipo',1)->get();
        $examen_p=Examen::select('id','nombre')->where('tipo',2)->get();
        $formadors=Formadores::select('id','nombre')->get();
        $formadors2=Formadores::select('id','nombre')->get();
        $formadors3=Formadores::select('id','nombre')->get();
        $x =Cursos::select('curso')->orderBy('id','desc')->latest()->get();
        $course_code = $x[0]->curso +1;

//        dd($course_code);

//        dd($formador[0]->nombre);
        return view('admin.cursos.create',compact('entidad','course_code','formador','tipo_maquina','tipo_curso','examen_t','examen_p','formadors','formadors2','formadors3'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//dd($request);
        $request->validate([
            'curso' => 'required|max:255|unique:cursos',
            'tipo_curso' => 'required',
            'codigo' => 'required',
            'entidad' => 'required',
            'formador' => 'required',
            'ciudad' => 'required',
            'direccion' => 'required',
            'tipo_maquina' => 'required',
            'examen_t' => 'required',
            'examen_p' => 'required',
        ]);
        $cursos = new Cursos($request->except('_token','tipo_maquina','examen-t','examen-p','publico-privado','estado','cerrado'));
//        dd($cursos);

//        $cursos = new Cursos();
        if($request->cerrado == null){
            $cursos->cerrado = 0;
        }else{
            $cursos->cerrado = 1;
        }
        if($request->estado == null){
            $cursos->estado = 0;
        }else{
            $cursos->estado = 1;
        }
        if($request->publico_privado == null){
            $cursos->publico_privado = 0;
        }else{
            $cursos->publico_privado = 1;
        }
//dd($cursos->cerrado);
        if(!$request->formador_apoyo_2){
            $cursos->formador_apoyo_2 = 0;
        }
        $x =$request->input('tipo_maquina');



        for( $i=0 ; $i <= count($x)-1 ;$i++ ){
            if($i == 0){
                $cursos->tipo_maquina_1 = $x[$i];
//                dd($x[$i]);
                $cursos->tipo_maquina_2 = null;
                $cursos->tipo_maquina_3 = null;
                $cursos->tipo_maquina_4 = null;
            }elseif ($i == 1){
                $cursos->tipo_maquina_2 = $x[$i];
                $cursos->tipo_maquina_3 = null;
                $cursos->tipo_maquina_4 = null;
            }elseif ($i == 2){
                $cursos->tipo_maquina_3 = $x[$i];
                $cursos->tipo_maquina_4 = null;
            }elseif ($i == 3){
                $cursos->tipo_maquina_4 = $x[$i];
            }

        }

        $cursos->examen_t = $request->examen_t;
        $cursos->examen_p = $request->examen_p;



        $asistentes_pdf = $request->file('asistentes_pdf');

        if($asistentes_pdf){
            $asistentes_pdf_path = $asistentes_pdf->store('Cursos/'.$request->codigo, 'public');
            $cursos->asistentes_pdf = $asistentes_pdf_path;
        }

        if ($cursos->save()) {

            return redirect()->route('admin.cursos')->with('success', 'Data added successfully');

        } else {

            return redirect()->route('admin.cursos.create')->with('error', 'Data failed to add');

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
        $cursos = Cursos::findOrFail($id);
        $entidad=EntidadesFormadoreas::select('id','nombre')->get();
        $formador=Formadores::select('id','nombre')->get();
        $tipo_maquina=Tipo_Maquina::select('id','tipo_maquina')->get();
        $tipo_curso=Tipo_De_Curso::select('id','tipo_curso')->get();
        $examen_t=Examen::select('id','nombre')->where('tipo',1)->get();
        $examen_p=Examen::select('id','nombre')->where('tipo',2)->get();
        $formadors=Formadores::select('id','nombre')->get();
        $formadors2=Formadores::select('id','nombre')->get();
        $formadors3=Formadores::select('id','nombre')->get();
        $asistent = Asistent::orderBy('id','desc')->where('curso',$id)->get();
        $operador = Operadores::orderBy('id','desc')->get();
        $horario = Horario::orderBy('id','desc')->where('curso',$id)->get();

        return view('admin.cursos.edit',compact('cursos','horario','asistent','operador','entidad','formador','tipo_maquina','tipo_curso','examen_t','examen_p','formadors','formadors2','formadors3'));
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
        $request->validate([
            'curso' => 'required|max:255',
            'tipo_curso' => 'required',
            'codigo' => 'required',
            'entidad' => 'required',
            'formador' => 'required',
            'ciudad' => 'required',
            'direccion' => 'required',
            'tipo_maquina' => 'required',
            'examen_t' => 'required',
            'examen_p' => 'required',
        ]);

        $cursos = Cursos::findOrFail($id);
//        dd($request);

        $cursos->curso = $request->curso;
        $cursos->tipo_curso = $request->tipo_curso;
        $cursos->codigo = $request->codigo;
        $cursos->entidad = $request->entidad;
        $cursos->formador = $request->formador;
        $cursos->formador_apoyo_1 = $request->formador_apoyo_1;
        $cursos->formador_apoyo_2 = $request->formador_apoyo_2;
        $cursos->formador_apoyo_3 = $request->formador_apoyo_3;
        $cursos->fecha_inicio = $request->fecha_inicio;
        $cursos->direccion = $request->direccion;
        $cursos->ciudad = $request->ciudad;
        $cursos->provincia = $request->provincia;
        $cursos->codigo_postal = $request->codigo_postal;
        $cursos->examen_t = $request->examen_t;
        $cursos->examen_p = $request->examen_p;
        $cursos->fecha_alta = $request->fecha_alta;
//        $cursos->publico_privado = $request->publico_privado;
        $cursos->observaciones = $request->observaciones;
        if(!$request->formador_apoyo_2){
            $cursos->formador_apoyo_2 = 0;
        }
//        $cursos->cerrado = $request->cerrado;
//        $cursos->estado = $request->estado;
        $x =$request->input('tipo_maquina');

        if($request->cerrado == null){
            $cursos->cerrado = 0;
        }else{
            $cursos->cerrado = 1;
        }
        if($request->estado == null){
            $cursos->estado = 0;
        }else{
            $cursos->estado = 1;
        }
        if($request->publico_privado == null){
            $cursos->publico_privado = 0;
        }else{
            $cursos->publico_privado = 1;
        }

        for( $i=0 ; $i <= count($x)-1 ;$i++ ){
            if($i == 0){
                $cursos->tipo_maquina_1 = $x[$i];
//                dd($x[$i]);
                $cursos->tipo_maquina_2 = null;
                $cursos->tipo_maquina_3 = null;
                $cursos->tipo_maquina_4 = null;
            }elseif ($i == 1){
                $cursos->tipo_maquina_2 = $x[$i];
                $cursos->tipo_maquina_3 = null;
                $cursos->tipo_maquina_4 = null;
            }elseif ($i == 2){
                $cursos->tipo_maquina_3 = $x[$i];
                $cursos->tipo_maquina_4 = null;
            }elseif ($i == 3){
                $cursos->tipo_maquina_4 = $x[$i];
            }

        }


        $asistentes_pdf = $request->file('asistentes_pdf');

        if($asistentes_pdf){
            if($cursos->asistentes_pdf && file_exists(storage_path('app/public/' . $cursos->asistentes_pdf))){
                \Storage::delete('public/'. $cursos->asistentes_pdf);
            }

            $asistentes_pdf_path = $asistentes_pdf->store('images/Cursos', 'public');

            $cursos->asistentes_pdf = $asistentes_pdf_path;

        }

        if ($cursos->save()) {

            return redirect()->route('admin.cursos')->with('success', 'Data updated successfully');

        } else {

            return redirect()->route('admin.cursos.edit')->with('error', 'Data failed to update');

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
        $cursos = cursos::findOrFail($id);
        $cursos->delete();

        return redirect()->route('admin.cursos')->with('success', 'Data deleted successfully');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function activo($id)
    {
        $cursos = cursos::findOrFail($id);
        $cursos->estado = 1;
//        $cursos->delete();
        $cursos->save();

        return redirect()->route('admin.cursos')->with('success', 'Data deleted successfully');
    }
}
