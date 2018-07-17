<?php

namespace App\Repos\Concretes\Eloquent\Repos;


use App\Constants\ConstantsCommentStatus;
use App\Models\Comment;
use App\Repos\Concretes\Eloquent\Models\EloquentComment;
use App\Repos\Contracts\RepoComments;

class ConcreteRepoComments implements RepoComments
{


    public function create(array $data): Comment
    {
        $eComment = EloquentComment ::create($data);

        return $this -> transcodeSingle($eComment);
    }

    private function transcodeSingle(EloquentComment $eComment)
    {
        $comment = new Comment();

        $comment -> id = $eComment -> id;
        $comment -> extRef = $eComment -> ext_ref;
        $comment -> parentID = $eComment -> parent_id;
        $comment -> text = $eComment -> text;
        $comment -> userID = $eComment -> user_id;
        $comment -> status = $eComment -> status;
        $comment -> createdAt = $eComment -> created_at;
        $comment -> updatedAt = $eComment -> updated_at;

        $eChildren = $eComment -> children;
        $comment -> children = $eChildren -> map(function ($comment) {
            return $this -> transcodeSingle($comment);
        }) -> toArray();

        return $comment;
    }

    public function get($ref): array
    {
        $eComment = EloquentComment ::where('ext_ref', $ref)
            -> whereNull('parent_id')
            -> where('status', ConstantsCommentStatus::APPROVED)
            -> get();

        $comments = $eComment -> map(function ($comment) {
            return $this -> transcodeSingle($comment);
        });

        return $comments -> toArray();
    }
}