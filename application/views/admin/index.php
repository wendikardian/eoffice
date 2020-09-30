<div class="header bg-primary pb-6">
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
            <!-- Card stats -->
            <div class="row">
                <?php
                $this->db->count_all_results('user');
                $this->db->where('role_id', 1);
                $this->db->from('user');
                $admin = $this->db->count_all_results();
                $this->db->count_all_results('user');
                $this->db->where('role_id', 2);
                $this->db->from('user');
                $bos = $this->db->count_all_results();
                $this->db->count_all_results('user');
                $this->db->where('role_id', 3);
                $this->db->from('user');
                $employee = $this->db->count_all_results();
                $this->db->count_all_results('user');
                $this->db->where('role_id', 4);
                $this->db->from('user');
                $guest = $this->db->count_all_results();


                ?>
                <div class="col-xl-3 col-md-6">
                    <div class="card card-stats">
                        <!-- Card body -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Admin</h5>
                                    <span class="h2 font-weight-bold mb-0"><?= $admin; ?></span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-gradient-orange text-white rounded-circle shadow">
                                        <i class="ni ni-chart-pie-35"></i>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card card-stats">
                        <!-- Card body -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Bos</h5>
                                    <span class="h2 font-weight-bold mb-0"><?= $bos; ?></span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-gradient-green text-white rounded-circle shadow">
                                        <i class="ni ni-chart-pie-35"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">

                    <div class="card card-stats">
                        <!-- Card body -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Employee</h5>
                                    <span class="h2 font-weight-bold mb-0"><?= $employee; ?></span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-gradient-blue text-white rounded-circle shadow">
                                        <i class="ni ni-chart-pie-35"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<div class="container mt-5">
    <div class="row">
        <div class="col-lg-12">
            <?= $this->session->flashdata('message'); ?>
            <h2>Data Hadir Absensi </h2>
            <div id="graph"></div>
        </div>
    </div>
    <div class="row mt-5">
        <h2>Data Karyawan</h2>
        <div class="col-lg-12">

            <form action="<?= base_url('dashboard/index'); ?>" class="mt-3" method="post">

                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Search Name Keyword .." aria-label="Search  Keyword .." aria-describedby="button-addon2" name="keyword" autocomplete="off" autofocus>
                    <div class="input-group-append">
                        <input class="btn btn-primary" type="submit" name="submit" placeholder="search">
                    </div>
                </div>

            </form>
            <h5>Result : <?= $total_rows; ?></h5>
            <h5>Searching for : <?= $keyword; ?></h5>
            <table class="table align-items-center mt-3">
                <thead class="thead">
                    <tr>
                        <th scope="col" class="sort" data-sort="name">No</th>
                        <th scope="col" class="sort" data-sort="name"></th>
                        <th scope="col" class="sort" data-sort="status">Name</th>
                        <th scope="col" class="sort" data-sort="status">Email</th>
                        <th scope="col" class="sort" data-sort="status">Status</th>
                        <th scope="col" class="sort" data-sort="status"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($member)) : ?>
                        <tr>
                            <td colspan="5">
                                <div class="alert alert-danger"> Data not found </div>
                            </td>
                        </tr>
                    <?php endif; ?>
                    <?php
                    $a = 1;
                    foreach ($member as $m) : ?>
                        <tr>
                            <td><?= ++$from; ?></td>
                            <td><img src="<?= base_url('assets/img/profile/' . $m['image']); ?>" alt="" class="avatar rounded-circle"></td>
                            <td><a href="<?= base_url('profile/viewprofile/' . $m['id']); ?>"><?= $m['name']; ?></a></td>
                            <td><?= $m['email']; ?></td>
                            <?php if ($m['is_active'] == 1) {
                                $status = 'active';
                            } else {
                                $status = 'deactive';
                            } ?>
                            <td><?= $status; ?></td>
                            <td><a href="<?= base_url('dashboard/print/' . $m['id']); ?>" class="badge badge-pill badge-primary"> Cetak Kartu </a>
                                <a href="<?= base_url('dashboard/editkaryawan/' . $m['id']); ?>" class="badge badge-pill badge-success"> Edit </a>
                                <?php if ($m['is_active'] == 1) : ?>
                                    <a href="<?= base_url('dashboard/deactive/' . $m['id']); ?>" class="badge badge-pill badge-danger" onclick="return confirm('Are You Sure ?');"> Deactive </a>
                                <?php else : ?>
                                    <a href="<?= base_url('dashboard/activate/' . $m['id']); ?>" class="badge badge-pill badge-success" onclick="return confirm('Are You Sure ?');"> Activate </a>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php
                        $a++;
                    endforeach; ?>
                </tbody>
            </table>
            <?php
            echo $this->pagination->create_links();
            ?>
        </div>
    </div>
