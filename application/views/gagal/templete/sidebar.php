<body>
    <!--[if lt IE 8]>
		<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
	<![endif]-->
    <!-- Start Left menu area -->
    <div class="left-sidebar-pro">
        <nav id="sidebar" class="">
            <div class="sidebar-header">
                <a href="index.html"><img class="main-logo" src="<?= base_url('assets/admin/'); ?>img/logo.jpg" alt="" /></a>
                <strong><a href="index.html"><img src="<?= base_url('assets/admin/'); ?>img/logo.jpg" alt="" /></a></strong>
            </div>
            <div class="left-custom-menu-adp-wrap comment-scrollbar">
                <nav class="sidebar-nav left-sidebar-menu-pro">
                    <ul class="metismenu" id="menu1">
                        <li>
                            <?php
                            $menu = $this->db->get('user_menu')->result_array();
                            foreach ($menu as $m) :
                            ?>
                                <a class="has-arrow" href="mailbox.html" aria-expanded="false">
                                    <i class="<?= $m['icon']; ?>"></i>
                                    <span class="mini-click-non"><?= $m['menu']; ?></span></a>
                                <ul class="" aria-expanded="false">
                                    <?php
                                    $menuId = $m['id'];
                                    $querysubmenu = "SELECT * FROM `user_sub_menu` WHERE `menu_id`= $menuId AND `is_active` = 1";
                                    $submenu = $this->db->query($querysubmenu)->result_array();
                                    foreach ($submenu as $sm) :
                                    ?>
                                        <li><a href="<?= base_url($sm['url']); ?>"><span> <?= $sm['title']; ?></span></a></li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php endforeach; ?>
                        </li>
                    </ul>
                </nav>
            </div>
        </nav>
    </div>