<?php
/**
 * Created by PhpStorm.
 * User: Ray
 * Date: 2018/8/6
 * Time: 11:27
 */

namespace Cross\Cors;



use Illuminate\Support\Facades\Facade;

class FacadeCors extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'FacadeCors';
    }
}