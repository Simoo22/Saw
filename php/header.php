<nav class="navbar navbar-expand-lg navbar-light" >
  <a class="navbar-brand" href="/index.php">
    <img src="/images/logo.png" width="180" height="70" alt="Logo">
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="/index.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Chi siamo?</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Dropdown
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
      </li>
    </ul>

    <ul class="navbar-nav navbar-right">
      <li class="nav-item"><a class="nav-link" href="/php/form/formRegistrazione.php">Registrati</a></li>
      <li class="nav-item dropdown">
        <a class="nav-link" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Accedi
        </a>
        <div class="dropdown-menu dropdown-menu-right">
          <form class="px-4 py-3"  action="/php/form/login.php" method="POST">
            <div class="form-group">
              <label for="email">Email</label>
              <input type="email" class="form-control" name="email" placeholder="email@example.com" >
            </div>
            <div class="form-group">
              <label for="pass">Password</label>
              <input type="password" class="form-control" name="pass" placeholder="Password">
              <a href="#"><small>Password dimenticata?</small></a>
            </div>
            <div class="form-check">
              <input type="checkbox" class="form-check-input" id="dropdownCheck2">
              <label class="form-check-label" for="dropdownCheck2">Remember me</label>
              <div class="dropdown-divider"></div>
            </div>
            <div class="row justify-content-center">
              <div class="dropdown-item">
                <a href="/php/form/formRegistrazione.php">Sei nuovo qui? Registrati!</a>
              </div>
              <button type="submit" class="btn btn-primary" value="Submit">Accedi</button>
            </div>
          </form>
        </div>
      </li>
    </ul>
  </div>
</nav>
