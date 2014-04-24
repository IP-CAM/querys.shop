<?php echo $header_login; ?>
<!-- BEGIN LOGO -->
<div class="logo">
  <img src="assets/img/logo-big.png" alt=""/>
</div>
<!-- END LOGO -->
<div class="content">
  <?php if ($error_warning) { ?>
  <div class="alert alert-danger">
    <button class="close" data-close="alert"></button>
    <span>
       <?php echo $error_warning; ?>
    </span>
  </div>
  <?php } ?>
  <!-- BEGIN FORGOT PASSWORD FORM -->
  <form class="forget-form" action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="forgotten" novalidate="novalidate" >
    <h3><img src="view/image/user.png" alt="" /><?php echo $heading_title; ?></h3>
    <p>
       <?php echo $text_email; ?>
    </p>
    <div class="form-group">
      <div class="input-icon">
        <i class="fa fa-envelope"></i>
        <input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="<?php echo $entry_email; ?>" value="<?php echo $email; ?>" name="email"/>

        <!-- <input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Email" name="email"> -->
      </div>
    </div>
    <div class="form-actions">
      <a href="<?php echo $cancel; ?>" type="button" class="btn"><i class="m-icon-swapleft"></i> <?php echo $button_cancel; ?></a>
      <button type="submit" class="btn blue pull-right">
      <?php echo $button_reset; ?> <i class="m-icon-swapright m-icon-white"></i>
      </button>
    </div>
  </form>
  <!-- END FORGOT PASSWORD FORM -->
</div>
<?php echo $footer_login; ?>