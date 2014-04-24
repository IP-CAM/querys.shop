<?php echo $header; ?>
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
      <h1><img src="view/image/category.png" alt="" /> <?php echo $heading_title; ?></h1>
      <div class="buttons"><a onclick="$('#form').submit();" class="button"><span><?php echo $button_save; ?></span></a><a onclick="location = '<?php echo $cancel; ?>';" class="button"><span><?php echo $button_cancel; ?></span></a></div>
      </div>
    <div class="content">
      
      
  	<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
      <table class="form">
        <tr>
          <td> <?php echo $entry_source; ?></td>
      	  <td><?php if ($source == 'youtube') { ?>
                  <input id="yout" type="radio" name="source" value="youtube" checked="checked"/> YouTube<br>
                  <input id="vime" type="radio" name="source" value="vimeo" /> Vimeo<br>
                  <?php } elseif ($source == 'vimeo') { ?>
                  <input id="yout" type="radio" name="source" value="youtube"/> YouTube<br>
                  <input id="vime" type="radio" name="source" value="vimeo" checked="checked"/> Vimeo<br>
                  <?php } else { ?>
                  <input id="yout" type="radio" name="source" value="youtube"/> YouTube<br>
                  <input id="vime" type="radio" name="source" value="vimeo"/> Vimeo<br> 
                  <?}?>
            </td>
        </tr>
       
        <tr id="youttr" style="display: none;">
          <td>YouTube URL:</td>
          <td>  <div><b>Enter YouTube Video ID or URL in the text box below</b><br/>
    <input type="text" id="youtubeDataFetcherInput" style="width: 380px;" value="<?php if($source=='youtube') echo $code; ?>" maxlength="200">
    <input type="button" value="Fetch Video Information" onClick="youtubeFetchData( );"></div></td>
        </tr>
        
         
        
        <tr id="vimetr" style="display: none;">
          <td>Vimeo URL:</td>
          <td>  <div><b>Enter Vimeo URL in the text box below - <span style="color: #666;">http://vimeo.com/xxxxxxxx</span></b><br/>
    <input type="text" id="vimeoDataFetcherInput" style="width: 380px;" value="<?php if($source=='vimeo') echo $code; ?>" maxlength="200">
    <input type="button" value="Fetch Video Information" onClick="getVimeoId();"></div>
</td>
        </tr> 
       

        <tr>
          <td><span class="required">*</span> <?php echo $entry_name; ?></td>
          <td><input id="name" name="name" value="<?php echo $name; ?>" size="100" />
            <?php if ($error_name) { ?>
            <span class="error"><?php echo $error_name; ?></span>
            <?php } ?></td>
        </tr>
        <tr>
          <td><?php echo $entry_description; ?></td>
          <td><textarea id="description"   name="description" cols="103" rows="10"><?php echo $description; ?></textarea></td>
        </tr>
        
        <tr>
          <td><?php echo $entry_image; ?></td>
          <td><input type="hidden" name="image" value="<?php echo $image; ?>" id="image" />
          <?php if($image != null ){ 
         			echo '<div id="preview"><a href="'.$code.'?>" target="_blank" ><img  src="'.$image.'" width="120" height="90" alt="" /></a></div>';
                 } 
                 else 
                 { 
                 echo '<div id="preview"><img  src="../image/no_image.jpg" width="120" height="90" alt="" /></div>';
                 } ?>
          
          
            </td>
        </tr>
        
        
        
        <tr style="display: none;">
          <td><input  name="code" value="<?php echo $code; ?>" id="code" /></td>
        </tr>
        
        <tr>
          <td><?php echo $entry_album; ?></td>
          <td><div class="scrollbox">
              <?php $class = 'even'; ?>
              <?php foreach ($albums as $album) { ?>
              <?php $class = ($class == 'even' ? 'odd' : 'even'); ?>
              <div class="<?php echo $class; ?>">
                <?php if (in_array($album['album_id'], $video_album)) { ?>
                <input type="checkbox" name="video_album[]" value="<?php echo $album['album_id']; ?>" checked="checked" />
                <?php echo $album['name']; ?>
                <?php } else { ?>
                <input type="checkbox" name="video_album[]" value="<?php echo $album['album_id']; ?>" />
                <?php echo $album['name']; ?>
                <?php } ?>
              </div>
              <?php } ?>
            </div></td>
        </tr>
        <tr>
          <td><?php echo $entry_sort_order; ?></td>
          <td><input name="sort_order" value="<?php echo $sort_order; ?>" size="1" /></td>
        </tr>
      </table>
    </form>
      
    </div>
  </div>
  
  <script type="text/javascript">
    
	function youtubeFetchData( )
    {
      var videoid = '';
      var tempvar = $( '#youtubeDataFetcherInput' ).attr( 'value' );
      if ( /^https?\:\/\/.+/i.test( tempvar ) )
      {
        tempvar = /[\?\&]v=([^\?\&]+)/.exec( tempvar );
        if ( ! tempvar )
        {
          alert( 'YouTube video URL has a problem!' );
          return;
        }
        videoid = tempvar[ 1 ];
      }
      else
      {
        if ( /^[A-Za-z0-9_\-]{8,32}$/.test( tempvar ) == false )
        {
          alert( 'YouTube video ID has a problem!' );
          return;
        }
        videoid = tempvar;
      }
      $.getScript( 'http://gdata.youtube.com/feeds/api/videos/' + encodeURIComponent( videoid ) + '?v=2&alt=json-in-script&callback=youtubeFetchDataCallback' );
    }
  
	function youtubeFetchDataCallback( data )
    {
      var n = '';
      n = data.entry[ "title" ].$t;
      $('#name').val(n).keyup();
	  
	  var d = '';
      d = data.entry[ "media$group" ][ "media$description" ].$t;
      $('#description').val(d).keyup();
	  
	  var i = '';
      i = '<a href="' + data.entry[ "media$group" ][ "media$player" ].url + '" target="_blank"><img src="' + data.entry[ "media$group" ][ "media$thumbnail" ][ 0 ].url + '" width="' + data.entry[ "media$group" ][ "media$thumbnail" ][ 0 ].width + '" height="' + data.entry[ "media$group" ][ "media$thumbnail" ][ 0 ].height + '" alt="Default Thumbnail"/></a>';
      $('#preview').html(i);
	  
	  var im = '';
      im = data.entry[ "media$group" ][ "media$thumbnail" ][ 0 ].url;
      $('#image').val(im).keyup();
	  
	  var c = '';
      c = data.entry[ "media$group" ][ "media$player" ].url;
      $('#code').val(c).keyup()
	 
    }
	
  </script>
 
