<?php

namespace App\Repos\Concretes\Eloquent\Repos\Tests;


use App\Constants\ConstantsCommentStatus;
use App\Models\Comment;
use App\Repos\Concretes\Eloquent\Models\EloquentComment;
use App\Repos\Concretes\Eloquent\Repos\ConcreteRepoComments;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class RepoCommentsTest extends TestCase
{

    use DatabaseMigrations;

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

        $this -> assertInstanceOf(Comment::class, $response);

        $this -> assertequals('1', $response -> extRef);
        $this -> assertequals(2, $response -> parentID);
        $this -> assertequals('foo', $response -> text);
        $this -> assertequals('3', $response -> userID);
        $this -> assertequals(ConstantsCommentStatus::PENDING, $response -> status);
    }


    public function test_get_success()
    {

        $comment = factory(EloquentComment::class) -> create([
            'id' => 1,
            'ext_ref' => 1,
            'parent_id' => null,
            'text' => 'foo',
            'user_id' => null,
            'status' => ConstantsCommentStatus::APPROVED
        ]);
        factory(EloquentComment::class, 2) -> create([
            'ext_ref' => null,
            'parent_id' => $comment -> id,
            'status' => ConstantsCommentStatus::APPROVED
        ]);
        $repoComments = new ConcreteRepoComments();

        $response = $repoComments -> get(1);

        $this -> assertCount(1, $response);
        $this -> assertCount(2, $response[0] -> children);
        $this -> assertInstanceOf(Comment::class, $response[0]);
        $this -> assertsame('foo', $response[0] -> text);
    }
}