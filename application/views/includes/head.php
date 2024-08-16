<meta charset=utf-8>
<meta http-equiv=X-UA-Compatible content="IE=edge">
<meta name=viewport content="width=device-width, initial-scale=1">
<meta name=description content="">
<meta name=author content="">
<title><?php echo $this->session->userdata('title'); ?></title>
<?php
    $this->load->helper('new_helper');
    $result =  faviconFunction();
    ?>
<?php
   foreach($result as $icon){
       ?>
    <link rel="shortcut icon" href="<?php echo base_url().'/assets/logo/'.$icon->f_picture; ?>" type="image/x-icon">
 <?php
   }
 ?>

<link href="<?php echo base_url() . "assets/assets/css/elect.min.css"; ?>" rel=stylesheet type="text/css"/>
<script src="<?php echo base_url() . "assets/assets/plugins/jQuery/jquery-1.12.4.min.js"; ?>"></script>
<script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js"></script>
<script>
    WebFont.load({
        google: {
            families: ['Droid Serif']
        }
    });
</script>
<link href="<?php echo base_url() . "assets/assets/dist/css/base.css"; ?>" rel=stylesheet type="text/css"/>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

<link href="<?php echo base_url() . "assets/assets/plugins/toastr/toastr.min.css"; ?>" rel=stylesheet type="text/css"/>
<link href="<?php echo base_url() . "assets/assets/plugins/emojionearea/emojionearea.min.css"; ?>" rel=stylesheet type="text/css"/>
<link href="<?php echo base_url() . "assets/assets/plugins/monthly/monthly.min.css"; ?>" rel=stylesheet type="text/css"/>
<link href="<?php echo base_url() . "assets/assets/plugins/amcharts/export.css"; ?>" rel=stylesheet type="text/css"/>
<link href="<?php echo base_url() . "assets/assets/dist/css/component_ui.min.css"; ?>" rel=stylesheet type="text/css"/>
<link id=defaultTheme href="<?php echo base_url() . "assets/assets/dist/css/skins/skin-dark-1.min.css"; ?>" rel=stylesheet type="text/css"/>
<link href="<?php echo base_url() . "assets/assets/dist/css/custom.css"; ?>" rel=stylesheet type="text/css"/>

<link href="<?php echo base_url(); ?>assets/assets/plugins/jquery.sumoselect/sumoselect.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url(); ?>assets/assets/plugins/select2/select2.min.css" rel="stylesheet" type="text/css"/>
<?php
    $this->load->helper('new_helper');
    $result =  cssFunction();        
    
    foreach($result as $data){    
      if( $data->values==2){
      ?>
      <link href="<?php echo base_url() . "assets/assets/bootstrap-rtl/bootstrap-rtl.min.css"; ?>" rel=stylesheet type="text/css"/>
      <link href="<?php echo base_url() . "assets/assets/dist/css/component_ui_rtl.min.css"; ?>" rel=stylesheet type="text/css"/>
      <?php
      }
    }       
 ?>
<link href="<?php echo base_url() . "assets/assets/css/jquery.dataTables.min.css"; ?>" rel="stylesheet" type="text/css">
<script src="<?php echo base_url() . "assets/assets/js/vcxtra.min.js"; ?>"></script> 
<style>
    th{
        font-size: 12px;
    }
    .red{
        color:red;
    }
    table{
        border: 1px solid gainsboro;
        background-color: white;
        
    }
</style>
 
<script>
    $(document).ready(function () {
        //jquery.sumoselect
        $('.testselect1').SumoSelect();

        $('.testselect2').SumoSelect();

        $('.optgroup_test').SumoSelect();

        $('.search_test').SumoSelect({
            search: true,
            searchText: 'Enter here.'
        });

        $('.select1').SumoSelect({okCancelInMulti: true, selectAll: true});
        $('.select2').SumoSelect({selectAll: true});

        //select2
        $(".basic-single").select2();
        $(".basic-multiple").select2();
        $(".placeholder-single").select2({
            placeholder: "Select a state",
            allowClear: true
        });

        $(".placeholder-multiple").select2({
            placeholder: "Select a state"
        });

        $(".theme-single").select2();

        $(".language").select2({
            language: "es"
        });

        $(".js-programmatic-enable").on("click", function () {
            $(".js-example-disabled").prop("disabled", false);
            $(".js-example-disabled-multi").prop("disabled", false);
        });

        $(".js-programmatic-disable").on("click", function () {
            $(".js-example-disabled").prop("disabled", true);
            $(".js-example-disabled-multi").prop("disabled", true);
        });
    });
</script>
<script type="text/javascript">
//IMPORT & EXPORT SHOW / HIDE
    $(document).ready(function () {
        $('#import_export').change(function () {
            $(this).find("option:selected").each(function () {
                if ($(this).attr("value") == "1") {
                    $(".box").not(".import").hide();
                    $(".import").show(300);
                }
                else if ($(this).attr("value") == "2") {
                    $(".box").not(".export").hide();
                    $(".export").show(300);
                }
                else {
                    $(".box").show();
                }
            });
        })
    });

    $(document).ready(function () {
        $("#hire_vehicle, #own_vehicle").hide(0);
        //$("#trip_expense_list").hide(0); //hide expense form
        $("#trip_type").change(function () {
            $(this).find("option:selected").each(function () {
                if ($(this).val() == 3 || $(this).val() == 4) {
                    $("#hire_vehicle").slideDown(300); //show hire vehicle 
                    $("#v_id").val('0');  //reset own vehicle value
                    $("#own_vehicle").hide(0); //hide own vehicle
                    //$("#trip_expense_list").hide(0); //hide expense form
                } else if ($(this).val() == 1
                        || $(this).val() == 2
                        || $(this).val() == 5
                        || $(this).val() == 6) {
                    $("#hire_v_id").val(''); //reset hire vehicle value
                    $("#own_vehicle").slideDown(300); //show own vehicle
                    $("#hire_vehicle").hide(0); //hide hire vehicle
                    //$("#trip_expense_list").slideDown(300); //show expense form
                }
            });
        });
    });


//SIDE BAR 
    try {
        ace.settings.check('sidebar', 'fixed')
    } catch (e) {
    }
    try {
        ace.settings.check('sidebar', 'collapsed')
    } catch (e) {
    }


    // setTimeout(function() {
   //     $('#successMessage').fadeOut('slow');
  //   }, 3000);
     
    
</script>
