<div class="modal fade" id="deleteCommentModal<?= $comment->id ?>" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5">Delete Comment</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this comment?<br/><br/>
                <p>
                    <?= $comment->body ?>
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button onclick="window.location.href = '/comment/delete/<?= $comment->id ?>'" type="button" class="btn btn-primary">Delete Comment</button>
            </div>
        </div>
    </div>
</div>