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

<?= $this->session->flashdata('message'); ?>
<div class="container mt-5">
    <div class="row mt-4">
        <div class="col-lg-2">
        </div>
        <div class="col-lg-1">
            <b> By</b>
        </div>
        <div class="col-lg-1">
            <center>:</center>
        </div>
        <?php
        $sender = $this->db->get_where('user', [
            'id' => $assignment['sender_id']
        ])->row_array();
        ?>
        <div class="col-lg-6">
            <div class="alert alert-primary" role="alert"><img src="<?= base_url('assets/img/profile/' . $sender['image']); ?>" alt="" class="avatar rounded-circle"> <a href="<?= base_url("profile/viewprofile/" . $assignment['sender_id']); ?>"><?= $sender['name']; ?></a></div>
        </div>
    </div>
    <div class="row">

        <div class="col-lg-2">
        </div>
        <div class="col-lg-1">
            <b> To (Group)</b>
        </div>
        <div class="col-lg-1">
            <center>:</center>
        </div>
        <div class="col-lg-6">
            <?php
            $group = $this->db->get_where('group', [
                'id' => $assignment['group_id']
            ])->row_array();
            ?>
            <div class="alert alert-primary" role="alert"><img src="<?= base_url('assets/img/group/' . $group['image']); ?>" alt="" class="avatar rounded-circle"> <a href="<?= base_url("group/accessgroup/" . $assignment['group_id']); ?>"><?= $group['title']; ?></a></div>
        </div>
    </div>
    <div class="row">

        <div class="col-lg-2">
        </div>
        <div class="col-lg-1">
            <b> Title</b>
        </div>
        <div class="col-lg-1">
            <center>:</center>
        </div>
        <div class="col-lg-6">
            <div class="alert alert-primary" role="alert"><?= $assignment['title']; ?></div>
        </div>
    </div>
    <div class="row">

        <div class="col-lg-2">
        </div>
        <div class="col-lg-1">
            <b> Created at</b>
        </div>
        <div class="col-lg-1">
            <center>:</center>
        </div>
        <div class="col-lg-6">
            <div class="alert alert-primary" role="alert"><?= date("Y/m/d h:i A", $assignment['created_at']); ?></div>
        </div>
    </div>
    <div class="row">

        <div class="col-lg-2">
        </div>
        <div class="col-lg-1">
            <b> Deadline at</b>
        </div>
        <div class="col-lg-1">
            <center>:</center>
        </div>
        <div class="col-lg-6">
            <div class="alert alert-primary" role="alert"><?= date("Y/m/d h:i A", $assignment['deadline_at']); ?></div>
        </div>
    </div>
    <?php
    $submition = $this->db->get_where('assignment_group_member', [
        'assignment_id' => $id,
        'user_id' => $user['id']
    ])->row_array();
    if ($submition < 1) :
        if ($assignment['deadline_at'] > time()) :
    ?>
            <div class="row">
                <div class="col-lg-2">
                </div>
                <div class="col-lg-1">
                    <b> Time Remaining</b>
                    <?php $remaining = $assignment['deadline_at'] - time();
                    $days_remaining = floor($remaining / 86400);
                    $hours_remaining = floor(($remaining % 86400) / 3600);
                    $min = floor(($remaining % 3600) / 60);
                    ?>
                </div>
                <div class="col-lg-1">
                    <center>:</center>
                </div>
                <div class="col-lg-6">
                    <div class="alert alert-success" role="alert"><?= $days_remaining; ?> Days <?= $hours_remaining; ?> Hours <?= $min; ?> Minute</div>
                </div>
            </div>
        <?php else : ?>
            <div class="row">
                <div class="col-lg-2">
                </div>
                <div class="col-lg-1">
                    <b> Time Remaining</b>
                    <?php $remaining = time() - $assignment['deadline_at'];
                    $days_remaining = floor($remaining / 86400);
                    $hours_remaining = floor(($remaining % 86400) / 3600);
                    $min = floor(($remaining % 3600) / 60);
                    ?>
                </div>
                <div class="col-lg-1">
                    <center>:</center>
                </div>
                <div class="col-lg-6">
                    <div class="alert alert-danger" role="alert"><?= $days_remaining; ?> Days <?= $hours_remaining; ?> Hours <?= $min; ?> Minute Late</div>
                </div>
            </div>
        <?php
        endif;
        ?>
    <?php else : ?>
        <?php if ($submition['file'] != NULL) : ?>
            <div class="row">
                <div class="col-lg-2">
                </div>
                <div class="col-lg-1">
                    <b> File </b>
                </div>
                <div class="col-lg-1">
                    <center>:</center>
                </div>
                <div class="col-lg-6">
                    <a href="<?= base_url('assets/assignment/' . $submition['file']); ?>" class="badge badge-pill badge-primary" download><i class="fa fa-file"></i> <?= $submition['file']; ?> </a>
                </div>
            </div>
            <div class="row  mt-2">
                <div class="col-lg-2">
                </div>
                <div class="col-lg-1">
                    <b> Submitted at </b>
                    <?php $remaining = time() - $assignment['deadline_at'];
                    $days_remaining = floor($remaining / 86400);
                    $hours_remaining = floor(($remaining % 86400) / 3600);
                    $min = floor(($remaining % 3600) / 60);
                    ?>
                </div>
                <div class="col-lg-1">
                    <center>:</center>
                </div>
                <div class="col-lg-6">
                    <?php if ($submition['submited_at'] < $assignment['deadline_at']) : ?>
                        <?php $remaining = $assignment['deadline_at'] - $submition['submited_at'];
                        $days_remaining = floor($remaining / 86400);
                        $hours_remaining = floor(($remaining % 86400) / 3600);
                        $min = floor(($remaining % 3600) / 60);
                        ?>
                        <div class="alert alert-success" role="alert"><?= $days_remaining; ?> Days <?= $hours_remaining; ?> Hours <?= $min; ?> Minute Earlier</div>
                    <?php else : ?>
                        <?php $remaining = $submition['submited_at'] -  $assignment['deadline_at'];
                        $days_remaining = floor($remaining / 86400);
                        $hours_remaining = floor(($remaining % 86400) / 3600);
                        $min = floor(($remaining % 3600) / 60);
                        ?>
                        <div class="alert alert-danger" role="alert"><?= $days_remaining; ?> Days <?= $hours_remaining; ?> Hours <?= $min; ?> Minute Late</div>
                    <?php endif; ?>
                </div>
            </div>
        <?php else : ?>
            <div class="row">
                <div class="col-lg-2">
                </div>
                <div class="col-lg-1">
                    <b> File </b>
                </div>
                <div class="col-lg-1">
                    <center>:</center>
                </div>
                <div class="col-lg-6">
                    <div class="alert alert-primary" role="alert"> Not Submited</div>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-lg-2">
                </div>
                <div class="col-lg-1">
                    <b> Submitted at </b>
                    <?php $remaining = time() - $assignment['deadline_at'];
                    $days_remaining = floor($remaining / 86400);
                    $hours_remaining = floor(($remaining % 86400) / 3600);
                    $min = floor(($remaining % 3600) / 60);
                    ?>
                </div>
                <div class="col-lg-1">
                    <center>:</center>
                </div>
                <div class="col-lg-6">
                    <?php if ($assignment['submited_at'] < $assignment['deadline_at']) : ?>
                        <?php $remaining = $assignment['deadline_at'] - $assignment['submited_at'];
                        $days_remaining = floor($remaining / 86400);
                        $hours_remaining = floor(($remaining % 86400) / 3600);
                        $min = floor(($remaining % 3600) / 60);
                        ?>
                        <div class="alert alert-success" role="alert"><?= $days_remaining; ?> Days <?= $hours_remaining; ?> Hours <?= $min; ?> Minute Earlier</div>
                    <?php else : ?>
                        <?php $remaining = $submition['submited_at'] -  $assignment['deadline_at'];
                        $days_remaining = floor($remaining / 86400);
                        $hours_remaining = floor(($remaining % 86400) / 3600);
                        $min = floor(($remaining % 3600) / 60);
                        ?>
                        <div class="alert alert-danger" role="alert"><?= $days_remaining; ?> Days <?= $hours_remaining; ?> Hours <?= $min; ?> Minute Late</div>
                    <?php endif; ?>
                </div>
            </div>
        <?php endif; ?>
    <?php
    endif; ?>
    <div class="row">
        <div class="col-lg-2">
        </div>
        <div class="col-lg-1"><b> Description</b> </div>
        <div class="col-lg-1">
            <center>:</center>
        </div>
        <div class="col-lg-4"></div>
        <div class="col-lg-2">
            <h6></h6>
        </div>
    </div>
    <div class="row mt-3">
        <br>
        <div class="col-lg-2"></div>
        <div class="col-lg-8">
            <div class="alert alert-default" role="alert">
                <?= $assignment['info']; ?>
            </div>
        </div>
    </div>
    <?php if ($submition < 1) : ?>
        <div class="row mt-3">
            <div class="col-lg-7"></div>
            <div class="col-lg-2"><a href="<?= base_url('assignment/addgroupsubmition/' . $assignment['id']); ?>" class="btn btn-outline-primary"> Add Submittion</a></div>
        </div>
    <?php else : ?>
        <div class="row mt-3">
            <div class="col-lg-7"></div>
            <div class="col-lg-2"><a href="<?= base_url('assignment/editgroupsubmition/' . $assignment['id']); ?>" class="btn btn-outline-primary"> Edit Submittion</a></div>
        </div>
    <?php endif; ?>
</div>