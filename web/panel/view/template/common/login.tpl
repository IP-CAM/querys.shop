<?php echo $header_login; ?>
<!-- BEGIN LOGO -->
<div class="logo">
  <img src="assets/images/logo_querys_ltda.png" alt=""/>
</div>
<!-- END LOGO -->
<!-- BEGIN LOGIN -->
<div class="content">
  <!-- BEGIN LOGIN FORM -->
  <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
    <h3 class="form-title"><?php echo $text_login; ?></h3>
    <?php if ($success) { ?>
    <div class="alert alert-success">
        <button class="close" data-close="alert"></button>
        <span>
           <?php echo $success; ?>
        </span>
    </div>
    <?php } ?>
    <?php if ($error_warning) { ?>
      <div class="alert alert-danger">
        <button class="close" data-close="alert"></button>
        <span>
           <?php echo $error_warning; ?>
        </span>
      </div>
    <?php } ?>
    <div class="form-group">
      <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
      <label class="control-label visible-ie8 visible-ie9"><?php echo $entry_username; ?></label>
      <div class="input-icon">
        <i class="fa fa-user"></i>
        <input class="form-control placeholder-no-fix" type="text" autocomplete="off" value="<?php echo $username; ?>" placeholder="<?php echo $entry_username; ?>" name="username"/>
      </div>
    </div>
    <div class="form-group">
      <label class="control-label visible-ie8 visible-ie9"><?php echo $entry_password; ?></label>
      <div class="input-icon">
        <i class="fa fa-lock"></i>
        <input class="form-control placeholder-no-fix" type="password" autocomplete="off" value="<?php echo $password; ?>" placeholder="<?php echo $entry_password; ?>" name="password"/>
      </div>
    </div>
    <div class="form-actions">
      <label class="checkbox"></label>
      <button type="submit" class="btn blue pull-right">
      <?php echo $button_login; ?> <i class="m-icon-swapright m-icon-white"></i>
      </button>
    </div>
    <?php if ($forgotten) { ?>
    <div class="forget-password">
      <h4><?php echo $text_forgotten; ?></h4>
      <p>No te preocupes haz clic <a href="<?php echo $forgotten; ?>" id="forget-password">aquí</a>
        para resetear tu clave.
      </p>
    </div>
    <?php } ?>
  </form>
  <!-- END LOGIN FORM -->

<?php echo $footer_login; ?>