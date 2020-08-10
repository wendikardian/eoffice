<!-- Header -->
<!-- Header -->
<div class="header pb-2 d-flex align-items-center" style="min-height: 300px; background-size: cover; background-position: center;">
    <!-- Mask -->
    <span class="mask bg-gradient-default opacity-8"></span>
    <!-- Header container -->
    <div class="container-fluid d-flex align-items-center">
        <div class="row">
            <div class="col-lg-7 col-md-10">
                <h6 class="display-2 text-white"> <?= $title; ?></h6>
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
            <hr class="mt-2">
            <div class="table-responsive">
                <div>
                    <table class="table align-items-center table-dark">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col" class="sort" data-sort="name">No</th>
                                <th scope="col" class="sort" data-sort="name"></th>
                                <th scope="col" class="sort" data-sort="status">Name</th>
                                <th scope="col" class="sort" data-sort="status">Datetime</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $a = 1;
                            foreach ($member as $m) : ?>
                                <tr>
                                    <td><?= $a; ?></td>
                                    <td><img src="<?= base_url('assets/img/profile/' . $m['image']); ?>" alt="" class="avatar rounded-circle"></td>
                                    <td><?= $m['name']; ?></td>
                                    <?php
                                    $id = $m['id'];
                                    $query = "SELECT * FROM `absensi_masuk` WHERE `date` LIKE '{$date}%' AND `user_id` = $id ";
                                    // $query = "SELECT * FROM absensi_masuk where user_id =$id ";
                                    $cek = $this->db->query($query)->row_array();
                                    if ($cek > 0) {
                                        $jam = $cek['date'];
                                    } else {
                                        $jam = '-';
                                    }
                                    ?>
                                    <td><?= $jam; ?></td>
                                </tr>
                            <?php
                                $a++;
                            endforeach; ?>
                        </tbody>
                    </table>
                </div>

            </div>