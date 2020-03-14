<?php 
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    if(!isset($_SESSION['is_admin_login'])){
        header("Location: login.php");
    }

    require_once("config.php");
    $query = "SELECT fullname, email, profile_pic FROM admin WHERE enc_username='$_SESSION[admin_username]'";
    $result = $con -> query($query);
    if ($result -> num_rows > 0) {
        $user = $result->fetch_assoc();
    }
?>

<script>
    if (typeof(Storage) !== "undefined") {
        var theme = localStorage.getItem("selected_theme");

        if (theme) {
            let body = document.getElementsByTagName("body")[0];
            body.className = theme;
        }
    };
</script>

<!--Start sidebar-wrapper-->
<div id="sidebar-wrapper" data-simplebar="" data-simplebar-auto-hide="true">
    <div class="user-details">
        <div class="media align-items-center user-pointer collapsed" data-toggle="collapse" data-target="#user-dropdown">
            <div class="avatar">
                <img class="mr-3 side-user-img" src="<?php echo $user['profile_pic']; ?>" alt="user avatar">
            </div>
            <div class="media-body">
                <h6 class="side-user-name"><?php echo $user['fullname']; ?></h6>
            </div>
        </div>
        <div id="user-dropdown" class="collapse">
            <ul class="user-setting-menu">
                <li><a href="javaScript:void();"><i class="icon-user"></i>  My Profile</a></li>
                <li><a href="javaScript:void();"><i class="icon-settings"></i> Setting</a></li>
                <li><a href="include/logout.php"><i class="icon-power"></i> Logout</a></li>
            </ul>
        </div>
    </div>

    <ul class="sidebar-menu">
        <li class="sidebar-header">MAIN NAVIGATION</li>
        <li>
            <a href="index.php" class="waves-effect"><i class="zmdi zmdi-view-dashboard"></i> <span>Dashboard</span></a>
        </li>
        <li>
            <a href="global_setting.php" class="waves-effect"><i class="zmdi zmdi-globe"></i> <span>Global Setting</span></a>
        </li>
        <li>
            <a href="intro.php" class="waves-effect"><i class="fa fa-info"></i> <span>Introduction</span></a>
        </li>
        <li>
            <a href="about_me.php" class="waves-effect"><i class="icon-user"></i> <span>About Me</span></a>
        </li>
        <li>
            <a href="my_skill.php" class="waves-effect"><i class="fa fa-cogs"></i> <span>My Skills</span></a>
        </li>
        <li>
            <a href="services.php" class="waves-effect"><i class="icon-globe"></i> <span>Services</span></a>
        </li>
        <li>
            <a href="experience.php" class="waves-effect"><i class="fa fa-history"></i> <span>Experience</span></a>
        </li>
        <li>
            <a href="portfolio.php" class="waves-effect"><i class="fa fa-briefcase"></i> <span>Portfolio</span></a>
        </li>
        <li>
            <a href="testimonial.php" class="waves-effect"><i class="fa fa-quote-left"></i> <span>Testimonial</span></a>
        </li>
        <li>
            <a href="clients.php" class="waves-effect"><i class="fa fa-users"></i> <span>Clients</span></a>
        </li>
        <li>
            <a href="contacts.php" class="waves-effect"><i class="fa fa-envelope"></i> <span>Contact</span></a>
        </li>
        <li>
            <a href="social_links.php" class="waves-effect"><i class="fa fa-twitter"></i> <span>Social Media</span></a>
        </li>

        <li class="sidebar-header">LABELS</li>

        <li>
            <a href="javaScript:void();" class="waves-effect"><i class="zmdi zmdi-coffee text-danger"></i> <span>Important</span></a>
        </li>
        <li>
            <a href="javaScript:void();" class="waves-effect"><i class="zmdi zmdi-chart-donut text-success"></i> <span>Warning</span></a>
        </li>
        <li>
            <a href="javaScript:void();" class="waves-effect"><i class="zmdi zmdi-share text-info"></i> <span>Information</span></a>
        </li>
    </ul>
</div>
<!--End sidebar-wrapper-->