<div class="container">
    <div class="row">
        <div class="col-lg-12 mt-4">
            <?php echo form_open_multipart('assignment/editgroupsubmition_process/' . $id); ?>
            <h2 class="mb-5">Edit Submition For Group Assignment</h2>
            <?= $this->session->flashdata('message'); ?>
            <?php if ($assignment['file'] != NULL) : ?>
                <div class="col-lg-12">
                    Last submition : <a href="<?= base_url('assets/assignment/' . $assignment['file']); ?>" class="badge badge-pill badge-primary" download><i class="fa fa-file"></i> <?= $assignment['file']; ?> </a>
                    <div class="form-group">
                    </div>
                <?php else : ?>
                <?php endif; ?>
                <label for="">File (If you need some document)</label>
                <input type="file" class="form-control" id="file" name="file" placeholder="File">
                <?= form_error('file', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
        </div>
        <div class="col-lg-10 mt-2"></div>
        <div class="col-lg-2">
            <button class="btn btn-primary mt-3 " type="submit">Submit</button>
        </div>
        </form>
    </div>
</div>