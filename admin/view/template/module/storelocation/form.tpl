<?php echo $header; ?>
<script type="text/javascript" src="https://maps.google.com/maps/api/js?sensor=false"></script>
	
<div id="content">
  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div>
  <?php if ($error_warning) { ?>
  <div class="warning"><?php echo $error_warning; ?></div>
  <?php } ?>
  <div class="box">
    <div class="heading">
      <h1><img src="view/image/information.png" alt="" /> <?php echo $heading_title; ?></h1>
      <div class="buttons"><a onclick="$('#form').submit();" class="button"><span><?php echo $button_save; ?></span></a><a onclick="location = '<?php echo $cancel; ?>';" class="button"><span><?php echo $button_cancel; ?></span></a></div>
    </div>
    <div class="content">
      <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
		<div style="display:none">
			<label for="latitude">Latitude</label><input name="latitude" id="latitude" type="hidden" value="<?php echo $latitude;?>" />
		</div>
		<div style="display:none">
			<label for="longitude">Longitude</label><input name="longitude" id="longitude" type="hidden" value="<?php echo $longitude;?>" />			
		</div>
        <div id="tab_general">
          <div id="languages" class="htabs">
            <?php foreach ($languages as $language) { ?>
            <a href="#language<?php echo $language['language_id']; ?>"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?></a>
            <?php } ?>
          </div>
          <?php foreach ($languages as $language) { ?>
          <div id="language<?php echo $language['language_id']; ?>">
            <table class="form">
              <tr>              
                <td><span class="required">*</span> <?php echo $entry_title; ?></td>
                <td><input name="storelocation_description[<?php echo $language['language_id']; ?>][title]" value="<?php echo isset($storelocation_description[$language['language_id']]) ? $storelocation_description[$language['language_id']]['title'] : ''; ?>" />
                  <?php if (isset($error_title[$language['language_id']])) { ?>
                  <span class="error"><?php echo $error_title[$language['language_id']]; ?></span>
                  <?php } ?></td>
              </tr>
              <tr>
                <td><?php echo $entry_address; ?></td>
                <td><textarea name="storelocation_description[<?php echo $language['language_id']; ?>][address]" cols="40" rows="5"><?php echo isset($storelocation_description[$language['language_id']]) ? $storelocation_description[$language['language_id']]['address'] : ''; ?></textarea></td>
              </tr>
              <tr>
                <td><span class="required">*</span> <?php echo $entry_description; ?></td>
                <td><textarea name="storelocation_description[<?php echo $language['language_id']; ?>][description]" id="description<?php echo $language['language_id']; ?>"><?php echo isset($storelocation_description[$language['language_id']]) ? $storelocation_description[$language['language_id']]['description'] : ''; ?></textarea>
                  <?php if (isset($error_description[$language['language_id']])) { ?>
                  <span class="error"><?php echo $error_description[$language['language_id']]; ?></span>
                  <?php } ?></td>
              </tr>
			  <tr>              
                <td><span class="required">*</span> <?php echo $entry_timing; ?></td>
                <td><input name="storelocation_description[<?php echo $language['language_id']; ?>][timing]" value="<?php echo isset($storelocation_description[$language['language_id']]) ? $storelocation_description[$language['language_id']]['timing'] : ''; ?>" />
                  <?php if (isset($error_timing[$language['language_id']])) { ?>
                  <span class="error"><?php echo $error_timing[$language['language_id']]; ?></span>
                  <?php } ?></td>
              </tr>
            </table>
          </div>
          <?php } ?>
        </div>
        <div id="tab_data">
          <table class="form">
            <tr>
              <td><?php echo $entry_keyword; ?></td>
              <td><input type="text" name="keyword" value="<?php echo $keyword; ?>" /></td>
            </tr>
            <tr>
              <td><?php echo $entry_store; ?></td>
              <td><div class="scrollbox">
                  <?php $class = 'even'; ?>
                  <div class="<?php echo $class; ?>">
                    <?php if (in_array(0, $storelocation_store)) { ?>
                    <input type="checkbox" name="storelocation_store[]" value="0" checked="checked" />
                    <?php echo $text_default; ?>
                    <?php } else { ?>
                    <input type="checkbox" name="storelocation_store[]" value="0" />
                    <?php echo $text_default; ?>
                    <?php } ?>
                  </div>
                  <?php foreach ($stores as $store) { ?>
                  <?php $class = ($class == 'even' ? 'odd' : 'even'); ?>
                  <div class="<?php echo $class; ?>">
                    <?php if (in_array($store['store_id'], $storelocation_store)) { ?>
                    <input type="checkbox" name="storelocation_store[]" value="<?php echo $store['store_id']; ?>" checked="checked" />
                    <?php echo $store['name']; ?>
                    <?php } else { ?>
                    <input type="checkbox" name="storelocation_store[]" value="<?php echo $store['store_id']; ?>" />
                    <?php echo $store['name']; ?>
                    <?php } ?>
                  </div>
                  <?php } ?>
                </div>
			  </td>
            </tr>
            <tr>
              <td><?php echo $entry_feature; ?></td>
              <td><select name="feature_flag">
                  <?php if ($status) { ?>
                  <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                  <option value="0"><?php echo $text_disabled; ?></option>
                  <?php } else { ?>
                  <option value="1"><?php echo $text_enabled; ?></option>
                  <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                  <?php } ?>
                </select></td>
            </tr>
            <tr>
              <td><?php echo $entry_status; ?></td>
              <td><select name="status">
                  <?php if ($status) { ?>
                  <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                  <option value="0"><?php echo $text_disabled; ?></option>
                  <?php } else { ?>
                  <option value="1"><?php echo $text_enabled; ?></option>
                  <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                  <?php } ?>
                </select></td>
            </tr>
            <tr>
              <td><?php echo $entry_image; ?></td>
              <td valign="top"><div class="image"><img src="<?php echo $thumb; ?>" alt="" id="thumb" />
                <input type="hidden" name="image" value="<?php echo $image; ?>" id="image" />
                <br /><a onclick="image_upload('image', 'thumb');"><?php echo $text_browse; ?></a>&nbsp;&nbsp;|&nbsp;&nbsp;<a onclick="$('#thumb').attr('src', '<?php echo $no_image; ?>'); $('#image').attr('value', '');"><?php echo $text_clear; ?></a></div></td>
            </tr>
			<tr>
              <td><?php echo $entry_email; ?></td>
              <td><input type="text" name="email" value="<?php echo $email; ?>" /></td>
            </tr>
			<tr>
              <td><?php echo $entry_phone; ?></td>
              <td><input type="text" name="phone" value="<?php echo $phone; ?>" /></td>
            </tr>
			<tr>
				<td>
					<?php echo $entry_map;?>
				</td>
				<td>
					<div class="row">
					   <div id="map_canvas" style="width:600px; height:500px;position:relative;z-index:999;overflow:auto;"></div>
					</div>
				</td>
			</tr>
          </table>
        </div>
      </form>
    </div>
  </div>
