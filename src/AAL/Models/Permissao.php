<?php

namespace Manzoli2122\AAL\Models;


use Manzoli2122\AAL\Interfaces\AALPermissaoInterface;
use Manzoli2122\AAL\Traits\AALPermissaoTrait;
use Illuminate\Support\Facades\Config;
use Illuminate\Database\Eloquent\Model;

class Permissao extends Model implements AALPermissaoInterface
{
    
    use AALPermissaoTrait;
    
      
    protected $table;
    
      
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = Config::get('aal.permissoes_table');
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


    public function perfis()
    {        
        return $this->belongsToMany( 'App\Modules\Admin\Models\Perfil' , 'permissao_perfils' , 'permissao_id', 'perfil_id');
        
    }



}
