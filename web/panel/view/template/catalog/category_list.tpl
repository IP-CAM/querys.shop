<?php echo $header; ?>
<div id="content">
  <div class="row">
    <div class="col-md-12">
     <!--  <h3 class="page-title">
         <?php echo $heading_title;?> <small>managed datatable samples</small>
      </h3> -->
      <ul class="page-breadcrumb breadcrumb">
          <li class="btn-group">
            <button type="button" class="btn blue dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="true">
            <span>
              Herramientas
            </span>
            <i class="fa fa-angle-down"></i>
            </button>
            <ul class="dropdown-menu pull-right" role="menu">
              <li>
                <a href="#">
                  Exportar a Excel
                </a>
              </li>
              <li>
                <a href="#">
                  Imprimir Listado
                </a>
              </li>
            </ul>
          </li>
        <?php foreach ($breadcrumbs as $key => $breadcrumb) { ?>
          <li><?php if(!$key): ?> <i class="fa fa-home"></i> <?php endif; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a><i class="fa fa-angle-right"></i></li>
        <?php } ?>
      </ul>
    </div>
  </div>
  <?php if($error_warning || $success) : ?>
  <div class="row">
    <div class="col-md-12">
      <?php if ($error_warning) { ?>
      <div class="warning"><?php echo $error_warning; ?></div>
      <?php } ?>
      <?php if ($success) { ?>
      <div class="success"><?php echo $success; ?></div>
      <?php } ?>
    </div>
  </div>
  <?php endif; ?>
  <div class="row">
    <div class="col-md-12">
      <div class="portlet box blue">
        <div class="portlet-title">
          <div class="caption"><img src="view/image/category.png" alt="" /> <?php echo $heading_title; ?></div>
          <div class="tools"><a href="javascript:;" class="collapse"></a><a href="#portlet-config" data-toggle="modal" class="config"></a><a href="javascript:;" class="reload"></a></div>
        </div>
        <div class="portlet-body">
          <div class="table-toolbar">
            <div class="btn-group">
              <a href="<?php echo $repair; ?>" class="btn yellow">
                <?php echo $button_repair; ?> <i class="fa fa-refresh"></i>
              </a>
            </div>
            <div class="btn-group">
              <a href="<?php echo $insert; ?>" class="btn green">
                <?php echo $button_insert; ?> <i class="fa fa-plus"></i>
              </a>
            </div>
            <div class="btn-group">
              <a onclick="$('#form').submit();" class="btn red">
                <?php echo $button_delete; ?> <i class="fa fa-minus"></i>
              </a>
            </div>
          </div>
          <div class="dataTables_wrapper"></div>
          <form action="<?php echo $delete; ?>" method="post" enctype="multipart/form-data" id="form">
            <table class="table table-striped table-bordered table-hover" id="datatable">
              <thead>
                <tr>
                  <th class="table-checkbox" width="1" style="text-align: center;">
                    <input type="checkbox" class="group-checkable" data-set="#datatable .checkboxes">
                  </th>
                  <th><?php echo $column_name; ?></th>
                  <th><?php echo $column_sort_order; ?></th>
                  <th><?php echo $column_action; ?></th>
                </tr>
              </thead>
              <tbody>
                <?php if ($categories) { ?>
                <?php foreach ($categories as $category) { ?>
                <tr class="odd gradeX">
                  <td><?php if ($category['selected']) { ?>
                    <input type="checkbox" name="selected[]" value="<?php echo $category['category_id']; ?>" checked="checked" class="checkboxes"/>
                    <?php } else { ?>
                    <input type="checkbox" name="selected[]" value="<?php echo $category['category_id']; ?>" class="checkboxes"/>
                    <?php } ?></td>
                  <td><?php echo $category['name']; ?></td>
                  <td><?php echo $category['sort_order']; ?></td>
                  <td><?php foreach ($category['action'] as $action) { ?>
                    [ <a href="<?php echo $action['href']; ?>"><?php echo $action['text']; ?></a> ]
                    <?php } ?></td>
                </tr>
                <?php } ?>
                <?php } else { ?>
                <tr>
                  <td class="center" colspan="4"><?php echo $text_no_results; ?></td>
                </tr>
                <?php } ?>
              </tbody>
            </table>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<?php echo $footer; ?>