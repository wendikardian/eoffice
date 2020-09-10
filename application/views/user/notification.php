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
            <h2>Notification</h2>
            <div class="table-responsive">
                <table class="table align-items-center table-light">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col" class="sort" data-sort="budget"></th>
                            <th scope="col" class="sort" data-sort="status">Name</th>
                            <th scope="col" class="sort" data-sort="status">Date</th>
                            <th scope="col" class="sort" data-sort="status">Description</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $a = 1;
                        foreach ($notif as $n) : ?>
                            <tr>
                                <td><img src="<?= base_url('assets/img/profile/' . $n['image']); ?>" alt="" class="avatar rounded-circle"></td>
                                <td><a href="<?= base_url('profile/viewprofile/' . $n['user_id']); ?>"><?= $n['name']; ?></a></td>
                                <td><?= date('d F Y H:i:s', $n['date']); ?></td>
                                <td><a href="<?= base_url($n['url']); ?>"><?= $n['desc']; ?></a></td>
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