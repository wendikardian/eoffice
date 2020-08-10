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
            <?php if (($user['role_id'] == 1) or ($user['role_id'] == 2)) : ?>
                <a href="" class="btn btn-primary mb3" data-toggle="modal" data-target="#newfolder"><i class="fa fa-lock" aria-hidden="true"></i> Add New Private Folder</a>
                <h6>#Only Admin and Boss who have this privillage</h6>
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
                        <th scope="col"> Action</th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    $a = 1;
                    ?>
                    <?php
                    foreach ($folder as $f) :
                    ?>
                        <tr>

                            <th scope="row"><?= $a; ?> </th>
                            <td><a href="<?= base_url('file/validation/' . $f['id']); ?>"><i class="fa fa-lock" aria-hidden="true"></i> <i class="fa fa-folder" aria-hidden="true"></i></a></td>
                            <td><a href="<?= base_url('file/validation/' . $f['id']); ?>"><?= $f['title']; ?></a></td>
                            <td><?= $f['owner']; ?></td>
                            <td><?= date('d F Y', $f['date']); ?></td>
                            <td>
                                <a href="" class="badge badge-pill badge-success"> Edit </a>
                                <a href="" class="badge badge-pill badge-danger"> Delete </a>
                            </td>
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
<div class="modal fade" id="newSubMenuModal" tabindex="-1" role="dialog" aria-labelledby="newSubMenuModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newSubMenuModalLabel">Password</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('File/validation/') . $f['id']; ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Folder password" required>
                        <?= form_error('title', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">access</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="newfolder" tabindex="-1" role="dialog" aria-labelledby="newfolderLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newfolderLabel">Add New Folder</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('File/addfolderpublic'); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="title" name="title" placeholder="Folder Name">
                        <?= form_error('title', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" id="password1" name="password1" placeholder="Folder password">
                        <?= form_error('title', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" id="password2" name="password2" placeholder="Repeat password">
                        <?= form_error('title', '<small class="text-danger pl-3">', '</small>'); ?>
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