<?php echo $header; ?>
<div class="middle">
    <div class="c-container">
      <div class="row">
        <div id="content">
            <article class="news">
                <div class="inner">
                    <h2><?php echo $heading_title; ?></h3>
                    <div class="table date-actions">
                        <ul class="news-meta table-cell">
                            <li><i class="fa fa-bookmark-o"></i></li>
                            <li class="date"><span class="long"><?php echo $date_added; ?></span></li>
                        </ul>
                        <div class="table-cell share">
                            <ul>
                                <?php if ($youtube){ ?>
                                <li><a href="<?php echo $youtube; ?>" target="_blank"><i class="fa fa-youtube"></i></a></li>
                                <?php } if ($fb){ ?>
                                <li><a href="<?php echo $fb; ?>" target="_blank"><i class="fa fa-facebook"></i></a></li>
                                <?php } if ($vk){ ?>
                                <li><a href="<?php echo $vk; ?>" target="_blank"><i class="fa fa-vk"></i></a></li>
                                <?php } if ($insta){ ?>
                                <li><a href="<?php echo $insta; ?>" target="_blank"><i class="fa fa-instagram"></i></a></li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                    <div class="images">
                        <?php if ($youtube){ ?>
                            <iframe width="1200" height="400" src="<?php echo $youtube; ?>" frameborder="0" allowfullscreen></iframe>
                        <?php } else{?>
                            <img src="<?php echo $image; ?>" alt="<?php echo $heading_title; ?>" />
                        <?php }?>
                    </div>
                    <div class="content">
                            <?php echo $description; ?>
                    </div>
                </div>
            </article>
        </div>
    </div>
</div>
<?php echo $content_bottom; ?>
<?php echo $footer; ?>