<?php

namespace app_unifil;

use Illuminate\Database\Eloquent\Model;

class NpjAlunoProcesso extends Model
{
    protected $table = 'NPJ_ALUNO_PROCESSO';
    
    protected $primaryKey = 'ID_ALUNO_PROC';
    public $timestamps = false;
    
    public function scopeOfIdProcesso($query, $idProcesso)
    {
        return $query->where('ID_PROCESSO','=' ,$idProcesso);
    }
}
