    <!-- Sidebar -->
    <ul style="background-color: #fb861e;" class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-code"></i>
        </div>
        <div class="sidebar-brand-text mx-2"><b>SMND</b></div>
      </a>

      <!-- Divider -->

      
      <!-- Divider -->
      <hr class="sidebar-divider">
      <!-- query menu -->
      <?php 
      $role_id = $this->session->userdata('role_id');
      $queryMenu = "SELECT `user_menu`.`id`,`menu`
                    FROM `user_menu` JOIN `user_acces_menu`
                    ON `user_menu`.`id` = `user_acces_menu`.`menu_id`
                    WHERE `user_acces_menu`.`role_id` = $role_id
                    ORDER BY `user_acces_menu`.`menu_id` ASC";
      $menu = $this->db->query($queryMenu)->result_array();


       ?>

       <!-- LOOPING MENU -->
      <?php foreach ($menu as $m): ?>
      <div class="sidebar-heading">
          <?= 
            $m['menu'];
           ?>
      </div>

      <!-- SUBMENU -->
      <?php 
      $menuId = $m['id'];
      $querySubMenu= "SELECT *
                      FROM `user_sub_menu` JOIN `user_menu`
                      ON `user_sub_menu`.`menu_id` = `user_menu`.`id`
                      WHERE `user_sub_menu`.`menu_id` = $menuId
                      AND `user_sub_menu`.`is_active` = 1";
       $subMenu = $this->db->query($querySubMenu)->result_array();
       ?>

         <?php foreach ($subMenu as $sm): ?>
          <?php if ($title == $sm['judul']) : ?>
          <li class="nav-item active">
          <?php else : ?>
            <li class="nav-item">
          <?php endif; ?>

              <a class="nav-link" href="<?= base_url($sm['url']); ?>">
              <i class="<?= $sm['icon'];  ?>"></i>
              <span><?= $sm['judul']; ?></span></a>
          </li>    
         <?php endforeach ?>
         <!-- Divider -->
          <hr class="sidebar-divider">
       <?php endforeach; ?>

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->
