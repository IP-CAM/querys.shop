<?php echo $header; ?>
<div id="content">
  <div class="row">
    <div class="col-md-12">
      <h3 class="page-title">
        <img src="view/image/category.png" alt="" /> <?php echo $heading_title;?>
      </h3>
      <ul class="page-breadcrumb breadcrumb">
        <?php foreach ($breadcrumbs as $key => $breadcrumb) { ?>
          <li><?php if(!$key): ?> <i class="fa fa-home"></i> <?php endif; ?><?php echo $breadcrumb['separator'];?> <a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>
    </div>
  </div>
  <?php if($error_warning) : ?>
  <div class="row">
    <div class="col-md-12">
      <div class="alert alert-danger"><?php echo $error_warning; ?></div>
    </div>
  </div>
  <?php endif; ?>
  <div class="row">
    <div class="col-md-12">
      <div class="portlet box blue">
        <div class="portlet-title">
          <div class="caption">
            <img src="view/image/category.png" alt="" /> <?php echo $heading_title; ?>
          </div>
          <div class="tools">
            <a href="javascript:;" class="collapse"></a>
          </div>
        </div>
        <div class="portlet-body">
          <div class="table-toolbar pull-right">
            <div class="btn-group">
              <a onclick="$('#form').submit();" class="btn blue">
                <?php echo $button_save; ?> <i class="fa fa-save"></i>
              </a>
            </div>
            <div class="btn-group">
              <a href="<?php echo $cancel; ?>" class="btn red">
                <?php echo $button_cancel; ?> <i class="fa fa-ban"></i>
              </a>
            </div>
          </div>

          <ul id="tabs" class="nav nav-tabs">
            <li class="active"><a href="#tab-general"><?php echo $tab_general; ?></a></li>
            <li>               <a href="#tab-data"><?php echo $tab_data; ?></a></li>
            <li>               <a href="#tab-design"><?php echo $tab_design; ?></a></li>
          </ul>
          <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
            <div class="tab-content">
              <div class="tab-pane fade active in" id="tab-general">
                <ul id="languages" class="nav nav-tabs">
                  <?php $key = 0; foreach ($languages as $language) { ?>
                  <li <?php if(!($key)): ?> class="active" <?php endif; ?>>
                    <a href="#language<?php echo $language['language_id']; ?>"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /> 
                      <?php echo $language['name']; ?>
                    </a>
                  </li>
                  <?php $key++; } ?>
                </ul>
                <?php foreach ($languages as $language) { ?>
                <div id="language<?php echo $language['language_id']; ?>">
                  <div class="form-body">
                    <div class="form-group <?php if(isset($error_name[$language['language_id']]) ) :?> has-error <?php endif; ?>">
                      <div class="row">
                        <div class="col-md-12">
                          <label class="control-label col-md-3"><span class="required">*</span> <?php echo $entry_name; ?></label>
                          <div class="col-md-9">
                            <input type="text" name="category_description[<?php echo $language['language_id']; ?>][name]" class="form-control" value="<?php echo isset($category_description[$language['language_id']]) ? $category_description[$language['language_id']]['name'] : ''; ?>" />
                            <?php if (isset($error_name[$language['language_id']])) { ?>
                            <span class="help-block"><?php echo $error_name[$language['language_id']]; ?></span>
                            <?php } ?>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="row">
                      <div class="col-md-12">
                          <label class="control-label col-md-3"><?php echo $entry_meta_description; ?></label>
                          <div class="col-md-9">
                            <textarea name="category_description[<?php echo $language['language_id']; ?>][meta_description]" class="form-control" cols="40" rows="5"><?php echo isset($category_description[$language['language_id']]) ? $category_description[$language['language_id']]['meta_description'] : ''; ?></textarea>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="row">
                        <div class="col-md-12">
                          <label class="control-label col-md-3"><?php echo $entry_meta_keyword; ?></label>
                          <div class="col-md-9">
                            <textarea name="category_description[<?php echo $language['language_id']; ?>][meta_keyword]" class="form-control" cols="40" rows="5"><?php echo isset($category_description[$language['language_id']]) ? $category_description[$language['language_id']]['meta_keyword'] : ''; ?></textarea>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="row">
                        <div class="col-md-12">
                          <label class="control-label col-md-3"><?php echo $entry_description; ?></label>
                          <div class="col-md-9">
                            <textarea name="category_description[<?php echo $language['language_id']; ?>][description]" class="form-control" id="description<?php echo $language['language_id']; ?>"><?php echo isset($category_description[$language['language_id']]) ? $category_description[$language['language_id']]['description'] : ''; ?></textarea>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <?php } ?>
              </div>
            </div>
            <div class="tab-content">
              <div class="tab-pane fade in" id="tab-data">
                <div class="form-body">
                  <div class="form-group">
                    <div class="row">
                      <div class="col-md-12">
                        <label class="control-label col-md-3"><?php echo $entry_parent; ?></label>
                        <div class="col-md-9">
                          <input type="text" name="path" class="form-control" value="<?php echo $path; ?>" size="100" />
                          <input type="hidden" name="parent_id" value="<?php echo $parent_id; ?>" />
                        </div>
                      </div>
                    </div> 
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <div class="col-md-12">
                        <label class="control-label col-md-3"><?php echo $entry_filter; ?></label>
                        <div class="col-md-9">
                          <input type="text" name="filter" value="" class="form-control" />
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <div class="col-md-12">
                        <label class="control-label col-md-3">&nbsp;</label>
                        <div class="col-md-9">
                          <div id="category-filter" class="scrollbox">
                            <?php $class = 'odd'; ?>
                            <?php foreach ($category_filters as $category_filter) { ?>
                            <?php $class = ($class == 'even' ? 'odd' : 'even'); ?>
                            <div id="category-filter<?php echo $category_filter['filter_id']; ?>" class="<?php echo $class; ?>"><?php echo $category_filter['name']; ?><img src="view/image/delete.png" alt="" />
                              <input type="hidden" name="category_filter[]" value="<?php echo $category_filter['filter_id']; ?>" />
                            </div>
                            <?php } ?>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <div class="col-md-12">
                        <label class="control-label col-md-3"><?php echo $entry_store; ?></label>
                        <div class="col-md-9">
                          <div class="scrollbox">
                            <?php $class = 'even'; ?>
                            <div class="<?php echo $class; ?>">
                              <?php if (in_array(0, $category_store)) { ?>
                              <input type="checkbox" name="category_store[]" value="0" checked="checked" />
                              <?php echo $text_default; ?>
                              <?php } else { ?>
                              <input type="checkbox" name="category_store[]" value="0" />
                              <?php echo $text_default; ?>
                              <?php } ?>
                            </div>
                            <?php foreach ($stores as $store) { ?>
                            <?php $class = ($class == 'even' ? 'odd' : 'even'); ?>
                            <div class="<?php echo $class; ?>">
                              <?php if (in_array($store['store_id'], $category_store)) { ?>
                              <input type="checkbox" name="category_store[]" value="<?php echo $store['store_id']; ?>" checked="checked" />
                              <?php echo $store['name']; ?>
                              <?php } else { ?>
                              <input type="checkbox" name="category_store[]" value="<?php echo $store['store_id']; ?>" />
                              <?php echo $store['name']; ?>
                              <?php } ?>
                            </div>
                            <?php } ?>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <div class="col-md-12">
                        <label class="control-label col-md-3"><?php echo $entry_keyword; ?></label>
                        <div class="col-md-9">
                          <input type="text" class="form-control" name="keyword" value="<?php echo $keyword; ?>" />
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <div class="col-md-12">
                        <label class="control-label col-md-3"><?php echo $entry_image; ?></label>
                        <div valign="top">
                          <div class="image"><img src="<?php echo $thumb; ?>" alt="" id="thumb" />
                            <input type="hidden" name="image" value="<?php echo $image; ?>" id="image" />
                            <br />
                            <a onclick="image_upload('image', 'thumb');"><?php echo $text_browse; ?></a>&nbsp;&nbsp;|&nbsp;&nbsp;<a onclick="$('#thumb').attr('src', '<?php echo $no_image; ?>'); $('#image').attr('value', '');"><?php echo $text_clear; ?></a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <div class="col-md-12">
                        <label class="control-label col-md-3"><?php echo $entry_top; ?></label>
                        <div class="col-md-9">
                          <?php if ($top) { ?>
                          <input type="checkbox" name="top" value="1" checked="checked" />
                          <?php } else { ?>
                          <input type="checkbox" name="top" value="1" />
                          <?php } ?>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <div class="col-md-12">
                        <label class="control-label col-md-3"><?php echo $entry_column; ?></label>
                        <div class="col-md-9">
                          <input type="text" name="column" class="form-control input-xsmall" value="<?php echo $column; ?>" size="1" />
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <div class="col-md-12">
                        <label class="control-label col-md-3"><?php echo $entry_sort_order; ?></label>
                        <div class="col-md-9">
                          <input type="text" name="sort_order" class="form-control input-xsmall" value="<?php echo $sort_order; ?>" size="1" />
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <div class="col-md-12">
                        <label class="control-label col-md-3"><?php echo $entry_status; ?></label>
                        <div class="col-md-9">
                          <select name="status" class="form-control input-small">
                            <?php if ($status) { ?>
                            <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                            <option value="0"><?php echo $text_disabled; ?></option>
                            <?php } else { ?>
                            <option value="1"><?php echo $text_enabled; ?></option>
                            <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                            <?php } ?>
                          </select>
                        </div>
                      </div> 
                    </div> 
                  </div>
                </div>
              </div>
            </div>
            <div class="tab-content">
              <div class="tab-pane fade in" id="tab-design">
                <table class="table table-striped table-responsive">
                  <thead>
                    <tr>
                      <td class="left"><?php echo $entry_store; ?></td>
                      <td class="left"><?php echo $entry_layout; ?></td>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td class="left"><?php echo $text_default; ?></td>
                      <td class="left"><select name="category_layout[0][layout_id]" class="form-control input-small">
                          <option value=""></option>
                          <?php foreach ($layouts as $layout) { ?>
                          <?php if (isset($category_layout[0]) && $category_layout[0] == $layout['layout_id']) { ?>
                          <option value="<?php echo $layout['layout_id']; ?>" selected="selected"><?php echo $layout['name']; ?></option>
                          <?php } else { ?>
                          <option value="<?php echo $layout['layout_id']; ?>"><?php echo $layout['name']; ?></option>
                          <?php } ?>
                          <?php } ?>
                        </select></td>
                    </tr>
                  </tbody>
                  <?php foreach ($stores as $store) { ?>
                  <tbody>
                    <tr>
                      <td class="left"><?php echo $store['name']; ?></td>
                      <td class="left"><select name="category_layout[<?php echo $store['store_id']; ?>][layout_id]" class="form-control input-small">
                          <option value=""></option>
                          <?php foreach ($layouts as $layout) { ?>
                          <?php if (isset($category_layout[$store['store_id']]) && $category_layout[$store['store_id']] == $layout['layout_id']) { ?>
                          <option value="<?php echo $layout['layout_id']; ?>" selected="selected"><?php echo $layout['name']; ?></option>
                          <?php } else { ?>
                          <option value="<?php echo $layout['layout_id']; ?>"><?php echo $layout['name']; ?></option>
                          <?php } ?>
                          <?php } ?>
                        </select></td>
                    </tr>
                  </tbody>
                  <?php } ?>
                </table>
              </div>
            </div>
          </form>
        </div>
  </div>
</div>
<script type="text/javascript" src="view/javascript/ckeditor/ckeditor.js"></script> 
<script type="text/javascript"><!--
<?php foreach ($languages as $language) { ?>
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
$('input[name=\'path\']').autocomplete({
	delay: 500,
	source: function(request, response) {		
		$.ajax({
			url: 'index.php?route=catalog/category/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request.term),
			dataType: 'json',
			success: function(json) {
				json.unshift({
					'category_id':  0,
					'name':  '<?php echo $text_none; ?>'
				});
				
				response($.map(json, function(item) {
					return {
						label: item.name,
						value: item.category_id
					}
				}));
			}
		});
	},
	select: function(event, ui) {
		$('input[name=\'path\']').val(ui.item.label);
		$('input[name=\'parent_id\']').val(ui.item.value);
		
		return false;
	},
	focus: function(event, ui) {
      	return false;
   	}
});
//--></script> 
<script type="text/javascript"><!--
// Filter
$('input[name=\'filter\']').autocomplete({
	delay: 500,
	source: function(request, response) {
		$.ajax({
			url: 'index.php?route=catalog/filter/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request.term),
			dataType: 'json',
			success: function(json) {		
				response($.map(json, function(item) {
					return {
						label: item.name,
						value: item.filter_id
					}
				}));
			}
		});
	}, 
	select: function(event, ui) {
		$('#category-filter' + ui.item.value).remove();
		
		$('#category-filter').append('<div id="category-filter' + ui.item.value + '">' + ui.item.label + '<img src="view/image/delete.png" alt="" /><input type="hidden" name="category_filter[]" value="' + ui.item.value + '" /></div>');

		$('#category-filter div:odd').attr('class', 'odd');
		$('#category-filter div:even').attr('class', 'even');
				
		return false;
	},
	focus: function(event, ui) {
      return false;
   }
});

$('#category-filter div img').live('click', function() {
	$(this).parent().remove();
	
	$('#category-filter div:odd').attr('class', 'odd');
	$('#category-filter div:even').attr('class', 'even');	
});
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
//--></script> 
<?php echo $footer; ?>