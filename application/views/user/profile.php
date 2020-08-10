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