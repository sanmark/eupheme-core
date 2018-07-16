<?php

namespace App\Repos\Concretes\Eloquent\Repos;


use App\Models\Comment;
use App\Repos\Concretes\Eloquent\Models\EloquentComment;
use App\Repos\Contracts\RepoComments;

class ConcreteRepoComments implements RepoComments
{


    public function create(array $data): Comment
    {
       $eComment = EloquentComment::create($data);

       $comment = new Comment();

       $comment->id = $eComment->id;
       $comment->extRef = $eComment->ext_ref;
       $comment->parentID = $eComment->parent_id;
       $comment->text = $eComment->text;
       $comment->userID = $eComment->user_id;
       $comment->status = $eComment->status;
       $comment->createdAt = $eComment->created_at;
       $comment->updatedAt = $eComment->updated_at;

       return $comment;
    }
}