<div class="container">
    <div class="row">
        <div class="col-lg-12 mt-4">
            <form action="<?= base_url('bos/addpoint_profile/' . $id); ?>" method="post">
                <h2 class="mb-5">Add/Subtrack Point</h2>
                <?= $this->session->flashdata('message'); ?>

                <div class="form-group">
                    <label for="">Employee Email </label>
                    <?php
                    $profile = $this->db->get_where('user', [
                        'id' => $id
                    ])->row_array();
                    $profile_email = $profile['email'];
                    ?>
                    <input type="text" class="form-control" value="<?= $profile_email; ?>" id="email" name="email" placeholder="Employee Email" readonly>
                    <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
                <div class="form-group">
                    <label class="form-control-label" for="input-username">Point</label>
                    <select name="point" id="point" class="form-control" required>
                        <option value="-50">-50</option>
                        <option value="-100">-100</option>
                        <option value="-200">-200</option>
                        <option value="-500">-500</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                        <option value="200">200</option>
                        <option value="500">500</option>
                    </select>
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