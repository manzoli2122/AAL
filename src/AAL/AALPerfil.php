<?php 

namespace Manzoli2122\AAL;

use Manzoli2122\AAL\Interfaces\AALPerfilInterface;
use Manzoli2122\AAL\Traits\AALPerfilTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;

class AALPerfil extends Model implements AALPerfilInterface
{
    use AALPerfilTrait;

   
    protected $table;

   
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = Config::get('aal.perfis_table');
    }

}
