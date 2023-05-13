<?php require_once __DIR__ .'/../layout/index.php'; ?>
    <h1 class="text-center mb-4 text-white">Optimy Test</h1>
    <?php foreach ($newsCollection as $news) { ?>
        <div class="card container-fluid mt-3 bg-white p-0">
            <div class="card-body p-4">
                <div class="container-fluid d-flex">
                    <div class="d-inline-block ms-auto me-2">
                        <button class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#editNewsModal<?= $news->id ?>">
                            Edit News
                        </button>
                    </div>
                    <div class="d-inline-block ms-2">
                        <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteNewsModal<?= $news->id ?>">
                            Delete News
                        </button>
                    </div>
                </div>
                <h5 class="card-title"><?php echo $news->title; ?></h5>
                <p class="card-text"><?php echo $news->body; ?></p>

                <?php foreach ($commentsCollection[$news->id] as $comment) { ?>
                    <div class="container pt-2 pb-2 d-block">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Comment <?php echo $comment->id; ?></h5>
                                <p class="card-text"><?php echo $comment->body; ?></p>
                                <div class="container-fluid d-flex p-0">
                                    <div class="d-inline-block ms-auto me-2">
                                        <button class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#editCommentModal<?= $comment->id ?>">
                                            Edit Comment
                                        </button>
                                    </div>
                                    <div class="d-inline-block ms-2">
                                        <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteCommentModal<?= $comment->id ?>">
                                            Delete Comment
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php require __DIR__ .'/../modals/comments/editCommentModal.php'; ?>
                    <?php require __DIR__ .'/../modals/comments/deleteCommentModal.php'; ?>
                <?php } ?>
                <div class="container-fluid d-flex pt-3 pb-2">
                    <div class="d-inline-block m-auto">
                        <div class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addCommentModal">
                            Add Comment
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php require __DIR__ .'/../modals/comments/addCommentModal.php'; ?>
        <?php require __DIR__ .'/../modals/news/editNewsModal.php'; ?>
        <?php require __DIR__ .'/../modals/news/deleteNewsModal.php'; ?>
    <?php } ?>

    <div class="container-fluid d-flex pt-5 pb-2">
        <div class="d-inline-block m-auto">
            <button class="btn bg-white text-primary" data-bs-toggle="modal" data-bs-target="#addNewsModal">
                Add News
            </button>
        </div>
    </div>
<?php require_once __DIR__ .'/../modals/news/addNewsModal.php'; ?>
<?php require_once __DIR__ .'/../layout/footer.php'; ?>
