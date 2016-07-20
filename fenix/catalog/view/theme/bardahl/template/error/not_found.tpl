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
      <h1><?php echo $heading_title; ?></h1>
      <p><?php echo $text_error; ?></p>
      <div class="buttons">
        <a href="<?php echo $continue; ?>" class="btn btn-primary"><?php echo $button_continue; ?></a>
      </div>
  <?php echo $content_bottom; ?>
</div>
</div>
<?php echo $footer; ?>