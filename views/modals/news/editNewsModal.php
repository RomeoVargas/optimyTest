<div class="modal fade" id="editNewsModal<?= $news->id ?>" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form method="POST" action="/update/<?= $news->id ?>" onsubmit="this.submit(); this.reset(); return false;" enctype="multipart/form-data" class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5">Edit News - <?= $news->title ?></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Title</label>
                    <input name="title" value="<?= $news->title ?>" required type="text" class="form-control">
                </div>
                <div class="mb-3">
                    <label class="form-label">Body</label>
                    <textarea name="body" required class="form-control" rows="3"><?= $news->body ?></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
        </form>
    </div>
</div>