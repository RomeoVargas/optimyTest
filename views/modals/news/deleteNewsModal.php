<div class="modal fade" id="deleteNewsModal<?= $news->id ?>" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5">Delete News - <?= $news->title ?></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this news?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button onclick="window.location.href = '/delete/<?= $news->id ?>'" type="button" class="btn btn-primary">Delete News</button>
            </div>
        </div>
    </div>
</div>