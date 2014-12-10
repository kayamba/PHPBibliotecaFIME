<?php
require "controller/solicitudes.php";
include_once("controller/validacion.php");
session_start();
acl($_SESSION['id'], $_SESSION['tipo'], "Cliente");

$user = isset($_SESSION['nick'])? $_SESSION['nick'] : "Anon";

$search = isset($_GET['search'])? $_GET['search']:"All";
$is_user = (isset($_SESSION["id"]));
$ticket = getSingleRequisition($_GET['print']);
?>

<html>
  <head>
    <title></title>
    <script src="http://code.jquery.com/jquery.js"></script>
    <script type="text/javascript" src="http://barcode-coder.com/js/jquery-barcode-last.min.js"></script>
  </head>
  <body>
    <p>
      <h3>Gaia Library</h3>
    </p>
    <?php while($row = $ticket->fetch_assoc()){ ?>
        <strong>Fecha de Renta: </strong> <?php echo $row["fecha_renta"] ?><br>
        <strong>Cliente:</strong> <?php echo $row["full_name"] ?><br>
        <strong>Titulo:</strong> <?php echo $row["Titulo"] ?><br>
        <strong>Fecha de Entrega</strong> <?php echo $row["fecha_entrega"] ?><br>
        <?php $len = strlen($row['IdPedido']); ?>
        <?php $con = substr("0000000000000", (-12 + $len)); ?>
        <br>
        <br>
        <script type="text/javascript">
        $(document).ready(function(){
          $("#bcTarget").barcode('<?php echo $con.$row['IdPedido'] ?>', "ean13");
          window.print();
          window.close();
        });
        </script>
      <?php } ?>
      <div id="bcTarget">
      </div>
  </body>
</html>
