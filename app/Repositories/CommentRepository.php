<?php


namespace App\Repositories;


use App\Models\Comment;

class CommentRepository extends Repository
{
    protected function model()
    {
        return Comment::class;
    }
}