<script type="text/javascript">  
  
function getVimeoId() {
 var tempvar = $( '#vimeoDataFetcherInput' ).attr( 'value' );
 
  if(tempvar.toLowerCase().indexOf('vimeo') > 0) {
    var re = new RegExp('/[0-9]+', "g");
    var match = re.exec(tempvar);
    if (match == null) {
       alert( 'Vimeo video ID has a problem!' );
          return;
    } else {
       videoid = match[0].substring(1);
	 
	   $.getJSON('http://www.vimeo.com/api/v2/video/' +videoid+ '.json?callback=?', {format: "json"}, function(data) {
          $('#name').val(data[0].title).keyup();
		 
		    var i = '';
            i = '<a href="' + data[0].url +' " target="_blank"><img src="' + data[0].thumbnail_medium + '" width="120" height="90" alt="Default Thumbnail"/></a>';
          $('#preview').html(i);
		  $('#image').val(data[0].thumbnail_medium).keyup();
		  $('#code').val(data[0].url).keyup();
		  
		  // Get the HTML and remove <br /> variants
		var htmlCleaned = (data[0].description).replace(/<br \/>/g, "\n");

		// Set the cleaned HTML
		$('#description').val(htmlCleaned);


// $('#description').val(data[0].description);
 
});

    }
  }
  return false;
}

 
</script> 
  
  
</div>
<script type="text/javascript" src="view/javascript/ckeditor/ckeditor.js"></script> 

<script type="text/javascript"><!--
function image_upload(field, preview) {
	$('#dialog').remove();
	
	$('#content').prepend('<div id="dialog" style="padding: 3px 0px 0px 0px;"><iframe src="index.php?route=common/filemanager&token=<?php echo $token; ?>&field=' + encodeURIComponent(field) + '" style="padding:0; margin: 0; display: block; width: 100%; height: 100%;" frameborder="no" scrolling="auto"></iframe></div>');
	
	$('#dialog').dialog({
		title: '<?php echo $text_image_manager; ?>',
		close: function (event, ui) {
			if ($('#' + field).attr('value')) {
				$.ajax({
					url: 'index.php?route=common/filemanager/image&token=<?php echo $token; ?>',
					type: 'POST',
					data: 'image=' + encodeURIComponent($('#' + field).val()),
					dataType: 'text',
					success: function(data) {
						$('#' + preview).replaceWith('<img src="' + data + '" alt="" id="' + preview + '" class="image" onclick="image_upload(\'' + field + '\', \'' + preview + '\');" />');
					}
				});
			}
		},	
		bgiframe: false,
		width: 700,
		height: 400,
		resizable: false,
		modal: false
	});
};
//--></script>

<script type="text/javascript"><!--
$('#yout').click(function() {
  $('#youttr').show(); 
  $('#vimetr').hide();
});

$('#vime').click(function() {
  $('#vimetr').show();
  $('#youttr').hide()
});
</script>


<?php echo $footer; ?>