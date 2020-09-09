<div class="header bg-primary pb-0">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                            <li class="breadcrumb-item"><?= $title; ?></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="container mt-3">
    <div class="row">
        <div class="col-lg-12">

            <?php if (validation_errors()) : ?>
                <div class="alert alert-danger" role="alert">
                    <?= validation_errors() ?>
                </div>
            <?php endif; ?>
            <?= $this->session->flashdata('message'); ?>
            <a href="<?= base_url('file/quit'); ?>" class="btn btn-danger"><i class="fa fa-outdent"></i></a>
            <?php if (($user['role_id'] == 1) or ($user['role_id'] == 2)) : ?>
                <a href="" class="btn btn-primary mb3" data-toggle="modal" data-target="#newfolder"><i class="fa fa-lock" aria-hidden="true"></i> + Upload New Private File</a>
                <h6># Only Admin and Boss who have upload this privillage</h6>
                <h6># Hanya pengupload file atau pemilik folder yang berhak menghapus file</h6>
                <hr>
            <?php else : ?>
                <hr>
            <?php endif; ?>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col"></th>
                        <th scope="col"> Title </th>
                        <th scope="col"> Created by </th>
                        <th scope="col"> Created At </th>
                        <th scope="col"> </th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    $a = 1;
                    ?>
                    <?php
                    foreach ($file as $f) :
                    ?>
                        <tr>

                            <th scope="row"><?= $a; ?> </th>
                            <td><a href="" data-toggle="modal" data-target="#newSubMenuModal"><i class="fa fa-file" aria-hidden="true"></i></a></td>
                            <td><a href="" data-toggle="modal" data-target="#newSubMenuModal"><?= $f['title']; ?></a></td>
                            <?php
                            $owner = $this->db->get_where('user', [
                                'id' => $f['owner_id']
                            ])->row_array();
                            ?>
                            <td><a href="<?= base_url('profile/viewprofile/' . $f['owner_id']); ?>"><?= $owner['name']; ?></a></td>
                            <td><?= date('d F Y', $f['date']); ?></td>
                            <?php
                            $folder = $this->db->get_where('folder_private', [
                                'id' => $folder_id
                            ])->row_array();
                            $folder_owner = $folder['owner_id'];
                            ?>
                            <?php if (($f['owner_id'] == $user['id']) or ($folder_owner == $user['id'])) :
                            ?>
                                <td>
                                    <a href="<?= base_url('assets/file/' . $f['title']); ?>" class="badge badge-pill badge-primary" download> Download </a>
                                    <a href="<?= base_url('file/delete_fileprivate/' . $f['id']); ?>" class="badge badge-pill badge-danger"> Delete </a>
                                </td>
                            <?php else : ?>
                                <td>
                                    <a href="<?= base_url('assets/file/' . $f['title']); ?>" class="badge badge-pill badge-primary" download> Download </a>
                                </td>
                            <?php endif; ?>
                        </tr>
                        <?php $a++; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

    </div>
</div>

</div>
<!-- /.container-fluid -->

</div>
<!-- Modal -->


<div class="modal fade" id="newfolder" tabindex="-1" role="dialog" aria-labelledby="newfolderLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newfolderLabel">Add New File</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php echo form_open_multipart('file/upload_file_private/' . $folder_id); ?>
            <div class="modal-body">
                <div class="col-sm-12">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="file" name="file" required>
                        <label class="custom-file-label" for="image">File</label>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">add</button>
            </div>
            </form>
        </div>
    </div>
</div>