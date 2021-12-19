<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Carnet extends Model 
{

    protected $table = 'carnet';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function operadores()
    {
        return $this->belongsTo('App\Model\Operadores', 'operador');
    }

    public function cursos()
    {
        return $this->belongsTo('App\Model\Cursos', 'curso');
    }

}