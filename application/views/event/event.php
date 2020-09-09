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

            <?php if (($user['role_id'] == 1) or ($user['role_id'] == 2)) : ?>
                <a href="" class="btn btn-primary mb3" data-toggle="modal" data-target="#newEvent"><i class="fa fa-table" aria-hidden="true"></i> Add New Event</a>
                <h6># Only Admin and Boss who have this privillage</h6>
                <hr class="mb--1">
            <?php else : ?>
                <hr>
            <?php endif; ?>
            <?= $this->session->flashdata('message'); ?>
            <!-- <form action="" class="mt--3">
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                        </div>
                        <input class="form-control datepicker" placeholder="Select date" type="date" value="06/20/2020">
                    </div>
                </div>
            </form> -->
        </div>
    </div>
    <div class="row">
        <div class="col-lg-1"></div>
        <div class="col-lg-8">
            <h2 class="mt-3 mb-2">Today Event !</h2>
        </div>
    </div>
    <div class="row mt-3">
        <?php foreach ($event as $e) : ?>
            <?php if ((time() - $e['date'] > 0) and (time() - $e['date'] < (60 * 60 * 24))) : ?>
                <div class="col-lg-4">
                    <?php if ($e['type'] == 1) : ?>
                        <div class="card text-white bg-danger mb-3" style="max-width: 18rem;">
                        <?php elseif ($e['type'] == 2) : ?>
                            <div class="card text-white bg-primary mb-3" style="max-width: 18rem;">
                            <?php else : ?>
                                <div class="card text-white bg-success mb-3" style="max-width: 18rem;">
                                <?php endif; ?>
                                <div class="card-body">
                                    <h2 class="card-title mb-0"><?= $e['subject']; ?></h2>
                                    <h6> <?= date('d F Y', $e['date']); ?></h6>
                                    <?php $singkat = substr($e['info'], 0, 20); ?>
                                    <p class="card-text"><?= $singkat; ?></p>
                                    <a href="<?= base_url('event/detailevent/' . $e['id']); ?>"><span class="badge badge-light">more</span></a>
                                </div>
                                </div>
                            </div>
                        <?php endif; ?>

                    <?php
                endforeach; ?>
                        </div>
                        <div class="row">
                            <div class="col-lg-1"></div>
                            <div class="col-lg-8">
                                <h2 class="mt-3 mb-2">Upcoming Event !</h2>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <?php foreach ($event as $e) : ?>
                                <?php if ($e['date'] - time() >= 10) : ?>
                                    <div class="col-lg-4">
                                        <?php if ($e['type'] == 1) : ?>
                                            <div class="card text-white bg-danger mb-3" style="max-width: 18rem;">
                                            <?php elseif ($e['type'] == 2) : ?>
                                                <div class="card text-white bg-primary mb-3" style="max-width: 18rem;">
                                                <?php else : ?>
                                                    <div class="card text-white bg-success mb-3" style="max-width: 18rem;">
                                                    <?php endif; ?>
                                                    <div class="card-body">
                                                        <h2 class="card-title mb-0"><?= $e['subject']; ?></h2>
                                                        <h6> <?= date('d F Y', $e['date']); ?></h6>
                                                        <?php $singkat = substr($e['info'], 0, 20); ?>
                                                        <p class="card-text"><?= $singkat; ?></p>
                                                        <a href="<?= base_url('event/detailevent/' . $e['id']); ?>"><span class="badge badge-light">more</span></a>
                                                    </div>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                        <?php
                                    endforeach; ?>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-1"></div>
                                                <div class="col-lg-8">
                                                    <h2 class="mt-3 mb-2">Completed Event !</h2>
                                                </div>
                                            </div>
                                            <div class="row mt-3">
                                                <?php foreach ($event as $e) : ?>
                                                    <?php if ($e['date'] - time() < (-60 * 60 * 24)) : ?>
                                                        <div class="col-lg-4">
                                                            <?php if ($e['type'] == 1) : ?>
                                                                <div class="card text-white bg-danger mb-3" style="max-width: 18rem;">
                                                                <?php elseif ($e['type'] == 2) : ?>
                                                                    <div class="card text-white bg-primary mb-3" style="max-width: 18rem;">
                                                                    <?php else : ?>
                                                                        <div class="card text-white bg-success mb-3" style="max-width: 18rem;">
                                                                        <?php endif; ?>
                                                                        <div class="card-body">
                                                                            <h2 class="card-title mb-0"><?= $e['subject']; ?></h2>
                                                                            <h6> <?= date('d F Y', $e['date']); ?></h6>
                                                                            <?php $singkat = substr($e['info'], 0, 20); ?>
                                                                            <p class="card-text"><?= $singkat; ?></p>
                                                                            <a href="<?= base_url('event/detailevent/' . $e['id']); ?>"><span class="badge badge-light">more</span></a>
                                                                        </div>
                                                                        </div>
                                                                    </div>
                                                                <?php endif; ?>

                                                            <?php
                                                        endforeach; ?>
                                                                </div>
                                                                <!-- /.container-fluid -->

                                                        </div>
                                                        <!-- Modal -->
                                                        <div class="modal fade" id="newEvent" tabindex="-1" role="dialog" aria-labelledby="newEventLabel" aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="newEventLabel">Add New Event</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <form action="<?= base_url('event/event'); ?>" method="post">
                                                                        <div class="modal-body">
                                                                            <div class="col-sm-12">
                                                                                <div class="form-group">
                                                                                    <input type="text" class="form-control" id="subject" name="subject" placeholder="Subject" required>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <textarea name="info" id="info" cols="15" rows="5" class="form-control" placeholder="Information" required></textarea>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <input type="date" class="form-control" id="date" name="date" placeholder="Date" required>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <select name="type" id="type" class="form-control" required>
                                                                                        <option value="1">Danger</option>
                                                                                        <option value="2">Annual Event</option>
                                                                                        <option value="3">Hangout</option>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                            <button type="submit" class="btn btn-primary">add</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>