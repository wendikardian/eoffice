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


<div class="container mt-5">
    <?= $this->session->flashdata('message'); ?>
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
            <div class="alert alert-primary" role="alert"><img src="<?= base_url('assets/img/group/' . $group['image']); ?>" alt="" class="avatar rounded-circle"> <a href="<?= base_url("dashboard/accessgroup/" . $assignment['group_id']); ?>"><?= $group['title']; ?></a></div>
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
</div>

<div class="row mt-3">
    <div class="col-lg-4">
    </div>
    <div class="col-lg-4">
        <h2 class="mt-3 mb-4">Member Submition</h2>
    </div>
    <div class="col-lg-12">
        <div class="table-responsive">
            <div>
                <table class="table align-items-center table-dark">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col" class="sort" data-sort="name">No</th>
                            <th scope="col" class="sort" data-sort="budget"></th>
                            <th scope="col" class="sort" data-sort="status">Name</th>
                            <th scope="col" class="sort" data-sort="status">File</th>
                            <th scope="col" class="sort" data-sort="status">Submited At</th>

                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php $a = 1;
                            foreach ($member as $m) :
                            ?>
                                <td><?= $a; ?></td>
                                <td><img src="<?= base_url('assets/img/profile/' . $m['image']); ?>" alt="" class="avatar rounded-circle"></td>
                                <td><a href="<?= base_url('profile/viewprofile/' . $m['id']); ?>"><?= $m['name']; ?></a></td>
                                <?php
                                $member_id = $m['id'];
                                $query = "SELECT * from `assignment_group_member` where assignment_id = $id and user_id = $member_id";
                                $work = $this->db->query($query)->row_array();
                                ?>
                                <?php if ($work > 1) : ?>
                                    <td><a href="<?= base_url('assets/assignment/' . $work['file']); ?>" class="badge badge-pill badge-primary" download><i class="fa fa-file"></i> <?= $work['file']; ?> </a></td>
                                    <?php if ($work['submited_at'] < $assignment['deadline_at']) : ?>
                                        <?php $remaining = $assignment['deadline_at'] - $work['submited_at'];
                                        $days_remaining = floor($remaining / 86400);
                                        $hours_remaining = floor(($remaining % 86400) / 3600);
                                        $min = floor(($remaining % 3600) / 60);
                                        ?>
                                        <td>
                                            <div class="badge badge-pill badge-success" role="alert"><?= $days_remaining; ?> Days <?= $hours_remaining; ?> Hours <?= $min; ?> Minute Earlier</div>
                                        </td>
                                    <?php else : ?>
                                        <?php $remaining = $assignment['submited_at'] -  $work['deadline_at'];
                                        $days_remaining = floor($remaining / 86400);
                                        $hours_remaining = floor(($remaining % 86400) / 3600);
                                        $min = floor(($remaining % 3600) / 60);
                                        ?>
                                        <td>
                                            <div class="badge badge-pill badge-danger" role="alert"><?= $days_remaining; ?> Days <?= $hours_remaining; ?> Hours <?= $min; ?> Minute Late</div>
                                        </td>
                                    <?php endif; ?>
                                <?php else : ?>
                                    <td>-</td>
                                    <td>-</td>
                                <?php endif; ?>

                        </tr>
                    <?php
                                $a++;
                            endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>



<div class="row mt-3">
    <div class="col-lg-7"></div>
    <div class="col-lg-1"><a href="<?= base_url('bos/editgroupassignment/' . $assignment['id']); ?>" class="btn btn-outline-primary"> Edit</a></div>
    <div class="col-lg-1"><a href="<?= base_url('bos/deletegroupassignment/' . $assignment['id']); ?>" class="btn btn-outline-danger" onclick="return confirm('Are You Sure ?');"> Delete</a></div>
</div>