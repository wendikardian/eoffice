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


<div class="container mt-2">
    <div class="row">
        <div class="col-lg-12">

            <?php if (validation_errors()) : ?>
                <div class="alert alert-danger" role="alert">
                    <?= validation_errors() ?>
                </div>
            <?php endif; ?>
            <?= $this->session->flashdata('message'); ?>
            <hr class="mt-2">
            <div class="table-responsive">
                <div>
                    <table class="table align-items-center table-dark">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col" class="sort" data-sort="name">No</th>
                                <th scope="col" class="sort" data-sort="budget"></th>
                                <th scope="col" class="sort" data-sort="status">To</th>
                                <th scope="col">Subject</th>
                                <th scope="col" class="sort" data-sort="completion">Date</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody class="list">
                            <?php
                            $a = 1;
                            ?>
                            <?php
                            foreach ($mail as $m) :
                            ?>
                                <tr>
                                    <td> <?= $a; ?> </td>
                                    <td><i class="fa fa-check"></i></td>
                                    <?php
                                    $recepient = $this->db->get_where('user', [
                                        'id' => $m['recepient_id']
                                    ])->row_array();
                                    ?>
                                    <td> <a href="<?= base_url('mailbox/viewsent/' . $m['id']); ?>"> <?= $recepient['email']; ?> </a></td>
                                    <td> <?= $m['subject']; ?> </td>
                                    <td> <?= date('d F Y', $m['created_at']); ?> </td>

                                    <?php
                                    if ($m['file'] == NULL) :
                                    ?>
                                        <td>-
                                        </td>
                                    <?php else : ?>
                                        <td><i class="fa fa-file"></i>
                                        </td>
                                    <?php endif; ?>
                                </tr>
                                <?php $a++; ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

            </div>