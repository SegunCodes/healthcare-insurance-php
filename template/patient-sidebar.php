<div class="deznav">
    <div class="deznav-scroll">
        <ul class="metismenu" id="menu">
            <li><a class="" href="patient-dashboard.php" aria-expanded="false">
                <i class="flaticon-381-networking"></i>
                    <span class="nav-text">Dashboard</span>
                </a>
            </li>
            <li><a href="patient-profile.php" aria-expanded="false">
                <i class="flaticon-381-user"></i>
                    <span class="nav-text">Profile</span>
                </a>
            </li>
            <?php
            $sql = mysqli_query($con,"SELECT * FROM users WHERE email = '{$_SESSION["SESSION_EMAIL"]}'");
            while ($row=mysqli_fetch_array($sql)) {
                $info = $row['info'];
                ?>
                <?php
                    if ($info == "1") {
                        echo '
                        <li>
                            <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                                <i class="flaticon-381-news"></i>
                                <span class="nav-text">Message Admin</span>
                            </a>
                            <ul aria-expanded="false">
                                <li><a href="patient-message.php">Send New Message</a></li>
                                <li><a href="patient-view-message.php">View Messages</a></li>
                            </ul>
                        </li>
                        <li><a href="allocated-hospital.php" aria-expanded="false">
                            <i class="flaticon-381-user"></i>
                                <span class="nav-text">Hospital Allocated</span>
                            </a>
                            
                        </li>
                        
                        ';
                    }
                ?>
            <?php
                }           
            ?>
            <li>
                <a class="" href="patient-account.php" aria-expanded="false">
                    <i class="flaticon-381-settings-2"></i>
                    <span class="nav-text">Account Settings</span>
                </a>
            </li>
            <li><a class="" onclick="return confirm('Are you sure you want to Log Out?')" href="logout.php" aria-expanded="false">
                <i class="flaticon-381-back"></i>
                    <span class="nav-text">Logout</span>
                </a>
                
            </li>
        </ul>
    </div>
</div>