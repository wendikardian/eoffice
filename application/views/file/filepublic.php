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
    <div class="row">
        <div class="col-lg-12">

            <?php if (validation_errors()) : ?>
                <div class="alert alert-danger" role="alert">
                    <?= validation_errors() ?>
                </div>
            <?php endif; ?>
            <?= $this->session->flashdata('message'); ?>
            <a href="" class="btn btn-primary mb3" data-toggle="modal" data-target="#newSubMenuModal"><i class="fa fa-folder" aria-hidden="true"> </i> Add New Folder</a>
            <hr>
            <form action="<?= base_url('file/publicfile'); ?>" class="mt-3" method="post">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Search Folder Keyword .." aria-label="Search  Keyword .." aria-describedby="button-addon2" name="keyword" autocomplete="off" autofocus>
                    <div class="input-group-append">
                        <input class="btn btn-primary" type="submit" name="submit" placeholder="search">
                    </div>
                </div>
            </form>
            <h5>Result : <?= $total_rows; ?></h5>
            <h5>Searching for : <?= $keyword; ?></h5>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col"></th>
                        <th scope="col"> Title </th>
                        <th scope="col"> Created by </th>
                        <th scope="col"> Created At </th>
                        <th scope="col"> </th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    $a = 1;
                    ?>
                    <?php
                    foreach ($folder as $f) :
                    ?>
                        <tr>

                            <th scope="row"><?= ++$from; ?></th>
                            <td><a href="<?= base_url('file/fileaccess/') . $f['id']; ?>"><i class="fa fa-folder" aria-hidden="true"></i></a></td>
                            <td><a href="<?= base_url('file/fileaccess/') . $f['id']; ?>"><?= $f['title']; ?></a></td>
                            <?php
                            $owner = $this->db->get_where('user', [
                                'id' => $f['owner_id']
                            ])->row_array();
                            ?>
                            <td><a href="<?= base_url('profile/viewprofile/' . $f['owner_id']); ?>"><?= $owner['name']; ?></a></td>
                            <td><?= date('d F Y', $f['date']); ?></td>
                            <?php if ($user['id'] == $f['owner_id']) : ?>
                                <td>
                                    <a href="<?= base_url('file/edit_folderpublic/' . $f['id']); ?>" class="badge badge-pill badge-success"> Edit </a>
                                    <a href="<?= base_url('file/delete_folderpublic/' . $f['id']); ?>" class="badge badge-pill badge-danger" onclick="return confirm('Are You Sure ?');"> Delete </a>
                                </td>
                            <?php else : ?>
                                <td></td>
                            <?php endif; ?>
                        </tr>
                        <?php $a++; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?php
            echo $this->pagination->create_links();
            ?>
        </div>

    </div>
</div>

</div>
<!-- /.container-fluid -->

</div>
<!-- Modal -->
<div class="modal fade" id="newSubMenuModal" tabindex="-1" role="dialog" aria-labelledby="newSubMenuModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newSubMenuModalLabel">Add New Folder</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('File/add_folderpublic'); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="title" name="title" placeholder="Folder title">
                        <?= form_error('title', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">add</button>
                </div>
            </form>
        </div>
    </div>
</div>