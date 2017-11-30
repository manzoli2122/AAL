<?php 

namespace Manzoli2122\AAL\Interfaces;

interface AALUsuarioInterface
{
    
    public function perfis();

    public function hasPerfil($name, $requireAll = false);
   
    public function can($permissao, $requireAll = false);
   
   // public function ability($roles, $permissions, $options = []);
   
    public function attachPerfil($perfil);
   
    public function detachPerfil($perfil);
    
    public function attachPerfis($perfis);
   
    public function detachPerfis($perfis);
}
