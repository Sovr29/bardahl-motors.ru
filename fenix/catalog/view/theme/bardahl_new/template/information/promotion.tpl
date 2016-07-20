<?php echo $header; ?>
<div class="middle">
    <div class="c-container">
      <div class="row">
        <div id="content">
            <article class="promotions_article">
                <div class="inner">
                    <h2><?php echo $heading_title; ?></h3>
                    <div class="table date-actions">
                        <ul class="promotion-meta table-cell">
                            <li><i class="fa fa-bookmark-o"></i></li>
                            <li class="date"><span class="long"><?php echo $date_begin; ?> - <?php echo $date_end; ?></span></li>
                        </ul>
                    </div>
                    <div class="images">
                        <img src="<?php echo $image; ?>" alt="<?php echo $heading_title; ?>" />
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