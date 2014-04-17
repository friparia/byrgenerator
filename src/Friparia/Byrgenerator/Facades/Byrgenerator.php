<?php namespace Friparia\Byrgenerator\Facades;

use Illuminate\Support\Facades\Facade;

class Byrgenerator extends Facade{

    protected static function getFacadeAccessor(){
        return 'byrgenerator';
    }
}
