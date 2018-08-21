<?php

namespace app_unifil;

use Illuminate\Database\Eloquent\Model;

class NpjCliente extends Model
{
    protected $table = 'NPJ_CLIENTES';
    protected $primaryKey = 'ID_CLIENTE';
    public $timestamps = false;
    
    public function scopeOfNome($query, $nome)
    {
        return $query->where('NM_CLIENTE','LIKE' ,$nome);
    }
}
