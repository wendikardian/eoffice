  <div class="breadcome-area">
      <div class="container-fluid">
          <div class="row">
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
                  <div class="breadcome-list">
                      <div class="row">
                          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 ">


                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
  <div class="container">
      <div class="row">
          <div class="col-lg-12">
              <h1><?= $title; ?></h1>
              <hr>
          </div>
      </div>
  </div>
  <?php
    $role = $this->db->get('user_role')->result_array();
    ?>
  <div class="row">
      <div class="col-lg-6">

          <?= form_error('menu', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
          <?= $this->session->flashdata('message'); ?>
          <a href="" class="btn btn-primary mb3" data-toggle="modal" data-target="#newRoleModal"> Add New Role</a>
          <hr>
          <table class="table table-hover">
              <thead>
                  <tr>
                      <th scope="col">No</th>
                      <th scope="col"> Role </th>
                      <th scope="col"> Action </th>

                  </tr>
              </thead>
              <tbody>
                  <?php
                    $a = 1;
                    ?>
                  <?php
                    foreach ($role as $r) :
                    ?>
                      <tr>

                          <th scope="row"><?= $a; ?> </th>
                          <td><?= $r['role']; ?></td>
                          <td>
                              <a href="<?= base_url('admin/roleaccess/') . $r['id']; ?>" <button class="btn btn-warning"> Access</button></a>
                              <a href="<?= base_url('admin/roleaccess/') . $r['id']; ?>" <button class="btn btn-success"> Edit</button></a>
                              <a href="<?= base_url('admin/roleaccess/') . $r['id']; ?>" <button class="btn btn-danger"> Delete</button></a>

                          </td>
                      </tr>
                      <?php $a++; ?>
                  <?php endforeach; ?>
              </tbody>
          </table>
      </div>

  </div>