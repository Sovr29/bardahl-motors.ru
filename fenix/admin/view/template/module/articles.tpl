<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-articles" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
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
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-articles" class="form-horizontal">
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-status"><?php echo $entry_status; ?></label>
            <div class="col-sm-10">
              <select name="articles_status" id="input-status" class="form-control">
                <?php if ($articles_status) { ?>
                <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                <option value="0"><?php echo $text_disabled; ?></option>
                <?php } else { ?>
                <option value="1"><?php echo $text_enabled; ?></option>
                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-meta-description"><?php echo $entry_meta_description; ?></label>
            <div class="col-sm-10">
              <textarea name="articles_meta_description" rows="5" placeholder="<?php echo $entry_meta_description; ?>" id="input-meta-description" class="form-control"><?php echo isset($articles_meta_description) ? $articles_meta_description : ''; ?></textarea>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-meta-keywords"><?php echo $entry_meta_keywords; ?></label>
            <div class="col-sm-10">
              <textarea name="articles_meta_keywords" rows="5" placeholder="<?php echo $entry_meta_keywords; ?>" id="input-meta-keywords" class="form-control"><?php echo isset($articles_meta_keywords) ? $articles_meta_keywords : ''; ?></textarea>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-exclude"><?php echo $entry_exclude; ?></label>
            <div class="col-sm-10">
              <input type="text" name="articles-exclude" value="" placeholder="<?php echo $entry_exclude; ?>" id="input-exclude" class="form-control" />
              <div id="articles-exclude" class="well well-sm" style="height: 150px; overflow: auto;">
                <?php if(isset($articles)) {
                    foreach ($articles as $article) { ?>
                <div id="articles-exclude<?php echo $article['article_id']; ?>"><i class="fa fa-minus-circle"></i> <?php echo $article['name']; ?>
                  <input type="hidden" name="articles_exclude[]" value="<?php echo $article['article_id']; ?>" />
                </div>
                <?php }
                } ?>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  <script type="text/javascript"><!--
        $('input[name=\'articles-exclude\']').autocomplete({
                source: function(request, response) {
                        $.ajax({
                                url: 'index.php?route=catalog/information/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request),
                                dataType: 'json',
                                success: function(json) {
                                        response($.map(json, function(item) {
                                                return {
                                                        label: item['title'],
                                                        value: item['information_id']
                                                }
                                        }));
                                }
                        });
                },
                select: function(item) {
                        $('input[name=\'articles_exclude\']').val('');

                        $('#articles-exclude' + item['value']).remove();

                        $('#articles-exclude').append('<div id="articles-exclude' + item['value'] + '"><i class="fa fa-minus-circle"></i> ' + item['label'] + '<input type="hidden" name="articles_exclude[]" value="' + item['value'] + '" /></div>');	
                }
        });

        $('#articles-exclude').delegate('.fa-minus-circle', 'click', function() {
                $(this).parent().remove();
        });
    //--></script>
</div>
<?php echo $footer; ?>