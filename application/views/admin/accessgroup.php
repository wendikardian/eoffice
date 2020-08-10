<!-- Header -->
<!-- Header -->
<div class="header pb-2 d-flex align-items-center" style="min-height: 300px; background-image: url(<?= base_url('assets/img/group/' . $group['image']); ?>); background-size: cover; background-position: center;">
    <!-- Mask -->
    <span class="mask bg-gradient-default opacity-8"></span>
    <!-- Header container -->
    <div class="container-fluid d-flex align-items-center">
        <div class="row">
            <div class="col-lg-7 col-md-10">
                <h1 class="display-2 text-white">Welcome to <?= $group['title']; ?></h1>
            </div>
        </div>
    </div>
</div>
<!-- Page content -->

<div class="container mt-2">
    <div class="row">
        <div class="col-lg-12">

            <?php if (validation_errors()) : ?>
                <div class="alert alert-danger" role="alert">
                    <?= validation_errors() ?>
                </div>
            <?php endif; ?>
            <?= $this->session->flashdata('message'); ?>
            <a href="<?= base_url('mailbox/writter'); ?>" class="btn btn-default mb3">
                <span class="btn-inner--icon"><i class="fa fa-edit"></i></span>
                <span class="btn-inner--text"> Change Icon</span></a>
            <hr class="mt-2">
            <div class="table-responsive">
                <div>
                    <table class="table align-items-center table-dark">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col" class="sort" data-sort="name">No</th>
                                <th scope="col" class="sort" data-sort="budget"></th>
                                <th scope="col" class="sort" data-sort="status">Name</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <?php $a = 1;
                                foreach ($member as $m) :
                                ?>
                                    <td><?= $a; ?></td>
                                    <td><img src="<?= base_url('assets/img/profile/' . $m['image']); ?>" alt="" class="avatar rounded-circle"></td>
                                    <td><?= $m['name']; ?></td>
                                    <td>
                                        <a href="<?= base_url('dashboard/kick/' . $m['id'] . '/' . $group['id']); ?>" class="badge badge-pill badge-danger" onclick="return confirm('Are You Sure ?');"> Kick </a>
                                    </td>
                            </tr>
                        <?php
                                    $a++;
                                endforeach; ?>
                        </tbody>
                    </table>
                </div>

            </div>