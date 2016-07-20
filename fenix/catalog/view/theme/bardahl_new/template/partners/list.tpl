<?php echo $header; ?>
<div class="middle">
    <?php echo $content_top; ?>   
<div class="c-container">
    <div class="partners">
        <ul class="nav nav-tabs" role="tablist">
            <?php foreach ($all_partners as $key => $category) { ?>
                <li role="presentation" <?php if($key == 1) { ?>class="active"<?php } ?>>
                    <a href="#tab_<?php echo($key) ?>" aria-controls="home" role="tab" data-toggle="tab">
                        <?php echo ($key == 1 ? $type_services : ($key == 2 ? $type_shops : $type_friends));?>
                    </a>
                </li>
            <?php } ?>
        </ul>
        <div class="tab-content">
            <?php foreach ($all_partners as $key => $category) { ?>
                <div role="tabpanel" class="tab-pane<?php if($key == 1) { ?> active<?php } ?>" id="tab_<?php echo($key) ?>">
                    <div class="table">
                    <?php $counter = 0;
                        foreach ($category as $partner) {
                            if($counter%3 == 0){
                                    if($counter > 0){
                                            echo '</div>';
                                    }
                                    echo '<div class="table-row">';
                            }?>
                        <article class="partner">
                            <div class="inner">
                                <div class="images">
                                    <a href="<?php echo $partner['href']; ?>"><img src="<?php echo $partner['image']; ?>" alt="<?php echo $partner['title']; ?>" /></a>
                                </div>
                                <div class="table actions">
                                    <div class="table-cell">
                                        <a href="<?php echo $partner['href']; ?>"><?php echo $partner['title']; ?></a>
                                    </div>
                                    <div class="table-cell">
                                        <ul class="share">
                                            <?php if ($partner['fb']){ ?>
                                            <li><a href="<?php echo $partner['fb']; ?>" target="_blank" rel="nofollow"><i class="fa fa-facebook"></i></a></li>
                                            <?php } if ($partner['vk']){ ?>
                                            <li><a href="<?php echo $partner['vk']; ?>" target="_blank" rel="nofollow"><i class="fa fa-vk"></i></a></li>
                                            <?php } if ($partner['insta']){ ?>
                                            <li><a href="<?php echo $partner['insta']; ?>" target="_blank" rel="nofollow"><i class="fa fa-instagram"></i></a></li>
                                            <?php } ?>
                                        </ul>
                                    </div>
                                </div>
                                <div class="content">
                                    <div><?php echo $partner['address']; ?></div>
                                    <div><?php echo $partner['phone']; ?></p></div>
                                </div>
                            </div>
                        </article>
                        <?php 
                        $counter++;
                        }
                        while($counter%3 != 0){
                            $counter++;
                            echo '<article class="partner"></article>';
                        }
                        echo '</div>'; ?>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
    <?php echo $content_bottom; ?>
</div>
<?php echo $footer; ?>