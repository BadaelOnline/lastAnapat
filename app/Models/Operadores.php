<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Operadores extends Model 
{

    protected $table = 'operadores';
    public $timestamps = true;
    protected $guarded=[];
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function entidades_formadoreas()
    {
        return $this->belongsTo('App\Model\Entidades_Formadoreas', 'entidad');
    }

    public function asistent()
    {
        return $this->hasMany('App\Model\Asistent', 'operador');
    }

    public function carnet()
    {
        return $this->hasMany('App\Model\Carnet', 'operador');
    }

}