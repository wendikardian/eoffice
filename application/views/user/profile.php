<!-- Header -->
<!-- Header -->
<div class="header pb-6 d-flex align-items-center" style="min-height: 300px; background-image: url(<?= base_url('assets/img/profile/' . $user['image']); ?>); background-size: cover; background-position: center top;">
    <!-- Mask -->
    <span class="mask bg-gradient-default opacity-8"></span>
    <!-- Header container -->
    <div class="container-fluid d-flex align-items-center">
        <div class="row">
            <div class="col-lg-7 col-md-10">
                <h1 class="display-2 text-white">Hello <?= $user['name']; ?></h1>
                <p class="text-white mt-0 mb-5">This is your profile page. You can see the progress you've made with your work and manage your projects or assigned tasks</p>
            </div>
        </div>
    </div>
</div>
<!-- Page content -->
<div class="container-fluid mt--6">
    <div class="row">
        <div class="col-xl-5 order-xl-2">
            <div class="card card-profile">
                <img src="<?= base_url('assets/admin'); ?>/img/theme/img-1-1000x600.jpg" alt="Image placeholder" class="card-img-top">
                <div class="row justify-content-center">
                    <div class="col-lg-3 order-lg-2">
                        <div class="card-profile-image">
                            <a href="#">
                                <img src="<?= base_url('assets/img/profile/' . $user['image']); ?>" class="rounded-circle">
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
                    <div class="d-flex justify-content-between">
                    </div>
                </div>
                <div class="card-body pt-0">
                    <div class="row">
                        <div class="col">

                        </div>
                    </div>
                    <div class="text-center mt-5">
                        <h5 class="h3">
                            <?= $this->session->flashdata('message'); ?>
                            <?= $user['name']; ?><span class="font-weight-light"></span>
                        </h5>
                        <h5 class="h3">
                            <?= $user['email']; ?><span class="font-weight-light"></span>
                        </h5>
                        <?php
                        if ($user['role_id'] == 1) {
                            $role = 'Admin';
                        } else if ($user['role_id'] == 2) {
                            $role = 'Bos';
                        } else if ($user['role_id'] == 3) {
                            $role = 'Employee';
                        } else {
                            $role = 'Guest';
                        }
                        ?>
                        <div class="h5 font-weight-300">
                            <i class="ni location_pin mr-2"></i><?= $role; ?>
                        </div>
                        <div class="h5 mt-2">
                            <i class="ni business_briefcase-24 mr-2"></i><?= $user['telp']; ?>
                        </div>
                        <div>
                            <i class="ni education_hat mr-2"></i> Member Since : <?= date('d F Y', $user['date_created']); ?>
                        </div>
                        <div>
                            <hr class="mt--1">
                            <a href="<?= base_url('profile/editprofile'); ?>"><button class="btn btn-primary"> Edit Profile</button></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
$user_id = $user['id'];
$query1 = "SELECT SUM(point) as point from `point_plus` where recepient_id = $user_id";
$point_plus = $this->db->query($query1)->row_array();
?>
<?php
if ($user['role_id'] == 2) :
?>-
<?php else : ?>
    <div class="container mt-3">
        <div class="row">
            <div class="col-xl-3 col-md-6 col-lg-12">
                <div class="card card-stats">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h4 class="card-title text-uppercase text-muted mb-0"> <b> Total Point </b></h4>
                            </div>
                            <div class="col-auto">

                                <a href="<?= base_url('profile/point/' . $user['id']); ?>">
                                    <div class="icon icon-shape bg-gradient-green text-white rounded-circle shadow">
                                        <?= $point_plus['point']; ?>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 col-lg-12">
                <div class="card card-stats">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <?php
                                $date = date("Y-m", time());
                                $query3 = "SELECT SUM(point) as point from `point_plus` where recepient_id = $user_id AND date like '{$date}%'";
                                $point_plus = $this->db->query($query3)->row_array();
                                ?>
                                <h4 class="card-title text-uppercase text-muted mb-0"> <b> This Month </b></h4>
                                <h4 class="card-title text-uppercase text-muted mb-0"> <b> Point </b></h4>
                                <h6 class="card-title text-uppercase text-muted mb-0"> <b> <?= date('F Y', time()); ?> </b></h6>
                            </div>
                            <div class="col-auto">
                                <a href="<?= base_url('profile/point/' . $user['id']); ?>">
                                    <div class="icon icon-shape bg-gradient-blue text-white rounded-circle shadow">
                                        <?= $point_plus['point']; ?>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-lg-12">
                <?= $this->session->flashdata('message'); ?>
                <h2>Point Performance </h2>
                <div id="graph"></div>
            </div>
        </div>
        <?php
        $query = "SELECT sum(point) as point, month(date) as month FROM `point_plus` WHERE recepient_id = $user_id group by month(date)";
        $point = $this->db->query($query)->result_array();
        $data = json_encode($point);
        // var_dump($data);
        ?>
        <script src="<?php echo base_url() . 'assets/js/jquery.min.js' ?>"></script>
        <script src="<?php echo base_url() . 'assets/js/raphael-min.js' ?>"></script>
        <script src="<?php echo base_url() . 'assets/js/morris.min.js' ?>"></script>
        <script>
            Morris.Bar({
                element: 'graph',
                data: <?php echo $data; ?>,
                xkey: 'month',
                ykeys: ['point'],
                labels: ['point']
            });
        </script>
    </div>
<?php endif; ?>