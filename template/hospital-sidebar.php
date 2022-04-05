<!--**********************************
    Sidebar start
***********************************-->
<div class="deznav">
    <div class="deznav-scroll">
        <ul class="metismenu" id="menu">
            <li><a class="" href="hospital-dashboard.php" aria-expanded="false">
                <i class="flaticon-381-networking"></i>
                    <span class="nav-text">Dashboard</span>
                </a>
            </li>
            <li><a href="hospital-profile.php" aria-expanded="false">
                <i class="flaticon-381-user"></i>
                    <span class="nav-text">Profile</span>
                </a>
                
            </li>
            <?php
            $sql = mysqli_query($con,"SELECT * FROM users WHERE email = '{$_SESSION["SESSION_EMAIL1"]}'");
            while ($row=mysqli_fetch_array($sql)) {
                $info = $row['info'];
                ?>
                <?php
                    if ($info == "1") {
                        echo '
                        <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                                <i class="flaticon-381-news"></i>
                                <span class="nav-text">Message Admin</span>
                            </a>
                            <ul aria-expanded="false">
                                <li><a href="hospital-message.php">Send New Message</a></li>
                                <li><a href="hospital-view-message.php">View Messages</a></li>
                            </ul>
                        </li>
                        <li><a href="patients-info.php" aria-expanded="false">
                            <i class="flaticon-381-user"></i>
                                <span class="nav-text">Patients/Enrolees</span>
                            </a>
                            
                        </li>
                        <li><a href="records.php" aria-expanded="false">
                            <i class="flaticon-381-user"></i>
                                <span class="nav-text">Hospital Records</span>
                            </a>
                            
                        </li>
                        ';
                    }
                ?>

            <?php
            }           
            ?>
            <li>
                <a class="" href="hospital-account.php" aria-expanded="false">
                <i class="flaticon-381-settings-2"></i>
                    <span class="nav-text">Account Settings</span>
                </a>
            </li>
            <li>
                <a onclick="return confirm('Are you sure you want to Log Out?')" class="" href="logout.php" aria-expanded="false">
                <i class="flaticon-381-back"></i>
                    <span class="nav-text">Logout</span>
                </a>
                
            </li>
        </ul>
    </div>
</div>
<!--**********************************
    Sidebar end
***********************************-->