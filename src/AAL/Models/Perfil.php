<?php

namespace Manzoli2122\AAL\Models;

use Manzoli2122\AAL\Interfaces\AALPerfilInterface;
use Manzoli2122\AAL\Traits\AALPerfilTrait;
use Illuminate\Support\Facades\Config;
use Illuminate\Database\Eloquent\Model;


class Perfil extends Model implements AALPerfilInterface
{    


    use AALPerfilTrait;

    protected $table;
    
       
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = Config::get('aal.perfis_table');
    }

     
    
    protected $fillable = [
            'nome', 'descricao', 
    ];
        
    public function rules($id = '')
    {
            return [
                'nome' => 'required|min:3|max:100',
                'descricao' => "required|min:0|max:100",     
            ];
    }

/*
    public function usuarios()
    {        
        return $this->belongsToMany( 'App\Core\User' , 'perfils_users', 'perfil_id' , 'user_id');
    }

*/
    public function permissoes()
    {        
        return $this->belongsToMany( 'App\Modules\Admin\Models\Permissao' , 'permissao_perfils' , 'perfil_id', 'permissao_id');
        
    }
    
    
}
