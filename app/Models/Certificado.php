<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Certificado extends Model
{
    use HasFactory;
    protected $guarded=['created_at', 'updated_at','deleted_at'];
    protected $table = 'certificados';
    public $timestamps = true;
    protected $hidden = ['created_at', 'updated_at','deleted_at'];
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function entidades_formadoreas()
    {
        return $this->belongsTo(EntidadesFormadoreas::class, 'entidad');
    }

    public function cursoo()
    {
        return $this->belongsTo(Cursos::class, 'curso');
    }


    public function operadorr()
    {
        return $this->belongsTo(Operadores::class, 'operador');
    }

    public function Tipo_Maquinas()
    {
        return $this->belongsToMany(Tipo_Maquina::class);
    }
}
