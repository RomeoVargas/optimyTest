<?php


namespace Tests\Models\News;

use App\Models\News;
use Exception;
use Faker\Factory;
use PHPUnit\Framework\TestCase;

class NewsSetAttributeTest extends TestCase
{
    public function test_set_invalid_attribute()
    {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Invalid attribute for this model');
        $faker = Factory::create();
        $news = new News();
        $news->setAttribute($faker->name(), $faker->text());
    }

    public function test_set_valid_attribute()
    {
        $faker = Factory::create();
        $news = new News();
        $title = $faker->text();
        $news->setAttribute('title', $title);
        $this->assertEquals($news->title, $title);
    }
}