<?php

namespace App\Repos\Concretes\Eloquent\Models;


class EloquentComment extends Base
{

    protected $fillable = [
        'ext_ref',
        'parent_id',
        'text',
        'user_id',
        'status'
    ];

    protected $table = 'comments';
}