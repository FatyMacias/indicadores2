<?php
Include("bd/database_connection.php");
$queryC = "SELECT cve_cpto, concepto AS 'concepto' FROM `cat_conceptos`";
$queryM = "SELECT mes,id_mes,nombre FROM `cat_mes` JOIN meses ON cat_mes.mes = meses.id_mes GROUP BY mes ORDER BY id_quin";


$statementC = $connect->prepare($queryC);
$statementM = $connect->prepare($queryM);

$statementC->execute();
$statementM->execute();

$resultC = $statementC->fetchAll();
$resultM = $statementM->fetchAll();

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>INICIO</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="background.css">

    <script src="https://code.jquery.com/jquery-1.12.4.js"></script> 
     <!-- importacion css para el toast-->
       <link href="css/toastr.min.css" rel="stylesheet"/>
  </head>

  <body id="backgroundImage">
    
    <div class="wrapper d-flex align-items-stretch">
      <nav id="sidebar">
      <center><a class="navbar-brand" href="inicio.php">INICIO</a></center>  
        <div class="p-4 pt-5">
          <a href="inicio.php" class="img logo thumbnailmb-5" style="background-image: url(images/zac.png);"></a>
          <br>
          <br>
          <ul class="list-unstyled components mb-5">
          <li>
            <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">INFORMACIÓN FINANCIERA</a>
              <ul class="collapse list-unstyled" id="homeSubmenu">
                <li>
                    <a href="inicio.php" onclick="openMenu('general')">Gráfica Global</a>
                </li>
                <li>
                    <a href="grafica_concepto.php" onclick="openMenu('conceptos')">Gráfica Por Concepto</a>
                </li>
                <li>
                    <a href="grafica_subsistema.php" onclick="openMenu('genero')">Subsistemas</a>
                </li>
                <li>
                    <a href="regiones.php" onclick="">Regiones</a>
                </li>
              </ul>
          </li>


           
            <li>
              <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">INFORMACIÓN DE PERSONAL</a>
              <ul class="collapse list-unstyled" id="pageSubmenu">
                <li>
                    <a href="grafica_genero.php" onclick="openMenu('subsis')">Gráfica Por Género</a>
                </li>
              </ul>
            </li>
          </ul>
       </div>
      </nav>
      
      

        <!-- Page Content  -->
      <div id="content" class="p-4 p-md-5">

        <nav class="navbar navbar-expand-lg navbar-light bg-light">
          <div class="container-fluid">
              <!-- Modal -->
   <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
        <!-- <h5 class="modal-title w-100 text-center" id="exampleModalLabel">Modal title</h5> -->
          <h4 class="modal-title w-100 text-center" class="modal-title">INFORMACIÓN</h4>
        </div>
        <div class="modal-body" id="body">
        </div>
         <div class="modal-footer">
          <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
        </div> 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary">Cerrar</button>
        <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
      </div>
    </div>
  </div>

            <button type="button" id="sidebarCollapse" class="btn btn-primary">
              <i class="fa fa-bars"></i>
              <span class="sr-only">Toggle Menu</span>
            </button>
            <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fa fa-bars"></i>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="nav navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Inicio</a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Cerrar sesión</a>
                </li>
              </ul>
            </div>
          </div>
        </nav>
        <div id="conceptos" class="w3-container menu" style="display">
          
              <center><h1 >INDICADORES POR CONCEPTO</h1></center>     

          <div>
          <div class="row">
    <div class="col-sm-6">
        <div class="form-group">
              <div class="input-group mb-6"style="width: 300px; height: 35px;" >
                <input type="text" class="form-control" placeholder="Ingrese nombre o clave" aria-label="Recipient's username" aria-describedby="button-addon2" id="something" list="somethingList">
                <div class="input-group-append">
                  <button class="btn btn-outline-success" id="limpiar" type="button">Limpiar</button>
                </div>
                <datalist id="somethingList">
                  <?php
                    foreach($resultC as $row)
                    {
                        echo '<option value="'.$row["cve_cpto"].' '.$row["concepto"].'" ></option>';
                    }
                  ?>
                </datalist>
              </div>

                <select name="idm" class="form-control" id="idm" style="width: 300px; height: 35px;">
                            <option value="">Seleccionar Mes</option>
                            <?php
                            foreach($resultM as $row)
                            {
                                echo '<option value="'.$row["mes"].'">'.$row["nombre"].'</option>';
                            }
                            ?>
                </select>
                </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">

        </div>
    </div>
</div>

          </div>
          <br>
          <br>
          <div class="panel-body">
         
            <div style="width: 200px; height: 10px;"></div>  
          </div>
          <div class="panel-body">
          <table  class="table table-hover table-bordered" style="border: 1px solid #ddd !important;">
              <thead class="thead-dark">
                <tr>
                  <th scope="col">Año</th>
                  <th scope="col">Importe</th>
                </tr>
              </thead>
              <tbody  id="col1">

              </tbody>
            </table>
            <div id="chart_area3" style="width: 1200px; height: 500px; visibility:hidden;"></div>
          </div>
          </div>

          <script>
            function openMenu(menuName) {
              var i;
              var x = document.getElementsByClassName("menu");
              for (i = 0; i < x.length; i++) {
                    x[i].style.display = "none";  
                  }
              document.getElementById(menuName).style.display = "block";  
            }
            function show(){
              //document.getElementById('chart_area').visibility = "visible";
              var x = document.getElementById('chart_area3');
              if (x.style.visibility === 'hidden') {
                  x.style.visibility = 'visible';
              } else {
                  x.style.visibility = 'hidden';
              }
               
            }
          </script>
          
      
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>  
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
    <script src="js/toastr.min.js"></script>
  </body>
