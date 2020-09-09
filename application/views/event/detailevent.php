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

            <?php if ($user['id'] == $event['created_by']) : ?>
                <a href="<?= base_url('event/edit/' . $id); ?>" class="btn btn-primary mb3"><i class="fa fa-edit" aria-hidden="true"></i> Edit</a>
                <a href="<?= base_url('event/delete/' . $id); ?>" class="btn btn-danger mb3" onclick="return confirm('Are You Sure ?');"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a>
                <h6># Only people who makes it have this privillage</h6>
                <hr class="mb--1">
            <?php else : ?>
                <hr>
            <?php endif; ?>
            <?= $this->session->flashdata('message'); ?>

        </div>
    </div>
    <div class="row">
        <?php
        if ($event['type'] == 1) {
            $border = 'danger';
            $type = 'danger';
        } elseif ($event['type'] == 2) {
            $border = 'primary';
            $type = 'annual event';
        } else {
            $border = 'success';
            $type = 'hangout';
        }
        ?>
        <div class="col-lg-12">
            <div class="card border-<?= $border; ?> mb-3" style="max-width: 80rem;">
                <div class="card-header bg-transparent border-<?= $border; ?>">
                    <div class="media align-items-center">
                        <span class="avatar avatar-sm rounded-circle">
                            <img alt="Image placeholder" src="<?= base_url('assets/img/profile/' . $event['image']); ?>">
                        </span>
                        <div class="media-body  ml-2  d-none d-lg-block">
                            <a href="<?= base_url('profile/viewprofile/' . $event['created_by']); ?>"> <span class="mb-0 text-sm  font-weight-bold"><?= $event['name']; ?></span></a>
                        </div>
                    </div>
                </div>
                <div class="card-body text-<?= $border; ?>">
                    <h1 class="card-title"><?= $event['subject']; ?></h1>
                    <h6 class="mt--3 mb-3"><?= date('d F Y', $event['date']); ?> &emsp;&emsp; type : <?= $type; ?></h6>
                    <p class="card-text"><?= $event['info']; ?></p>
                </div>
                <div class="card-footer bg-transparent border-<?= $border; ?>"></div>
            </div>
        </div>
    </div>
</div>