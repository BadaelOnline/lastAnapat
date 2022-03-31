<?php

namespace App\Exports;

use App\Models\Certificado;
use App\Models\Cursos;
use App\Models\EntidadesFormadoreas;
use App\Models\Operadores;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CertificadoExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {

        $certificados = Certificado::all();
//        dd($certificados);
        foreach ($certificados as $certificado){
            $entidad =EntidadesFormadoreas::findOrFail($certificado->entidad);
            $certificado->entidad = $entidad->razon_social;
            $curso = Cursos::findOrFail($certificado->curso);
            $certificado->curso = $curso->codigo;
        }
        return $certificados;
    }

    public function headings(): array
    {
        return[
            'Id',
            'created_at',
            'updated_at',
            'deleted_at',
            'numero',
            'operador',
            'entidad',
            'curso',
            'emision',
            'vencimiento',
            'observaciones',
            'cer_fecha',
            'cer_apellidos',
            'cer_nombre',
            'dni',
            'cer_type_course',
            'fecha_alta',

            'entidad_nombre',
            'tipos_carnet',
            'carnet',
            'tipo_1',
            'tipo_2',
            'tipo_3',
            'tipo_4',

        ];
    }
}
