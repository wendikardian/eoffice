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
            <a href="" class="btn btn-primary mb3" data-toggle="modal" data-target="#newRoleModal"> Add New Group</a>
            <hr>
            <form action="<?= base_url('dashboard/group'); ?>" class="mt-3" method="post">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Search Group Keyword .." aria-label="Search  Keyword .." aria-describedby="button-addon2" name="keyword" autocomplete="off" autofocus>
                    <div class="input-group-append">
                        <input class="btn btn-primary" type="submit" name="submit" placeholder="search">
                    </div>
                </div>
            </form>
            <h5>Result : <?= $total_rows; ?></h5>
            <h5>Searching for : <?= $keyword; ?></h5>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col"></th>
                        <th scope="col"> Name </th>
                        <th scope="col"> Action </th>
                    </tr>
                </thead>
                <?php
                $a = 1;
                foreach ($group as $g) :
                ?>

                    <tbody>
                        <td><?= $a; ?></td>
                        <td>
                            <img width="30" height="30" src="<?= base_url('assets/img/group/' . $g['image']); ?>">
                        </td>
                        <td><?= $g['title']; ?></td>
                        <td>
                            <a href="<?= base_url('dashboard/accessgroup/' . $g['id']); ?>" class="badge badge-pill badge-warning"> Access </a>
                            <a href="<?= base_url('dashboard/password_group/' . $g['id']); ?>" class="badge badge-pill badge-success"> Change Password </a>
                            <a href="<?= base_url('dashboard/delete_group/' . $g['id']); ?>" class="badge badge-pill badge-danger" onclick="return confirm('Are You Sure ?');"> Delete </a></td>
                    </tbody>
                <?php
                    $a++;
                endforeach; ?>
            </table>
            <?php
            echo $this->pagination->create_links();
            ?>
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
            <form action="<?= base_url('dashboard/add_group'); ?>" method="post">
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