 <nav class="navbar navbar-default">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
          data-target="#bs-example-navbar-collapse-1">
            <span class="sr-only"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="inicio.php" id="logo">
            <img id="logo" src="img/logo.png" alt=""></a>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav">
              <li>
              <a href="#"><span class="badge">42</span>Ver Ticket's</a>
            </li>
            <li>
              <a href="inicio.php">Inicio <span class="sr-only">(current)</span></a>
            </li>
            
            <li>
              <a href="solicitud.php">Crear Ticket</a>
            </li>
            
          </ul>
          <form class="navbar-form navbar-left" role="search">
            <div class="form-group">
              <input type="text" class="form-control" placeholder="Buscar # Ticket">
            </div>
            <button type="submit" class="btn btn-default">Buscar</button>
          </form>
          <ul class="nav navbar-nav navbar-right">
            <li>
              <a href="#">Manuales <span class="sr-only">(current)</span></a>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
              aria-expanded="false">Opciones<span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li>
                    <a id="crea_usuario"  href="Usuarios.php">Crear Usuario</a>
                </li>
                <li>
                  <a href="Usuarios.php">Modificar Usuario</a>
                </li>
                                <li class="divider"></li>
                <li>
                  <a href="#">Cerrar Sesión</a>
                </li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </nav>