  <div class="main-content" id="panel">
      <!-- Topnav -->
      <nav class="navbar navbar-top navbar-expand navbar-dark bg-primary border-bottom">
          <div class="container-fluid">
              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                  <!-- Search form -->

                  <!-- Navbar links -->
                  <ul class="navbar-nav align-items-center  ml-md-auto ">
                      <li class="nav-item d-xl-none">
                          <!-- Sidenav toggler -->
                          <div class="pr-3 sidenav-toggler sidenav-toggler-dark" data-action="sidenav-pin" data-target="#sidenav-main">
                              <div class="sidenav-toggler-inner">
                                  <i class="sidenav-toggler-line"></i>
                                  <i class="sidenav-toggler-line"></i>
                                  <i class="sidenav-toggler-line"></i>
                              </div>
                          </div>
                      </li>
                      <li class="nav-item d-sm-none">
                      </li>
                      <li class="nav-item dropdown">
                          <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <?php
                                $user_id = $user['id'];
                                $cek = "SELECT COUNT(id) as id from notification where recepient_id = $user_id AND is_read = 0";
                                $jumlah = $this->db->query($cek)->row_array();
                                ?>
                              <?php
                                if ($jumlah['id'] > 0) : ?>
                                  <i class="ni ni-bell-55"><?= $jumlah['id']; ?></i>
                              <?php else : ?>
                                  <i class="ni ni-bell-55"></i>
                              <?php endif; ?>
                          </a>
                          <div class="dropdown-menu dropdown-menu-xl  dropdown-menu-right  py-0 overflow-hidden">
                              <!-- Dropdown header -->
                              <div class="px-3 py-3">
                                  <h6 class="text-sm text-muted m-0"><strong class="text-primary">Notifications</strong> </h6>
                              </div>
                              <?php
                                $user_id = $user['id'];
                                $query = "SELECT user.image as image, user.name as name, notification.id as id,notification.desc, notification.date,url, is_read from notification JOIN user on user.id = notification.sender_id WHERE recepient_id = $user_id ORDER BY notification.id desc LIMIT 5";
                                $notif = $this->db->query($query)->result_array();
                                ?>
                              <?php
                                foreach ($notif as $n) :
                                ?>
                                  <div class="list-group list-group-flush">
                                      <a href="<?= base_url('profile/cek_notif/' . $n['id']); ?>" class="list-group-item list-group-item-action">
                                          <div class="row align-items-center">
                                              <div class="col-auto">
                                                  <!-- Avatar -->
                                                  <img alt="Image placeholder" src="<?= base_url('assets/img/profile/' . $n['image']); ?>" class="avatar rounded-circle">
                                              </div>
                                              <div class="col ml--2">
                                                  <div class="d-flex justify-content-between align-items-center">
                                                      <div>
                                                          <h4 class="mb-0 text-sm"><?= $n['name']; ?></h4>
                                                      </div>
                                                      <div class="text-right text-muted">
                                                          <small><?= date('d F Y H:i:s', $n['date']); ?></small>
                                                      </div>
                                                  </div>
                                                  <?php
                                                    if ($n['is_read'] == 0) : ?>
                                                      <b><?= $n['desc']; ?></b>
                                                  <?php else : ?>
                                                      <p class="text-sm mb-0"><?= $n['desc']; ?></p>
                                                  <?php endif; ?>
                                              </div>
                                          </div>
                                      </a>
                                  </div>
                              <?php endforeach; ?>
                              <!-- View all -->
                              <a href="<?= base_url('profile/notification/' . $user['id']); ?>" class="dropdown-item text-center text-primary font-weight-bold py-3">View all</a>
                          </div>
                      </li>
                  </ul>
                  <ul class="navbar-nav align-items-center  ml-auto ml-md-0 ">
                      <li class="nav-item dropdown">
                          <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <div class="media align-items-center">
                                  <span class="avatar avatar-sm rounded-circle">
                                      <img alt="Image placeholder" src="<?= base_url('assets/img/profile/' . $user['image']); ?>">
                                  </span>
                                  <div class="media-body  ml-2  d-none d-lg-block">
                                      <span class="mb-0 text-sm  font-weight-bold"><?= $user['name']; ?></span>
                                  </div>
                              </div>
                          </a>
                          <div class="dropdown-menu  dropdown-menu-right ">
                              <div class="dropdown-header noti-title">
                                  <h6 class="text-overflow m-0">Welcome!</h6>
                              </div>
                              <a href="<?= base_url('profile/profile'); ?>" class="dropdown-item">
                                  <i class="ni ni-single-02"></i>
                                  <span>My profile</span>
                              </a>
                              <a href="<?= base_url("mailbox/inbox"); ?>" class="dropdown-item">
                                  <i class="ni ni-email-83"></i>
                                  <span>Mail</span>
                              </a>
                              <a href="<?= base_url('assignment/assignment'); ?>" class="dropdown-item">
                                  <i class="ni ni-single-copy-04"></i>
                                  <span>Assignment</span>
                              </a>
                              <a href="<?= base_url('group/mygroup'); ?>" class="dropdown-item">
                                  <i class="ni ni-app"></i>
                                  <span>My Group</span>
                              </a>
                              <div class="dropdown-divider"></div>
                              <a href="<?= base_url('auth/logout'); ?>" class="dropdown-item">
                                  <i class="ni ni-user-run"></i>
                                  <span>Logout</span>
                              </a>
                          </div>
                      </li>
                  </ul>
              </div>
          </div>
      </nav>