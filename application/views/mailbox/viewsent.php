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
            <b> To</b>
        </div>
        <div class="col-lg-1">
            <center>:</center>
        </div>
        <?php
        $recepient = $this->db->get_where('user', [
            'id' => $mail['recepient_id']
        ])->row_array();
        ?>
        <div class="col-lg-6">
            <?= $recepient['email']; ?>
        </div>
    </div>
    <div class="row mt-3">

        <div class="col-lg-2">
        </div>
        <div class="col-lg-1">
            <b> Subject</b>
        </div>
        <div class="col-lg-1">
            <center>:</center>
        </div>
        <div class="col-lg-6">
            <?= $mail['subject']; ?>
        </div>
    </div>
    <div class="row mt-3">

        <div class="col-lg-2">
        </div>
        <div class="col-lg-1"><b> Message</b> </div>
        <div class="col-lg-1">
            <center>:</center>
        </div>
        <div class="col-lg-4"></div>
        <div class="col-lg-2">
            <h6><?= date('d F Y H:i:s', $mail['created_at']); ?></h6>
        </div>
    </div>
    <div class="row mt-4">
        <br>
        <div class="col-lg-2"></div>
        <div class="col-lg-8">
            <div class="alert alert-default" role="alert">
                <?= $mail['message']; ?>
            </div>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-lg-2"></div>
        <div class="col-lg-8">
            <?php
            if ($mail['file'] == NULL) :
            ?>
            <?php else : ?>
                <a href="<?= base_url('assets/file_mail/' . $mail['file']); ?>" class="badge badge-pill badge-primary" download><i class="fa fa-file"></i> <?= $mail['file']; ?> </a>
            <?php endif; ?>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-lg-8">
        </div>
        <div class="col-lg-1">
        </div>
        <div class="col-lg-1">
            <a href="<?= base_url('mailbox/trash_sender/' . $mail['id']); ?>" class="btn btn-danger" onclick="return confirm('Are you Sure?');"><i class="fa fa-trash"></i></a>
        </div>
    </div>
    </form>
</div>