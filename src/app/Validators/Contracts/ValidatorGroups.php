<?php

namespace App\Validators\Contracts;

interface ValidatorGroups
{

    public function create(array $data);

    public function update(array $data);
}
