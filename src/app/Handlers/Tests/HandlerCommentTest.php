<?php

namespace App\Handlers\Tests;


use App\Constants\ConstantsCommentStatus;
use App\Handlers\HandlerComments;
use App\Models\Comment;
use App\Repos\Contracts\RepoComments;
use App\Validators\Contracts\ValidatorComments;
use App\Validators\Exceptions\InvalidInputException;
use Tests\TestCase;

class HandlerCommentTest extends TestCase
{

    public function test_create_success()
    {
        $repoComment = $this -> mock(RepoComments::class);
        $validatorComments = $this -> mock(ValidatorComments::class);
        $mockComment = $this -> mock(Comment::class);
        $mockComment -> text = 'foo';
        $mockComment -> id = 1;
        $mockComment -> extRef = null;
        $mockComment -> parenetID = null;
        $mockComment -> userID = null;
        $mockComment -> text = ConstantsCommentStatus::PENDING;

        $validatorComments -> shouldReceive('create')
            -> once()
            -> withArgs([
                [
                    'text' => 'foo',
                ]
            ]);

        $repoComment -> shouldReceive('create')
            -> once()
            -> withargs([
                [
                    'text' => 'foo'
                ]
            ])
            -> andReturn($mockComment);

        $handlerComment = new HandlerComments($validatorComments, $repoComment);

        $response = $handlerComment -> create(['text' => 'foo']);

        $this -> assertInstanceOf(Comment::class, $response);

    }


    public function test_create_fail()
    {
        $this -> expectException(InvalidInputException::class);

        $repoComment = $this -> mock(RepoComments::class);
        $validatorComment = $this -> mock(ValidatorComments::class);

        $validatorComment -> shouldReceive('create')
            -> once()
            -> withArgs([[]])
            -> andThrow($this -> mock(InvalidInputException::class));

        $handlerComment = new HandlerComments($validatorComment, $repoComment);

        $handlerComment -> create([]);
    }
}