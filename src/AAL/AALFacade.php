<?php 

namespace Manzoli2122\AAL;



use Illuminate\Support\Facades\Facade;

class AALFacade extends Facade
{
    
    protected static function getFacadeAccessor()
    {
        return 'aal';
    }

    
}