</div>
<script src="<?php echo base_url() . 'assets/js/jquery.min.js' ?>"></script>
<script src="<?php echo base_url() . 'assets/js/raphael-min.js' ?>"></script>
<script src="<?php echo base_url() . 'assets/js/morris.min.js' ?>"></script>
<script>
    Morris.Line({
        element: 'graph',
        data: <?php echo $absen; ?>,
        xkey: 'date',
        ykeys: ['jumlah'],
        labels: ['jumlah']
    });
</script>

<div class="container mt-5">
    <div class="row">
        <div class="col-lg-6">
            <h2>Data Admin</h2>
            <table class="table align-items-center mt-3">
                <thead class="thead">
                    <tr>
                        <th scope="col" class="sort" data-sort="name">No</th>
                        <th scope="col" class="sort" data-sort="name"></th>
                        <th scope="col" class="sort" data-sort="status">Name</th>
                        <th scope="col" class="sort" data-sort="status">Email</th>
                        <th scope="col" class="sort" data-sort="status">Status</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    $admin = $this->db->get_where('user', [
                        'role_id' => 1
                    ])->result_array();
                    $a = 1;
                    foreach ($admin as $ad) : ?>
                        <tr>
                            <td><?= $a; ?></td>
                            <td><img src="<?= base_url('assets/img/profile/' . $ad['image']); ?>" alt="" class="avatar rounded-circle"></td>
                            <td><a href="<?= base_url('profile/viewprofile/' . $ad['id']); ?>"><?= $ad['name']; ?></a></td>
                            <td><?= $ad['email']; ?></td>
                            <?php if ($ad['is_active'] == 1) {
                                $status = 'active';
                            } else {
                                $status = 'deactive';
                            } ?>
                            <td><?= $status; ?></td>
                        </tr>
                    <?php
                        $a++;
                    endforeach; ?>
                </tbody>

            </table>
        </div>
        <div class="col-lg-6">
            <h2>Data Bos</h2>
            <table class="table align-items-center mt-3">
                <thead class="thead">
                    <tr>
                        <th scope="col" class="sort" data-sort="name">No</th>
                        <th scope="col" class="sort" data-sort="name"></th>
                        <th scope="col" class="sort" data-sort="status">Name</th>
                        <th scope="col" class="sort" data-sort="status">Email</th>
                        <th scope="col" class="sort" data-sort="status">Status</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    $bos = $this->db->get_where('user', [
                        'role_id' => 2
                    ])->result_array();
                    $a = 1;
                    foreach ($bos as $ad) : ?>
                        <tr>
                            <td><?= $a; ?></td>
                            <td><img src="<?= base_url('assets/img/profile/' . $ad['image']); ?>" alt="" class="avatar rounded-circle"></td>
                            <td><a href="<?= base_url('profile/viewprofile/' . $ad['id']); ?>"><?= $ad['name']; ?></a></td>
                            <td><?= $ad['email']; ?></td>
                            <?php if ($ad['is_active'] == 1) {
                                $status = 'active';
                            } else {
                                $status = 'deactive';
                            } ?>
                            <td><?= $status; ?></td>
                        </tr>
                    <?php
                        $a++;
                    endforeach; ?>
                </tbody>

            </table>
        </div>
    </div>
</div>