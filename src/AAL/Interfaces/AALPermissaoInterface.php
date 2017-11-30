<?php 

namespace Manzoli2122\AAL\Interfaces;



interface AALPermissaoInterface
{
    public function perfis();

    public function attachPerfil($perfil);

    public function detachPerfil($perfil);

    public function attachPerfis($perfis);
    
    public function detachPerfis($perfis);
}
