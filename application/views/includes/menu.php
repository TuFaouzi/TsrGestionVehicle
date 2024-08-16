

<div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <i class="material-icons">apps</i>
    </button>
    <?php
        $this->load->helper('new_helper');
        $result =  yourHelperFunction();        
     ?>
    <a class="navbar-brand" href="<?php echo base_url() . "dashboard"; ?>"> 
        <?php
         foreach($result as $d){
             ?>
               <img class="main-logo" src="<?php echo base_url().'assets/logo/'.$d->d_picture; ?>" id="bg" alt="logo">
         <?php
        }
        ?>
    </a>
</div>
<div class="nav-container">
    <ul class="nav navbar-nav hidden-xs">
        <li><a id="fullscreen" href="#"><i class="material-icons">fullscreen</i> </a></li>
<!--        <li class="hidden-xs"> 
            <a class="search-trigger" href="#">
                <i class="material-icons">search</i>
            </a>
            <div class="fullscreen-search-overlay" id="search-overlay">
                <a href="#" class="fullscreen-close" id="fullscreen-close-button"><i class="ti-close"></i></a>
                <div id="fullscreen-search-wrapper">
                    <form method="get" id="fullscreen-searchform">
                        <input type="text" value="" placeholder="Type keyword(s) here" id="fullscreen-search-input">
                        <i class="ti-search fullscreen-search-icon"><input value="" type="submit"></i>
                    </form>
                </div>
            </div>
        </li>  -->
    </ul>
    <ul class="nav navbar-top-links navbar-right">   
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="material-icons">add_alert</i>
                <div class="notify"> <span class="heartbit"></span> <span class="point"></span> </div>
            </a>
            <ul class="dropdown-menu dropdown-alerts">
                <li class="rad-dropmenu-header"><a style="color:red" href="#"><?php echo display('alertcenter');?></a></li>
                <li class="rad-dropmenu-footer"><a href="<?php echo base_url(); ?>alert_center/index"><?php echo display('seefullalertdetails');?></a></li>
            </ul>
        </li>
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="material-icons">person_add</i>
            </a>
            <ul class="dropdown-menu dropdown-user">   
                <li>
                    <?php
                    echo "&nbsp;&nbsp;&nbsp;";
                    echo "<i class='ti-user'></i>&nbsp;";
                    echo $this->session->userdata('fullname');
                    echo "<strong class=\"text-danger\">";
                    if ($this->session->userdata('user_type') == 9)
                        echo display('admin');
                    else
                        echo display('operator');;
                    echo "</strong>";
                    ?>
                </li>
                <?php if ($this->session->userdata('user_type') == 9) {
                    ?>
                    <li><a href="<?php echo base_url(); ?>admin/app_setting"><i class="hvr-buzz-out fa fa-gear"></i>&nbsp; <?php echo display('appsetting');?></a></li>
                    <li><a href="<?php echo base_url(); ?>admin/user_add"><i class="hvr-buzz-out fa fa-user-o"></i>&nbsp; <?php echo display('adduser') ?></a></li>
                    <?php
                }
                ?>
                <li><a href="<?php echo base_url(); ?>admin/user_view"><i class="hvr-buzz-out fa fa-user-circle"></i>&nbsp; <?php echo display('viewuser'); ?></a></li>  
                <li><a href="<?php echo base_url(); ?>admin/user_edit"><i class="hvr-buzz-out fa fa-user-circle"></i>&nbsp; <?php echo display('editprofile'); ?></a></li>
                <li><a href="<?php echo base_url(); ?>admin/logout"> <i class="glyphicon glyphicon-off"></i>&nbsp; <?php echo display('logout'); ?></a></li>
            </ul>
        </li>
        <li class="log_out">
            <a href="<?php echo base_url(); ?>admin/logout">
                <i class="material-icons">power_settings_new</i>
            </a>
        </li>
    </ul>
</div>
<script>
    $(document).ready(function(){
         var bdtask="bdtask";
         $("#goog-logo-link").html(bdtask);
    });
  
  
</script>