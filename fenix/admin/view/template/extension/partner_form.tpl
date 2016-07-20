<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
    <div class="page-header">
        <div class="container-fluid">
            <div class="pull-right">
                <button type="submit" form="form-partner" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
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
                <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-partner" class="form-horizontal">
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
                                    <input type="text" name="partner[<?php echo $language['language_id']; ?>][title]" value="<?php echo isset($partner[$language['language_id']]) ? $partner[$language['language_id']]['title'] : ''; ?>" placeholder="<?php echo $text_title; ?>" id="input-title<?php echo $language['language_id']; ?>" class="form-control" />
                                </div>
                            </div>
                            <div class="form-group required">
                                <label class="col-sm-2 control-label" for="input-address<?php echo $language['language_id']; ?>"><?php echo $text_address; ?></label>
                                <div class="col-sm-10">
                                    <input name="partner[<?php echo $language['language_id']; ?>][address]" rows="5" placeholder="<?php echo $text_address; ?>" id="input-address<?php echo $language['language_id']; ?>" class="form-control" value="<?php echo isset($partner[$language['language_id']]) ? $partner[$language['language_id']]['address'] : ''; ?>"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="input-phone<?php echo $language['language_id']; ?>"><?php echo $text_phone; ?></label>
                                <div class="col-sm-10">
                                    <input name="partner[<?php echo $language['language_id']; ?>][phone]" placeholder="<?php echo $text_phone; ?>" id="input-phone<?php echo $language['language_id']; ?>" value="<?php echo isset($partner[$language['language_id']]) ? $partner[$language['language_id']]['phone'] : ''; ?>" class="form-control" />
                                </div>
                            </div>
                        </div>
			<?php } ?>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="input-type"><?php echo $text_type; ?></label>
                        <div class="col-sm-10">
                            <select name="type" id="input-type" class="form-control">
                                <option value="1" <?php if($type==1) {?> selected="selected" <?php } ?>><?php echo $text_type_service; ?></option>
                                <option value="2" <?php if($type==2) {?> selected="selected" <?php } ?>><?php echo $text_type_shop; ?></option>
                                <option value="3" <?php if($type==3) {?> selected="selected" <?php } ?>><?php echo $text_type_friends; ?></option>
                            </select>
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
                        <label class="col-sm-2 control-label" for="input-href"><?php echo $text_href; ?></label>
                        <div class="col-sm-10">
                            <input type="text" name="href" value="<?php echo $href; ?>" placeholder="<?php echo $text_href; ?>" id="input-href" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="input-keyword"><?php echo $text_keyword; ?></label>
                        <div class="col-sm-10">
                            <input type="text" name="keyword" value="<?php echo $keyword; ?>" placeholder="<?php echo $text_keyword; ?>" id="input-keyword" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="input-fb"><?php echo $text_fb; ?></label>
                        <div class="col-sm-10">
                            <input type="text" name="fb" value="<?php echo $fb; ?>" placeholder="<?php echo $text_fb; ?>" id="input-fb" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="input-vk"><?php echo $text_vk; ?></label>
                        <div class="col-sm-10">
                            <input type="text" name="vk" value="<?php echo $vk; ?>" placeholder="<?php echo $text_vk; ?>" id="input-vk" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="input-insta"><?php echo $text_insta; ?></label>
                        <div class="col-sm-10">
                            <input type="text" name="insta" value="<?php echo $insta; ?>" placeholder="<?php echo $text_insta; ?>" id="input-insta" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="input-sort-order"><?php echo $text_sort_order; ?></label>
                        <div class="col-sm-10">
                            <input type="text" name="sort_order" value="<?php echo $sort_order; ?>" placeholder="<?php echo $text_sort_order; ?>" id="input-sort-order" class="form-control" />
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
<?php echo $footer; ?>