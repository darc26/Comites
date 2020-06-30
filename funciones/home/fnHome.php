<?php
session_start();
include('../../data/conexion.php');
error_reporting(0);


use  PHPMailer\PHPMailer\PHPMailer;
use  PHPMailer\PHPMailer\Exception;
require ('../../PHPMailer-master/src/PHPMailer.php');
require ('../../PHPMailer-master/src/Exception.php');
require ('../../PHPMailer-master/src/SMTP.php');
//$login     = isset($_SESSION['persona']);
// cookie que almacena el numero de identificacion de la persona logueada
$usuario   = $_COOKIE['usuarioPROYECTO1'];
$idUsuario = $_COOKIE['idusuarioPROYECTO1'];
$perfil    = $_SESSION["perfilPROYECTO1"];
date_default_timezone_set('America/Bogota');
$fecha  = date("Y/m/d H:i:s");
$opcion = $_POST['opcion'];
if($opcion== 'CARGARHOME'){
setlocale(LC_ALL,"es_ES.utf8","es_ES","esp");


  echo "<script>CRUDCOMITES('LISTACOMITES')</script>";

 
  ?>
  <div class="row"  id="filtros">
    <div class="col-md-4 col-sm-6 col-12">
      <div class="info-box est" data-value="1">
          <a  class="info-box-icon bg-success "><i class="fas fa-user-clock"></i></i></a>

          <div class="info-box-content">
          <span class="info-box-text">Comites en proceso</span>
          <?php   
          $conv = mysqli_query($conectar, "select count(*) cant from tbl_comites where  est_clave_int in(1)");
          $datv = mysqli_fetch_array($conv);
          
          
          ?>
          <span class="info-box-number"><?php echo $datv['cant']  ?> </span>
          </div>
          <!-- /.info-box-content -->
      </div>
        <!-- /.info-box -->
    </div>
    <div class="col-md-4 col-sm-6 col-12">
        <div class="info-box est"  data-value="3" >
          <?php   
            $conv = mysqli_query($conectar, "select count(*) cant from tbl_comites where  est_clave_int in(3)");
            $datv = mysqli_fetch_array($conv);
            
            
            ?>
            <a class="info-box-icon bg-warning "><i class="fas fa-user-alt-slash"></i></a>

            <div class="info-box-content">
            <span class="info-box-text"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Comités cerrados</font></font></span>
          
            <span class="info-box-number"><?php echo $datv['cant']  ?> </span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <div class="col-md-4 col-sm-6 col-12">
        <div class="info-box est" data-value="2">
            <a class="info-box-icon bg-danger"><i class="fas fa-user-times"></i></i></i></a>

            <div class="info-box-content">
            <span class="info-box-text"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Comites Anulados</font></font></span>
            <?php   
            $conv = mysqli_query($conectar, "select count(*) cant from tbl_comites where  est_clave_int in(2)");
            $datv = mysqli_fetch_array($conv);
            
            
            ?>
            <span class="info-box-number"><?php echo $datv['cant']  ?> </span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <div class="col-md-6">
        <div class="card card-primary">
        
          <div class="card-body"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
          <div id="container"></div>
          </div>
          <!-- /.card-body -->
        </div>
    </div>
    <div class="col-md-6">
    <div class="card card-success">
         
          <div class="card-body"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
          <div id="container2"></div>
          </div>
          <!-- /.card-body -->
        </div>
    </div>
    <div class="col-md-12 card" id="tabl" style="display: none;">
      <div class="card-body" id="tabladatos1"> 
      </div>
    </div>
  </div>
  <script>

    $(document).ready(function(){                                    
      $(".est").on( "click",function(){    
        $('#tabl').show();
        var ests = $(this).attr('data-value');
        window.location.href='#tabl';
        CRUDCOMITES('LISTACOMITES',ests)
       
      });                                   
    }),
    $(document).ready(function(){ 

    Highcharts.setOptions({
      lang:{
        downloadCSV: 'Descargar  CSV',
        downloadJPEG: 'Descargar Imagen JPG',
        downloadPDF: 'Descargar PDF',
        downloadPNG: 'Descargar Imagen PNG',
        downloadSVG: 'Descargar SVG',
        downloadXLS:'Descargar XLS',
        exitFullscreen:"Salir de pantalla completa",
        loading:'Cargando...',
      
        noData:'No hay datos',
        printChart:'Imprimir grafico',
        resetZoom:'Reiniciar zoom', 
        viewFullscreen:'Ver en pantalla completa',
        months: [
            'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio',
            'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Dicimbre'
        ]
      }
    })
        //grafico de barras
    Highcharts.chart('container2', {
      title: {
          text: 'Comites x Mes '
      },
      chart: {
          type: 'column'
      },
      colors: ['#28E', '#4A0'],
      xAxis: [{
          labels: {
              autoRotation: 0
          },
          //opposite: true,
          reversed: true,
          type: 'category'
      }],
      accessibility: {
          point: {
              descriptionFormatter: function (point) {
                  return (
                      point.options.custom.value + ' en el ' + point.series.options.custom.gender + ' ' + point.name + '.'
                  );
              }
          }
      },
      tooltip: {
          headerFormat: '',
          pointFormat: (
              '{series.options.custom.gender}'+ ' {point.name}<br />' +
              '{point.options.custom.value}'
          )
      },
      plotOptions: {
          series: {
              dataSorting: {
                  enabled: true,
                  sortKey: 'custom.mes'
              },
              keys: ['name', 'custom.value', 'y','custom.mes'], // 4th data position as custom property
              stacking: 'normal',
              events: {
                  click: function (event) {
                      console.log(event);
                      console.log(event.point.custom.mes);
                     
                      $('#tabl').show();
                          window.location.href='#tabl';
                          CRUDCOMITES('LISTACOMITESMES',event.point.custom.mes)
                  }
              }
          }
      },
      series: [{
          name: 'Meses',
          xAxis: 0,
          yAxis: 0,
          custom: {
              gender: 'Mes'
          },
          data: [
              <?php $m = 1; $k = 0; $y= date('Y'); 
              while($k<12){ $me = $m; if($me<10){ $me = "0".$me; } $fecham = $y."-".$m."-01"; $mes = strftime("%B",strtotime($fecham));  
              $mese = $y."-".$me;
              $contot = mysqli_query($conectar, "SELECT COUNT(com_clave_int) cantidad FROM tbl_comites where date_format(com_fecha,'%Y-%m')= '".$mese."' and est_clave_int!=2 ");
              $dattot = mysqli_fetch_array($contot); $tot = $dattot['cantidad']; if($tot<=0){ $tot = 0; }
              $tot = round($tot,0);
              
              ?>
              ['<?php echo ucfirst($mes);?>', '<?php echo $tot; ?>', <?php echo $tot;?>,'<?php echo $mese;?>'],
              <?php
              $m++;  $k++;
              }
              ?>
          ]
      },]

  });

        //Grafico por Mes
  
      
      // -------------------------------------------------------Grafico por estado Por estado-----------------------------------------------------
  Highcharts.chart('container', {
    chart: {
        type: 'pie'
    },
    title: {
        text: 'Comites Por Estado'
    },
    accessibility: {
        announceNewData: {
            enabled: true
        },
        point: {
            valueSuffix: '%'
        }
    },
    plotOptions: {
        series: {
            cursor: 'pointer',
            dataLabels: {
                enabled: true,
                format: '<span style="color:{point.color}">{point.name}: {point.y:.0f}</span> ',
                
            },
            events: {
              click: function (event) {
                
                var names = event.point.name
                if(names  == 'En proceso'){
                  var est = 1;
                  
                }else if(names == 'Cerrados'){
                  var est =3;
                }else{
                  var est = 2;  
                }
                $('#tabl').show();
                window.location.href='#tabl';
                CRUDCOMITES('LISTACOMITES',est)
              }
            }
        }
    },
    tooltip: {
        headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
        pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.0f}</b> '
    },
    series: [
        {
            name: "Estado",
            colorByPoint: true,
            allowPointSelect: true,
            data: [
                { 
                    name: "En proceso",
                    y: <?php $conv = mysqli_query($conectar, "select count(*) cant from tbl_comites where  est_clave_int in(1)"); $datv = mysqli_fetch_array($conv);   echo $datv['cant']  ?>,
                    drilldown: "Firefox",
                    color:"#28a745 ",
                     sliced: true,
                    selected: true
                },
                {
                    name: "Cerrados",
                    y:<?php $conv = mysqli_query($conectar, "select count(*) cant from tbl_comites where  est_clave_int in(3)"); $datv = mysqli_fetch_array($conv);   echo $datv['cant']  ?>,
                    drilldown: "Firefox",
                    color:"#ffc107"
                },
                {
                    name: "Anulado",
                    y:  <?php $conv = mysqli_query($conectar, "select count(*) cant from tbl_comites where  est_clave_int in(2)"); $datv =          mysqli_fetch_array($conv);   echo $datv['cant']  ?>,
                    drilldown: "Internet Explorer",
                    color:"#dc3545"
                },
            ],
            showInLegend: true
        }
    ],     
});














  //     var canvas = document.getElementById("pieChart");
  //     canvas.onclick = function (evt) {
  //       var activePoints = pieChart.getElementsAtEvent(evt);
  //       var chartData = activePoints[0]['_chart'].config.data;
  //       var idx = activePoints[0]['_index'];

  //       var label = chartData.labels[idx];
  //       var value = chartData.datasets[0].data[idx];

  //       if(label == 'En proceso'){
  //         var est = 1;
          
  //       }else if(label == 'Cerrados'){
  //         var est =3;
        
  //       }else{
  //         var est = 2;        
  //       }
  //       $('#tabl').show();
  //       window.location.href='#tabl';
  //       CRUDCOMITES('LISTACOMITES',est)
  //     };









  //     var pieChart = new Chart(pieChartCanvas, {
  //       type: 'doughnut',
  //       data: pieData,
  //       options: pieOptions      
  //     })
  //     $('#world-map-markers').mapael({
  //       map: {
  //         name : "usa_states",
  //         zoom: {
  //           enabled: true,
  //           maxLevel: 10
  //         },
  //       },
  //     });

    });
  
  </script>
  <?php
  echo "<script> INICIALIZARHOME()</script>";
}