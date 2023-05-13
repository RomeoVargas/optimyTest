<?php


namespace Tests\Models\News;

use App\Models\News;
use Exception;
use Faker\Factory;
use PHPUnit\Framework\TestCase;

class NewsGetAttributesTest extends TestCase
{
    public function test_get_invalid_attributes()
    {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Invalid attribute for this model');
        $faker = Factory::create();
        $news = new News();
        $news->getAttributes([
            $faker->name()
        ]);
    }

    public function test_get_partial_invalid_attributes()
    {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Invalid attribute for this model');
        $faker = Factory::create();
        $news = new News();
        $news->getAttributes([
            'title',
            $faker->name()
        ]);
    }

    public function test_get_valid_attribute()
    {
        $faker = Factory::create();
        $validAttributes = [
            'title' => $faker->text()
        ];
        $news = new News($validAttributes);
        $fetchedAttributes = $news->getAttributes(['title']);
        $this->assertIsArray($fetchedAttributes);
        $this->assertEquals($fetchedAttributes, $validAttributes);
    }

    public function test_get_valid_multiple_attributes()
    {
        $faker = Factory::create();
        $validAttributes = [
            'title' => $faker->text(),
            'body' => $faker->text()
        ];
        $news = new News($validAttributes);
        $fetchedAttributes = $news->getAttributes(['title', 'body']);
        $this->assertIsArray($fetchedAttributes);
        $this->assertEquals($fetchedAttributes, $validAttributes);
    }
}