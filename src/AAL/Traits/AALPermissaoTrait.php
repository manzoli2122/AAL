<?php 

namespace Manzoli2122\AAL\Traits;


use Illuminate\Support\Facades\Config;



trait AALPermissaoTrait
{
   

    public function perfis()
    {
        return $this->belongsToMany( 'Manzoli2122\AAL\Models\Perfil' , 'permissao_perfils' ,'permissao_id', 'perfil_id' );
    }

   



    public static function boot()
    {
        parent::boot();
        static::deleting(function($permissao) {
            if (!method_exists( 'Manzoli2122\AAL\Models\Permissao', 'bootSoftDeletes')) {
                $permissao->perfis()->sync([]);
            }
            return true;
        });
    }



    public static function permissos_sem_perfil($perfil_id)
    {
        return $this->whereNotIn('id', function($query) use ($perfil_id){
            $query->select("permissao_perfils.permissao_id");
            $query->from("permissao_perfils");
            $query->whereRaw("permissao_perfils.perfil_id = {$perfil_id} ");
        } )->get();            
        
    }


    

    public function attachPerfil($perfil){
        
        if(is_object($perfil)) {
            $perfil = $perfil->getKey();
        }
        if(is_array($perfil)) {
            return $this->attachPerfis($perfil);
        }
        $this->perfis()->attach($perfil);

    }
    
       
    public function detachPerfil($perfil){
        if (is_object($perfil)) {
            $perfil = $perfil->getKey();
        }
        if (is_array($perfil)) {
            return $this->detachPerfis($perfil);
        }
        $this->perfis()->detach($perfil);
    }
    




        
    public function attachPerfis($perfis){
        foreach ($perfis as $perfil) {
            $this->attachPerfil($perfil);
        }
    }
    
       
    public function detachPerfis($perfis=null){
        if (!$perfis) $perfis = $this->perfis()->get();
        foreach ($perfis as $perfil) {
            $this->detachRole($perfil);
        }
    }






}
