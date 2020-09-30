<div class="container mt-5">
    <div class="row">
        <div class="col-lg-12">
            <div class="media align-items-center">
                <span class="avatar avatar-sm rounded-circle">
                    <?php
                    $creator = $this->db->get_where('user', [
                        'id' => $timeline['created_by']
                    ])->row_array();
                    ?>
                    <img alt="Image placeholder" src="<?= base_url('assets/img/profile/' . $creator['image']); ?>">
                </span>
                <div class="media-body  ml-2 d-lg-block">
                    <a href="<?= base_url('profile/viewprofile/' . $timeline['created_by']); ?>"><span class="mb-0 text-sm  font-weight-bold"><?= $creator['name']; ?></span></a>
                </div>
                <h6><?= date('d F Y H:i:s', $timeline['date']); ?></h6>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="alert alert-default mt-4 mb-2" role="alert">
                <?= $timeline['caption']; ?><br>
                <?php
                if ($timeline['image'] == NULL) :
                ?>
                <?php else : ?>
                    <center><img src="<?= base_url('assets/img/announcement/' . $timeline['image']); ?>" class="mt-3"></center>
                <?php endif; ?>
            </div>
            <div class="alert alert-light mt-2 mb-4" role="alert">
                <form action="<?= base_url('group/timeline_comment/' . $id); ?>" method="post">
                    <div class="row">
                        <div class="col-lg-12">
                            <?= $this->session->flashdata('message'); ?></div>
                        <div class="col-lg-11 mt-1">

                            <input type="text" class="form-control" name="comment" id="comment" placeholder="Comment" required>
                        </div>
                        <div class="col-lg-1 mt-1">
                            <button class="btn btn-primary" type="submit"> <i class="fa fa-paper-plane"></i></button>
                        </div>
                </form>
            </div>
            <?php foreach ($comment as $c) : ?>
                <div class="row">
                    <div class="container">
                        <div class="col-lg-12">
                            <div class="media align-items-center mt-2">
                                <span class="avatar avatar-sm rounded-circle">
                                    <?php
                                    $commenter = $this->db->get_where('user', [
                                        'id' => $c['uid']
                                    ])->row_array();
                                    ?>
                                    <img alt="Image placeholder" src="<?= base_url('assets/img/profile/' . $commenter['image']); ?>">
                                </span>
                                <div class="media-body  ml-2  d-none d-lg-block">
                                    <a href="<?= base_url('profile/viewprofile/' . $commenter['id']); ?>"><span class="mb-0 text-sm  font-weight-bold"><?= $commenter['name']; ?></span></a>
                                </div>
                                <h6><?= date('d F Y H:i:s', $c['date']); ?></h6>
                            </div>
                            <div class="alert alert-info" role="alert">
                                <?= $c['comment']; ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>