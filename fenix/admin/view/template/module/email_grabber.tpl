<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-email-grabber" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
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
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-email-grabber" name="form-email-grabber" class="form-horizontal">
          <div class="form-group required">
            <label class="col-sm-2 control-label" for="input-text"><?php echo $entry_text; ?></label>
            <div class="col-sm-10">
              <textarea name="email_grabber_text" id="input-text" class="form-control"><?php echo ($email_grabber_text); ?></textarea>
              <?php if ($error_text) { ?>
              <div class="text-danger"><?php echo $error_text; ?></div>
              <?php } ?>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-success-text"><?php echo $entry_success_text; ?></label>
            <div class="col-sm-10">
              <textarea name="email_grabber_success_text" id="input-success-text" class="form-control"><?php echo ($email_grabber_success_text); ?></textarea>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-button-text"><?php echo $entry_button_text; ?></label>
            <div class="col-sm-10">
              <input name="email_grabber_button_text" id="input-button_text" class="form-control" value="<?php echo $email_grabber_button_text; ?>"/>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-time"><span data-toggle="tooltip" data-html="true" data-trigger="hover" title="<?php echo htmlspecialchars($help_time); ?>"><?php echo $entry_time; ?></span></label>
            <div class="col-sm-10">
                <input name="email_grabber_time" id="input-time" type="number" class="form-control" value="<?php echo $email_grabber_time; ?>"/>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-create-coupon"><?php echo $entry_create_coupon; ?></label>
            <div class="col-sm-10">
                <input name="email_grabber_create_coupon" id="input-create-coupon" type="checkbox" class="form-control" <?php echo ($email_grabber_create_coupon == 1 ? "checked" : ""); ?> value="1" />
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-coupon-type"><?php echo $entry_coupon_type; ?></label>
            <div class="col-sm-10">
              <select id="input-coupon-type" name="email_grabber_coupon_type" class="form-control">
                <?php if ($email_grabber_coupon_type == 'P') { ?>
                <option value="P" selected="selected"><?php echo $text_percent; ?></option>
                <?php } else { ?>
                <option value="P"><?php echo $text_percent; ?></option>
                <?php } ?>
                <?php if ($email_grabber_coupon_type == 'F') { ?>
                <option value="F" selected="selected"><?php echo $text_amount; ?></option>
                <?php } else { ?>
                <option value="F"><?php echo $text_amount; ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-coupon-discount"><?php echo $entry_coupon_discount; ?></label>
            <div class="col-sm-10">
              <input type="text" name="email_grabber_coupon_discount" value="<?php echo $email_grabber_coupon_discount; ?>" id="input-coupon-discount" class="form-control" />
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-coupon-discount-summ"><span data-toggle="tooltip" data-html="true" data-trigger="hover" title="<?php echo htmlspecialchars($help_coupon_discount_summ); ?>"><?php echo $entry_coupon_discount_summ; ?></span></label>
            <div class="col-sm-10">
                <input name="email_grabber_coupon_discount_summ" id="input-coupon-discount-summ" type="text" class="form-control" value="<?php echo $email_grabber_coupon_discount_summ; ?>"/>
            </div>
          </div>  
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-status"><?php echo $entry_status; ?></label>
            <div class="col-sm-10">
              <select name="email_grabber_status" id="input-status" class="form-control">
                <?php if ($email_grabber_status) { ?>
                <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                <option value="0"><?php echo $text_disabled; ?></option>
                <?php } else { ?>
                <option value="1"><?php echo $text_enabled; ?></option>
                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<?php echo $footer; ?>
<script type="text/javascript"><!--
$('#input-text').summernote({height: 300});
$('#input-success-text').summernote({height: 300});
$(document).ready(function(){
   if(!$('#input-create-coupon').is(':checked'))
   {
       $('#input-coupon-type').parent().parent().hide();
       $('#input-coupon-discount').parent().parent().hide();
       $('#input-coupon-discount-summ').parent().parent().hide();
   }
   $('#input-create-coupon').on('change', function(){
        if(!$('#input-create-coupon').is(':checked'))
        {
            $('#input-coupon-type').parent().parent().hide();
            $('#input-coupon-discount').parent().parent().hide();
            $('#input-coupon-discount-summ').parent().parent().hide();
        }
        else
        {
            $('#input-coupon-type').parent().parent().show();
            $('#input-coupon-discount').parent().parent().show();
            $('#input-coupon-discount-summ').parent().parent().show();
        }
   });
});
//--></script> 