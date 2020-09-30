<?php
// Skrip berikut ini adalah skrip yang bertugas untuk meng-export data tadi ke excell
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=backup_absen_" . $date . ".xls");
?>

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
                                <th scope="col" class="sort" data-sort="status">Name</th>
                                <th scope="col" class="sort" data-sort="status">Datetime</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $a = 1;
                            foreach ($member as $m) : ?>
                                <tr>
                                    <td><?= $a; ?></td>
                                    <td><a href="<?= base_url('profile/viewprofile/' . $m['id']); ?>"><?= $m['name']; ?><a href=""></a></td>
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