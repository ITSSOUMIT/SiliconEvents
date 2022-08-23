<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="dashboard" class="brand-link">
        <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light"><?php echo $_SESSION['username']; ?></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                with font-awesome or any other icon font library -->
                <li class="nav-header">DEPARTMENT</li>
                <li class="nav-item">
                    <a href="newEvent" class="nav-link" id="sideNewEvent">
                        <i class="nav-icon fas fa-calendar-plus"></i>
                        <p>
                            Events Calendar
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="addReport" class="nav-link" id="sideAddReport">
                        <i class="nav-icon fas fa-plus"></i>
                        <p>
                            Add Report
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="reports" class="nav-link" id="sideReport">
                        <i class="nav-icon fas fa-file-alt"></i>
                        <p>
                            My Reports
                        </p>
                    </a>
                </li>
                <?php if((isSuperAdmin()==12) || (isSuperAdmin()==1)){ ?>
                <li class="nav-header">ADMIN</li>
                <li class="nav-item">
                    <a href="searchReports" class="nav-link" id="sideSearchReport">
                        <i class="nav-icon fas fa-search"></i>
                        <p>
                            Search Reports
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="allReports" class="nav-link" id="sideAllReport">
                        <i class="nav-icon fas fa-file-alt"></i>
                        <p>
                            Submitted Reports
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="reportSharing" class="nav-link" id="sideReportShare">
                        <i class="nav-icon fas fa-share"></i>
                        <p>
                            Report Sharing
                        </p>
                    </a>
                </li>
                <?php } ?>
                <?php if(isSuperAdmin()==12){ ?>
                <li class="nav-header">MANAGEMENT</li>
                <li class="nav-item">
                    <a href="userManagement" class="nav-link" id="sideUserManagement">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            Users
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="departmentManagement" class="nav-link" id="sideDepartment">
                        <i class="nav-icon fas fa-briefcase"></i>
                        <p>
                            Departments
                        </p>
                    </a>
                </li>
                <li class="nav-header">SERVER</li>
                <li class="nav-item">
                    <a href="filemgr" class="nav-link" id="sideServer" target="_blank">
                        <i class="nav-icon fas fa-server"></i>
                        <p>
                            File Management
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="phpmyadmin" class="nav-link" id="sideDatabase" target="_blank">
                        <i class="nav-icon fas fa-database"></i>
                        <p>
                            Database Management
                        </p>
                    </a>
                </li>
                <?php } ?>
                <li class="nav-header">ACCOUNT</li>
                <!-- <li class="nav-item">
                    <a href="seatMatrix" class="nav-link" id="sideSeatMatrix">
                        <i class="nav-icon fas fa-chair"></i>
                        <p>
                            Seat Matrix
                        </p>
                    </a>
                </li> -->
                <li class="nav-item">
                    <a href="changePassword" class="nav-link" id="sideChangePassword">
                        <i class="nav-icon fas fa-key"></i>
                        <p>
                            Change Password
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="logout" class="nav-link">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>
                            Logout
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>