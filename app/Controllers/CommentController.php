<?php


namespace App\Controllers;


use App\Repositories\CommentRepository;
use App\Request;
use App\Services\CrudService;

class CommentController
{
    public function add(Request $request)
    {
        $commentCrudService = new CrudService(new CommentRepository());
        $commentCrudService->create($request->getParameters());

        redirect('/');
    }

    public function update($id, Request $request)
    {
        $commentCrudService = new CrudService(new CommentRepository());
        $commentCrudService->update(
            ['id' => $id],
            $request->getParameters()
        );

        redirect('/');
    }

    public function delete($id)
    {
        $commentCrudService = new CrudService(new CommentRepository());
        $commentCrudService->deleteById($id);

        redirect('/');
    }
}