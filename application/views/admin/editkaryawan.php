<div class="container mt-5">
    <div class="row">
        <div class="col-lg-12">
            <h2>Edit Data Karyawan !</h2>
        </div>
    </div>
    <form action="<?= base_url('dashboard/p_editkaryawan/' . $id); ?>" method="post">
        <div class="row">
            <div class="col-lg-12">
                <div class="form-group">
                    <label class="form-control-label" for="input-username">Role</label>
                    <select name="role" id="role" class="form-control" required>
                        <?php
                        foreach ($role as $r) :
                        ?>
                            <option value="<?= $r['id']; ?>" <?php echo ($karyawan['role_id'] == $r['id']) ? 'selected' : ''; ?>><?= $r['role']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <?php
            if ($karyawan['is_active'] == 1) {
                $active_1 = "selected";
                $active_2 = "";
            } else {
                $active_1 = "";
                $active_2 = "selected";
            }
            ?>
            <div class="col-lg-10"></div>
            <div class="col-lg-2">
                <button class="btn btn-primary" type="submit"><i class="fa fa-paper-plane"></i></button>
            </div>
        </div>
    </form>
</div>