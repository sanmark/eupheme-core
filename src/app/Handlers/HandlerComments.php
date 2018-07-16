<?php

namespace App\Handlers;


use App\Repos\Contracts\RepoComments;
use App\Validators\Contracts\ValidatorComments;

class HandlerComments
{

    private $repoComments;
    private $validatorComments;

    public function __construct(ValidatorComments $validatorComments, RepoComments $repoComments)
    {
        $this -> repoComments = $repoComments;
        $this -> validatorComments = $validatorComments;
    }

    public function create(array $data)
    {
        $this -> validatorComments -> create($data);
        $comment = $this -> repoComments -> create($data);

        return $comment;

    }

}