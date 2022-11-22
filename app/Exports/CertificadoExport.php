<?php

namespace App\Exports;

use App\Models\Asistent;
use App\Models\Certificado;
use App\Models\Cursos;
use App\Models\EntidadesFormadoreas;
use App\Models\Operadores;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CertificadoExport implements FromCollection, WithHeadings
{
    protected $id;

    function __construct($id)
    {
        $this->id = $id;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $now = now() . date('');
        if ($this->id == "1") {
//            $certificados = Certificado::orderBy('id','asc')->whereDate('vencimiento' , '>' ,$now )->get();
            $certificados = Certificado::orderBy('id', 'desc')->get();

            foreach ($certificados as $key => $certificado) {
                $cerOpe = $certificado->operadorr;
                $cerCurso = $certificado->cursoo;
                if (!($cerOpe->estado == 1 && @$cerCurso->estado == 0)) {
                    $certificados->forget($key);
                }
            }
        } else {
            $certificados = Certificado::orderBy('id', 'desc')->get();

            foreach ($certificados as $key => $certificado) {
                $cerOpe = $certificado->operadorr;
                $cerCurso = $certificado->cursoo;
                if ($cerOpe->estado != 0 || $cerCurso->estado != 1 || $cerCurso->cerrado != 1) {
                    $certificados->forget($key);
                }
            }
//            $certificados = Certificado::orderBy('id','asc')->whereDate('vencimiento' , '<=' ,$now )->get();
        }

//        dd($certificados);
        foreach ($certificados as $certificado) {
           $nota_p=Asistent::where('curso',$certificado->curso)->where('operador',$certificado->operador)->first()->nota_p;
            $ope = $certificado->operadorr;
            if ($certificado->entidad != 0) {
                $entidad = EntidadesFormadoreas::findOrFail($certificado->entidad);
                $certificado->entidad = $entidad->razon_social;
            } else {
                $certificado->entidad = "";
            }

            if ($certificado->curso != 0) {
                $curso = Cursos::findOrFail($certificado->curso);
                $certificado->curso = $curso->codigo;
            } else {
                $certificado->curso = "";
            }
            $certificado->estado_del_operador = $ope->estado == 1 ? 'activo' : 'inactivo';
            $certificado->fecha_alta=date('d/m/Y H:i:s' ,strtotime($certificado->fecha_alta));
//            $certificado->created_at =date('d/m/Y H:i:s',strtotime($certificado->created_at));
//            $certificado->updated_at=date('d/m/Y H:i:s',strtotime($certificado->updated_at));
//            $certificado->deleted_at=date('d/m/Y H:i:s',strtotime($certificado->deleted_at));
            $certificado->emision=date('d/m/Y',strtotime($certificado->emision));
            $certificado->vencimiento=date('d/m/Y',strtotime($certificado->vencimiento));
            $certificado->cer_fecha=date(Now()->format('d/m/Y'));
            $certificado->nota_p=$nota_p;
        }
        return $certificados;
    }

    public function headings(): array
    {
        return [
            'Id',
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
            'estado del operador',
            'nota pract.'

        ];
    }
}
