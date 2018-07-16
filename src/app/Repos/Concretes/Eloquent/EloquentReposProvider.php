<?php

namespace App\Repos\Concretes\Eloquent;

use App\Repos\Concretes\Eloquent\Repos\ConcreteRepoComments;
use App\Repos\Contracts\RepoComments;
use Illuminate\Support\ServiceProvider;

class EloquentReposProvider extends ServiceProvider
{

    public function register()
    {
        $this->app->bind(RepoComments::class, ConcreteRepoComments::class);
    }

}
