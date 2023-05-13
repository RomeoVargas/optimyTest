<?php


namespace Tests\Models\Comment;

use App\Models\Comment;
use Exception;
use Faker\Factory;
use PHPUnit\Framework\TestCase;

class CommentGetAttributeTest extends TestCase
{
    public function test_get_invalid_attribute()
    {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Invalid attribute for this model');
        $faker = Factory::create();
        $comment = new Comment();
        $comment->getAttribute($faker->name());
    }

    public function test_get_valid_attribute()
    {
        $faker = Factory::create();
        $body = $faker->text();
        $comment = new Comment([
            'body' => $body
        ]);
        $fetchedAttribute = $comment->getAttribute('body');
        $this->assertEquals($fetchedAttribute, $body);
    }
}