<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-promotions" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
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
    <?php if ($error) { ?>
    <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $heading_title; ?></h3>
      </div>
      <div class="panel-body">
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-promotions" class="form-horizontal">
          <ul class="nav nav-tabs" id="language">
			<?php foreach ($languages as $language) { ?>
			<li><a href="#language<?php echo $language['language_id']; ?>" data-toggle="tab"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?></a></li>
			<?php } ?>
		  </ul>
		  <div class="tab-content">
			<?php foreach ($languages as $language) { ?>
			<div class="tab-pane" id="language<?php echo $language['language_id']; ?>">
			  <div class="form-group required">
				<label class="col-sm-2 control-label" for="input-title<?php echo $language['language_id']; ?>"><?php echo $text_title; ?></label>
				<div class="col-sm-10">
				  <input type="text" name="promotion[<?php echo $language['language_id']; ?>][title]" value="<?php echo isset($promotion[$language['language_id']]) ? $promotion[$language['language_id']]['title'] : ''; ?>" placeholder="<?php echo $text_title; ?>" id="input-title<?php echo $language['language_id']; ?>" class="form-control" />
				</div>
			  </div>
			  <div class="form-group required">
				<label class="col-sm-2 control-label" for="input-short<?php echo $language['language_id']; ?>"><?php echo $text_short_description; ?></label>
				<div class="col-sm-10">
				  <textarea name="promotion[<?php echo $language['language_id']; ?>][short_description]" rows="5" placeholder="<?php echo $text_short_description; ?>" id="input-short<?php echo $language['language_id']; ?>" class="form-control"><?php echo isset($promotion[$language['language_id']]) ? $promotion[$language['language_id']]['short_description'] : ''; ?></textarea>
				</div>
			  </div>
			  <div class="form-group">
				<label class="col-sm-2 control-label" for="input-description<?php echo $language['language_id']; ?>"><?php echo $text_description; ?></label>
				<div class="col-sm-10">
				  <textarea name="promotion[<?php echo $language['language_id']; ?>][description]" placeholder="<?php echo $text_description; ?>" id="input-description<?php echo $language['language_id']; ?>"><?php echo isset($promotion[$language['language_id']]) ? $promotion[$language['language_id']]['description'] : ''; ?></textarea>
				</div>
			  </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="input-meta-description<?php echo $language['language_id']; ?>"><?php echo $text_meta_description; ?></label>
                                <div class="col-sm-10">
                                  <textarea name="promotion[<?php echo $language['language_id']; ?>][meta_description]" rows="5" placeholder="<?php echo $text_meta_description; ?>" id="input-meta-description<?php echo $language['language_id']; ?>" class="form-control"><?php echo isset($promotion[$language['language_id']]) ? $promotion[$language['language_id']]['meta_description'] : ''; ?></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="input-meta-keyword<?php echo $language['language_id']; ?>"><?php echo $text_meta_keyword; ?></label>
                                <div class="col-sm-10">
                                  <textarea name="promotion[<?php echo $language['language_id']; ?>][meta_keyword]" rows="5" placeholder="<?php echo $text_meta_keyword; ?>" id="input-meta-keyword<?php echo $language['language_id']; ?>" class="form-control"><?php echo isset($promotion[$language['language_id']]) ? $promotion[$language['language_id']]['meta_keyword'] : ''; ?></textarea>
                                </div>
                            </div>
			</div>
			<?php } ?>
		  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label"><?php echo $text_show_on_main_page; ?></label>
                    <div class="col-sm-10">
                      <label class="radio-inline">
                        <?php if ($show_on_main_page) { ?>
                        <input type="radio" name="show_on_main_page" value="1" checked="checked" />
                        <?php echo $text_yes; ?>
                        <?php } else { ?>
                        <input type="radio" name="show_on_main_page" value="1" />
                        <?php echo $text_yes; ?>
                        <?php } ?>
                      </label>
                      <label class="radio-inline">
                        <?php if (!$show_on_main_page) { ?>
                        <input type="radio" name="show_on_main_page" value="0" checked="checked" />
                        <?php echo $text_no; ?>
                        <?php } else { ?>
                        <input type="radio" name="show_on_main_page" value="0" />
                        <?php echo $text_no; ?>
                        <?php } ?>
                      </label>
                    </div>
                  </div>
                  <div class="form-group">
			<label class="col-sm-2 control-label" for="input-date-begin"><?php echo $text_dates; ?></label>
			<div class="col-sm-10">
                            <div class="form-inline">
                                <label for="input-date-begin"><?php echo $text_date_begin; ?></label>
                                <div class="input-group date">
                                    <input type="text" name="date_begin" value="<?php echo $date_begin; ?>" placeholder="<?php echo $entry_date_begin; ?>" data-date-format="YYYY-MM-DD" id="input-date-begin" class="form-control" />
                                    <span class="input-group-btn">
                                        <button class="btn btn-default" type="button"><i class="fa fa-calendar"></i></button>
                                    </span>
                                </div>
                                <label for="input-date-end"><?php echo $text_date_end; ?></label>
                                <div class="input-group date">
                                    <input type="text" name="date_end" value="<?php echo $date_end; ?>" placeholder="<?php echo $entry_date_end; ?>" data-date-format="YYYY-MM-DD" id="input-date-end" class="form-control" />
                                    <span class="input-group-btn">
                                        <button class="btn btn-default" type="button"><i class="fa fa-calendar"></i></button>
                                    </span>
                                </div>
                                <div class="input-group">
                                    <button type="button" onclick="addDates();" data-toggle="tooltip" title="<?php echo $button_date_add; ?>" class="btn btn-primary"><i class="fa fa-plus-circle"></i></button>
                                </div>
                            </div>
                            <div>&nbsp;</div>
                            <div id="promotion_dates" class="well well-sm" style="height: 150px; overflow: auto;">
                            <?php foreach ($promotion_periods as $period) { ?>
                                <div>
                                  <i class="fa fa-minus-circle"></i> 
                                  <?php echo $text_date_begin; ?> <?php echo $period['date_begin']; ?> <?php echo $text_date_end; ?> <?php echo $period['date_end']; ?>
                                  <input type="hidden" name="date_periods[]" value="<?php echo $period['date_begin']; ?>#<?php echo $period['date_end']; ?>" />
                                </div>
                            <?php } ?>
                            </div>
                        </div>
		  </div> 
		  <div class="form-group">
			<label class="col-sm-2 control-label" for="input-image"><?php echo $text_image; ?></label>
			<div class="col-sm-10">
			  <a href="" id="thumb-image" data-toggle="image" class="img-thumbnail"><img src="<?php echo $thumb; ?>" alt="" title="" data-placeholder="<?php echo $no_image; ?>" /></a>
			  <input type="hidden" name="image" value="<?php echo $image; ?>" id="input-image" />
			</div>
		  </div>  
		  <div class="form-group">
			<label class="col-sm-2 control-label" for="input-keyword"><?php echo $text_keyword; ?></label>
			<div class="col-sm-10">
			  <input type="text" name="keyword" value="<?php echo $keyword; ?>" placeholder="<?php echo $text_keyword; ?>" id="input-keyword" class="form-control" />
			</div>
		  </div>
		  <div class="form-group">
			<label class="col-sm-2 control-label" for="input-status"><?php echo $text_status; ?></label>
			<div class="col-sm-10">
			  <select name="status" id="input-status" class="form-control">
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
        </form>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
$('#language a:first').tab('show');

<?php foreach ($languages as $language) { ?>
$('#input-description<?php echo $language['language_id']; ?>').summernote({height: 300});
<?php } ?>
</script>

<script type="text/javascript">
    function addDates(){
        var dateBegin = $('#input-date-begin').val();
        var dateEnd = $('#input-date-end').val();
        if(dateBegin.length > 0 && dateEnd.length > 0 && $('input[name^=date_periods][value=' + dateBegin + '#' + dateEnd + ']').length === 0)
        {
            var period = $('<div></div>');
            period.append('<i class="fa fa-minus-circle"></i>');
            period.append(' <?php echo $text_date_begin; ?> ' + dateBegin + ' <?php echo $text_date_end; ?> ' + dateEnd);
            period.append('<input type="hidden" name="date_periods[]" value="' + dateBegin + '#' + dateEnd + '"/>');
            $('#promotion_dates').append(period);
        }
    }
    $(document).ready(function (){
        $('.date').datetimepicker({pickTime: false});
        $('#promotion_dates').delegate('.fa-minus-circle', 'click', function() {
            $(this).parent().remove();
        });
    });
</script>    
<?php echo $footer; ?>