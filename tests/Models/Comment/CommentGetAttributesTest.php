<?php


namespace Tests\Models\Comment;

use App\Models\Comment;
use Exception;
use Faker\Factory;
use PHPUnit\Framework\TestCase;

class CommentGetAttributesTest extends TestCase
{
    public function test_get_invalid_attributes()
    {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Invalid attribute for this model');
        $faker = Factory::create();
        $comment = new Comment();
        $comment->getAttributes([
            $faker->name()
        ]);
    }

    public function test_get_partial_invalid_attributes()
    {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Invalid attribute for this model');
        $faker = Factory::create();
        $comment = new Comment();
        $comment->getAttributes([
            'body',
            $faker->name()
        ]);
    }

    public function test_get_valid_attribute()
    {
        $faker = Factory::create();
        $validAttributes = [
            'body' => $faker->text()
        ];
        $comment = new Comment($validAttributes);
        $fetchedAttributes = $comment->getAttributes(['body']);
        $this->assertIsArray($fetchedAttributes);
        $this->assertEquals($fetchedAttributes, $validAttributes);
    }

    public function test_get_valid_multiple_attributes()
    {
        $faker = Factory::create();
        $validAttributes = [
            'body' => $faker->text(),
            'news_id' => $faker->randomNumber()
        ];
        $comment = new Comment($validAttributes);
        $fetchedAttributes = $comment->getAttributes(['body', 'news_id']);
        $this->assertIsArray($fetchedAttributes);
        $this->assertEquals($fetchedAttributes, $validAttributes);
    }
}