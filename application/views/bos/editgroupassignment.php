<div class="container">
    <div class="row">
        <div class="col-lg-12 mt-4">
            <form action="<?= base_url('bos/editgroupassignment/' . $id); ?>" method="post">
                <h2 class="mb-5">Edit Group Work/Assignment</h2>
                <?= $this->session->flashdata('message'); ?>
                <div class=" form-group">
                    <label for="">Title</label>
                    <input type="text" class="form-control" id="title" name="title" placeholder="Assingment Title" value="<?= $assignment['title']; ?>" required>
                    <?= form_error('title', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
                <div class="form-group">
                    <?php
                    $deadline = $assignment['deadline_at'];
                    $sisa = $deadline % (24 * 60 * 60);
                    $day = $deadline - $sisa;
                    ?>
                    <label for="">Deadline Date</label>
                    <input type="date" class="form-control" id="date" name="date" placeholder="Assingment TItle" value="<?= date('Y-m-d', $day); ?>" required>
                    <?= form_error('date', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
                <div class="form-group">
                    <label for="">Deadline Time (Set AM and PM)</label>
                    <input type="time" class="form-control" id="time" name="time" placeholder="Assingment Title" value="<?= date('h:i', $sisa); ?>">
                    <?= form_error('time', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
                <div class="form-group">
                    <style>
                        #desc {
                            height: 100px;
                        }
                    </style>
                    <label for="">Description</label>
                    <input type="text" class="form-control" id="desc" name="desc" placeholder="Descripiton" value="<?= $assignment['info']; ?>" required>
                    <?= form_error('desc', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>

        </div>
        <div class="col-lg-2">
            <button class="btn btn-primary" type="submit">Edit</button>
        </div>
        </form>
    </div>
</div>