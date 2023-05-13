<?php


namespace Tests\Models\News;

use App\Models\News;
use Exception;
use Faker\Factory;
use PHPUnit\Framework\TestCase;

class NewsGetAttributeTest extends TestCase
{
    public function test_get_invalid_attribute()
    {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Invalid attribute for this model');
        $faker = Factory::create();
        $news = new News();
        $news->getAttribute($faker->name());
    }

    public function test_get_valid_attribute()
    {
        $faker = Factory::create();
        $title = $faker->text();
        $news = new News([
            'title' => $title
        ]);
        $fetchedAttribute = $news->getAttribute('title');
        $this->assertEquals($fetchedAttribute, $title);
    }
}