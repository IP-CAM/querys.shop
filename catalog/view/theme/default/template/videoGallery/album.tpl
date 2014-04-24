<?php echo $header; ?><?php echo $column_left; ?><?php echo $column_right; ?>
<div id="content"><?php echo $content_top; ?>
  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div>
 
  <div class="box">
  <div class="box-heading"><?php echo $heading_title; ?></div>
  <div class="box-content">
  <?php if ($albums) { ?>
        <div class="album_sort">
          <div style="float: left;"><?php echo $text_sort; ?></div>
          <div style="float: left;">
            <select name="sort" onchange="location = this.value">
              <?php foreach ($sorts as $sorts) { ?>
              <?php if (($sort . '-' . $order) == $sorts['value']) { ?>
              <option value="<?php echo $sorts['href']; ?>" selected="selected"><?php echo $sorts['text']; ?></option>
              <?php } else { ?>
              <option value="<?php echo $sorts['href']; ?>"><?php echo $sorts['text']; ?></option>
              <?php } ?>
              <?php } ?>
            </select>
          </div>
        </div>
        <table class="table_album">
          <?php for ($i = 0; $i < sizeof($albums); $i = $i + 4) { ?>
          <tr>
            <?php for ($j = $i; $j < ($i + 4); $j++) { ?>
	            <td class="td_album">
	              <?php if (isset($albums[$j])) { ?>
	              <div class="album">
	              	<a href="<?php echo $albums[$j]['href']; ?>"><img  src="<?php echo $albums[$j]['thumb']; ?>" title="<?php echo $albums[$j]['name']; ?>" alt="<?php echo $albums[$j]['name']; ?>" /></a>
	              </div>
	              <a href="<?php echo $albums[$j]['href']; ?>" class="album_name"><?php echo $albums[$j]['name']; ?></a><br />
	              <p class="album_date_added"><?php echo $albums[$j]['date_added'][0]; ?></p>
	              <?php } ?>
	            </td>
            <?php } ?>
          </tr>
          <?php } ?>
        </table>
        <div class="pagination"><?php echo $pagination; ?></div>
        <?php } ?>
  </div>
</div>
 
  <?php echo $content_bottom; ?></div>
<?php echo $footer; ?>
