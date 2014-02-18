<?php echo $header; ?><?php echo $column_left; ?><?php echo $column_right; ?>
<style>
	#gmaps-canvas{
		width: 600px;
		height: 500px;
	}
	.map{
		float:left;
		margin-right:20px;
	}
	.basic-info{
		float:left;
		width:350px;
	}
	.list-item{
		float:left;
		width:340px;
	}
	.content-item{
		clear:both;
		margin-bottom:15px;
		border-bottom:1px solid #EEE;
		float:left;
		width:100%;
		padding-bottom:10px;
	}	
	.storelocation-image{
		margin-right:10px;
		float:left;
	}
	.storelocation-content{
	
	}
	.storelocation-content a{
		clear:both;
	}
	.storelocation-content .title{
		font-size:14px;
		margin-bottom:10px;
	}
	.detail{
		text-align:right;
		margin-top:10px;
		clear:both;
		display:block;
	}
	.list-map{
		width:600px;
		height:500px;
		float:right;
	}
	.pagination{
		margin-top:0;
		border:0;
	}
	.content-top{
		float:left;
		clear:both;
	}
	.content-bottom{
		clear:both;
		float:left;
		margin-top:20px;
		width:100%;
	}
	#gmaps-canvas img {max-width: none !important;} 
</style>
<div id="content"><?php echo $content_top; ?>
  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div>
  <h1><?php echo $heading_title; ?></h1>
  <?php if (isset($storelocation_info)) { ?>
	<script>
		$(document).ready(function(){
			loadDetailMap('gmaps-canvas', <?php echo $latitude;?>, <?php echo $longitude;?>, '<?php echo addslashes($heading_title); ?>', '<?php echo preg_replace("/(\r\n|\n|\r)/", "<br />", addslashes($address));?>');

			$('#find_direction').click(function(){
				var url = 'http://maps.google.com/maps';
				var saddress = $('#location_from').val();
				var daddress = <?php echo $latitude;?>+','+<?php echo $longitude;?>;
				urlRedirect = url+'?saddr='+encodeURIComponent(saddress)+'&daddr='+daddress;
				window.location.href = urlRedirect;
			});
		});
	</script>
    <div class="location-content">
		<div class="content-top">
			<div id="gmaps-canvas" class="map">
			
			</div>
			<div class="basic-info">
				<p><?php echo $entry_address;?>: <?php echo $address;?></p>
				<p><?php echo $entry_timing;?>: <?php echo $timing;?></p>
				<p><?php echo $entry_email;?>: <?php echo $email;?></p>
				<p><?php echo $entry_phone;?>: <?php echo $phone;?></p>
			</div>
			<div class="content-direction">
				<?php echo $entry_your_location;?>: <input type="text" name="location_from" id="location_from">&nbsp;&nbsp;<input type="button" id="find_direction" name="find_direction" value="<?php echo $button_direction;?>" class="button"/>
			</div>
		</div>
		<br /><br />
		<div class="content-bottom">
			<?php echo $content; ?>
		</div>
    </div>
    <div class="buttons">
      <div class="right"><a onclick="location='<?php echo $storelocation; ?>'" class="button"><span><?php echo $button_storelocation; ?></span></a></div>
    </div>
  <?php } elseif (isset($storelocation_data)) { ?>
	<?php if($storelocation_search_show & empty($tag_search)): ?>
    <form method="POST" id="search-location" action="<?php echo $form_search;?>">
		<?php echo $text_key;?>: <input type="text" name="key" id="gmaps-input-address" value="<?php echo $key_search; ?>"/>
		<input type="hidden" name="latitude" value="0"/>
		<input type="hidden" name="longitude" value="0"/>&nbsp;&nbsp;
		<?php echo $text_distance;?>: <input type="input" name="radius" value="<?php echo $radius; ?>"/> <?php echo $text_meter;?>
		<input type="submit" name="search" value="<?php echo $button_search; ?>" class="button"/><br /><br />
    </form>
	
	<?php endif ?>
	<div class="content">
		<div class="list-item">
			<?php foreach ($storelocation_data as $storelocation) { ?>
			  <div class="content-item">
				<?php if($storelocation['image']):?>
				  <img class="storelocation-image" src="<?php echo $storelocation['image'];?>" />
				<?php endif;?>
				<span class="storelocation-content">
				  <a href="<?php echo $storelocation['href']; ?>" class="title"><?php echo $storelocation['title']; ?></a><br/>
				  <?php echo $storelocation['address']; ?><br />
				</span>
				<a href="<?php echo $storelocation['href']; ?>" class="detail"><?php echo $text_read_more; ?></a>
			  </div>
			<?php } ?>
			<div class="pagination"><?php echo $pagination; ?></div>
		</div>
		<div id="gmaps-canvas" class="list-map"></div>
	</div>
	<script>
		$(document).ready(function(){
			<?php if(count($storelocation_data) <> 1):?>
				var marders = new Array();
				<?php $i = 0; ?>
				<?php foreach ($storelocation_data as $storelocation):?>
					marders[<?php echo $i;?>] = [<?php echo $storelocation["latitude"];?>,<?php echo $storelocation["longitude"];?>,'<?php echo addslashes($storelocation["title"]);?>',"<?php echo preg_replace("/(\r\n|\n|\r)/", "<br />", addslashes($storelocation["address"]));?>"];
					<?php
						if($i == 0){
							$latitude = $storelocation["latitude"];
							$longitude = $storelocation["longitude"];
						}
					?>
					<?php $i++; ?>
				<?php endforeach;?>
				loadMap('gmaps-canvas', <?php echo $latitude;?>, <?php echo $longitude;?>, marders);
			<?php else: ?>
				<?php foreach ($storelocation_data as $storelocation):?>
					loadDetailMap('gmaps-canvas', <?php echo $storelocation["latitude"];?>, <?php echo $storelocation["longitude"];?>, "<?php echo addslashes($storelocation["title"]);?>", "<?php echo preg_replace("/(\r\n|\n|\r)/", "<br />", addslashes($storelocation["address"]));?>");
				<?php endforeach;?>
			<?php endif ?>
		});
	</script>
	<br />
  <?php } else { ?>
	<form method="POST" id="search-location" action="<?php echo $form_search;?>">
		<?php echo $text_key;?>: <input type="text" name="key" id="gmaps-input-address" value="<?php echo isset($key_search)?$key_search:''; ?>"/>
		<input type="hidden" name="latitude" value="0"/>
		<input type="hidden" name="longitude" value="0"/>
		<?php echo $text_distance;?>: <input type="input" name="radius" value="<?php echo isset($radius)?$radius:200; ?>"/> <?php echo $text_meter;?>
		<input type="submit" name="search" value="<?php echo $button_search; ?>" class="button"/><br /><br />
    </form>
	<div id="gmaps-canvas" class="map" style="display:none;"></div>
  <?php } ?>
  <?php echo $content_bottom; ?>
</div>
<?php echo $footer; ?>
