<div class="modal fade" id="addCommentModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form method="POST" action="/comment/add" onsubmit="this.submit(); this.reset(); return false;" enctype="multipart/form-data" class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5">Add Comment</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="news_id" value="<?= $news->id ?>">
                <div class="mb-3">
                    <label class="form-label">Body</label>
                    <textarea name="body" required class="form-control" rows="3"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
        </form>
    </div>
</div>