<div class="container mt-5">
    <div class="row">
        <div class="col-lg-12">
            <h2>Edit Group !</h2>
        </div>
    </div>
    <?php echo form_open_multipart('dashboard/group_edit/' . $id); ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="form-group">
                <label class="form-control-label" for="input-username">Name</label>
                <input type="text" id="title" name="title" class="form-control" value="<?= $group['title']; ?>" required>
                <?= form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="form-group">
                <label class="form-control-label" for="input-username">Picture</label>
                <div class="col-sm-3">
                    <img src="<?= base_url('assets/img/group/') . $group['image']; ?>" class="img-thumbnail">
                </div>
                <div class="col-sm-9">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="image" name="image">
                        <label class="custom-file-label" for="image">Image</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-lg-10"></div>
<div class="col-lg-2">
    <button class="btn btn-primary" type="submit"><i class="fa fa-edit"></i> Edit</button>
</div>
</div>
</form>
</div>