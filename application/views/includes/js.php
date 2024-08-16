
<!--<script src="<?php // echo base_url() . "assets/assets/plugins/jQuery/jquery-1.12.4.min.js";  ?>"></script>-->
<script src="<?php echo base_url() . "assets/assets/plugins/jquery-ui-1.12.1/jquery-ui.min.js"; ?>"></script>
<script src="<?php echo base_url() . "assets/assets/bootstrap/js/bootstrap.min.js"; ?>"></script>
<script src="<?php echo base_url() . "assets/assets/plugins/metisMenu/metisMenu.min.js"; ?>"></script>
<script src="<?php echo base_url() . "assets/assets/plugins/lobipanel/lobipanel.min.js"; ?>"></script>
<script src="<?php echo base_url() . "assets/assets/plugins/animsition/js/animsition.min.js"; ?>"></script>
<script src="<?php echo base_url() . "assets/assets/plugins/fastclick/fastclick.min.js"; ?>"></script>
<script src="<?php echo base_url() . "assets/assets/plugins/slimScroll/jquery.slimscroll.min.js"; ?>"></script>
<script src="<?php echo base_url() . "assets/assets/plugins/toastr/toastr.min.js"; ?>"></script>
<script src="<?php echo base_url() . "assets/assets/plugins/sparkline/sparkline.min.js"; ?>"></script>
<script src="<?php echo base_url() . "assets/assets/plugins/counterup/jquery.counterup.min.js"; ?>"></script>
<script src="<?php echo base_url() . "assets/assets/plugins/counterup/waypoints.js"; ?>"></script>

<script src="<?php echo base_url(); ?>assets/assets/plugins/jquery.sumoselect/jquery.sumoselect.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/assets/plugins/select2/select2.min.js" type="text/javascript"></script>

<script src="<?php echo base_url() . "assets/assets/plugins/datatables/dataTables.min.js"; ?>" type="text/javascript"></script>
<script src="<?php echo base_url() . "assets/assets/plugins/emojionearea/emojionearea.min.js"; ?>"></script>

<script src="<?php echo base_url() . "assets/assets/plugins/monthly/monthly.min.js"; ?>"></script>
<script src="<?php echo base_url() . "assets/assets/plugins/amcharts/amcharts.js"; ?>"></script>
<script src="<?php echo base_url() . "assets/assets/plugins/amcharts/ammap.js"; ?>"></script>

<script src="<?php echo base_url() . "assets/assets/plugins/amcharts/worldLow.js"; ?>"></script>
<script src="<?php echo base_url() . "assets/assets/plugins/amcharts/serial.js"; ?>"></script>
<script src="<?php echo base_url() . "assets/assets/plugins/amcharts/export.min.js"; ?>"></script>
<script src="<?php echo base_url() . "assets/assets/plugins/amcharts/light.js"; ?>"></script>
<script src="<?php echo base_url() . "assets/assets/plugins/amcharts/pie.js"; ?>"></script>



<script src="<?php echo base_url() . "assets/assets/dist/js/app.min.js"; ?>"></script>
<script src="<?php echo base_url() . "assets/assets/dist/js/page/dashboard.min.js"; ?>"></script>
<script src="<?php echo base_url() . "assets/assets/dist/js/jQuery.style.switcher.min.js"; ?>"></script>

<script src="<?php echo base_url() . "assets/assets/plugins/chartJs/Chart.min.js"; ?>" type="text/javascript"></script>
<script src="<?php echo base_url() . "assets/assets/dist/js/app.min.js"; ?>" type="text/javascript"></script>
<script src="<?php echo base_url() . "assets/assets/dist/js/jQuery.style.switcher.min.js"; ?>" type="text/javascript"></script>
<!--old-->
<script src="<?php echo base_url() . "assets/assets/js/elementsfull.min.js"; ?>"></script>
<script src="<?php echo base_url() . "assets/assets/js/tasking.min.js"; ?>"></script>
<!--old-->
<script>
    $(document).ready(function () {

        "use strict"; // Start of use strict

        $('#dataTableExample1').DataTable({
            "dom": "<'row'<'col-sm-6'l><'col-sm-6'f>>t<'row'<'col-sm-6'i><'col-sm-6'p>>",
            "lengthMenu": [[6, 25, 50, -1], [6, 25, 50, "All"]],
            "iDisplayLength": 6
        });

        $("#dataTableExample2").DataTable({
            dom: "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>tp",
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            buttons: [
                {extend: 'copy', className: 'btn-sm'},
                {extend: 'csv', title: 'ExampleFile', className: 'btn-sm'},
                {extend: 'excel', title: 'ExampleFile', className: 'btn-sm'},
                {extend: 'pdf', title: 'ExampleFile', className: 'btn-sm'},
                {extend: 'print', className: 'btn-sm'}
            ]
        });

    });
