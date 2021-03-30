<?php

namespace App\Facades;

use App\Services\ProductService;
use Illuminate\Support\Facades\Facade;

/**
 * @method static store(array $data)
 * @method static index(array $data)
 * @method static getAllWithPagination()
 * @method static update($id, array $data)
 * @method static show($id)
*/
class ProductFacade extends Facade{

    public static function getFacadeAccessor(){
        return ProductService::class;
    }

}