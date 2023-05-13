<?php


namespace App\Repositories;


use App\Models\News;

class NewsRepository extends Repository
{
    protected function model()
    {
        return News::class;
    }
}