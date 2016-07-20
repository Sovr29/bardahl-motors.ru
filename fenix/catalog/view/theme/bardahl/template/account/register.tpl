<?php echo $header; ?>
<div class="container" style="margin-top: 250px;">
    
    <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li>
            <a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
        </li>
        <?php } ?>
    </ul>
    
    <?php if ($error_warning) { ?>
        <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?></div>
    <?php } ?>

    <div class="row">
        <?php echo $column_left; ?>
        <?php if ($column_left && $column_right) { ?>
        <?php $class = 'col-sm-6'; ?>
        <?php } elseif ($column_left || $column_right) { ?>
        <?php $class = 'col-sm-9'; ?>
        <?php } else { ?>
        <?php $class = 'col-sm-12'; ?>
        <?php } ?>
        <div id="content" class="<?php echo $class; ?>">
            
            <?php echo $content_top; ?>
            <h1><?php echo $heading_title; ?></h1>
            <p><?php echo $text_account_already; ?></p>
            
            <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
                <fieldset id="account">
                    
                    <!--<legend><?php echo $text_your_details; ?></legend>-->
                    <div class="form-group required" style="display: <?php echo (count($customer_groups) > 1 ? 'block' : 'none'); ?>;">
                        <label class="col-sm-2 control-label"><?php echo $entry_customer_group; ?></label>
                        <div class="col-sm-10">
                            <?php foreach ($customer_groups as $customer_group) { ?>
                            <?php if ($customer_group['customer_group_id'] == $customer_group_id) { ?>
                            <div class="radio">
                              <label>
                                <input type="radio" name="customer_group_id" value="<?php echo $customer_group['customer_group_id']; ?>" checked="checked" />
                                <?php echo $customer_group['name']; ?>
                              </label>
                            </div>
                            <?php } else { ?>
                            <div class="radio">
                              <label>
                                <input type="radio" name="customer_group_id" value="<?php echo $customer_group['customer_group_id']; ?>" />
                                <?php echo $customer_group['name']; ?>
                              </label>
                            </div>
                            <?php } ?>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="form-group required">
                        <label class="col-sm-2 control-label" for="input-email"><?php echo $entry_email; ?></label>
                        <div class="col-sm-10">
                          <input type="email" name="email" value="<?php echo $email; ?>" placeholder="<?php echo $entry_email; ?>" id="input-email" class="form-control" />
                          <?php if ($error_email) { ?>
                          <div class="text-danger"><?php echo $error_email; ?></div>
                          <?php } ?>
                        </div>
                    </div>
                
                    <div class="form-group required">
                      <label class="col-sm-2 control-label" for="input-password"><?php echo $entry_password; ?></label>
                      <div class="col-sm-10">
                        <input type="password" name="password" value="<?php echo $password; ?>" placeholder="<?php echo $entry_password; ?>" id="input-password" class="form-control" />
                        <?php if ($error_password) { ?>
                        <div class="text-danger"><?php echo $error_password; ?></div>
                        <?php } ?>
                      </div>
                    </div>
                    <div class="form-group required">
                      <label class="col-sm-2 control-label" for="input-confirm"><?php echo $entry_confirm; ?></label>
                      <div class="col-sm-10">
                        <input type="password" name="confirm" value="<?php echo $confirm; ?>" placeholder="<?php echo $entry_confirm; ?>" id="input-confirm" class="form-control" />
                        <?php if ($error_confirm) { ?>
                        <div class="text-danger"><?php echo $error_confirm; ?></div>
                        <?php } ?>
                      </div>
                    </div>
                </fieldset>
                <fieldset>
                    <!--<legend><?php echo $text_newsletter; ?></legend>-->
                    <div class="form-group">
                      <label class="col-sm-2 control-label"><?php echo $entry_newsletter; ?></label>
                      <div class="col-sm-10">
                        <?php if ($newsletter) { ?>
                        <label class="radio-inline">
                          <input type="radio" name="newsletter" value="1" checked="checked" />
                          <?php echo $text_yes; ?></label>
                        <label class="radio-inline">
                          <input type="radio" name="newsletter" value="0" />
                          <?php echo $text_no; ?></label>
                        <?php } else { ?>
                        <label class="radio-inline">
                          <input type="radio" name="newsletter" value="1" />
                          <?php echo $text_yes; ?></label>
                        <label class="radio-inline">
                          <input type="radio" name="newsletter" value="0" checked="checked" />
                          <?php echo $text_no; ?></label>
                        <?php } ?>
                      </div>
                    </div>
                </fieldset>
                  <?php if ($text_agree) { ?>
                <div class="buttons">
                    <div class="pull-right"><?php echo $text_agree; ?>
                      <?php if ($agree) { ?>
                      <input type="checkbox" name="agree" value="1" checked="checked" />
                      <?php } else { ?>
                      <input type="checkbox" name="agree" value="1" />
                      <?php } ?>
                      &nbsp;
                      <input type="submit" value="<?php echo $button_continue; ?>" class="btn btn-primary" />
                    </div>
                </div>
                  <?php } else { ?>
                <div class="buttons">
                    <div class="pull-right">
                      <input type="submit" value="<?php echo $button_continue; ?>" class="btn btn-primary" />
                    </div>
                </div>
                  <?php } ?>
            </form>
            
        </div>
    </div>
    
</div>
<?php echo $footer; ?>

