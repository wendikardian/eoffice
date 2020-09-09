<body>
    <!-- Sidenav -->
    <nav class="sidenav navbar navbar-vertical  fixed-left  navbar-expand-xs navbar-light bg-white" id="sidenav-main">
        <div class="scrollbar-inner">
            <!-- Brand -->
            <div class="sidenav-header  align-items-center">
                <a class="navbar-brand" href="javascript:void(0)">
                    <img src="<?= base_url('assets/'); ?>/img/icon.jpg" class="navbar-brand-img" alt="...">
                </a>
            </div>
            <div class="navbar-inner">
                <!-- Collapse -->
                <div class="collapse navbar-collapse" id="sidenav-collapse-main">
                    <!-- Nav items -->
                    <ul class="navbar-nav mt-0">
                        <?php
                        $rele_id = $this->session->userdata('role_id');
                        $queryMenu = "SELECT `user_menu`.`id`, `menu`, `icon`
                      FROM `user_menu` JOIN `user_access_menu` 
                       ON `user_menu`.`id` = `user_access_menu`.`menu_id`
                    WHERE `user_access_menu`.`role_id` = $rele_id
                    ORDER BY `user_access_menu`.`menu_id` ASC";

                        $menu = $this->db->query($queryMenu)->result_array();
                        foreach ($menu as $m) :
                        ?>
                            <li class="nav-item mt--3">
                                <a class="nav-link active mb--2">
                                    <i class="<?= $m['icon']; ?>"></i>
                                    <b><span class="nav-link-text">
                                            <?= $m['menu']; ?>
                                        </span></b>
                                    <?php
                                    $menuId = $m['id'];
                                    $querysubmenu = "SELECT * FROM `user_sub_menu` WHERE `menu_id`= $menuId AND `is_active` = 1";
                                    $submenu = $this->db->query($querysubmenu)->result_array();
                                    foreach ($submenu as $sm) :
                                    ?>
                                        <a class="nav-link active pt-0">
                                            <a href="<?= base_url($sm['url']); ?>"><span class="nav-link-text ml-4"><?= $sm['title']; ?></a>
                                        </a>
                                    <?php endforeach; ?>

                                </a>
                            </li>
                            <hr class="my-3 pt-0">
                        <?php endforeach; ?>
                </div>
            </div>
        </div>
    </nav>