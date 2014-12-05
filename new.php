<!DOCTYPE html>
<?php
include_once("controller/validacion.php");
session_start();
acl($_SESSION['id'], $_SESSION['tipo'], "Admin");
$user = isset($_SESSION['nick'])? $_SESSION['nick'] : "Anon";
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
      <form role="form" action="controller/new.php" method="post" enctype="multipart/form-data">
        <div class="form-group col-md-6 col-md-offset-3">
          <label for="titulo">Titulo: </label>
          <input id="titulo" name="titulo" type="text" class="form-control" placeholder="Titulo"></input>
        </div>
        <div class="form-group col-md-6 col-md-offset-3">
          <label for="tipo">Categoria: </label>
          <input id="tipo" name="tipo" type="text" class="form-control" placeholder="Tipo"></input>
        </div>
        <div class="form-group col-md-6 col-md-offset-3">
          <label for="editorial">Editorial: </label>
          <input id="editorial" name="editorial" type="text" class="form-control" placeholder="Editorial"></input>
        </div>
        <div class="form-group col-md-6 col-md-offset-3">
          <label for="autor">Autor: </label>
          <input id="autor" name="autor" type="text" class="form-control" placeholder="Autor"></input>
        </div>
        <div class="form-group col-md-6 col-md-offset-3">
          <label for="cantidad">Disponibilidad: </label>
          <input id="cantidad" name="cantidad" type="number" class="form-control" placeholder="Disponibilidad"></input>
        </div>
        <div class="form-group col-md-6 col-md-offset-3">
          <label for="descripcion">Descripcion: </label>
          <textarea id="descripcion" name="descripcion"class="form-control" placeholder="Descripcion"></textarea>
        </div>
        <div class="form-group col-md-6 col-md-offset-3">
          <label for="image">Portada: </label>
          <input id="image" name="image" type="file"></input>
          <p class="help-block">Selecciona la portada.</p>
        </div>
        <div class="col-md-2 col-md-offset-5">
          <button type="submit" class="btn btn-default">Guardar</button>
        </div>
      </form>
    </div>
  </div>

  <!-- Libreria jQuery requerida por los plugins de Javascript -->
  <script src="http://code.jquery.com/jquery.js"></script>
  <!-- Todos los plugins JavaScript de Bootstrap (tambien puedes incluir archivos JavaScript individuales unicos plugins que utilices)-->
  <script src="js/bootstrap.min.js"></script>
</body>
</html>
