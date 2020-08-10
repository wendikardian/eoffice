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
    <div class="row">

        <div class="col-lg-2">
        </div>
        <div class="col-lg-1">
            To
        </div>
        <div class="col-lg-1">
            <center>:</center>
        </div>
        <div class="col-lg-6">
            <?php echo form_open_multipart('mailbox/writter'); ?>
            <input type="email" class="form-control" id="recepient" name="recepient" placeholder="name@example.com" required>
        </div>
    </div>
    <div class="row mt-2">

        <div class="col-lg-2">
        </div>
        <div class="col-lg-1">
            Subject
        </div>
        <div class="col-lg-1">
            <center>:</center>
        </div>
        <div class="col-lg-6">
            <input type="text" class="form-control" id="subject" name="subject" placeholder="" required>
        </div>
    </div>
    <div class="row mt-2">

        <div class="col-lg-2">
        </div>
        <div class="col-lg-8">
            <textarea class="form-control" id="message" name="message" rows="5" placeholder="Message"></textarea>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-lg-2">
        </div>
        <div class="col-lg-2">
            Attachment (optional)</div>
        <div class="col-sm-6">
            <div class="custom-file">
                <input type="file" class="custom-file-input" id="file" name="file">
                <label class="custom-file-label" for="">File</label>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-lg-2">
        </div>
        <div class="col-lg-8">
            <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="customRadioInline1" name="status" class="custom-control-input" value="1" checked>
                <label class="custom-control-label" for="customRadioInline1">Send</label>
            </div>
            <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="customRadioInline2" name="status" class="custom-control-input" value="2">
                <label class="custom-control-label" for="customRadioInline2">Save as Draft</label>
            </div>
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-lg-9">
        </div>
        <div class="col-lg-2">
            <button class="btn btn-primary" type="submit"><i class="ni ni-send"></i></button>
        </div>
    </div>
    </form>
</div>