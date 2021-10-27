<nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
      <a class="navbar-brand" href="home.php">Servicio Tecnico</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">          
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="drop_ordenes" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Reparaciones</a>
            <div class="dropdown-menu" aria-labelledby="reparaciones">
              <a class="dropdown-item" href="ordenes-add.php">Nueva Orden de reparacion</a>
              <a class="dropdown-item" href="ordenes.php">Ordenes de reparacion</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="reparaciones.php">Reparaciones</a>              
            </div>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="drop_clientes" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Clientes</a>
            <div class="dropdown-menu" aria-labelledby="clientes.php">
              <a class="dropdown-item" href="clientes.php">Clientes</a>
              <a class="dropdown-item" href="clientes-add.php">Nuevo Cliente</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="clientes-pagos.php">Pagos de clientes</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="clientes-estados.php">Estados de clientes</a>
            </div>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="drop_equipos" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Equipos</a>
            <div class="dropdown-menu" aria-labelledby="reparaciones">
              <a class="dropdown-item" href="equipos.php">Equipos</a>
              <a class="dropdown-item" href="equipos-add.php">Nuevo Equipo</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="modelos.php">Modelos de equipos</a>
              <a class="dropdown-item" href="fallas.php">Fallas asociadas</a>
              <div class="dropdown-divider"></div>              
              <a class="dropdown-item" href="marcas.php">Marcas</a>
            </div>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="drop_proveedores" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Proveedores</a>
            <div class="dropdown-menu" aria-labelledby="reparaciones">
              <a class="dropdown-item" href="ordenes-add.php">Pedidos a proveedores</a>
              <a class="dropdown-item" href="ordenes.php">Pagos a proveedores</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="proveedores.php">Proveedores</a>
            </div>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Configuracion</a>
            <div class="dropdown-menu" aria-labelledby="Configuracion">
              <a class="dropdown-item" href="monedas.php">Monedas</a>
              <a class="dropdown-item" href="cond-fiscal">Condicion Fiscal</a>
              <a class="dropdown-item" href="listas.php">Listas de precios</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="localidades.php">Localidades</a>
              <a class="dropdown-item" href="partidos.php">Partidos</a>
              <a class="dropdown-item" href="provincias.php">Provincias</a>
            </div>
          </li>
        </ul>        
        <ul class="nav navbar-nav flex-row navbar-right"><!-- MENU USUARIO -->
              <?php if(isset($_SESSION["id_usuario"])){?>
                  <li class="nav-item dropdown">
                    <a href="#" class=" nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user"></i><?php echo " ".$_SESSION["nombre"]." (".$_SESSION["user"].")"; ?> <span class="caret"></span></a>
                    <div class="dropdown-menu">
                      <a class="dropdown-item" href="usuarios-edit.php"><i class="fa fa-user"></i> Mi cuenta</a>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="logout.php"><i class="fa fa-sign-out-alt"></i> Cerrar Sesion</a>
                    </div>
                  </li>
              <?php }else{?>
                  <li>
                    <button type="button" class="btn btn-outline-success my-2 my-sm-0" data-toggle="modal" data-target="#loginmodal" data-whatever=""><i class="fa fa-sing-in"></i> Acceder</button>
                  </li>
                  <li>
                    <a class="nav-link p-2"href="<?php echo "index.php?accion=usuarios-add"; ?>"  data-target="#registro">Registrarse</a>
                  </li>
              <?php }?>
            </ul><!-- END MENU USUARIO -->        
      </div>
    </nav>
    <div class="row" style="height: 60px;"></div>