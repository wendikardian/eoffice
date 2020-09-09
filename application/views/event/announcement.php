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
    <?= $this->session->flashdata('message'); ?>
    <div class="row">

        <?php if (($user['role_id'] == 1) or ($user['role_id'] == 2)) : ?>
            <h2>Create announcement !</h2>
            <div class="col-lg-10">
                <?php echo form_open_multipart('event/announcement'); ?>
                <textarea name="caption" id="caption" cols="110" rows="2" class="form-control" placeholder="Caption" required></textarea>
                <label for="" class="form-control-label mt-2">Image (Optional)</label>
                <input type="file" name="image" id="image" class="form-control" placeholder="Image (Optional)" required>
            </div>
            <div class="col-lg-2">
                <button type="submit" class="btn btn-primary"> <i class="fa fa-share-square"></i></button>
            </div>
            </form>
        <?php else : ?>
        <?php endif; ?>

    </div>
    <div class="container mt-5">
        <?php foreach ($announcement as $a) : ?>
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
                        <div class="media-body  ml-2  d-none d-lg-block">
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
                        $aid = $a['id'];
                        $query = "SELECT COUNT(`id`) as id from `comment` where `aid` = $aid";
                        $total = $this->db->query($query)->row_array();
                        ?>
                        <div class="col-lg-8">
                            <a href="<?= base_url('event/comment/' . $a['id']); ?>" class="btn btn-warning mt-5"> <?= $total['id']; ?> Comment</a>
                            <?php
                            if ($a['created_by'] == $user['id']) : ?>
                                <a href="<?= base_url('event/a_edit/' . $a['id']); ?>" class="btn btn-primary mt-5">Edit</a>
                                <a href="<?= base_url('event/a_delete/' . $a['id']); ?>" class="btn btn-danger mt-5" onclick="return confirm('Are You Sure ?');">Delete</a>
                            <?php else : ?>
                            <?php endif; ?>
                        </div>
                    </div><br>
                </div>
            </div>
        <?php endforeach; ?>
    </div>