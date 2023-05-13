<?php


namespace App\Models;

/**
 * Class News
 * @package App\Models
 *
 * @property int id
 * @property string title
 * @property string body
 * @property string created_at
 */
class News extends Model
{
    protected $table = 'news';

    protected $attributes = [
        'id', 'title', 'body', 'created_at'
    ];
}