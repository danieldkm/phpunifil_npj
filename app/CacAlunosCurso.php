<?php

namespace app_unifil;

use Illuminate\Database\Eloquent\Model;

class CacAlunosCurso extends Model
{
    protected $table = 'CAC_ALUNOS_CURSO';
    
    protected $primaryKey = 'NR_MATRICULA';
    public $timestamps = false;
    
//    public function aluno()
//    {
//        return $this->has('app_unifil\CacAlunos', 'SQ_ALUNO');
//        return $this->belongsTo('app_unifil\CacAlunos', 'SQ_ALUNO');
//         return $this->belongsTo('App\Post', 'foreign_key');
//        return $this->hasOne('App\Phone', 'foreign_key', 'local_key');
//    }
    
}
