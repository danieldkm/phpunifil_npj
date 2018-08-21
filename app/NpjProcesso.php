<?php

namespace app_unifil;

use Illuminate\Database\Eloquent\Model;
use app_unifil\NpjCliente;

class NpjProcesso extends Model
{
    protected $table = 'NPJ_PROCESSOS';
    
    protected $primaryKey = 'ID_PROCESSO';
    public $timestamps = false;
    public $NM_ALUNO;
    
    public function scopeOfArquivado($query, $sn)
    {
        return $query->where('SN_ARQUIVADO','=' ,$sn);
    }
    
    public function scopeOfId($query, $sn)
    {
        return $query->where('ID_PROCESSO','=' ,$sn);
    }
    
    public function scopeOfNrProcesso($query, $nr)
    {
        return $query->where('NR_PROCESSO','LIKE',$nr);
    }
}