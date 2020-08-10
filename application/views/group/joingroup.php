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
        <div class="col-lg-2">
        </div>
        <div class="col-lg-8 mt-3">
            <h3>Confirm the password for Joining the Group</h3>
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-lg-1">
        </div>
        <div class="col-lg-6">
            <form action="<?= base_url('group/join/' . $group_id); ?>" method="post">
                <div class="form-group">
                    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" id="password" name="password" required>
                </div>
        </div>
        <div class="col-lg-2 mt-0">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
        </form>

    </div>

</div>
</div>

</div>
<!-- /.container-fluid -->

</div>