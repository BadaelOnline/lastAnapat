<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cursos extends Model 
{
    protected $guarded=[];
    protected $table = 'cursos';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function entidades_formadoreas()
    {
        return $this->belongsTo('App\Model\Entidades_Formadoreas', 'entidad');
    }

    public function formadores()
    {
        return $this->belongsTo('App\Model\Formadores', 'formador', 'formador_apoyo_1', 'formador_apoyo_2', 'formador_apoyo_3');
    }

    public function tipo_maquina()
    {
        return $this->belongsTo('App\Model\Tipo_Maquina', 'tipo_maquina_1', 'tipo_maquina_2', 'tipo_maquina_3', 'tipo_maquina_4');
    }

    public function tipo_de_curso()
    {
        return $this->belongsTo('App\Model\Tipo_De_Curso', 'tipo_curso');
    }

    public function teoria()
    {
        return $this->belongsTo('App\Model\Teoria', 'examen-t');
    }

    public function practica()
    {
        return $this->belongsTo('App\Model\Practica', 'examen-p');
    }

    public function horario()
    {
        return $this->hasMany('App\Model\Horario', 'curso');
    }

    public function asistent()
    {
        return $this->hasMany('App\Model\Asistent', 'curso');
    }

    public function carnet()
    {
        return $this->hasMany('App\Model\Carnet', 'curso');
    }

}