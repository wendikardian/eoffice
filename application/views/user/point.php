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
            <h2>History</h2>
            <div class="table-responsive">
                <table class="table align-items-center table-dark">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col" class="sort" data-sort="name">No</th>
                            <th scope="col" class="sort" data-sort="status">Point</th>
                            <th scope="col" class="sort" data-sort="status">Date</th>
                            <th scope="col" class="sort" data-sort="status">Description</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $a = 1;
                        foreach ($plus as $p) : ?>
                            <tr>
                                <td><?= $a; ?></td>
                                <td><?= $p['point']; ?></td>
                                <td><?= $p['date']; ?></td>
                                <td><?= $p['desc']; ?></td>
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