</script>
<script type="text/javascript">
//    $(document).ready(function () {
//        $('table.DataTable').dataTable({
//            paging: true,
//            searching: true,
//            "lengthMenu": [[15, 50, 100, -1], [15, 50, 100, "All"]],
//        });
//    });
    jQuery(function ($) {
        $('#sample-table-2').dataTable({
            paging: true,
            searching: true,
            "lengthMenu": [[20, 50, 100, -1], [20, 50, 100, "All"]],
        });
        $('.easy-pie-chart.percentage').each(function () {
            var $box = $(this).closest('.infobox');
            var barColor = $(this).data('color') || (!$box.hasClass('infobox-dark') ? $box.css('color') : 'rgba(255,255,255,0.95)');
            var trackColor = barColor == 'rgba(255,255,255,0.95)' ? 'rgba(255,255,255,0.25)' : '#E2E2E2';
            var size = parseInt($(this).data('size')) || 50;
            $(this).easyPieChart({
                barColor: barColor,
                trackColor: trackColor,
                scaleColor: false,
                lineCap: 'butt',
                lineWidth: parseInt(size / 10),
                animate: /msie\s*(8|7|6)/.test(navigator.userAgent.toLowerCase()) ? false : 1000,
                size: size
            });
        })
        $('.sparkline').each(function () {
            var $box = $(this).closest('.infobox');
            var barColor = !$box.hasClass('infobox-dark') ? $box.css('color') : '#FFF';
            $(this).sparkline('html',
                    {
                        tagValuesAttribute: 'data-values',
                        type: 'bar',
                        barColor: barColor,
                        chartRangeMin: $(this).data('min') || 0
                    });
        });

        var placeholder = $('#piechart-placeholder').css({'width': '90%', 'min-height': '150px'});
        var data = [
            {label: "social networks", data: 38.7, color: "#68BC31"},
            {label: "search engines", data: 24.5, color: "#2091CF"},
            {label: "ad campaigns", data: 8.2, color: "#AF4E96"},
            {label: "direct traffic", data: 18.6, color: "#DA5430"},
            {label: "other", data: 10, color: "#FEE074"}
        ]
        function drawPieChart(placeholder, data, position) {
            $.plot(placeholder, data, {
                series: {
                    pie: {
                        show: true,
                        tilt: 0.8,
                        highlight: {
                            opacity: 0.25
                        },
                        stroke: {
                            color: '#fff',
                            width: 2
                        },
                        startAngle: 2
                    }
                },
                legend: {
                    show: true,
                    position: position || "ne",
                    labelBoxBorderColor: null,
                    margin: [-30, 15]
                }
                ,
                grid: {
                    hoverable: true,
                    clickable: true
                }
            })
        }
        // drawPieChart(placeholder, data);
        $('.dialogs,.comments').ace_scroll({
            size: 300
        });
        //Android's default browser somehow is confused when tapping on label which will lead to dragging the task
        //so disable dragging when clicking on label
        var agent = navigator.userAgent.toLowerCase();
        if ("ontouchstart" in document && /applewebkit/.test(agent) && /android/.test(agent))
            $('#tasks').on('touchstart', function (e) {
                var li = $(e.target).closest('#tasks li');
                if (li.length == 0)
                    return;
                var label = li.find('label.inline').get(0);
                if (label == e.target || $.contains(label, e.target))
                    e.stopImmediatePropagation();
            });

        $('#tasks').sortable({
            opacity: 0.8,
            revert: true,
            forceHelperSize: true,
            placeholder: 'draggable-placeholder',
            forcePlaceholderSize: true,
            tolerance: 'pointer',
            stop: function (event, ui) {
                //just for Chrome!!!! so that dropdowns on items don't appear below other items after being moved
                $(ui.item).css('z-index', 'auto');
            }
        }
        );
        $('#tasks').disableSelection();
        $('#tasks input:checkbox').removeAttr('checked').on('click', function () {
            if (this.checked)
                $(this).closest('li').addClass('selected');
            else
                $(this).closest('li').removeClass('selected');
        });


        //show the dropdowns on top or bottom depending on window height and menu position
        $('#task-tab .dropdown-hover').on('mouseenter', function (e) {
            var offset = $(this).offset();

            var $w = $(window)
            if (offset.top > $w.scrollTop() + $w.innerHeight() - 100)
                $(this).addClass('dropup');
            else
                $(this).removeClass('dropup');
        });


    });


    //------------------ date picker --------------------------
    $(function () {
        $(".datepicker").datepicker({dateFormat: 'dd-mm-yy'});
    });


    // print particular part 
    function printContent(el) {
        var restorepage = document.body.innerHTML;
        var printcontent = document.getElementById(el).innerHTML;
        document.body.innerHTML = printcontent;
        var x = window.print();
        document.body.innerHTML = restorepage;
        if (!x) {
            window.location = '<?php echo current_url() ?>';
        }
        location.reload();
    }

    $("#gaiframe, #pf-pdf-form").hide();//hide pdf advertise

    $(document).ready(function () {
        //CALCULATE TOTAL COST
        $('body').on('keyup', '.amount_edit', function () {
            var s = $(this).attr('id').split('_');
            var price = $("#amount_" + s[1]).val();
            var qty = $("#quantity_" + s[1]).val();
            $("#total_" + s[1]).html((qty * price).toFixed(2));
        });
        // ENDS OF CALCULATE TOTAL COST


        //COMPANY VAT STATUS
        $("#vat_option").css('display', 'none');
        $('#vat_status').change(function () {
            var status = $(this).val();
            if (status == 1 || status == 2) {
                $("#vat_option").slideDown().css('display', 'block');
            } else {
                $("#vat_option").css('display', 'none');
            }
        });
        //ENDS OF COMPANY VAT STATUS

        //CALCULATE COMPANY RENT WITH VAT
        $(".vat_calculator").keyup(function () {
            var rent = $("#rent").val();
            var vat = $("#vat").val();
            var vat_status = $("#vat_status").val();
            if (vat_status == 0) {
                var total_rent = rent;
            }
            //including vat
            if (vat_status == 1) {
                var g_vat = ((vat / 100) * rent);
                var total_rent = parseInt(rent) + parseInt(g_vat);
            }
            //excluding vat
            if (vat_status == 2) {
                var g_vat = ((vat / 100) * rent);
                var total_rent = parseInt(rent) - parseInt(g_vat);
            }
            $("#total_rent").val(total_rent);
        });
        // CALCULATE COMPANY RENT WITH VAT

        // PRINT PARTICULAR AREA 
        function printContent(el)
        {
            var restorepage = document.body.innerHTML;
            var printcontent = document.getElementById(el).innerHTML;
            document.body.innerHTML = printcontent;
            var x = window.print();
            document.body.innerHTML = restorepage;
            window.reload();
            if (!x) {
                window.location = '<?php echo current_url() ?>';
            }
        }
        //ENDS OF PRINT PARTICULAR AREA 

        //LOAD MODAL WITH AJAX_JQUERY_CONTROLLER
        $(".led_btn").click(function () {
            var url = $(this).attr("href");
            var href = url.split("#");
            jquery_ajax('ajax_query', 'get_local_expense', href[1], "#local_expense_list");
        });

        //**starts of first city**//
        $('#city_start').change(function () {

            var controller = 'ajax_query';
            var method = 'station_start';
            var type = $('#city_start').val();
            var result_loc = '#start_point';
            jquery_ajax(controller, method, type, result_loc);
        });
        //**ends of first city**//

        //**starts of second city**//
        $('#city_end').change(function () {
            var controller = 'ajax_query';
            var method = 'station_start';
            var type = $('#city_end').val();
            var result_loc = '#end_point';
            jquery_ajax(controller, method, type, result_loc);
        });
        //**ends of second city**//

        //**starts of first city2**//
        $('#city_start_2').change(function () {
            var controller = 'ajax_query';
            var method = 'station_start';
            var type = $('#city_start_2').val();
            var result_loc = '#start_point_2';
            jquery_ajax(controller, method, type, result_loc);
        });
        //**ends of first city2**//

        //**starts of second city2**//
        $('#city_end_2').change(function () {
            var controller = 'ajax_query';
            var method = 'station_start';
            var type = $('#city_end_2').val();
            var result_loc = '#end_point_2';
            jquery_ajax(controller, method, type, result_loc);
        });
        //**ends of second city2**// 
    });

    function jquery_ajax(controller, method, type, restul_loc) {
        $.ajax({
            'url': '<?php echo base_url(); ?>index.php/' + controller + '/' + method + '/' + type,
            'type': 'POST',
            'data': {'type': type},
            'cache': false,
            'success': function (data) {
                var container = $(restul_loc);
                if (data) {
                    container.html(data);
                }
            }
            , error: function (data) {
                alert('failed');
            }
        });
    }
</script>
