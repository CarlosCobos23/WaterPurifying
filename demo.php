<?php

include "connect.php";

function insert($name, $value){
  $con= connection();

  $sql = "INSERT INTO arduinoData (sensorName,sensorValue) VALUES ('$name','$value')";
   if(mysqli_query($con, $sql)){
       echo "Records inserted successfully.";

   } else{
       echo "ERROR: Could not able to execute $sql. " . mysqli_error($con);
   }

}

if(isset($_GET)){
  switch($_GET["action"]){
    case "insert":

    $value = $_POST['arduinoData'];

    $data_back = json_decode($_POST['arduinoData']);
    $sName = $data_back->{"sensorName"};
    $sValue = $data_back->{"sensorValue"};
    insert($sName,$sValue);

    break;
  }
}

 ?>

 <!DOCTYPE html>
 <html lang="en" dir="ltr">
   <head>
     <meta charset="utf-8">
     <link rel="stylesheet" type="text/css" href="design.css">
      <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
     <link rel="stylesheet"
     href="https://use.fontawesome.com/releases/v5.0.10/css/all.css"
     integrity="sha384-+d0P83n9kaQMCwj8F4RJB66tzIwOKmrdb46+porD/OvrJ+37WqIM7UoBtwHO6Nlg"
     crossorigin="anonymous">
     <title>Consumo de agua</title>
   </head>
   <body>
   <nav>
   	<ul class="nav">
   	<li class="nav-item"><i class="fas fa-bars menu-icn"></i></li>
     <li class="nav-item"><a class="active">Consumo de agua</a></li>
   	</ul>
   	</nav>
    <?php
    $conStat= connection();
    if($conStat== true){
     echo "<div id='trueStat'>Conectado a la Base de Datos</div> <br />";
   }else {
      echo "<div id='falseStat'>Sin conexion a la Base de Datos</div> <br />";
   }
    ?>
    <input type="button" value="Actualizar Datos" id="datosBtn" onclick="window.location.reload()"/>
     <div>
       <table>
       <thead>
         <th>
           Id
         </th>
         <th>
           Valor (L)
         </th>
       </thead>
       <tbody>
         <?php
             $con= connection();

             $result = mysqli_query($con,"SELECT * FROM arduinoData");
             while($row = mysqli_fetch_array($result)):
              ?>
         <tr>
           <td>
             <?php echo $row['id']; ?>
           </td>
           <td>
             <?php echo $row['sensorValue']; ?>
           </td>
         </tr>
         <?php endwhile; ?>
       </tbody>
     </table>
   </div>
   <div id="barchart_values" style="width: 900px; height: 300px;"></div>
   <div>
     <table>
       <thead >
         <th style="background-color:#e5c134; color:#fff">
           Sugerencias:
         </th>
       </thead>
       <tbody>
         <tr>
           <td style="background-color:#ede1b1;">
             Te recomendamos cerrar la llave mientras te lavas los dientes.
           </td>
         </tr>
       </tbody>
     </table>
   </div>
    <footer>
      <p>Desarrollado por: Water Purifying</p>
      <p>Informacion de contacto: <a href="mailto:waterpurifying@hotmail.com">waterpurifying@hotmail.com</a>.</p>

     </footer>
   </body>
 </html>

     <script type="text/javascript">
    google.charts.load("current", {packages:["corechart"]});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
      var data = google.visualization.arrayToDataTable([
        ["Element", "Consumo", { role: "style" } ],
        ["Lunes", <?php

        $result = mysqli_query($con,"SELECT * FROM arduinoData WHERE ID='6'");
        while($row = mysqli_fetch_array($result)):
        echo $row['sensorValue'];
      endwhile;
         ?>, "#219bff"],
         ["Martes", <?php

         $result = mysqli_query($con,"SELECT * FROM arduinoData WHERE ID='7'");
         while($row = mysqli_fetch_array($result)):
         echo $row['sensorValue'];
         endwhile;
          ?>, "#219bff"],
          ["Miercoles", <?php

          $result = mysqli_query($con,"SELECT * FROM arduinoData WHERE ID='8'");
          while($row = mysqli_fetch_array($result)):
          echo $row['sensorValue'];
          endwhile;
           ?>, "#219bff"],
           ["Jueves", <?php

           $result = mysqli_query($con,"SELECT * FROM arduinoData WHERE ID='9'");
           while($row = mysqli_fetch_array($result)):
           echo $row['sensorValue'];
         endwhile;
            ?>, "#219bff"],
            ["Viernes", <?php

            $result = mysqli_query($con,"SELECT * FROM arduinoData WHERE ID='10'");
            while($row = mysqli_fetch_array($result)):
            echo $row['sensorValue'];
          endwhile;
             ?>, "#219bff"],
             ["Sabado", <?php

             $result = mysqli_query($con,"SELECT * FROM arduinoData WHERE ID='11'");
             while($row = mysqli_fetch_array($result)):
             echo $row['sensorValue'];
           endwhile;
              ?>, "#219bff"],
              ["Domingo", <?php

              $result = mysqli_query($con,"SELECT * FROM arduinoData WHERE ID='12'");
              while($row = mysqli_fetch_array($result)):
              echo $row['sensorValue'];
            endwhile;
               ?>, "#219bff"]
      ]);

      var view = new google.visualization.DataView(data);
      view.setColumns([0, 1,
                       { calc: "stringify",
                         sourceColumn: 1,
                         type: "string",
                         role: "annotation" },
                       2]);

      var options = {
        title: "Consumo de agua en lts.",
        width: 800,
        height: 500,
        bar: {groupWidth: "70%"},
        legend: { position: "none" },
      };
      var chart = new google.visualization.BarChart(document.getElementById("barchart_values"));
      chart.draw(view, options);
  }
  </script>
