<?php echo $header; ?>
<div class="middle">
    <?php echo $content_top; ?>   
    <div class="c-container">
        <nav class="top-nav">
                <ul>
                    <?php 
                    $last = count($breadcrumbs);
                    foreach ($breadcrumbs as $num => $breadcrumb) { 
                    ?>
                        <?php if ($last != ($num+1)) { ?>
                        <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
                        <?php } else { ?>
                        <li><?php echo $breadcrumb['text']; ?></li>
                        <?php } ?>
                    <?php } ?>
                </ul>
        </nav>
        <?php if ($success) { ?>
        <div class="alert alert-success"><i class="fa fa-check-circle"></i> <?php echo $success; ?></div>
        <?php } ?>
        
        
        <h2><?php echo $text_my_account; ?></h2>
        <ul class="list-unstyled">
          <li><a href="<?php echo $edit; ?>"><?php echo $text_edit; ?></a></li>
          <li><a href="<?php echo $password; ?>"><?php echo $text_password; ?></a></li>
          <li><a href="<?php echo $address; ?>"><?php echo $text_address; ?></a></li>
        </ul>
        <h2><?php echo $text_my_orders; ?></h2>
        <ul class="list-unstyled">
          <li><a href="<?php echo $order; ?>"><?php echo $text_order; ?></a></li>
        </ul>
        <h2><?php echo $text_my_newsletter; ?></h2>
        <ul class="list-unstyled">
          <li><a href="<?php echo $newsletter; ?>"><?php echo $text_newsletter; ?></a></li>
        </ul>

        
<?php echo $content_bottom; ?>
    </div>
</div>
<?php echo $footer; ?>