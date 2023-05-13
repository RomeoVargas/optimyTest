<?php


namespace App\Controllers;


use App\Repositories\CommentRepository;
use App\Repositories\NewsRepository;
use App\Request;
use App\Services\CrudService;

class NewsController
{
    public function getList()
    {
        $newsCrudService = new CrudService(new NewsRepository());
        $commentsCrudService = new CrudService(new CommentRepository());

        $newsCollection = $newsCrudService->all();
        $commentsCollection = [];
        foreach ($newsCollection as $news) {
            $commentsCollection[$news->id] = $commentsCrudService->search([
                'news_id' => $news->id
            ]);
        }

        display_page('news/list', [
            'newsCollection' => $newsCollection,
            'commentsCollection' => $commentsCollection
        ]);
    }

    public function add(Request $request)
    {
        $newsCrudService = new CrudService(new NewsRepository());
        $newsCrudService->create($request->getParameters());

        redirect('/');
    }

    public function update($id, Request $request)
    {
        $newsCrudService = new CrudService(new NewsRepository());
        $newsCrudService->update(
            ['id' => $id],
            $request->getParameters()
        );

        redirect('/');
    }

    public function delete($id)
    {
        $commentsCrudService = new CrudService(new CommentRepository());
        $commentsCrudService->deleteByAttribute('news_id', $id);

        $newsCrudService = new CrudService(new NewsRepository());
        $newsCrudService->deleteById($id);

        redirect('/');
    }
}