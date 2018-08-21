<?php

namespace app_unifil;

use Illuminate\Database\Eloquent\Model;

class NpjOrientador extends Model
{
    protected $table = 'NPJ_ORIENTADOR';
    
    protected $primaryKey = 'SQ_ORIENTADOR';
    public $timestamps = false;
}
