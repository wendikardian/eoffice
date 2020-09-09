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
    <div class="row">
        <div class="col-lg-12">
            <h2>Rank <a href="<?= base_url('bos/rankpoint_month'); ?>" class="badge badge-success">This month</a></h2>
            <div class="table-responsive">
                <table class="table align-items-center table-light">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col" class="sort" data-sort="name">No</th>
                            <th scope="col" class="sort" data-sort="budget"></th>
                            <th scope="col" class="sort" data-sort="status">Name</th>
                            <th scope="col" class="sort" data-sort="status">Point</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $a = 1;
                        foreach ($plus as $p) : ?>
                            <tr>
                                <td><?= $a; ?></td>
                                <?php
                                $recepient = $this->db->get_where('user', [
                                    'id' => $p['recepient_id']
                                ])->row_array();
                                ?>
                                <td><img src="<?= base_url('assets/img/profile/' . $recepient['image']); ?>" alt="" class="avatar rounded-circle"></td>
                                <td><a href="<?= base_url('profile/viewprofile/' . $recepient['id']); ?>"><?= $recepient['name']; ?></a></td>
                                <td><?= $p['point']; ?></td>
                            </tr>
                        <?php
                            $a++;
                        endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>