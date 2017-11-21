<?php 

namespace Manzoli2122\AAL\Traits;


use Illuminate\Support\Facades\Config;



trait AALPermissaoTrait
{
   

    public function perfis()
    {
        return $this->belongsToMany(Config::get('aal.perfil'), Config::get('aal.permissao_perfil_table'), Config::get('aal.permissao_foreign_key'), Config::get('aal.perfil_foreign_key'));
    }

   



    public static function boot()
    {
        parent::boot();

        static::deleting(function($permissao) {
            if (!method_exists(Config::get('aal.permissao'), 'bootSoftDeletes')) {
                $permissao->perfis()->sync([]);
            }

            return true;
        });
    }
}
