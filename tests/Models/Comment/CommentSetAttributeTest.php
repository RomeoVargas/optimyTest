<?php


namespace Tests\Models\Comment;

use App\Models\Comment;
use Exception;
use Faker\Factory;
use PHPUnit\Framework\TestCase;

class CommentSetAttributeTest extends TestCase
{
    public function test_set_invalid_attribute()
    {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Invalid attribute for this model');
        $faker = Factory::create();
        $comment = new Comment();
        $comment->setAttribute($faker->name(), $faker->text());
    }

    public function test_set_valid_attribute()
    {
        $faker = Factory::create();
        $comment = new Comment();
        $body = $faker->text();
        $comment->setAttribute('body', $body);
        $this->assertEquals($comment->body, $body);
    }
}