<?php

namespace App\Repos\Concretes\Eloquent;

use App\Repos\Concretes\Eloquent\Repos\ConcreteRepoGroups;
use App\Repos\Contracts\RepoGroups;
use Illuminate\Support\ServiceProvider;

class EloquentReposProvider extends ServiceProvider
{

    public function register()
    {
        $map = [
            RepoGroups::class => ConcreteRepoGroups::class,
        ];

        foreach ($map as $contract => $concrete) {
            $this -> app
                -> bind($contract, $concrete);
        }
    }

}
