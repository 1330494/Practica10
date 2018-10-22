<!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-danger elevation-4">
    <!-- Brand Logo -->
    <a href="index.php" class="brand-link bg-danger">
      <img src="dist/img/School.png" alt="TutorSys" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Sistema de Tutorias</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="dist/img/escudo.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Modo: Admin</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview menu-open">

            <a href="#" class="nav-link active text-light">
              <i class="nav-icon fa fa-th"></i>
              <p>
                Menu
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>

            <ul class="nav nav-treeview">

              <li class="nav-item">
                <a href="index.php?action=usuarios" class="nav-link">
                  <i class="nav-icon fa fa-users text-white"></i>
                  <p>Usuarios</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="index.php?action=alumnos" class="nav-link">
                  <i class="nav-icon fa fa-graduation-cap text-secondary"></i>
                  <p>Alumnos</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="index.php?action=maestros" class="nav-link">
                  <i class="nav-icon fa fa-group text-primary"></i>
                  <p>Maestros</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="index.php?action=carreras" class="nav-link">
                  <i class="nav-icon fa fa-institution text-success"></i>
                  <p>Carreras</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="index.php?action=categorias" class="nav-link">
                  <i class="nav-icon fa fa-tags text-warning"></i>
                  <p>Categorias</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="index.php?action=tutorias-admin" class="nav-link">
                  <i class="nav-icon fa fa-id-badge text-info"></i>
                  <p>Tutorias</p>
                </a>
              </li>

            </ul>

          </li>

          <li class="nav-item">
            <a href="index.php?action=salir" class="nav-link">
              <i class="nav-icon fa fa-circle-o text-danger"></i>
              <p class="text">Salir</p>
            </a>
          </li>
                    
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>