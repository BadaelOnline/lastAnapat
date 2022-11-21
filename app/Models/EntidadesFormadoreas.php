<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class EntidadesFormadoreas extends Model
{
    use HasFactory;
   protected $guarded=[];
    protected $table = 'entidades_formadoreas';
    public $timestamps = true;
    protected $hidden = ['created_at', 'updated_at','deleted_at'];

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function formadores()
    {
        return $this->hasMany('App\Model\Formadores', 'entidad');
    }

    public function certificados()
    {
        return $this->hasMany(Certificado::class, 'entidad');
    }

}
