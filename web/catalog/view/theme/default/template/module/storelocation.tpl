<?php if ($storelocation) { ?>
<div class="box">
  <div class="box-heading"><?php echo $heading_title;?></div>
  <div class="box-content">
    <?php
      foreach ($storelocation as $storelocation_story) { 
    ?>
     	<div class="storelocation-item" style="clear:both;margin:5px;">
        <?php if($show_headline && $storelocation_story['image']):?>
          <img class="storelocation-image" style="float:left;margin-right:5px;" src="<?php echo $storelocation_story['image'];?>" />
        <?php endif;?>
        <?php if ($show_headline) { ?>
        <a href="<?php echo $storelocation_story['href']; ?>"><span class="title"><?php echo $storelocation_story['title']; ?></span></a>
        <br />
        <?php } ?>
        <?php if ($show_description) { ?>
        <p class="description"><?php echo $storelocation_story['address']; ?></p><br/>
		<hr/>
        <?php }?>
      </div>
    <?php
    } ?>
  </div>
</div>
<?php } ?>