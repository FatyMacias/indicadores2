<?php
Include("bd/database_connection.php");
$queryC = "SELECT SUBSTRING(qna_pago,1,4) AS 'year' FROM indicador GROUP BY year ASC";
//$query = "SELECT SUBSTRING(qna_pago,1,4) AS 'year' FROM indicador GROUP BY year DESC";
$queryM = "SELECT SUBSTRING(qna_ini,5,6) AS quincena FROM `cat_quincenas` LIMIT 24";
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
    <!-- Required meta tags -->
    <title>INDICADORES</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Rgoogle -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    
    <!--datables CSS básico-->
    <link rel="stylesheet" type="text/css" href="datatables/datatables.min.css"/>
    <!--datables estilo bootstrap 4 CSS-->  
    <link rel="stylesheet"  type="text/css" href="datatables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css">
     <!-- de aqui para abajo no se que pdo --> 
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css">

     
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
     <!-- importacion css para el toast-->
     <link href="css/toastr.min.css" rel="stylesheet"/>
     <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous"> 
    
  </head>
  
  <body>
    
    <div class="wrapper d-flex align-items-stretch">
      <nav id="sidebar">
      <center><a class="navbar-brand">INICIO</a></center>  
        <div class="p-4 pt-5">
          <a href="inicio.php" class="img logo thumbnailmb-5" style="background-image: url(images/zac.png);"></a>
          <br>
          <br>
          <ul class="list-unstyled components mb-5">
            <li class="active">
            <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">INFORMACIÓN FINANCIERA</a>
              <ul class="collapse list-unstyled" id="homeSubmenu">
                <li>
                    <a href="inicio.php" onclick="openMenu('general')">Gráfica Global</a>
                </li>
                <li>
                    <a href="grafica_concepto.php" onclick="openMenu('conceptos')">Gráfica Por Concepto</a>
                </li>
                <!-- <li>
                    <a href="#">Por banco</a>
                </li> -->
                <li>
                    <a href="grafica_subsistema.php" onclick="openMenu('genero')">Subsistemas</a>
                </li>
                <!-- <li>
                    <a href="grafica_porgenero.php" onclick="openMenu('genero')">Por género</a>
                </li> -->

                <li>
                    <a href="regiones.php">Regiones</a>
                </li> 

              </ul>
            </li>


           
            <li>
              <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">INFORMACIÓN DE PERSONAL</a>
              <ul class="collapse list-unstyled" id="pageSubmenu">
                <li>
                    <a href="grafica_genero.php" onclick="openMenu('subsis')">Gráfica Por Género</a>
                </li>
                <!-- <li>
                    <a href="#">Page 2</a>
                </li>
                <li>
                    <a href="#">Page 3</a>
                </li> -->
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
  <center>
    <h1>INDICADORES POR REGIONES</h1>
  </center>
  <div>
        <select name="id" class="form-control" id="id"style="width: 300px; height: 35px;">
                  <option value="">Seleccionar año</option>
                  <?php
                    foreach($resultC as $row)
                    {
                        echo '<option value="'.$row["year"].'">'.''.$row["year"] . ' ' .''.$row["concepto"].'</option>';
                    }
                  ?>
        </select>

        <select name="idd" class="form-control" id="idd" style="width: 300px; height: 35px;">
                  <option value="">Seleccionar quincena</option>
                  <?php
                    foreach($resultM as $row)
                    {
                        echo '<option value="'.$row["quincena"].'">'.$row["quincena"].'</option>';
                    }
                  ?>
        </select>
    </div>
  <div>
    <br>
    <br>
    <div class="panel-body">
      <div class="table">
        <table id="example2" class="table table-hover table-bordered" style="width:100%; border: 1px solid #ddd !important;">
          <thead class="thead-dark">
            <tr>
              <!-- <th scope="col">id</th> -->
              <th scope="col">Región</th>
              <th scope="col">Importe Total</th>
              <th scope="col">Importe/Docentes</th>
              <th scope="col">Importe/Administrativos</th>
            </tr>
          </thead>
          <tbody id="colsubsis"></tbody>
          <tfoot class="thead-dark">
          <tr>
              <!-- <th scope="col">id</th> -->
              <th scope="col">Región</th>
              <th scope="col">Importe Total</th>
              <th scope="col">Importe/Docentes</th>
              <th scope="col">Importe/Administrativos</th>
            </tr>
          </tfoot>
        </table>
        <table>
          <tr id = "colbuts">
          </tr>
        </table>
        <div>
        <input id = "btns" type="button" class="float-md-left btn btn-success" onclick="mostb()" value="Confirmar Seleccion">
        <input id = "btnd" type="button" class="float-md-left btn btn-success" onclick="disable()" value="Reset">
        </div>
        <table id="example" class="table table-hover table-bordered" style="width:100%; border: 1px solid #ddd !important;">
          <thead class="thead-dark">
            <tr>
              <!-- <th scope="col">id</th> -->
              <th scope="col">Región</th>
              <th scope="col">Importe Total</th>
              <th scope="col">Importe/Docentes</th>
              <th scope="col">Importe/Administrativos</th>
            </tr>
          </thead>
          <tbody id="tableModify">
          </tbody>
          <tfoot class="thead-dark">
          <tr>
              <!-- <th scope="col">id</th> -->
              <th scope="col">Región</th>
              <th scope="col">Importe Total</th>
              <th scope="col">Importe/Docentes</th>
              <th scope="col">Importe/Administrativos</th>
            </tr>
          </tfoot>
          
        </table>
        <div class="panel-body">
          <div id="chart_area" style="width: 1200px; height: 500px; visibility: hidden; "></div>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
  function show2(){
      //document.getElementById('chart_area').visibility = "visible";
      var x = document.getElementById('chart_area');
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
          <!-- datatables JS -->
    <script type="text/javascript" src="datatables/datatables.min.js"></script>
        <!-- para usar botones en datatables JS -->  
    <script src="datatables/Buttons-1.5.6/js/dataTables.buttons.min.js"></script>  
    <script src="datatables/JSZip-2.5.0/jszip.min.js"></script>    
    <script src="datatables/pdfmake-0.1.36/pdfmake.min.js"></script>    
    <script src="datatables/pdfmake-0.1.36/vfs_fonts.js"></script>
    <script src="datatables/Buttons-1.5.6/js/buttons.html5.min.js"></script> 
    <script src="js/toastr.min.js"></script>
    
  </body>
</html>

<!-- libreria de google con internet <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script> -->
<!-- libreria de google sin internet-->
<script type="text/javascript" src="./charts/loader.js"></script>
<script type="text/javascript">
google.charts.load('current', {packages: ['corechart', 'bar']});
// google.charts.load('current', {'packages':['table']});

google.charts.setOnLoadCallback();


//peticion para la grafica por conceptos
function load_subsis(id, idd)
{
 

    //var temp_title = title + ' '+id+'';
    $.ajax({
        url:"bd/fetch_reg.php",
        method:"POST",
        data:{id:id, idd:idd},
        dataType:"JSON",
        success: function (data) {
                drawSubsis(data);
                toastr.success('Datos cargados', '', {timeOut: 2000});
            },
        error: function (data) {
                data = 0;
                drawSubsis(data);
                toastr.error('No se encontraron datos', 'Error', {timeOut: 2000});
            }
        });
    }

function drawSubsis(chart_data,success)
{
    var jsonData = chart_data;
    //alert(jsonData.length);
    var temp = 1;
    var data = new google.visualization.DataTable();
    data.addColumn('string', 'Quincenas');
    data.addColumn('number', 'Importe $');
    data.addColumn({
               type: 'string',
               role: 'style'
           });
    var tablaData ='';
    var tablaData2 ='';
    var tablaData3 ='';
    var tablaData4 ='';
    var tablaData5 ='';
    var tablaData6 ='';
    //
    
   $('#colsubsis').empty();
   $('#colbuts').empty();
   //$('#col2_1').empty();
    $.each(jsonData, function(i, jsonData){
       // var mes = temp ++;
        var id = jsonData.id;
        var region = jsonData.region;
        var total = jsonData.total;
        var docente = jsonData.docente;
        var admvos = jsonData.admvos;
        var style = jsonData.style;
        data.addRows([[region, parseInt(total), style]]);
        //var importe = parseFloat($.trim(jsonData.importe));
        /////////
        tablaData += '<tr id = "'+id+'">';
        //tablaData += '<td>'+mes+'</td>';
        tablaData += '<td >'+region+'</td>';
        tablaData += '<td>'+'$'+total.replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,")+'</td>';
        tablaData += '<td>'+'$'+docente.replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,")+'</td>';
        tablaData += '<td>'+'$'+admvos.replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,")+'<input type="button" class=" boton float-md-right btn btn-success" onclick="cloneRow('+id+')" value="Seleccionar"></td>';
        //tablaData += '<td> <input type="button" class="btn btn-success" value="Seleccionar"> </td>'
        tablaData += '</tr>';
        
        //tablaData += '<tr>';
        //tablaData += '<td>'+'$'+jsonData.importe+'</td>';
        //tablaData += '</tr>';
        /////////
        


    });
    
    tablaData6 += '<td> <input type="button" class="btn btn-success" value="Mostrar/Ocultar Graficas" onclick="show2()"> </td>';
    var total = 0, total2 = 0, total3 = 0;
    for (var i in jsonData){
      total += parseInt(jsonData[i].total, 10);
      total2 += parseInt(jsonData[i].docente, 10);
      total3 += parseInt(jsonData[i].admvos, 10);
    }

    tablaData+='<td>'+'Total:'+'</td>';
    tablaData+='<td>'+total.toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,")+'</td>';
    tablaData+='<td>'+total2.toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,")+'</td>';
    tablaData+='<td>'+total3.toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,")+'</td>';
    
    $("#colbuts").append(tablaData6);
    $("#colsubsis").append(tablaData);
    var axis = data.getNumberOfRows();
   //alert('max data table value: ' + axis);
   for(var x=0;x<axis;x++){
    data.setValue(x, 2, '#'+Math.floor(Math.random()*16777215).toString(16));
   }

    var options = {
        title:'Regiones',
        legend: 'none',
        hAxis: {
            title: "Regiones"
        },
        vAxis: {
            title: 'Importe',
            format: 'currency'
        }
    };

    var chart = new google.visualization.ColumnChart(document.getElementById('chart_area'));
    chart.draw(data, options);

    $(document).ready(function() {    
    var table = $('#example2').DataTable({  
        bSort : false,
        order: [],
        lengthMenu: [
          [10, 25, 50, 100, 200, -1],
          [10, 25, 50, 100, 200, "All"],
        ],      
        language: {
                "lengthMenu": "Mostrar _MENU_ registros",
                "zeroRecords": "No se encontraron resultados",
                "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                "infoFiltered": "(filtrado de un total de _MAX_ registros)",
                "sSearch": "Buscar:",
                "oPaginate": {
                    "sFirst": "Primero",
                    "sLast":"Último",
                    "sNext":"Siguiente",
                    "sPrevious": "Anterior"
			     },
			     "sProcessing":"Procesando...",
            },
        //para usar los botones   
        responsive: "true",
        dom: 'Bfrtilp',       
        buttons:[ 
			{
				extend:    'excelHtml5',
				text:      '<i class="fas fa-file-excel"></i> ',
				titleAttr: 'Exportar a Excel',
				className: 'btn btn-success'
			},
			{
				extend:    'pdfHtml5',
				text:      '<i class="fas fa-file-pdf"></i> ',
				titleAttr: 'Exportar a PDF',
				className: 'btn btn-danger'
			},

		]	        
    });  
    $('#id, #idd').change(function(){
          table.clear().destroy();
        });   
});




}

function cloneRow(region) {
      //alert(region);
      var row = document.getElementById(region); // find row to copy
      var table = document.getElementById("tableModify"); // find table to append to
      var clone = row.cloneNode(true); // copy children too
      //clone.id = "newID"; // change id or other attributes/contents
      table.appendChild(clone); // add new row to end of table
      

     
    }

function disable(){


}

function mostb(){
  $(document).ready(function() {    
    var table2 = $('#example').DataTable({  
        bSort : false,
        order: [],
        lengthMenu: [
          [10, 25, 50, 100, 200, -1],
          [10, 25, 50, 100, 200, "All"],
        ],      
        language: {
                "lengthMenu": "Mostrar _MENU_ registros",
                "zeroRecords": "No se encontraron resultados",
                "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                "infoFiltered": "(filtrado de un total de _MAX_ registros)",
                "sSearch": "Buscar:",
                "oPaginate": {
                    "sFirst": "Primero",
                    "sLast":"Último",
                    "sNext":"Siguiente",
                    "sPrevious": "Anterior"
          },
          "sProcessing":"Procesando...",
            },
        //para usar los botones   
        responsive: "true",
        dom: 'Bfrtilp',       
        buttons:[ 
      {
        extend:    'excelHtml5',
        text:      '<i class="fas fa-file-excel"></i> ',
        titleAttr: 'Exportar a Excel',
        className: 'btn btn-success'
      },
      {
        extend:    'pdfHtml5',
        text:      '<i class="fas fa-file-pdf"></i> ',
        titleAttr: 'Exportar a PDF',
        className: 'btn btn-danger'
      },

    ]	        
    }); 

        $("#btnd").click(function(){
          table2.clear().destroy();
          //$("#btns").prop("disabled", true);
        });

});


}
</script>






<script>
    // Detectar seleccion del select option
$(document).ready(function(){
    $("#btns").prop("disabled", true);
    $("#btnd").prop("disabled", true);
    $('#id, #idd').change(function(){
        var id =$('#id').val();
        var idd = $('#idd').val();
        if(id != '' && idd != '')
        {
            //alert("The text has been changed.");
            load_subsis(id, idd);
            $("#btns").prop("disabled", false);

        }
    });

});

$(document).ready(function(){

  $("#btns").on("click", function() {
      $(this).prop("disabled", true);
      $("#btnd").prop("disabled", false);
      //$(".boton").prop("disabled", true);
      $(".boton").hide();
  });
  $("#btnd").on("click", function() {
      $(this).prop("disabled", true);
      $("#btns").prop("disabled", false);
      //$(".boton").prop("disabled", true);
      $(".boton").show();

  });


});
</script>