<div id="back">

</div>

<div class="login-box">

  <!-- /.login-logo -->
  <div class="login-box-body">
    <div class="login-logo">
      <img src="vistas/img/plantilla/logo-negro-bloque.png" class="img-responsive" style="padding: 40px 40px 0px 40px">
    </div>

    <form method="post">
      <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="Usuario" name="ingUsuario" required>
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Contraseña" name="ingPassword" required>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>

      <div class="row">
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Ingresar</button>
        </div>
      </div>

      <?php
        $login = new ControladorUsuarios();
        $login -> ctrIngresoUsuario();
      ?>
    </form>

  </div>
</div>
