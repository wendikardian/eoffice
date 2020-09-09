<div class="container">
    <div class="row">
        <div class="col-lg-12 mt-4">
            <form action="<?= base_url('bos/addsinglework'); ?>" method="post">
                <h2 class="mb-5">Add Single Work/Assignment</h2>
                <?= $this->session->flashdata('message'); ?>

                <div class="form-group">
                    <label for="">Employee Email</label>
                    <input type="text" class="form-control" id="email" name="email" placeholder="Employee Email" required>
                    <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>

                </div>
                <div class="form-group">
                    <label for="">Title</label>
                    <input type="text" class="form-control" id="title" name="title" placeholder="Assingment TItle" required>
                    <?= form_error('title', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
                <div class="form-group">
                    <label for="">Deadline Date</label>
                    <input type="date" class="form-control" id="date" name="date" placeholder="Assingment TItle" required>
                    <?= form_error('date', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
                <div class="form-group">
                    <label for="">Deadline Time</label>
                    <input type="time" class="form-control" id="time" name="time" placeholder="Assingment Title">
                    <?= form_error('time', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
                <div class="form-group">
                    <style>
                        #desc {
                            height: 100px;
                        }
                    </style>
                    <label for="">Description</label>
                    <input type="text" class="form-control" id="desc" name="desc" placeholder="Descripiton" required>
                    <?= form_error('desc', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>

        </div>
        <div class="col-lg-2">
            <button class="btn btn-primary" type="submit">Submit</button>
        </div>
        </form>
    </div>
</div>