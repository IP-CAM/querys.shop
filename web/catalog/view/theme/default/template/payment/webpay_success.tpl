<?php echo $header; ?><?php //echo $column_left; ?><?php // echo $column_right; ?>
<div id="content">
  <div class="container">
  <?php echo $content_top; ?>
<!--
  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div>
-->

<!-- -->
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
        
        <p>En caso de <b>requerir devoluciones</b> o <b>reembolsos</b> favor de contactar al teléfono +56 2 29233302 o al mail <b><a href="mailto: contactocat@forus.cl">contactocat@forus.cl</a></b>
 
  <!-- -->

<!-- -->
        <br/>
        <br/>
        <h2>Plazos de Entrega</h2>
        <table border="0" cellpadding="4" cellspacing="0" style="border-collapse: collapse; width: 95%;font-size: 12;color: #383838;margin: 0 auto;" width="498">
          <colgroup>
            <col style="width: 158pt;" width="211">
            <col span="2" style="width: 60pt;" width="80">
            <col style="width: 95pt;" width="127">
          </colgroup>
          <tbody>
            <tr height="15" style="height: 11.25pt;">
              <td colspan="4" height="15" style="height: 11.25pt;">Si realizaste tu compra antes de las 13:00 de un día hábil, entonces recibirás tu(s) producto(s) en los días</td>
            </tr>
            <tr height="15" style="height: 11.25pt;">
              <td colspan="4" height="15" style="height: 11.25pt;">hábiles indicados en la siguiente tabla. Si realizaste la compra después de las 13:00, entonces debes</td>
            </tr>
            <tr height="15" style="height: 11.25pt;">
              <td colspan="2" height="15" style="height: 11.25pt;">sumarle un día hábil adicional a lo indicado en la tabla.</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr height="15" style="height: 11.25pt;">
              <td height="15" style="height: 11.25pt;">&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr height="15" style="height: 11.25pt;">
              <td colspan="4" height="15" style="height: 11.25pt;">Ejemplo 1: Si compraste un lunes a las 16:00 con destino a la Araucanía, recibirás tu compra el jueves o viernes.</td>
            </tr>
            <tr height="15" style="height: 11.25pt;">
              <td colspan="4" height="15" style="height: 11.25pt;">Ejemplo 2: Si compraste un lunes a las 11:00 con destino a la Araucanía, recibirás tu compra el miércoles o jueves.</td>
            </tr>
            <tr height="15" style="height: 11.25pt;">
              <td height="15" style="height: 11.25pt;">&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr height="15" style="height: 11.25pt;background: #F3F3F3;font-weight: bold;">
              <td height="15" style="height: 11.25pt;">REGIÓN</td>
              <td>DOMICILIO</td>
              <td>CITYBOX</td>
              <td>SUCURSAL CORREOS CHILE</td>
            </tr>
            <tr height="15" style="height: 11.25pt;">
              <td height="15" style="height: 11.25pt;">Arica y Parinacota</td>
              <td>5-7</td>
              <td>-</td>
              <td>5-7</td>
            </tr>
            <tr height="15" style="height: 11.25pt;background: #F3F3F3;">
              <td height="15" style="height: 11.25pt;">Tarapacá</td>
              <td>4-6</td>
              <td>-</td>
              <td>4-6</td>
            </tr>
            <tr height="15" style="height: 11.25pt;">
              <td height="15" style="height: 11.25pt;">Antofagasta</td>
              <td>4-5</td>
              <td>-</td>
              <td>4-5</td>
            </tr>
            <tr height="15" style="height: 11.25pt;background: #F3F3F3;">
              <td height="15" style="height: 11.25pt;">Atacama</td>
              <td>3-4</td>
              <td>-</td>
              <td>3-4</td>
            </tr>
            <tr height="15" style="height: 11.25pt;">
              <td height="15" style="height: 11.25pt;">Coquimbo</td>
              <td>2-3</td>
              <td>-</td>
              <td>2-3</td>
            </tr>
            <tr height="15" style="height: 11.25pt;background: #F3F3F3;">
              <td height="15" style="height: 11.25pt;">Valparaíso</td>
              <td>2-3</td>
              <td>-</td>
              <td>2-3</td>
            </tr>
            <tr height="15" style="height: 11.25pt;">
              <td height="15" style="height: 11.25pt;">Libertador General Bernardo O'Higgins</td>
              <td>2-3</td>
              <td>-</td>
              <td>2-3</td>
            </tr>
            <tr height="15" style="height: 11.25pt;background: #F3F3F3;">
              <td height="15" style="height: 11.25pt;">Maule</td>
              <td>2-3</td>
              <td>-</td>
              <td>2-3</td>
            </tr>
            <tr height="15" style="height: 11.25pt;">
              <td height="15" style="height: 11.25pt;">Bio Bio</td>
              <td>2-3</td>
              <td>-</td>
              <td>2-3</td>
            </tr>
            <tr height="15" style="height: 11.25pt;background: #F3F3F3;">
              <td height="15" style="height: 11.25pt;">Araucanía</td>
              <td>2-3</td>
              <td>-</td>
              <td>2-3</td>
            </tr>
            <tr height="15" style="height: 11.25pt;">
              <td height="15" style="height: 11.25pt;">Los Ríos</td>
              <td>3-4</td>
              <td>-</td>
              <td>3-4</td>
            </tr>
            <tr height="15" style="height: 11.25pt;background: #F3F3F3;">
              <td height="15" style="height: 11.25pt;">Los Lagos</td>
              <td>4-6</td>
              <td>-</td>
              <td>4-6</td>
            </tr>
            <tr height="15" style="height: 11.25pt;">
              <td height="15" style="height: 11.25pt;">Aisén del General Carlos Ibáñez del Campo</td>
              <td>11-13</td>
              <td>-</td>
              <td>11-13</td>
            </tr>
            <tr height="15" style="height: 11.25pt;background: #F3F3F3;">
              <td height="15" style="height: 11.25pt;">Magallanes y la Antártica Chilena</td>
              <td>14-16</td>
              <td>-</td>
              <td>14-16</td>
            </tr>
            <tr height="15" style="height: 11.25pt;">
              <td height="15" style="height: 11.25pt;">Región Metropolitana</td>
              <td>1-2</td>
              <td>1-2</td>
              <td>1-2</td>
            </tr>
          </tbody>
        </table>
  <?php echo $content_bottom; ?>
  <script type="text/javascript">
    var fb_param = {};
    fb_param.pixel_id = '6012081131839';
    fb_param.value = '0.00';
    fb_param.currency = 'USD';
    (function(){
      var fpw = document.createElement('script');
      fpw.async = true;
      fpw.src = '//connect.facebook.net/en_US/fp.js';
      var ref = document.getElementsByTagName('script')[0];
      ref.parentNode.insertBefore(fpw, ref);
    })();
    </script>
  <noscript><img height="1" width="1" alt="" style="display:none" src="https://www.facebook.com/offsite_event.php?id=6012081131839&amp;value=0&amp;currency=USD" /></noscript>

</div>
</div>
<?php echo $footer; ?>
