<?php

namespace Tests\Feature;

use App\Constants\ConstantsCommentStatus;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class CreateCommentTest extends TestCase
{
    use DatabaseMigrations;

    public function test_save_comment_success()
    {
        $response = $this -> postWithValidAppKeyAndSecretHash('api/comments', [
            'ext_ref' => 1,
            'parent_id' => 3,
            'text' => 'comment text',
            'user_id' => 4,
            'status' => 0
        ]);

        $response -> assertStatus(200);

        $response -> assertjson([
                'payload' => [
                    'extRef' => 1,
                    'parentID' => 3,
                    'text' => 'comment text',
                    'userID' => 4,
                    'status' => ConstantsCommentStatus::PENDING,
                    'children' => []
                ]
            ]
        );

        $this -> assertDatabaseHas('comments', [
            'ext_ref' => 1,
            'parent_id' => 3,
            'text' => 'comment text',
            'user_id' => 4,
            'status' => ConstantsCommentStatus::PENDING
        ]);
    }
}
