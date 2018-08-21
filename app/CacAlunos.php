<?php

namespace app_unifil;

use Illuminate\Database\Eloquent\Model;

class CacAlunos extends Model
{
    protected $table = 'CAC_ALUNOS';
    
    protected $primaryKey = 'SQ_ALUNO';
    public $timestamps = false;
}
