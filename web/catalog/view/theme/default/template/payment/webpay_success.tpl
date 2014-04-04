<?php echo $header; ?><?php echo $column_left; ?><?php echo $column_right; ?>
<div id="content">
  <div class="container">
    <?php echo $content_top; ?>
    <div class="breadcrumb">
      <?php foreach ($breadcrumbs as $breadcrumb) { ?>
      <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
      <?php } ?>
    </div>
    <h1><?php echo $text_heading_title; ?></h1>
    <!-- Comprobante de compra -->
    <ul>
      <li><strong><?php echo $text_nombre_comercio?></strong> <?php echo $nombre_comercio?></li>
      <li><strong><?php echo $text_url_comercio?></strong> <?php echo $url_comercio?></li>
      <li><strong><?php echo $text_nombre?></strong><?php echo $nombre?></li>
      <li><strong><?php echo $text_fecha_transaccion?></strong> <?php echo $fecha_transaccion; ?></li>
      <li><strong><?php echo $text_tipo_transaccion?></strong> <?php echo $tipo_transaccion?></li>
      <li><strong><?php echo $text_codigo_autorizacion?></strong><?php echo $codigo_autorizacion; ?> </li>
      <li><strong><?php echo $text_numero_tarjeta?></strong>XXXXXXXXXXXX-<?php echo $numero_tarjeta; ?> </li>
      <li><strong><?php echo $text_numero_orden_pedido?></strong><?php echo $numero_orden_pedido;?></li>
      <li><strong><?php echo $text_cantidad_cuotas?></strong> 0<?php echo $cantidad_cuotas; ?> </li>        
      <li><strong><?php echo $text_tipo_cuotas?></strong> <?php echo $vn; ?></li>
      <li><strong>Tipo Pago: </strong> <?php echo $tipo_pago; ?></li>
    </ul>
      <br />
      <h2>Detalle de Compra</h2>
      <div class="checkout-product">
        <table>
          <thead>
            <tr>
              <td class="name"><?php echo $column_name; ?></td>
              <td class="model"><?php echo $column_model; ?></td>
              <td class="quantity"><?php echo $column_quantity; ?></td>
              <td class="price"><?php echo $column_price; ?></td>
              <td class="total"><?php echo $column_total; ?></td>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($products as $product) { ?>
            <tr>
              <td class="name"><a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a>
                <?php foreach ($product['option'] as $option) { ?>
                <br />
                &nbsp;<small> - <?php echo $option['name']; ?>: <?php echo $option['value']; ?></small>
                <?php } ?></td>
              <td class="model"><?php echo $product['model']; ?></td>
              <td class="quantity"><?php echo $product['quantity']; ?></td>
              <td class="price"><?php echo $product['price']; ?></td>
              <td class="total"><?php echo $product['total']; ?></td>
            </tr>
            <?php } ?>
          </tbody>
          <tfoot>
            <?php foreach ($totals as $total) { ?>
            <tr>
              <td colspan="4" class="price"><b><?php echo $total['title']; ?>:</b></td>
              <td class="total"><?php echo $total['text']; ?></td>
            </tr>
            <?php } ?>
          </tfoot>
        </table> 
      </div>
      <p>En caso de <b>requerir devoluciones</b> o <b>reembolsos</b> favor de contactar al teléfono <?php echo $this->config->get('config_telephone');?> o al mail <b><a href="mailto: <?php echo $this->config->get('config_email');?>"><?php echo $this->config->get('config_email');?></a></b>
    <?php echo $content_bottom; ?>
  </div>
</div>
<?php echo $footer; ?>
