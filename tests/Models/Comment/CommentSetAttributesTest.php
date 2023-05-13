<?php


namespace Tests\Models\Comment;

use App\Models\Comment;
use Exception;
use Faker\Factory;
use PHPUnit\Framework\TestCase;

class CommentSetAttributesTest extends TestCase
{
    public function test_set_invalid_attributes()
    {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Invalid attribute for this model');
        $faker = Factory::create();
        $comment = new Comment();
        $comment->setAttributes([
            $faker->name() => $faker->text()
        ]);
    }

    public function test_set_partial_invalid_attributes()
    {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Invalid attribute for this model');
        $faker = Factory::create();
        $comment = new Comment();
        $comment->setAttributes([
            'body' => $faker->text(),
            $faker->name() => $faker->text()
        ]);
    }

    public function test_set_valid_attribute()
    {
        $faker = Factory::create();
        $comment = new Comment();
        $body = $faker->text();
        $comment->setAttributes(['body' => $body]);
        $this->assertEquals($comment->body, $body);
    }

    public function test_set_valid_multiple_attributes()
    {
        $faker = Factory::create();
        $comment = new Comment();
        $body = $faker->text();
        $newsId = $faker->randomNumber();
        $comment->setAttributes([
            'body' => $body,
            'news_id' => $newsId
        ]);
        $this->assertEquals($comment->body, $body);
        $this->assertEquals($comment->news_id, $newsId);
    }

    public function test_set_from_constructor()
    {
        $faker = Factory::create();
        $body = $faker->text();
        $newsId = $faker->randomNumber();
        $comment = new Comment([
            'body' => $body,
            'news_id' => $newsId
        ]);
        $this->assertEquals($comment->body, $body);
        $this->assertEquals($comment->news_id, $newsId);
    }
}