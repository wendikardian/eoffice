<div class="container-fluid ">
    <div class="row">
        <div class="col-xl-8 order-xl-1">
            <div class="card">
                <div class="card-header">
                    <form action="<?= base_url('file/change_password/' . $id); ?>" method="post">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">Change folder password for folder '<?= $folder['title']; ?>'</h3>
                            </div>
                        </div>
                </div>
                <div class="card-body">
                    <div class="pl-lg-4">
                        <div class="row">
                            <div class="col-lg-12">
                                <?= $this->session->flashdata('message'); ?>
                                <div class="form-group">
                                    <label class="form-control-label" for="input-username">Current Password</label>
                                    <input type="password" id="current_password" name="current_password" class="form-control">
                                    <?= form_error('current_password', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-username">New Password</label>
                                    <input type="password" id="new_password1" name="new_password1" class="form-control">
                                    <?= form_error('new_password1', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-username">Repeat Password</label>
                                    <input type="password" id="new_password2" name="new_password2" class="form-control">
                                    <?= form_error('new_password2', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                            </div>
                            <div class="col-12 text-right">
                                <button class="btn btn-sm btn-primary" type="submit"> Change Password</button>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>