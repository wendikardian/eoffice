<div class="header pb-2 d-flex align-items-center" style="min-height: 300px; background-image: url(<?= base_url('assets/img/group/' . $group['image']); ?>); background-size: cover; background-position: center;">
    <!-- Mask -->
    <span class="mask bg-gradient-default opacity-8"></span>
    <!-- Header container -->
    <div class="container-fluid d-flex align-items-center">
        <div class="row">
            <div class="col-lg-12 col-md-10">
                <h4 class="display-2 text-white"> <?= $group['title']; ?> Time Line</h4>
            </div>
        </div>
    </div>
</div>
<!-- Page content -->

<div class="container mt-3">
    <?= $this->session->flashdata('message'); ?>
    <div class="row">
        <div class="col-lg-12 mb-3">
            <a href="<?= base_url('group/assignment/' . $group['id']); ?>" class="btn btn-success mb3">
                <span class="btn-inner--icon"><i class="fa fa-edit"></i></span>
                <span class="btn-inner--text"> Assignment</span></a>
            <a href="<?= base_url('group/accessgroup/' . $group['id']); ?>" class="btn btn-primary mb3">
                <span class="btn-inner--icon"><i class="fa fa-user"></i></span>
                <span class="btn-inner--text"> Member</span></a>
        </div>
        <h2>Post Something here !</h2>
        <div class="col-lg-10">
            <?php echo form_open_multipart('group/timeline/' . $group['id']); ?>
            <textarea name="caption" id="caption" cols="110" rows="2" class="form-control" placeholder="Caption" required></textarea>
            <label for="" class="form-control-label mt-2">Image (Optional)</label>
            <input type="file" name="image" id="image" class="form-control" placeholder="Image (Optional)">
        </div>
        <div class="col-lg-2">
            <button type="submit" class="btn btn-primary"> <i class="fa fa-share-square"></i></button>
        </div>
        </form>
    </div>
    <div class="container mt-5">
        <?php foreach ($timeline as $a) : ?>
            <div class="row">
                <div class="col-lg-12">
                    <div class="media align-items-center">
                        <span class="avatar avatar-sm rounded-circle">
                            <?php
                            $creator = $this->db->get_where('user', [
                                'id' => $a['created_by']
                            ])->row_array();
                            ?>
                            <img alt="Image placeholder" src="<?= base_url('assets/img/profile/' . $creator['image']); ?>">
                        </span>
                        <div class="media-body  ml-2  d-lg-block">
                            <a href="<?= base_url('profile/viewprofile/' . $a['created_by']); ?>"><span class="mb-0 text-sm  font-weight-bold"><?= $creator['name']; ?></span></a>
                        </div>
                        <h6><?= date('d F Y H:i:s', $a['date']); ?></h6>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="alert alert-default mt-4 mb-4" role="alert">
                        <?= $a['caption']; ?><br>
                        <?php
                        if ($a['image'] == NULL) :
                        ?>
                        <?php else : ?>
                            <center><img src="<?= base_url('assets/img/announcement/' . $a['image']); ?>" class="mt-3"></center>
                        <?php endif; ?>

                        <div class="col-lg-2"></div>
                        <?php
                        $tid = $a['id'];
                        $query = "SELECT COUNT(`id`) as id from `timeline_comment` where `tid` = $tid";
                        $total = $this->db->query($query)->row_array();
                        ?>
                        <div class="col-lg-8">
                            <a href="<?= base_url('group/timeline_comment/' . $a['id']); ?>" class="btn btn-warning mt-5"> <?= $total['id']; ?> Comment</a>
                            <?php
                            if ($a['created_by'] == $user['id']) : ?>
                                <a href="<?= base_url('group/timeline_edit/' . $a['id']); ?>" class="btn btn-primary mt-5">Edit</a>
                                <a href="<?= base_url('group/timeline_delete/' . $a['id']); ?>" class="btn btn-danger mt-5" onclick="return confirm('Are You Sure ?');">Delete</a>
                            <?php else : ?>
                            <?php endif; ?>
                        </div>
                    </div><br>
                </div>
            </div>
        <?php endforeach; ?>
    </div>