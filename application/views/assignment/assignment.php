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
        <div class="col-lg-12 mb-3 mt-3">
            <h2> On Process as assignment</h2>
        </div>
        <?php
        foreach ($assignment_process as $a) :
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
                                    <a href="<?= base_url('assignment/accesssinglework/' . $a['id']); ?>">
                                        <div class="icon icon-shape bg-gradient-green text-white rounded-circle shadow">
                                            <i class="ni ni-book-bookmark"></i>
                                    </a>
                                <?php else :
                                ?>
                                    <a href="<?= base_url('assignment/accesssinglework/' . $a['id']); ?>">
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

<div class="col-lg-12 mb-3">
    <h2> Completed assignment</h2>
</div>
<?php
foreach ($assignment_done as $a) :
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
                        if ($a['deadline_at'] > $a['submited_at']) :
                        ?>
                            <a href="<?= base_url('assignment/accesssinglework/' . $a['id']); ?>">
                                <div class="icon icon-shape bg-gradient-green text-white rounded-circle shadow">
                                    <i class="ni ni-book-bookmark"></i>
                            </a>
                        <?php else :
                        ?>
                            <a href="<?= base_url('assignment/accesssinglework/' . $a['id']); ?>">
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
</div>
</div>