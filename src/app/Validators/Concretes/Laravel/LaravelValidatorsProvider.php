<?php

namespace App\Validators\Concretes\Laravel;

use App\Validators\Concretes\Laravel\Validators\ConcreteValidatorGroups;
use App\Validators\Contracts\ValidatorGroups;
use Illuminate\Support\ServiceProvider;

class LaravelValidatorsProvider extends ServiceProvider
{

    public function register()
    {
        $map = [
            ValidatorGroups::class => ConcreteValidatorGroups::class,
        ];

        foreach ($map as $contract => $concrete) {
            $this -> app
                -> bind($contract, $concrete);
        }
    }

}
