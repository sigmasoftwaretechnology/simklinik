	<aside class="main-sidebar sidebar-dark-primary elevation-4">
	    <!-- Sidebar -->
	    <div class="sidebar">
	        <!-- Sidebar user (optional) -->
	        		<?php 
						$session = session();
					?>
	        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
	            <div class="image">
	                <img src="<?php echo base_url('assets/img/profil.png');?>" class="img-circle elevation-2" alt="User Image">
	            </div>
	            <div class="info">
	                <a href="#" class="d-block"><?php echo ucwords(strtolower($session->get('nama_user')))?></a>
	            </div>
	        </div>

	        <!-- Sidebar Menu -->
	        <nav class="mt-2">
	            <ul class="nav nav-pills nav-sidebar flex-column nav-flat" data-widget="treeview" role="menu"
	                data-accordion="false">
	                <!-- Add icons to the links using the .nav-icon class
							 with font-awesome or any other icon font library -->
	                <li class="nav-item">
	                    <a href="<?php echo base_url();?>" class="nav-link">
	                        <i class="nav-icon fas fa-tachometer-alt"></i>
	                        <p>
	                            Dashboard
	                        </p>
	                    </a>
	                </li>
	                <li class="nav-item">
	                    <a href="<?php echo base_url();?>/farmasi" class="nav-link">
	                        <i class="nav-icon fas fa-th"></i></i>
	                        <p>
	                            Farmasi
	                        </p>
	                    </a>
	                </li>
					<li class="nav-item">
	                    <a href="<?php echo base_url();?>/keuangan" class="nav-link">
	                        <i class="nav-icon fas fa-th"></i></i>
	                        <p>
	                            Keuangan
	                        </p>
	                    </a>
	                </li>
					<li class="nav-item">
	                    <a href="<?php echo base_url();?>/setting" class="nav-link">
	                        <i class="nav-icon fas fa-th"></i></i>
	                        <p>
	                            Setting
	                        </p>
	                    </a>
	                </li>
	            </ul>
	        </nav>
	        <!-- /.sidebar-menu -->
	    </div>
	    <!-- /.sidebar -->
	</aside>