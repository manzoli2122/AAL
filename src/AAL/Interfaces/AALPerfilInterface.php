<?php 

namespace Manzoli2122\AAL\Interfaces;

interface AALPerfilInterface
{
   
    public function usuarios();
   
    public function permissoes();
    
    public function savePermissoes($inputPermissoess);
    
    public function attachPermissao($permissao);
   
    public function detachPermissao($permissao);
    
    public function attachPermissoes($permissoes);
   
    public function detachPermissoes($permissoes);




    public function attachUsuario($usuario);    
       
    public function detachUsuario($usuario);    
        
    public function attachUsuarios($usuarios);    
       
    public function detachUsuarios($usuarios);
}
