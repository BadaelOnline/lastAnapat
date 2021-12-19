<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Asistent extends Model 
{

    protected $table = 'asistent';
    public $timestamps = true;
    protected $guarded=[];
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function cursos()
    {
        return $this->belongsTo('App\Model\Cursos', 'curso');
    }

    public function operadores()
    {
        return $this->belongsTo('App\Model\Operadores', 'operador');
    }

    public function teoria()
    {
        return $this->belongsTo('App\Model\Teoria', 'tipo_carnet');
    }

    public function practica()
    {
        return $this->belongsTo('App\Model\Practica', 'tipo_1', 'tipo_2', 'tipo_3', 'tipo_4');
    }

}