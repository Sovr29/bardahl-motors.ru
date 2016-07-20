<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-ms" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
        <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a></div>
      <h1><?php echo $heading_title; ?></h1>
      <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>
    </div>
  </div>
  <div class="container-fluid">
    <?php if ($error_warning) { ?>
    <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_edit; ?></h3>
      </div>
      <div class="panel-body">
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-ms" name="form-ms" class="form-horizontal">
          <div class="form-group required">
            <label class="col-sm-2 control-label" for="input-login"><?php echo $entry_login; ?></label>
            <div class="col-sm-10">
              <input name="ms_login" id="input-login" class="form-control" value="<?php echo $ms_login; ?>" autocomplete="off"/>
              <?php if ($error_login) { ?>
              <div class="text-danger"><?php echo $error_login; ?></div>
              <?php } ?>
            </div>
          </div>
          <div class="form-group required">
            <label class="col-sm-2 control-label" for="input-pwd"><?php echo $entry_pwd; ?></label>
            <div class="col-sm-10">
              <input name="ms_pwd" id="input-pwd" class="form-control" type="password" value="<?php echo $ms_pwd; ?>" autocomplete="off"/>
              <?php if ($error_pwd) { ?>
              <div class="text-danger"><?php echo $error_pwd; ?></div>
              <?php } ?>
            </div>
          </div>
          <div class="form-group required">
            <label class="col-sm-2 control-label" for="input-order-status"><?php echo $entry_order_status; ?></label>
            <div class="col-sm-10">
                <select id="input-order-status" name="ms_order_status" class="form-control"></select>
                <?php if ($error_order_status) { ?>
                    <div class="text-danger"><?php echo $error_order_status; ?></div>
                <?php } ?>
            </div>
          </div>
          <div class="form-group required">
            <label class="col-sm-2 control-label" for="input-company"><span data-toggle="tooltip" data-html="true" data-trigger="hover" title="<?php echo htmlspecialchars($help_company); ?>"><?php echo $entry_company; ?></span></label>
            <div class="col-sm-10">
                <select id="input-company" name="ms_company" class="form-control"></select>
                <?php if ($error_company) { ?>
                    <div class="text-danger"><?php echo $error_company; ?></div>
                <?php } ?>
            </div>
          </div>
          <div class="form-group required">
            <label class="col-sm-2 control-label" for="input-warehouse"><?php echo $entry_warehouse; ?></label>
            <div class="col-sm-10">
                <select id="input-warehouse" name="ms_warehouse" class="form-control"></select>
                <?php if ($error_warehouse) { ?>
                    <div class="text-danger"><?php echo $error_warehouse; ?></div>
                <?php } ?>
            </div>
          </div>
          <div class="form-group required">
            <label class="col-sm-2 control-label" for="input-project"><?php echo $entry_project; ?></label>
            <div class="col-sm-10">
                <select id="input-project" name="ms_project" class="form-control"></select>
                <?php if ($error_project) { ?>
                    <div class="text-danger"><?php echo $error_project; ?></div>
                <?php } ?>
            </div>
          </div>
          <div class="form-group required">
            <label class="col-sm-2 control-label" for="input-source"><?php echo $entry_source; ?></label>
            <div class="col-sm-10">
                <select id="input-source" name="ms_source" class="form-control"></select>
                <?php if ($error_source) { ?>
                    <div class="text-danger"><?php echo $error_source; ?></div>
                <?php } ?>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label"><?php echo $entry_deliveries; ?></label>
            <div class="col-sm-10">
                <div class="well">
                    <?php foreach($shipping_methods as $shipping_method) { ?>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="input-source1"><?php echo $shipping_method['name']; ?></label>
                            <div class="col-sm-10">
                                <select id="input-<?php echo($shipping_method['code']) ?>" name="ms_shipping_method[<?php echo($shipping_method['code']) ?>]" class="form-control">
                                    <?php foreach($shipping_methods_ms as $shipping_method_ms) { ?>
                                    <option value="<?php echo $shipping_method_ms['id']; ?>" <?php echo(($ms_shipping_method[$shipping_method['code']] == $shipping_method_ms['id']) ? 'selected' : '') ?>><?php echo $shipping_method_ms['name']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
          </div>
          <div class="form-group required">
            <label class="col-sm-2 control-label" for="input-coupon"><?php echo $entry_coupon; ?></label>
            <div class="col-sm-10">
                <select id="input-coupon" name="ms_coupon" class="form-control"></select>
                <?php if ($error_coupon) { ?>
                    <div class="text-danger"><?php echo $error_coupon; ?></div>
                <?php } ?>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<?php echo $footer; ?>
<script type="text/javascript"><!--
    
function getCompanies(){
    var company = '<?php echo($ms_company) ?>';
    
    $.ajax({
        url: 'index.php?route=module/ms/getCompanies&token=<?php echo $token; ?>',
        type: 'post',
        dataType: 'json',
        cache: false,
        contentType: false,
        processData: false,
        success: function(json) {
                if (json['error']) {
                    alert(json['error']);
                }
                else if(json['data'] && json['data'].companies)
                {
                    var c = json['data'].companies;
                    for(var i = 0; i < c.length; i++)
                    {
                        $('#input-company').append('<option value="' + c[i].id + '"' + ((company === c[i].id) ? ' selected' : '') + '>' + c[i].name + '</option>')
                    }
                    $('#input-company').removeAttr('disabled');
                    getWarehouses();
                }
        },
        error: function(xhr, ajaxOptions, thrownError) {
                alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
    });
}

function getStatuses(){
    var order_status = '<?php echo($ms_order_status) ?>';
    
    $.ajax({
        url: 'index.php?route=module/ms/getStatuses&token=<?php echo $token; ?>',
        type: 'post',
        dataType: 'json',
        cache: false,
        contentType: false,
        processData: false,
        success: function(json) {
            if (json['error']) {
                alert(json['error']);
            }
            else if(json['data'] && json['data'].statuses)
            {
                var s = json['data'].statuses;
                for(var i = 0; i < s.length; i++)
                {
                    $('#input-order-status').append('<option value="' + s[i].id + '"' + ((order_status === s[i].id) ? ' selected' : '') + '>' + s[i].name + '</option>')
                }
                $('#input-order-status').removeAttr('disabled');
                getCompanies();
            }
        },
        error: function(xhr, ajaxOptions, thrownError) {
                alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
    });
}

function getWarehouses(){
    
    var warehouse = '<?php echo($ms_warehouse) ?>';
    
    $.ajax({
        url: 'index.php?route=module/ms/getWarehouses&token=<?php echo $token; ?>',
        type: 'post',
        dataType: 'json',
        cache: false,
        contentType: false,
        processData: false,
        success: function(json) {
                if (json['error']) {
                    alert(json['error']);
                }
                else if(json['data'] && json['data'].warehouses)
                {
                    var w = json['data'].warehouses;
                    for(var i = 0; i < w.length; i++)
                    {
                        $('#input-warehouse').append('<option value="' + w[i].id + '"' + ((warehouse === w[i].id) ? ' selected' : '') + '>' + w[i].name + '</option>')
                    }
                    $('#input-warehouse').removeAttr('disabled');
                    getProjects();
                }
        },
        error: function(xhr, ajaxOptions, thrownError) {
                alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
    });
}

function getProjects(){
    
    var project = '<?php echo($ms_project) ?>';
    
    $.ajax({
        url: 'index.php?route=module/ms/getProjects&token=<?php echo $token; ?>',
        type: 'post',
        dataType: 'json',
        cache: false,
        contentType: false,
        processData: false,
        success: function(json) {
                if (json['error']) {
                    alert(json['error']);
                }
                else if(json['data'] && json['data'].projects)
                {
                    var p = json['data'].projects;
                    for(var i = 0; i < p.length; i++)
                    {
                        $('#input-project').append('<option value="' + p[i].id + '"' + ((project === p[i].id) ? ' selected' : '') + '>' + p[i].name + '</option>')
                    }
                    $('#input-project').removeAttr('disabled');
                }
                getSources();
        },
        error: function(xhr, ajaxOptions, thrownError) {
                alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
    });
}

function getSources(){
    
    var source = '<?php echo($ms_source) ?>';
    
    $.ajax({
        url: 'index.php?route=module/ms/getSources&token=<?php echo $token; ?>',
        type: 'post',
        dataType: 'json',
        cache: false,
        contentType: false,
        processData: false,
        success: function(json) {
                if (json['error']) {
                    alert(json['error']);
                }
                else if(json['data'] && json['data'].sources)
                {
                    var s = json['data'].sources;
                    for(var i = 0; i < s.length; i++)
                    {
                        $('#input-source').append('<option value="' + s[i].id + '"' + ((source === s[i].id) ? ' selected' : '') + '>' + s[i].name + '</option>')
                    }
                    $('#input-source').removeAttr('disabled');
                    
                    getCoupons();
                }
        },
        error: function(xhr, ajaxOptions, thrownError) {
                alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
    });
}

function getCoupons(){
    
    var coupon = '<?php echo($ms_coupon) ?>';
    
    $.ajax({
        url: 'index.php?route=module/ms/getCoupons&token=<?php echo $token; ?>',
        type: 'post',
        dataType: 'json',
        cache: false,
        contentType: false,
        processData: false,
        success: function(json) {
                if (json['error']) {
                    alert(json['error']);
                }
                else if(json['data'] && json['data'].coupons)
                {
                    var c = json['data'].coupons;
                    for(var i = 0; i < c.length; i++)
                    {
                        $('#input-coupon').append('<option value="' + c[i].id + '"' + ((coupon === c[i].id) ? ' selected' : '') + '>' + c[i].name + '</option>')
                    }
                    $('#input-coupon').removeAttr('disabled');
                    
                    $('button[type=submit]').button('reset');
                }
        },
        error: function(xhr, ajaxOptions, thrownError) {
                alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
    });
}

$(document).ready(function(){
   $('#input-company').prop('disabled', 'disabled');
   $('#input-order-status').prop('disabled', 'disabled');
   $('#input-warehouse').prop('disabled', 'disabled');
   $('#input-project').prop('disabled', 'disabled');
   $('#input-source').prop('disabled', 'disabled');
   $('#input-coupon').prop('disabled', 'disabled');
   
   
   
   if($('#input-login').val().length > 0 && $('#input-pwd').val().length > 0)
   {
    $('button[type=submit]').button('loading');
    getStatuses();
   }
   
});
//--></script> 