<?php


namespace App\Models;

/**
 * Class Comment
 * @package App\Models
 *
 * @property int id
 * @property int news_id
 * @property string body
 * @property string created_at
 */
class Comment extends Model
{
    protected $table = 'comment';

    protected $attributes = [
        'id', 'news_id', 'body', 'created_at'
    ];
}