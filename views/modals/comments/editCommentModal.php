<div class="modal fade" id="editCommentModal<?= $comment->id ?>" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form method="POST" action="/comment/update/<?= $comment->id ?>" onsubmit="this.submit(); this.reset(); return false;" enctype="multipart/form-data" class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5">Edit Comment</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="news_id" value="<?= $news->id ?>">
                <div class="mb-3">
                    <label class="form-label">Body</label>
                    <textarea name="body" required class="form-control" rows="3"><?= $comment->body ?></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
        </form>
    </div>
</div>