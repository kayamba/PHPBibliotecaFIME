<!DOCTYPE html>
<?php
require "controller/solicitudes.php";
include_once("controller/validacion.php");
session_start();
acl($_SESSION['id'], $_SESSION['tipo'], "Cliente");

$user = isset($_SESSION['nick'])? $_SESSION['nick'] : "Anon";


$search = isset($_GET['search'])? $_GET['search']:"All";
$is_user = (isset($_SESSION["id"]));
$admin = ($_SESSION["tipo"] == "Admin");
if (isset($_GET["id"])) {
  if (($_GET["id"] == $_SESSION["id"]) OR ($_SESSION["tipo"] == "Admin")) {
    $result = getListRequisition($_GET["id"]);
  }else{
    $result = false;
  }
}else{
  $result = getAllRequisition();
}

?>
<html>
<head>
  <title>Biblioteca</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- CSS de Bootstrap -->
  <link href="css/bootstrap.css" rel="stylesheet" media="screen">
  <!-- librerias opcionales que activan el soporte de html5 en IE8-->
  <!--[if lt IE 9]-->
  <script src="js/html5shiv.js"></script>
  <script src="js/respond.min.js"></script>
  <!--[endif]-->
  <?php if(isset($_GET['print'])) {
    $url = "print.php?print=".$_GET['print'];
    ?>
    <script type="text/javascript">
    var ticket = window.open('<?php echo $url ?>');
    </script>
    <?php
  } ?>
</head>
<body>
  <div class="navbar navbar-inverse" role="navigation">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#menu-gmnet">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Biblioteca</a>
    </div>

    <div class="collapse navbar-collapse" id="menu-gmnet">
      <ul class="nav navbar-nav">
        <li><a href="list.php">Libros <span class="glyphicon glyphicon-sort-by-order"></span></a></li>
        <li><a href="search.php">Busqueda <span class="glyphicon glyphicon-search"></span></a></li>
        <?php if (isset($_SESSION["tipo"])): ?>
          <?php if ($_SESSION["tipo"] == "Admin"): ?>
            <li><a href="requisition.php">Solicitudes <span class="glyphicon glyphicon-sort-by-order"></span></a></li>
            <li><a href="clientes.php">Clientes <span class="glyphicon glyphicon-sort-by-order"></span></a></li>
            <li><a href="libros.php">Rentados <span class="glyphicon glyphicon-sort-by-order"></span></a></li>
            <li><a href="reportes.php">Reporte de Rentas <span class="glyphicon glyphicon-sort-by-order"></span></a></li>
          <?php else: ?>
            <li><a href="requisition.php?id=<?php echo $_SESSION['id'] ?>">Solicitudes <span class="glyphicon glyphicon-sort-by-order"></span></a></li>
          <?php endif ?>
        <?php endif ?>
      </ul>

      <ul class="nav navbar-nav navbar-right">
        <li>
          <form role="search" class="navbar-form" action="list.php" method="get">
            <div class="input-group">
              <span class="input-group-addon">Buscar:</span>
              <input id="search" name="search" type="text" class="form-control" placeholder="Introduce el titulo del libro"></input>
              <span class="input-group-btn">
                <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-search"></span></button>
              </span>
            </div>
          </form>
        </li>
        <li><a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"> <?php echo $user ?></span></a>
          <ul class="dropdown-menu">
            <?php if ($user == "Anon"): ?>
              <li><a href="account.php">Registrarme</a></li>
              <li><a href="login.php">Login</a></li>
            <?php else: ?>
              <li><a href="controller/logout.php">Salir</a></li>
            <?php endif ?>
          </ul>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-cog"></span></a>
          <ul class="dropdown-menu">
            <?php if (isset($_SESSION["tipo"])): ?>
              <?php if ($_SESSION["tipo"] == "Admin"): ?>
                <li><a href="new.php">Nuevo Libro <span class="glyphicon glyphicon-upload"></span></a></li>
                <li><a href="new_admin.php">Nuevo Adminsitrador <span class="glyphicon glyphicon-plus-sign"></span></a></li>
              <?php endif ?>
            <?php endif ?>
            <li class="divider"></li>
            <li><a href="about.html">Acerca de</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
  <div class="container">
    <div class="row show-grid">
      <div class="row">

        <!--Iteracion en PHP  -->
        <?php if ($is_user): ?>
          <?php if ($admin and !isset($_GET["id"])): ?>
            <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 col-md-offset-2 col-lg-offset-2">
            <table class="table table-responsive table-hover table-borderer">
              <thead>
                <th>
                  ID
                </th>
                <th>
                  User
                </th>
                <th>
                  Cantidad
                </th>
              </thead>
              <tbody>
                <?php while($row = $result->fetch_assoc()){ ?>
                  <tr>
                    <td>
                      <?php echo $row["IdUsuario"] ?>
                    </td>
                    <td>
                      <a href="requisition.php?id=<?php echo $row['IdUsuario'] ?>">
                      <?php echo $row["Nick"] ?>
                    </a>
                    </td>
                    <td class="cantidad">
                      <?php echo $row["Solicitudes"] ?>
                    </td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
            <?php else: ?>
              <?php
              while ($row = $result->fetch_assoc()) {
                ?>
                <div class="col-sm-6 col-md-2 col-lg-2 col-xs-6">
                  <div class="thumbnail">
                    <img src="<?php echo $row['URL'];?>" alt="<?php echo $row['Titulo']; ?>">
                  </div>
                  <div class="caption">
                    <h4 class="text-center"><?php echo $row['Titulo']; ?></h4>
                    <p><?php echo $row['Descripcion']; ?></p>
                    <p>
                      <?php if ($admin): ?>
                        <a href="controller/rentar.php?id=<?php echo $row['IdPedido']?>" class="btn btn-success">Entregar</a>
                      <?php endif ?>
                      <a href="controller/cancel.php?id=<?php echo $row['IdPedido']?>" class="btn btn-danger">Cancelar</a>
                    </p>
                  </div>
                </div>
                <?php
              }
              ?>
            <?php endif ?>
          <?php endif ?>
          <!-- Fin de Iteraciones -->

        </div>
      </div>
    </div>

    <!-- Libreria jQuery requerida por los plugins de Javascript -->
    <script src="http://code.jquery.com/jquery.js"></script>
    <!-- Todos los plugins JavaScript de Bootstrap (tambien puedes incluir archivos JavaScript individuales unicos plugins que utilices)-->
    <script src="js/bootstrap.min.js"></script>
    <script type="text/javascript">
    $('.confirmation').on('click', function () {
      return confirm('Estas seguro de eliminar el comic del inventario?');
    });
    </script>
  </body>
  </html>
