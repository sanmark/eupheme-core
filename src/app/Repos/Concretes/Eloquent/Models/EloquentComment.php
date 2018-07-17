<?php

namespace App\Repos\Concretes\Eloquent\Models;


use App\Constants\ConstantsCommentStatus;

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

    public function children()
    {
        return $this -> hasMany(EloquentComment::class, 'parent_id') -> where('status',
            ConstantsCommentStatus::APPROVED) -> with('children');
    }
}