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

            <?= form_error('name', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
            <?= form_error('password1', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
            <?= $this->session->flashdata('message'); ?>
            <a href="<?= base_url('dashboard/scanabsent'); ?>" class="btn btn-primary mb3"> Scan</a>
            <a href="<?= base_url('dashboard/absentmanual'); ?>" class="btn btn-success mb3"> Manual</a>
            <hr>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col"> Tanggal </th>
                        <th scope="col"> Jumlah Hadir </th>
                        <th scope="col"> </th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($absent as $a) :
                    ?>
                        <tr>
                            <td><?= $no; ?></td>
                            <td><?= $a['date']; ?></td>
                            <td><?= $a['jumlah']; ?></td>
                            <td>
                                <a href="<?= base_url('dashboard/viewabsent/' . $a['date']) ?>" class="badge badge-pill badge-success"> Access </a>
                            </td>
                        </tr>
                    <?php
                        $no++;
                    endforeach;
                    ?>
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
            <form action="<?= base_url('dashboard/group'); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="name" name="name" placeholder="Group Name" required>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" id="password1" name="password1" placeholder="Password" required>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" id="password2" name="password2" placeholder="Repeat Password" required>
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