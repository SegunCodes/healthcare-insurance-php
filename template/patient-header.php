
<div class="nav-header">
    <a href="patient-dashboard.php" class="brand-logo">
        <img class="logo-abbr" src="./images/logo.png" alt="">
        <img class="logo-compact" src="./images/logo-text.png" alt="">
        <img class="brand-title" src="./images/logo-text.png" alt="">
    </a>

    <div class="nav-control">
        <div class="hamburger">
            <span class="line"></span><span class="line"></span><span class="line"></span>
        </div>
    </div>
</div>
<div class="chatbox">
    <div class="chatbox-close"></div>
    <div class="custom-tab-1">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#notes">Notes</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#alerts">Alerts</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#chat">Chat</a>
            </li>
        </ul>

    </div>
</div>
<div class="header">
    <div class="header-content">
        <nav class="navbar navbar-expand">
            <div class="collapse navbar-collapse justify-content-between">
                <div class="header-left">
                    <div class="dashboard_bar">
                       Patient Dashboard
                    </div>
                </div>
                <ul class="navbar-nav header-right">
                    <li class="nav-item">
                        <div class="input-group search-area d-xl-inline-flex d-none">
                            <div class="input-group-append">
                                <span class="input-group-text"><a href="javascript:void(0)"><i class="flaticon-381-search-2"></i></a></span>
                            </div>
                            <input type="text" class="form-control" placeholder="Search here...">
                        </div>
                    </li>
                    <li class="nav-item dropdown header-profile">
                    <?php 
                        include('includes/db.php');// require database connection file
                        $sql = mysqli_query($con,"SELECT * FROM patient WHERE email = '{$_SESSION["SESSION_EMAIL"]}'");//query patient session by email
                        while ($row=mysqli_fetch_array($sql)) {
                            ?>
                        <a class="nav-link" href="javascript:void(0)" role="button" data-toggle="dropdown">
                            <!-- <img src="images/profile/17.jpg" width="20" alt=""/> -->
                            <div class="header-info">
                                <span class="text-black"><strong><?php echo $row["fname"]. ' '; echo $row["lname"] //display patient full name?></strong></span>
                            </div>
                        </a>
                        <?php
                        }
                        ?>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a href="patient-profile.php" class="dropdown-item ai-icon">
                                <svg id="icon-user1" xmlns="http://www.w3.org/2000/svg" class="text-primary" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                                <span class="ml-2">Profile </span>
                            </a>
                            <a onclick="return confirm('Are you sure you want to Log Out?')" href="logout.php" class="dropdown-item ai-icon">
                                <svg id="icon-logout" xmlns="http://www.w3.org/2000/svg" class="text-danger" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
                                <span class="ml-2">Logout </span>
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</div>