<?php

namespace App\Repos\Contracts;


use App\Models\Comment;

interface RepoComments
{

    public function create(array $data): Comment;

    public function get($ref): array;
}