<?php

namespace App\Http\Controllers;

use App\Models\Cursos;
use App\Models\EntidadesFormadoreas;
use App\Models\Examen;
use App\Models\Formadores;
use App\Models\Tipo_De_Curso;
use App\Models\Tipo_Maquina;
use Illuminate\Http\Request;
use App\Models\Horario;

class HorarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $horario = Horario::all();
        $cursos = Cursos::select('id','codigo')->get();
//        dd($cursos[0]->id);
        return view ('admin.horario.index', compact('horario','cursos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $curso=Cursos::select('id','curso')->get();
        return view('admin.horario.create',compact('curso','id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();


        $horario = Horario::create($data);
        $cursos = Cursos::findOrFail($request->curso);
        $entidad=EntidadesFormadoreas::select('id','nombre')->get();
        $formador=Formadores::select('id','nombre')->get();
        $tipo_maquina=Tipo_Maquina::select('id','tipo_maquina')->get();
        $tipo_curso=Tipo_De_Curso::select('id','tipo_curso')->get();
        $examen_t=Examen::select('id','nombre')->where('tipo',1)->get();
        $examen_p=Examen::select('id','nombre')->where('tipo',2)->get();
        $formadors=Formadores::select('id','nombre')->get();
        $formadors2=Formadores::select('id','nombre')->get();
        $formadors3=Formadores::select('id','nombre')->get();

        if ($horario) {

            return redirect()->route('admin.cursos.edit',$cursos->id)->with('cursos','entidad','formador','tipo_maquina','tipo_curso','examen_t','examen_p','formadors','formadors2','formadors3');

        } else {

            return redirect()->route('admin.horario.create')->with('error', 'Data Gagal Ditambahkan');

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
        $horario = Horario::findOrFail($id);
        $curso=Cursos::select('id','curso')->get();
//        dd($horario);
        return view ('admin.horario.edit', compact('horario','curso'));
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
        $horario = horario::findOrFail($id);

        $horario->curso = $request->curso;
        $horario->contenido = $request->contenido;
        $horario->alumnos = $request->alumnos;
        $horario->fecha_inicio = $request->fecha_inicio;
        $horario->final = $request->final;





        if ($horario->save()) {

            return redirect()->route('admin.horario')->with('success', 'Data Berhasil Diperbarui');

        } else {

            return redirect()->route('admin.horario.edit')->with('error', 'Data Gagal Diperbarui');

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
        $Horario = Horario::findOrFail($id);

        $Horario->delete();

        return redirect()->route('admin.horario')->with('success', 'Data Berhasil Dihapus');
    }
}