</html>


<script type="text/javascript" src="./charts/loader.js"></script>
<script type="text/javascript">
google.charts.load('current', {packages: ['corechart', 'bar']});
google.charts.load('current', {'packages':['table']});

google.charts.setOnLoadCallback();


//peticion para la grafica por conceptos
function load_conceptowise3_data(idc, idm, title)
{
    var temp_title = title + ' '+idc+''+''+idm+'';
    $.ajax({
        url:"bd/fetch_concepto.php",
        method:"POST",
        data:{idc:idc, idm:idm},
        dataType:"JSON",
        success: function (data) {
                drawMonthwiseChart3(data);
                toastr.success('Datos cargados', '', {timeOut: 2000});
            },
        error: function (data) {
                toastr.error('No se encontraron datos', 'Error', {timeOut: 2000});
            }
        });
}
var tokenData;
function load_funcon(idc, idm)
{
    $.ajax({
        url:"bd/fetch_funcon.php",
        method:"POST",
        data:{idc:idc, idm:idm},
        dataType:"JSON",
        success: function (data) {
                tokenData = data;
                
            },
        error: function (data) {
                toastr.error('No se encontraron datos', 'Error', {timeOut: 2000});
            }
        });
}
//dibujar grafica por conceptos
function drawMonthwiseChart3(chart_data, chart_main_title)
{
    var jsonData = chart_data;
    var tablaData ='';
    var tablaData6 ='';

    var data = new google.visualization.DataTable();
    data.addColumn('string', 'Quincenas');
    data.addColumn('number', 'Importe $');
    data.addColumn({
               type: 'string',
               role: 'style'
           });
          
     $('#col1').empty();

    $.each(jsonData, function(i, jsonData){
        var concepto = jsonData.concepto;
        var importe = parseFloat($.trim(jsonData.importe));
        var style = jsonData.style;
        data.addRows([[concepto, importe, style]]);
        tablaData += '<tr>';
        tablaData += '<td>'+jsonData.concepto+'</td>';
        tablaData += '<td>'+'$'+jsonData.importe.toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,")+'</td>';
        tablaData += '</tr>';


    });
    var total = 0;
    for(var i in jsonData){
      total += parseFloat(jsonData[i].importe,10);
    }
    tablaData += '<td class="table-dark text-light"><strong>Total:</strong></td>';
    tablaData += '<td><strong>'+'$'+total.toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,")+'</strong></td>';
    tablaData += '<tr>';
    tablaData += '<td> <input type="button" class="btn btn-success" value="Ocultar/Mostrar Grafica" onclick="show()"> </td>';
    tablaData += '</tr>';
    $("#col1").append(tablaData);

    var axis = data.getNumberOfRows();
   for(var x=0;x<axis;x++){
    data.setValue(x, 2, '#'+Math.floor(Math.random()*16777215).toString(16));
   }

    var options = {
        title:chart_main_title,
        legend: 'none',
        hAxis: {
            title: "Quincenas"
        },
        vAxis: {
            title: 'Importe',
            format: 'currency'
        }
    };

    var chart = new google.visualization.ColumnChart(document.getElementById('chart_area3'));
    chart.draw(data, options);
    google.visualization.events.addListener(chart, 'select', selectHandler);
    function selectHandler() {
      tablaData6 = "";
      var selection = chart.getSelection();
      for (var i =0; i<selection.length;i++){
        var item = selection[i];
        var str = data.getValue(item.row, 0);
        var stn = data.getRowProperties(item.row);
        $.each(tokenData, function(i, tokenData){
           var fuente = tokenData.fuente;
           var quin = tokenData.concepto;
           var importe = tokenData.importe;
           var nombre = tokenData.nombre;
           if(str){
             if(quin == str){
                tablaData6 += "<strong>Fuente:</strong> "+nombre+' '+fuente+' <strong>Importe:</strong> '+'$'+importe.toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,")+"<br>";
                $("#myModal").modal();
                $("#body").html(
                  tablaData6);
                $("#myModal").modal();
             }
           }
        });
      }
    }
}
</script>






<script>
    // Detectar seleccion del select option
$(document).ready(function(){

    //el input se limpiara al hacer click en boton de limpiar
    $('#limpiar').on("click", function() {
        $('#something').val('');
        $('#idm').prop('selectedIndex',0);
    });

    $('#something, #idm').change(function(){
        var idc = $("#something").val().slice(0,2);
        var idm = $('#idm').val();
        if(idc != '' && idm != '')
        {
            load_funcon(idc, idm);
            load_conceptowise3_data(idc, idm, 'Importe por cada año, concepto: ');
            //el input se limpiara cuando llegue a este punto
        }
    });


});


</script>


