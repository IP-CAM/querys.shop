<?php echo $header; ?>
<?php echo $column_left; ?>
<?php echo $column_right; ?>
<div class="breadcrumb">
  <?php foreach ($breadcrumbs as $breadcrumb) { ?>
  <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
  <?php } ?>
</div>
<div id="content"><?php echo $content_top; ?>
  <h1 style="margin-left:0px;">Transacción Fracasada</h1>
  <h2>OC Nº: <?php echo $tbk_orden_compra?></h2>
  <p>Las posibles causas de este rechazo son:</p>
  <ul>
  	<li>Error en el ingreso de los datos de su tarjeta de crédito (fecha y/o código de seguridad).</li>
  	<li>Su tarjeta de crédito o débito no cuenta con el cupo necesario para cancelar la compra.</li>
  	<li>Tarjeta aún no habilitada en el sistema financiero. </li>
  	<li>Si el problema persiste favor comunicarse con su Banco emisor.</li>
  </ul>
  <div class="buttons">
    <div class="right"><a href="<?php echo $continue; ?>" class="button"><?php echo $button_continue; ?></a></div>
  </div>
  <?php echo $content_bottom; ?>
</div>
<?php echo $footer; ?>
