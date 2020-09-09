<div class="container mt-5">
    <div class="row">
        <div class="col-lg-12">
            <h2>Edit SubMenu !</h2>
        </div>
    </div>
    <?php echo form_open_multipart('menu/edit_submenu/' . $id); ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="form-group">
                <label class="form-control-label" for="input-username">Name</label>
                <input type="text" id="name" name="name" class="form-control" value="<?= $submenu['title']; ?>" required>
                <?= form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="form-group">
                <label class="form-control-label" for="input-username">Url</label>
                <input type="text" id="url" name="url" class="form-control" value="<?= $submenu['url']; ?>" required>
                <?= form_error('icon', '<small class="text-danger pl-3">', '</small>'); ?>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="form-group">
                <label class="form-control-label" for="input-username">Menu</label>
                <select name="menu" id="menu" class="form-control" required>
                    <?php
                    foreach ($menu as $m) :
                    ?>
                        <option value="<?= $m['id']; ?>" <?php echo ($submenu['menu_id'] == $m['id']) ? 'selected' : ''; ?>><?= $m['menu']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="form-group">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="1" name="is_active" id="is_active" <?= ($submenu['is_active'] == 1) ? 'checked' : ''; ?>>
                    <label class="form-check-label" for="is_active">
                        active ?
                    </label>
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