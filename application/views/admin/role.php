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
        <div class="col-lg-10">

            <?= form_error('menu', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
            <?= $this->session->flashdata('message'); ?>
            <a href="" class="btn btn-primary mb3" data-toggle="modal" data-target="#newRoleModal"> Add New Role</a>
            <hr>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">ID</th>
                        <th scope="col"> Role </th>
                        <th scope="col"> Action </th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    $a = 1;
                    ?>
                    <?php
                    foreach ($role as $r) :
                    ?>
                        <tr>

                            <th scope="row"><?= $a; ?> </th>
                            <th scope="row"><?= $r['id']; ?> </th>
                            <td><?= $r['role']; ?></td>
                            <td>
                                <a href="<?= base_url('dashboard/roleaccess/') . $r['id']; ?>" class="badge badge-pill badge-warning"> Access </a>
                                <a href="<?= base_url('dashboard/edit_role/' . $r['id']); ?>" class="badge badge-pill badge-success"> Edit </a>
                                <a href="<?= base_url('dashboard/delete_role/') . $r['id']; ?>" class="badge badge-pill badge-danger" onclick="return confirm('Are You Sure ?');"> Delete </a>
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
<div class="modal fade" id="newRoleModal" tabindex="-1" role="dialog" aria-labelledby="newRoleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newRoleModalLabel">Add New Role</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('dashboard/role'); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="role" name="role" placeholder="Role Name">
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