<!-- Header -->
<!-- Header -->
<div class="header pb-2 d-flex align-items-center" style="min-height: 300px; background-image: url(<?= base_url('assets/img/group/' . $group['image']); ?>); background-size: cover; background-position: center;">
    <!-- Mask -->
    <span class="mask bg-gradient-default opacity-8"></span>
    <!-- Header container -->
    <div class="container-fluid d-flex align-items-center">
        <div class="row">
            <div class="col-lg-7 col-md-10">
                <h1 class="display-2 text-white"> <?= $group['title']; ?> Assignment</h1>
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
            <a href="<?= base_url('group/timeline/' . $group['id']); ?>" class="btn btn-default mb3">
                <span class="btn-inner--icon"><i class="fa fa-chalkboard"></i></span>
                <span class="btn-inner--text"> Time Line</span></a>
            <a href="<?= base_url('group/accessgroup/' . $group['id']); ?>" class="btn btn-primary mb3">
                <span class="btn-inner--icon"><i class="fa fa-user"></i></span>
                <span class="btn-inner--text"> Member</span></a>
            <div class="container mt-3">
                <div class="row">
                    <div class="col-lg-12 mb-3 mt-3">
                        <h2> Assignment</h2>
                    </div>
                    <?php
                    foreach ($assignment as $a) :
                    ?>
                        <div class="col-xl-3 col-md-6 col-lg-12">
                            <div class="card card-stats">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <?php
                                            $bos = $this->db->get_where('user', ['id' => $a['sender_id']])->row_array();
                                            ?>
                                            <h6 class="card-title text-uppercase text-muted mb-0">by : <?= $bos['name']; ?></h6>
                                            <span class="h5 mb-0"><?= $a['title']; ?></span>
                                        </div>
                                        <div class="col-auto">
                                            <?php
                                            if ($a['deadline_at'] > time()) :
                                            ?>
                                                <a href="<?= base_url('assignment/accessgroupwork/' . $a['id']); ?>">
                                                    <div class="icon icon-shape bg-gradient-green text-white rounded-circle shadow">
                                                        <i class="ni ni-book-bookmark"></i>
                                                </a>
                                            <?php else :
                                            ?>
                                                <a href="<?= base_url('assignment/accessgroupwork/' . $a['id']); ?>">
                                                    <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
                                                        <i class="ni ni-book-bookmark"></i>
                                                </a>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
            <?php
                    endforeach; ?>