<?php

namespace Dnvmaster\Repositories;

use Dnvmaster\Comment;

class CommentsRepository extends Repository
{
    public function __construct(Comment $comment)
    {
        $this->model = $comment;
    }
}