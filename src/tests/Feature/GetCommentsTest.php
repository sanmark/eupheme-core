<?php

namespace Tests\Feature;

use App\Constants\ConstantsCommentStatus;
use App\Repos\Concretes\Eloquent\Models\EloquentComment;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class GetCommentsTest extends TestCase
{
    use DatabaseMigrations;

    public function test_get_comment_success()
    {

        $parentComment = factory(EloquentComment::class) -> create([
            'ext_ref' => 1,
            'parent_id' => null,
            'text' => 'parent comment',
            'user_id' => 10,
            'status' => ConstantsCommentStatus::APPROVED
        ]);

        $children = factory(EloquentComment::class, 2) -> create([
            'ext_ref' => null,
            'parent_id' => $parentComment -> id,
            'user_id' => 10,
            'status' => ConstantsCommentStatus::APPROVED
        ]);

        $response = $this -> getWithValidAppKeyAndSecretHash('/api/ref/1');

        $response -> assertStatus(200);

        $response -> assertJsonStructure([
            'payload' => [
                [
                    'extRef',
                    'parentID',
                    'text',
                    'userID',
                    'status',
                    'createdAt',
                    'updatedAt',
                    'children' => []
                ]
            ]
        ]);

        $response -> assertJson([
            'payload' => [
                [
                    'extRef' => 1,
                    'parentID' => null,
                    'text' => 'parent comment',
                    'userID' => 10,
                    'status' => ConstantsCommentStatus::APPROVED,
                    'children' => [
                        [
                            'extRef' => null,
                            'parentID' => $parentComment -> id,
                        ]
                    ]
                ]
            ]
        ]);

        $response -> assertJsonCount(2, 'payload.0.children');
    }

    public function test_not_get_pending_comments()
    {
        $parentComment = factory(EloquentComment::class) -> create([
            'ext_ref' => 1,
            'parent_id' => null,
            'text' => 'parent_comment',
            'user_id' => 10,
            'status' => ConstantsCommentStatus::APPROVED
        ]);

        factory(EloquentComment::class, 1) -> create([
            'ext_ref' => null,
            'parent_id' => $parentComment -> id,
            'user_id' => 10,
            'status' => ConstantsCommentStatus::PENDING
        ]);
        factory(EloquentComment::class, 1) -> create([
            'ext_ref' => null,
            'parent_id' => $parentComment -> id,
            'user_id' => 10,
            'status' => ConstantsCommentStatus::APPROVED
        ]);

        $response = $this -> getWithValidAppKeyAndSecretHash('/api/ref/1');

        $response -> assertStatus(200);

        $response -> assertJsonCount(1, 'payload.0.children');
    }

    public function test_no_parent_comment_for_ref()
    {
        $response = $this -> getWithValidAppKeyAndSecretHash('/api/ref/1');

        $response -> assertStatus(200);

        $response -> assertJsonCount(0, 'payload');
    }
}
