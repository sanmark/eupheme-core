<?php

namespace App\Validators\Concretes\Laravel\Validators;


use App\Validators\Concretes\Laravel\Constants\ConstantsRules;
use App\Validators\Constants\ConstantsResponses;
use App\Validators\Contracts\ValidatorComments;

class ConcreteValidatorComments extends Base implements ValidatorComments

{

    public function create(array $data)
    {
        $rules = [
            'text' => [
                ConstantsRules::Required => ConstantsResponses::Required
            ]
        ];

        $this -> process($data, $rules);

    }
}