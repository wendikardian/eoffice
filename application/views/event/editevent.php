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

<div class="container-fluid mt-2">
    <div class="row">
        <div class="col-xl-8 order-xl-1">
            <div class="card">
                <div class="card-header">
                    <?php echo form_open_multipart('event/edit/' . $event['id']); ?>
                    <div class="row align-items-center">

                    </div>
                </div>
                <div class="card-body">
                    <div class="pl-lg-4">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-username">Subject</label>
                                    <input type="text" id="subject" name="subject" class="form-control" value="<?= $event['subject']; ?>" required>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-username">Information</label>
                                    <input type="text" id="info" name="info" class="form-control" value="<?= $event['info'] ?>" required>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-username">Date</label>
                                    <input type="date" id="date" name="date" class="form-control" value="<?= $event['date']; ?>" required>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <?php
                                if ($event['type'] == 1) {
                                    $selected_1 = 'selected';
                                    $selected_2 = '';
                                    $selected_3 = '';
                                } elseif ($event['type'] == 2) {
                                    $selected_2 = 'selected';
                                    $selected_1 = '';
                                    $selected_3 = '';
                                } elseif ($event['type'] == 3) {
                                    $selected_3 = 'selected';
                                    $selected_1 = '';
                                    $selected_2 = '';
                                }
                                ?>
                                <div class="form-group">
                                    <label class="form-control-label" for="input-username">Type</label>
                                    <select name="type" id="type" class="form-control" required>
                                        <option value="1" <?= $selected_1; ?>>Danger</option>
                                        <option value="2" <?= $selected_2; ?>>Annual Event</option>
                                        <option value="3" <?= $selected_3; ?>>Hangout</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="col-12 text-right">
                                    <button class="btn btn-sm btn-primary" type="submit"> Edit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>