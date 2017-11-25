<?php

namespace  Manzoli2122\AAL\Http\Controllers;

use Illuminate\Http\Request;

class AutorizacaoController extends Controller
{
 

    public function __construct(  ){
        $this->middleware('auth');
    }  
       


    public function index()
    {
        return view("autorizacao::index");
    }
        
}
