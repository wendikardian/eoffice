<div class="container mt-5">
    <div class="row">
        <div class="col-lg-12">
            <h2>Edit Announcement !</h2>
        </div>
    </div>
    <style>
        #caption {
            height: 100px;
        }
    </style>
    <form action="<?= base_url('group/timeline_edit/' . $id); ?>" method="post">
        <div class="row">
            <div class="col-lg-11">
                <input type="text" class="form-control" width="100" name="caption" id="caption" value="<?= $timeline['caption']; ?>" required>
            </div>
            <div class="col-lg-1">
                <button class="btn btn-primary" type="submit"><i class="fa fa-paper-plane"></i></button>
            </div>
        </div>
    </form>
</div>