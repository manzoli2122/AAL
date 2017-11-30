<?php 

namespace Manzoli2122\AAL\Traits;

use Illuminate\Cache\TaggableStore;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use InvalidArgumentException;

trait AALUsuarioTrait
{
    
    public static function boot()
    {
        parent::boot();
        static::deleting(function($usuario) {
            if (!method_exists(Config::get('auth.providers.users.model'), 'bootSoftDeletes')) {
                $usuario->perfis()->sync([]);
            }
            return true;
        });
    }




    public function cachedPerfis()
    {
        $usuarioPrimaryKey = $this->primaryKey;
        $cacheKey = 'aal_perfis_for_usuario_'.$this->$usuarioPrimaryKey;
        if(Cache::getStore() instanceof TaggableStore) {
            return Cache::tags(Config::get('aal.perfil_usuario_table'))->remember($cacheKey, Config::get('cache.ttl'), function () {
                return $this->perfis()->get();
            });
        }
        else return $this->perfis()->get();
    }

    




    public function save(array $options = [])
    {   //both inserts and updates
        if(Cache::getStore() instanceof TaggableStore) {
            Cache::tags(Config::get('aal.perfil_usuario_table'))->flush();
        }
        return parent::save($options);
    }

  
    




    public function delete(array $options = [])
    {   //soft or hard
        $result = parent::delete($options);
        if(Cache::getStore() instanceof TaggableStore) {
            Cache::tags(Config::get('aal.perfil_usuario_table'))->flush();
        }
        return $result;
    }

    
    





    public function restore()
    {   //soft delete undo's
        $result = parent::restore();
        if(Cache::getStore() instanceof TaggableStore) {
            Cache::tags(Config::get('aal.perfil_usuario_table'))->flush();
        }
        return $result;
    }

    
   
    





    public function perfis()
    {
        return $this->belongsToMany( Config::get('aal.perfil') , Config::get('aal.perfil_usuario_table'), Config::get('aal.usuario_foreign_key'), Config::get('aal.perfil_foreign_key'));
    }


    
    
   
    public function usuarios_sem_perfil($perfil_id)
    {
        return $this->whereNotIn('id', function($query) use ($perfil_id){
            $query->select("perfils_users.user_id");
            $query->from("perfils_users");
            $query->whereRaw("perfils_users.perfil_id = {$perfil_id} ");
        } )->get();       
        
    }
    



    
    
    





    public function hasPerfil($name, $requireAll = false)
    {
        if (is_array($name)) {
            foreach ($name as $perfilName) {
                $hasPerfil = $this->hasPerfil($perfilName);

                if ($hasPerfil && !$requireAll) {
                    return true;
                } elseif (!$hasPerfil && $requireAll) {
                    return false;
                }
            }
            return $requireAll;
        } else {
            foreach ($this->cachedPerfis() as $perfil) {
                if ($perfil->nome == $name) {
                    return true;
                }
            }
        }
        return false;
    }

   
    





    public function can($permissao, $requireAll = false)
    {
                
        if($this->hasPerfil('Admin')){
            return true;
        }
                
        if (is_array($permissao)) {
            foreach ($permissao as $permName) {
                $hasPerm = $this->can($permName);

                if ($hasPerm && !$requireAll) {
                    return true;
                } elseif (!$hasPerm && $requireAll) {
                    return false;
                }
            }
            return $requireAll;
        } else {
            foreach ($this->cachedPerfis() as $perfil) {
                // Validate against the Permission table
                foreach ($perfil->cachedPermissoes() as $perm) {
                    if (str_is( $permissao, $perm->nome) ) {
                        return true;
                    }
                }
            }
        }
        return false;
    }

   
    


/*

    public function ability($perfis, $permissoes, $options = [])
    {
        // Convert string to array if that's what is passed in.
        if (!is_array($perfis)) {
            $perfis = explode(',', $perfis);
        }
        if (!is_array($permissoes)) {
            $permissoes = explode(',', $permissoes);
        }

        // Set up default values and validate options.
        if (!isset($options['validate_all'])) {
            $options['validate_all'] = false;
        } else {
            if ($options['validate_all'] !== true && $options['validate_all'] !== false) {
                throw new InvalidArgumentException();
            }
        }
        if (!isset($options['return_type'])) {
            $options['return_type'] = 'boolean';
        } else {
            if ($options['return_type'] != 'boolean' &&
                $options['return_type'] != 'array' &&
                $options['return_type'] != 'both') {
                throw new InvalidArgumentException();
            }
        }

        // Loop through perfis and permissaos and check each.
        $checkedPerfis = [];
        $checkedPermissoes = [];
        foreach ($perfis as $perfil) {
            $checkedPerfis[$perfil] = $this->hasPerfil($perfil);
        }
        foreach ($permissoes as $permissao) {
            $checkedPermissoes[$permissao] = $this->can($permissao);
        }

        if(($options['validate_all'] && !(in_array(false,$checkedPerfis) || in_array(false,$checkedPermissoes))) ||
            (!$options['validate_all'] && (in_array(true,$checkedPerfis) || in_array(true,$checkedPermissoes)))) {
            $validateAll = true;
        } else {
            $validateAll = false;
        }

        // Return based on option
        if ($options['return_type'] == 'boolean') {
            return $validateAll;
        } elseif ($options['return_type'] == 'array') {
            return ['perfis' => $checkedPerfis, 'permissoes' => $checkedPermissoes];
        } else {
            return [$validateAll, ['perfis' => $checkedPerfis, 'permissoes' => $checkedPermissoes]];
        }

    }

   */
    
    



    public function attachPerfil($perfil)
    {
        if(is_object($perfil)) {
            $perfil = $perfil->getKey();
        }
        $this->perfis()->attach($perfil);
    }

    
    



    public function detachPerfil($perfil)
    {
        if (is_object($perfil)) {
            $perfil = $perfil->getKey();
        }
        $this->perfis()->detach($perfil);
    }

   
    





    public function attachPerfis($perfis)
    {
        foreach ($perfis as $perfil) {
            $this->attachPerfil($perfil);
        }
    }

   
    




    public function detachPerfis($perfis=null)
    {
        if (!$perfis) $perfis = $this->perfis()->get();

        foreach ($perfis as $perfil) {
            $this->detachPerfil($perfil);
        }
    }

    
    



    public function scopeWithPerfil($query, $perfil)
    {
        return $query->whereHas('perfis', function ($query) use ($perfil)
        {
            $query->where('name', $perfil);
        });
    }

}
