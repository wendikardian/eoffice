<div class="container mt-5">
    <div class="row">
        <div class="col-lg-12">
            <h2>Edit Group !</h2>
        </div>
    </div>
    <?php echo form_open_multipart('dashboard/edit_role/' . $id); ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="form-group">
                <label class="form-control-label" for="input-username">Name</label>
                <input type="text" id="name" name="name" class="form-control" value="<?= $role['role']; ?>" required>
                <?= form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
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