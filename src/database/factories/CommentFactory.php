<?php

use App\Repos\Concretes\Eloquent\Models\EloquentComment;
use Faker\Generator as Faker;

$factory -> define(EloquentComment::class, function (Faker $faker) {
    return [
        'ext_ref' => $faker -> numberBetween(1, 99),
        'parent_id' => function () {
            return factory(EloquentComment::class) -> create() -> id;
        },
        'text' => $faker -> text,
        'user_id' => $faker -> numberBetween(1, 99),
        'status' => \App\Constants\ConstantsCommentStatus::PENDING
    ];
});
