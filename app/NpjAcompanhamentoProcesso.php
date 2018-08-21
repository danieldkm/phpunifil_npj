<?php

namespace app_unifil;

use Illuminate\Database\Eloquent\Model;

class NpjAcompanhamentoProcesso extends Model
{
    protected $table = 'NPJ_ACOMPANHAMENTO_PROCESSO';
    
    protected $primaryKey = 'ID_ACOMPANHAMENTO';
    public $timestamps = false;
}
