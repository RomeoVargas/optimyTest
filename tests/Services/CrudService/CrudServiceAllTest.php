<?php


namespace Tests\Services\CrudService;


use App\Models\News;
use App\Repositories\CommentRepository;
use App\Repositories\NewsRepository;
use App\Services\CrudService;
use PHPUnit\Framework\TestCase;
use TypeError;

class CrudServiceAllTest extends TestCase
{
    public function test_all_call_multiple_repositories()
    {
        $repositoryClasses = [
            NewsRepository::class,
            CommentRepository::class
        ];

        foreach ($repositoryClasses as $repositoryClass) {
            $repository = $this->createMock($repositoryClass);
            $repository
                ->expects(self::once())
                ->method('all')
                ->willReturn(true);

            $crudService = new CrudService($repository);
            $this->assertEquals($crudService->all(), true);
        }
    }

    public function test_error_when_non_repository_class_is_passed()
    {
        $this->expectException(TypeError::class);
        new CrudService(new News());
    }
}