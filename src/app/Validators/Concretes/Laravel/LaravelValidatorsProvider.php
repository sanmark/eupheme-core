<?php

namespace App\Validators\Concretes\Laravel;

use App\Validators\Concretes\Laravel\Validators\ConcreteValidatorComments;
use App\Validators\Contracts\ValidatorComments;
use Illuminate\Support\ServiceProvider;

class LaravelValidatorsProvider extends ServiceProvider
{

    public function register()
    {
        $this -> app -> bind(ValidatorComments::class,
            ConcreteValidatorComments::class);
    }

}
