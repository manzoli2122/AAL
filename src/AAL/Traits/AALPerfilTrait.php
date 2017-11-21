<?php 


namespace Manzoli2122\AAL\Traits;


use Illuminate\Cache\TaggableStore;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Cache;

trait AALPerfilTrait
{



    
   
    public function cachedPermissoes()
    {
        $perfilPrimaryKey = $this->primaryKey;
        $cacheKey = 'aal_permissoes_for_perfil_' . $this->$perfilPrimaryKey;
        if (Cache::getStore() instanceof TaggableStore) {
            return Cache::tags(Config::get('aal.permissao_perfil_table'))->remember($cacheKey, Config::get('cache.ttl', 60), function () {
                return $this->permissoes()->get();
            });
        } else return $this->permissoes()->get();
    }

    public function save(array $options = [])
    {   //both inserts and updates
        if (!parent::save($options)) {
            return false;
        }
        if (Cache::getStore() instanceof TaggableStore) {
            Cache::tags(Config::get('aal.permissao_perfil_table'))->flush();
        }
        return true;
    }

    public function delete(array $options = [])
    {   //soft or hard
        if (!parent::delete($options)) {
            return false;
        }
        if (Cache::getStore() instanceof TaggableStore) {
            Cache::tags(Config::get('aal.permissao_perfil_table'))->flush();
        }
        return true;
    }

    public function restore()
    {   //soft delete undo's
        if (!parent::restore()) {
            return false;
        }
        if (Cache::getStore() instanceof TaggableStore) {
            Cache::tags(Config::get('aal.permissao_perfil_table'))->flush();
        }
        return true;
    }

   



    public function usuarios()
    {
        return $this->belongsToMany(Config::get('auth.providers.users.model'), Config::get('aal.perfil_usuario_table'), Config::get('aal.perfil_foreign_key'), Config::get('aal.usuario_foreign_key'));
    }

  


    public function permissoes()
    {
        return $this->belongsToMany(Config::get('aal.permissao'), Config::get('aal.permissao_perfil_table'), Config::get('aal.perfil_foreign_key'), Config::get('aal.permissao_foreign_key'));
    }

   



    public static function boot()
    {
        parent::boot();

        static::deleting(function ($perfil) {
            if (!method_exists(Config::get('aal.perfil'), 'bootSoftDeletes')) {
                $perfil->usuarios()->sync([]);
                $perfil->permissoes()->sync([]);
            }

            return true;
        });
    }

   


    public function hasPermissao($name, $requireAll = false)
    {
        if (is_array($name)) {
            foreach ($name as $permissaoName) {
                $hasPermissao = $this->hasPermissao($permissaoName);

                if ($hasPermissao && !$requireAll) {
                    return true;
                } elseif (!$hasPermissao && $requireAll) {
                    return false;
                }
            }

            // If we've made it this far and $requireAll is FALSE, then NONE of the permissaos were found
            // If we've made it this far and $requireAll is TRUE, then ALL of the permissaos were found.
            // Return the value of $requireAll;
            return $requireAll;
        } else {
            foreach ($this->cachedPermissoes() as $permissao) {
                if ($permissao->name == $name) {
                    return true;
                }
            }
        }

        return false;
    }

    


    public function savepermissaos($inputPermissoes)
    {
        if (!empty($inputPermissoes)) {
            $this->permissoes()->sync($inputPermissoes);
        } else {
            $this->permissoes()->detach();
        }

        if (Cache::getStore() instanceof TaggableStore) {
            Cache::tags(Config::get('aal.permissao_perfil_table'))->flush();
        }
    }

    



    public function attachPermissao($permissao)
    {
        if (is_object($permissao)) {
            $permissao = $permissao->getKey();
        }

        if (is_array($permissao)) {
            return $this->attachPermissoes($permissao);
        }

        $this->permissoes()->attach($permissao);
    }

    



    public function detachPermissao($permissao)
    {
        if (is_object($permissao)) {
            $permissao = $permissao->getKey();
        }

        if (is_array($permissao)) {
            return $this->detachPermissoes($permissao);
        }

        $this->permissoes()->detach($permissao);
    }

   


    
    public function attachPermissoes($permissoes)
    {
        foreach ($permissoes as $permissao) {
            $this->attachPermission($permissao);
        }
    }

    


    public function detachPermissoes($permissoes = null)
    {
        if (!$permissoes) $permissoes = $this->permissoes()->get();

        foreach ($permissoes as $permissao) {
            $this->detachPermissao($permissao);
        }
    }
}
