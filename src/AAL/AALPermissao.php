<?php namespace Manzoli2122\AAL;



use Manzoli2122\AAL\Interfaces\AALPermissaoInterface;
use Manzoli2122\AAL\Traits\AALPermissaoTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;

class AALPermissao extends Model implements AALPermissaoInterface
{
    use AALPermissaoTrait;

  
    protected $table;

  
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = Config::get('aal.permissoes_table');
    }

}
