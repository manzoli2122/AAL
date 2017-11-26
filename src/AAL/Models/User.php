<?php

namespace Manzoli2122\AAL\Models;


use Manzoli2122\AAL\Interfaces\AALUsuarioInterface;
use Manzoli2122\AAL\Traits\AALUsuarioTrait;
use Illuminate\Support\Facades\Config;
use Illuminate\Database\Eloquent\Model;

class Permissao extends Model implements AALUsuarioInterface
{
    
    use AALUsuarioTrait;
    
      
    protected $table;
    
      
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = Config::get('aal.usuarios_table');
    }
  
}
