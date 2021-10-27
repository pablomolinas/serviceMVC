

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

    <!-- Custom styles for this template -->
    <link href="signin.css" rel="stylesheet">
  <div class="container-fluid">
      <div class="row justify-content-center">
          <div class="col-6 align-self-center text-center">
            <form class="form-signin" method="post">                
                <h1 class="h3 mb-3 font-weight-normal">Servicio Tecnico</h1>
                <h4 class="h3 mb-3 font-weight-normal">Inicio de sesion</h4>
                <label for="inputEmail" class="sr-only">Email address</label>
                <input type="text" id="user" name="user" class="form-control" placeholder="Ingresa usuario" required autofocus>
                <label for="inputEmailPassword" class="sr-only">Password</label>
                <input type="password" id="pass" name="pass" class="form-control" placeholder="Password" required>
                <div class="checkbox mb-3">
                 
                </div>
                <input type="hidden" name="enviar" value="">
                <button class="btn btn-lg btn-primary btn-block" type="submit">Iniciar</button>
                <p class="mt-5 mb-3 text-muted">&copy; 2019</p>
            </form>
            <?php echo $this->info; ?>
          </div>
      </div>
  </div>
