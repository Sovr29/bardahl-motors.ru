<?php echo $header; ?>
<div class="middle grid-container">
    <?php echo $content_top; ?>   
    <div class="c-container">
      <h1><?php echo $heading_title; ?></h1>
      <?php echo $text_message; ?>
      <div class="buttons">
        <div class="pull-right"><a href="<?php echo $continue; ?>" class="btn btn-primary"><?php echo $button_continue; ?></a></div>
      </div>
      <?php echo $content_bottom; ?>
    </div>
</div>
<?php echo $footer; ?>