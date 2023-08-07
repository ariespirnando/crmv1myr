<!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES -->
<link href="<?php echo base_url().'assets/' ?>assets/css/elements/breadcrumb.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url().'assets/' ?>plugins/apex/apexcharts.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url().'assets/' ?>assets/css/dashboard/dash_2.css" rel="stylesheet" type="text/css" />  
<link href="<?php echo base_url().'assets/' ?>plugins/loaders/custom-loader.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/' ?>assets/css/elements/alert.css">
<link href="<?php echo base_url().'assets/' ?>assets/css/components/custom-modal.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url().'assets/' ?>plugins/notification/snackbar/snackbar.min.css" rel="stylesheet" type="text/css" />


<!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES --> 

<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
    <div class="widget widget-chart-one"> 
        <div class="widget-content"> 
            <nav class="breadcrumb-one" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0);"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                        Laporan</a></li> 
                </ol> 
            </nav>  
            <br> 
        </div>
    </div>
</div>

<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
    <div class="widget widget-activity-four">
        <div class="widget-heading">
            <div class="row">
                <div class="col-md-6">
                    <h5 class="">Grafik Keluhan Perbulan</h5>
                </div> 
                <div class="col-md-6"> 
                    <h5 class="btn btn-primary" style="float: right;">Download</h5>
                </div>
            </div> 
        </div>

        <div class="widget-content">
            <div id="uniqueVisits"></div>
        </div>
    </div>
</div>
 
 

<!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
<script src="<?php echo base_url().'assets/' ?>plugins/apex/apexcharts.min.js"></script>   
<!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->

<script>
 
    var d_1options1 = {
      chart: {
          height: 298,
          type: 'bar',
          toolbar: {
            show: false,
          },
          dropShadow: {
              enabled: true,
              top: 1,
              left: 1,
              blur: 2,
              color: '#acb0c3',
              opacity: 0.7,
          }
      },
      colors: ['#5c1ac3', '#ffbb44'],
      plotOptions: {
          bar: {
              horizontal: false,
              columnWidth: '55%',
              endingShape: 'rounded'  
          },
      },
      dataLabels: {
          enabled: false
      },
      legend: {
            position: 'bottom',
            horizontalAlign: 'center',
            fontSize: '14px',
            markers: {
              width: 10,
              height: 10,
            },
            itemMargin: {
              horizontal: 0,
              vertical: 8
            }
      },
      stroke: {
          show: true,
          width: 2,
          colors: ['transparent']
      },
      series: [
          {
          name: 'Keluhan',
          data: [
              <?php 
              $i = 1;
              foreach($loaddt as $d){
                if($i==12){
                    echo $d['internal'];
                }else{
                    echo $d['internal'].',';
                }
                $i++;
              }  
              ?>
              ]
          },  
        ],
      xaxis: {
          categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
      },
      fill: {
        type: 'gradient',
        gradient: {
          shade: 'light',
          type: 'vertical',
          shadeIntensity: 0.3,
          inverseColors: false,
          opacityFrom: 1,
          opacityTo: 0.8,
          stops: [0, 100]
        }
      },
      tooltip: {
          y: {
              formatter: function (val) {
                  return val
              }
          }
      }
    }

    var d_1C_3 = new ApexCharts(
        document.querySelector("#uniqueVisits"),
        d_1options1
    );
    d_1C_3.render();

      
    <?php 
    if($this->session->userdata('message') <> ''){ 
        if($this->session->userdata('info')==1){
            echo "<script>
                        Snackbar.show({
                            text: '".$this->session->userdata('message')."',
                            actionTextColor: '#fff',
                            backgroundColor: '#8dbf42'
                        });
                    </script>";
        }else{
            echo "<script>
                        Snackbar.show({
                            text: '".$this->session->userdata('message')."',
                            actionTextColor: '#fff',
                            backgroundColor: '#e7515a'
                        });
                    </script>";
        } 
    }
    ?>
</script>