</div>
<script type="text/javascript" src="view/javascript/ckeditor/ckeditor.js"></script> 
<script type="text/javascript"><!--
<?php $defaultLang = ''; 
	foreach ($languages as $language) { 
		if($defaultLang == ''){ $defaultLang = $language['language_id'];}
?>
CKEDITOR.replace('description<?php echo $language['language_id']; ?>', {
	filebrowserBrowseUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
	filebrowserImageBrowseUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
	filebrowserFlashBrowseUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
	filebrowserUploadUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
	filebrowserImageUploadUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
	filebrowserFlashUploadUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>'
});
<?php } ?>
//--></script>
<script type="text/javascript"><!--
function image_upload(field, thumb) {
	$('#dialog').remove();

	$('#content').prepend('<div id="dialog" style="padding: 3px 0px 0px 0px;"><iframe src="index.php?route=common/filemanager&token=<?php echo $token; ?>&field=' + encodeURIComponent(field) + '" style="padding:0; margin: 0; display: block; width: 100%; height: 100%;" frameborder="no" scrolling="auto"></iframe></div>');

	$('#dialog').dialog({
		title: '<?php echo $text_image_manager; ?>',
		close: function (event, ui) {
			if ($('#' + field).attr('value')) {
				$.ajax({
					url: 'index.php?route=common/filemanager/image&token=<?php echo $token; ?>&image=' + encodeURIComponent($('#' + field).val()),
					dataType: 'text',
					success: function(data) {
						$('#' + thumb).replaceWith('<img src="' + data + '" alt="" id="' + thumb + '" />');
					}
				});
			}
		},	
		bgiframe: false,
		width: 800,
		height: 400,
		resizable: false,
		modal: false
	});
};
//--></script> 
<script type="text/javascript"><!--
$('#tabs a').tabs(); 
$('#languages a').tabs();
var marker = null;
var map;

$(document).ready(function() {
	<?php if(!empty($latitude) && !empty($longitude)):?>
		initialize();
	<?php else:?>
	initialize();
	$('textarea[name="storelocation_description[<?php echo $defaultLang;?>][address]"]').focusout(function() {
		var key = $('textarea[name="storelocation_description[<?php echo $defaultLang;?>][address]"]').val();
		if(key.length > 0){
			var geocoder = new google.maps.Geocoder();
			geocoder.geocode({ 'address': key}, function(results, status)  {
				if (status == google.maps.GeocoderStatus.OK)  {
					map.setCenter(results[0].geometry.location);
					map.setZoom(10);
				}
			});
		}
	});
	<?php endif;?>
});

function initialize() {
	var latlng = new google.maps.LatLng(<?php echo !empty($latitude)?$latitude:33.5207;?>, <?php echo !empty($longitude)?$longitude:-86.8025;?>);
	var settings = {
		zoom: 15,
		center: latlng,
		mapTypeControl: true,
		mapTypeControlOptions: {style: google.maps.MapTypeControlStyle.DROPDOWN_MENU},
		navigationControl: true,
		navigationControlOptions: {style: google.maps.NavigationControlStyle.SMALL},
		mapTypeId: google.maps.MapTypeId.ROADMAP
	};

	map = new google.maps.Map(document.getElementById("map_canvas"), settings);
	
	<?php
	if(!empty($latitude) && !empty($longitude)):
	?>
		var companyPos = new google.maps.LatLng(<?php echo $latitude;?>, <?php echo $longitude;?>);
		marker = new google.maps.Marker({
		  position: companyPos,
		  map: map,
		  draggable: true
		});
		google.maps.event.addListener(marker, 'dragend', function(){
			addLocation();
		});
	<?php else: ?>
		google.maps.event.addListener(map, "click", function(event) {
		  if (marker != null) {
			marker.setMap(null);
			marker = null;
		  } else {
			  marker = new google.maps.Marker({
				position: event.latLng,
				map: map,
				draggable: true
			  });

			  addLocation();

			  google.maps.event.addListener(marker, 'dragend', function(){
				addLocation();
			  });
		  }
		});
	<?php
	endif;
	?>
}

function addLocation()
{
	var latlng = marker.getPosition();

	$('#latitude').val(latlng.lat());
	$('#longitude').val(latlng.lng());

	return false;
}

function removeLocation()
{
	marker.setMap(null);
	return false;
}
//--></script> 
<?php echo $footer; ?>
