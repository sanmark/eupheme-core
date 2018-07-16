<?php

namespace App\Repos\Concretes\Eloquent\Repos\Tests;


use App\Constants\ConstantsCommentStatus;
use App\Models\Comment;
use App\Repos\Concretes\Eloquent\Models\EloquentComment;
use App\Repos\Concretes\Eloquent\Repos\ConcreteRepoComments;
use Tests\TestCase;

class RepoCommentsTest extends TestCase
{

    public function test_create_success()
    {
        $data = [
            'ext_ref' => 1,
            'parent_id' => 2,
            'text' => 'foo',
            'user_id' => 3,
            'status' => ConstantsCommentStatus::PENDING
        ];

        $repoComment = new ConcreteRepoComments();

        $response = $repoComment -> create($data);

        $this->assertInstanceOf(Comment::class, $response);

        $this->assertequals('1' , $response->extRef);
        $this->assertequals(2 , $response->parentID);
        $this->assertequals('foo' , $response->text);
        $this->assertequals('3' , $response->userID);
        $this->assertequals(ConstantsCommentStatus::PENDING , $response->status);
    }

}