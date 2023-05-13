<?php


namespace Tests\Models\News;

use App\Models\News;
use Exception;
use Faker\Factory;
use PHPUnit\Framework\TestCase;

class NewsSetAttributesTest extends TestCase
{
    public function test_set_invalid_attributes()
    {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Invalid attribute for this model');
        $faker = Factory::create();
        $news = new News();
        $news->setAttributes([
            $faker->name() => $faker->text()
        ]);
    }

    public function test_set_partial_invalid_attributes()
    {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Invalid attribute for this model');
        $faker = Factory::create();
        $news = new News();
        $news->setAttributes([
            'title' => $faker->text(),
            $faker->name() => $faker->text()
        ]);
    }

    public function test_set_valid_attribute()
    {
        $faker = Factory::create();
        $news = new News();
        $title = $faker->text();
        $news->setAttributes(['title' => $title]);
        $this->assertEquals($news->title, $title);
    }

    public function test_set_valid_multiple_attributes()
    {
        $faker = Factory::create();
        $news = new News();
        $title = $faker->text();
        $body = $faker->text();
        $news->setAttributes([
            'title' => $title,
            'body' => $body
        ]);
        $this->assertEquals($news->title, $title);
        $this->assertEquals($news->body, $body);
    }

    public function test_set_from_constructor()
    {
        $faker = Factory::create();
        $title = $faker->text();
        $body = $faker->text();
        $news = new News([
            'title' => $title,
            'body' => $body
        ]);
        $this->assertEquals($news->title, $title);
        $this->assertEquals($news->body, $body);
    }
}