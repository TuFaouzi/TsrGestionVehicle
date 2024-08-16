<div class=row>
    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
        <div class="statistic-box statistic-filled-3"> 
            
            <h2><span id=count-trip></span><span class=slight><i class="fa fa-play fa-rotate-270 text-warning"></i></span></h2>
            <div class=small><?php echo display('trip');?></div>
            
            <img style="margin-left:58%;margin-top:-48%;width: 30%;" src="<?php echo base_url();?>assets/img/delivery-truck.png">
            <div class="sparkline3 text-center"></div>
            
        </div>
    </div>
    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
        <div class="statistic-box statistic-filled-1">
            <h2><span id=count-customer></span></h2>
            <div class=small><?php echo display('customers');?></div>
             
             <img style="margin-left:58%;margin-top:-48%;width: 30%;" src="<?php echo base_url();?>assets/img/specialist-use.png">
            <div class="sparkline1 text-center"></div>
        </div>
    </div>
    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
        <div class="statistic-box statistic-filled-2">
            <h2><span id=count-fitness></span></h2>
            <div class=small><?php echo display('fitness');?></div>
          
          <img style="margin-left:58%;margin-top:-48%;width: 30%;" src="<?php echo base_url();?>assets/img/stretching-exercises.png">
            <div class="sparkline2 text-center"></div>
        </div>
    </div>
    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
        <div class="statistic-box statistic-filled-4">
            <h2><span id="count-driver">5489</span></h2>
            <div class=small><?php echo display('driver');?></div>
               <img style="margin-left:58%;margin-top:-48%;width: 30%;" src="<?php echo base_url();?>assets/img/accountant.png">
            <div class="sparkline4 text-center"></div>
        </div>
    </div>
</div>
<div class=row>
    <div class="col-sm-6 col-md-8">
        <div class="panel panel-bd lobidisable">
            <div class="panel-heading">
                <div class="panel-title">
                    <h4><?php echo display('weeklytripandfarerent');?></h4>
                </div>
            </div>
            <div class="panel-body">
                <canvas id="singelBarChart" height="143"></canvas>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-md-4">
        <div class="panel panel-bd lobidisable">
            <div class="panel-heading">
                <div class="panel-title">
                    <h4><?php echo display('businesschart');?></h4>
                </div>
            </div>
            <div class="panel-body">
                <canvas id="pieChart" height="310"></canvas>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $.ajax({
            dataType: "json",
            url: "<?php echo base_url()?>chart",
            method: "GET",
            success: function (data){
                var weekname = [data[0], data[3], data[6], data[9], data[12], data[15], data[18]];
                var trip = [data[1], data[4], data[7], data[10], data[13], data[16], data[19]];
                var profit = [data[2], data[5], data[8], data[11], data[14], data[17], data[20]];       
                var ctx = document.getElementById("singelBarChart");    
                
                var myChart = new Chart(ctx,{
                    type: 'bar',
                    data: {
                        labels: weekname,
                        //labels: ["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"],
                        datasets: [
                            {
                                label: "Trip",
                                data: trip,
                                borderColor: "rgb(0, 191, 255)",
                                borderWidth: "0",
                                backgroundColor: "rgb(0, 191, 255)"
                            },
                            {
                                label: "Fare-rent",
                                data: profit,
                                borderColor: "rgba(85, 139, 47, 0.9)",
                                borderWidth: "0",
                                backgroundColor: "rgb(72, 87, 191)"
                            }
                        ]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                    ticks: {
                                        beginAtZero: true
                                    }
                                }]
                        }
                    }
                });
            }
        });
        $.ajax({
            dataType: "json",
            url: "<?php echo base_url()?>chart/customer",
            method: "GET",
            success: function (data) {
               
 
                $('#count-trip').html(String(data.trip));
                $('#count-customer').html(String(data.customer));
                $('#count-fitness').html(String(data.fitness));
                $('#count-driver').html(String(data.driver));

               
                var ctx = document.getElementById("pieChart");
                var myChart = new Chart(ctx, {
                    type: 'pie',
                    data: {
                        datasets: [{
                                data: [data.customer, data.vehile, data.driver],
                                backgroundColor: [
                                    "rgb(6, 81, 131)",
                                    "rgb(68, 0, 226)",
                                    "rgb(68, 229, 226)",
                                    "rgba(0, 0, 0, 0.04)"
                                ],
                                hoverBackgroundColor: [
                                    "rgba(85, 139, 47, 0.9)",
                                    "rgba(85, 139, 47, 0.7)",
                                    "rgba(85, 139, 47, 0.5)",
                                    "rgba(0,0,0,0.07)"
                                ]

                            }],
                        labels: [
                            "customer",
                            "Vehicle",
                            "Driver"
                        ]
                    },
                    options: {
                        responsive: true
                    }
                });
            }
        });

    });
</script>

