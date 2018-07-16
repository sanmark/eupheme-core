<?php

namespace App\Models;


class Comment
{
    public $id;
    public $extRef;
    public $parentID;
    public $text;
    public $userID;
    public $status;
    public $createdAt;
    public $updatedAt;
}