<div class="container">
    <div class="row">
        <div class="col-lg-12 mt-4">
            <?php echo form_open_multipart('assignment/addgroupsubmition_process/' . $id); ?>
            <h2 class="mb-5">Add Submition for Group Assignment</h2>
            <?= $this->session->flashdata('message'); ?>
            <div class="form-group">
                <label for="">File (If you need some document)</label>
                <input type="file" class="form-control" id="file" name="file" placeholder="File">
                <?= form_error('file', '<small class="text-danger pl-3">', '</small>'); ?>
            </div>
        </div>
        <div class="col-lg-2">
            <button class="btn btn-primary" type="submit">Submit</button>
        </div>
        </form>
    </div>
</div>