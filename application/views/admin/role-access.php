<div class="header bg-primary pb-0">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                            <li class="breadcrumb-item"><?= $title; ?> : <?= $role['role']; ?></li>
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
            <hr>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col"> Menu </th>
                        <th scope="col"> Access </th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    $a = 1;
                    foreach ($menu as $m) :
                    ?>
                        <tr>

                            <th scope="row"><?= $a; ?> </th>
                            <td><?= $m['menu'] ?></td>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" <?= check_access($role['id'], $m['id']); ?> data-role="<?= $role['id']; ?>" data-menu="<?= $m['id']; ?>">
                                    <!-- function check_access dimasukin kedalam helper dengan membawa parameter role id
                                    dan menu id -->
                                    <!-- untuk live checklist menggunakan ajax yang disimpan difooter dimana dibedain nya
                                    berdasarkan class form check input -->
                                </div>
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