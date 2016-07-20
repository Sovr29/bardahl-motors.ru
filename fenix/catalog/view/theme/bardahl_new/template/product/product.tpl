<?php

echo $header; ?>
<div class="middle">
    <div class="c-container">     
        <div class="card">
            <div class="t-card clearfix">
                <div class="l-card">
                    <figure>
                        <?php if ($thumb) { ?>
                        <img src="<?php echo $thumb; ?>" title="<?php echo $heading_title; ?>" alt="<?php echo $heading_title; ?>" />
                        <?php } ?>
                    </figure>
                    <div class="b-card clearfix">
                        <div>
                            <?php if ($price) { ?>
                                <ul class="list-unstyled">
                                    <?php if (!$special) { ?>
                                        <li>
                                            <div class="price bold"><?php echo $price; ?> <i class="fa fa-rub"></i></div>
                                        </li>
                                    <?php } else { ?>
                                        <li><span class="price bold special"><?php echo $price; ?> <i class="fa fa-rub"></i></span></li>
                                        <li><div class="price bold"><?php echo $special; ?> <i class="fa fa-rub"></i></div></li>
                                    <?php } ?>	
                                    <?php if ($discounts) { ?>
                                        <li>
                                            <hr>
                                        </li>
                                        <?php foreach ($discounts as $discount) { ?>
                                        <li><?php echo $discount['quantity']; ?><?php echo $text_discount; ?><?php echo $discount['price']; ?> <i class="fa fa-rub"></i></li>
                                        <?php } ?>
                                    <?php } ?>
                                </ul>
                            <?php } ?>
                            <div>
                                <button href="javascript:void(0);" onclick="cart.add('<?php echo $product_id; ?>', '<?php echo 1 ?>');" class="btn btn-primary bt-bsk bold" <?php echo ($quantity > 0 ? '':'disabled');?>><?php if($quantity > 0){?><i class="glyphicon glyphicon-shopping-cart"></i>В корзину<?php }else{?>Нет в наличии<?php }?></button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="r-card">
                    <div class="t-r-card">
                        <div class="hed-card bold"><?php echo $heading_title; ?></div>
                        <div class="articul">
                            <?php if ($sku) { ?>
                                Артикул: <strong><?php echo $sku; ?></strong>
                            <?php } ?>
                        </div>
                        <?php foreach ($attribute_groups as $attribute_group) { foreach ($attribute_group['attribute'] as $attribute) { ?>
                        <div class="volum"><?php echo $attribute['name'].' '.$attribute['text'];?></div>
                        <?php }} ?>			                        
                    </div>
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab-description" data-toggle="tab"><?php echo $tab_description; ?></a></li>
                        <?php if ($admission) { ?>
                            <li><a href="#tab-admission" data-toggle="tab"><?php echo $tab_admission; ?></a></li>
                        <?php } ?>
						<?php if ($technical_info) { ?>
                            <li><a href="#tab-technical_info" data-toggle="tab"><?php echo $tab_technical_info; ?></a></li>
                        <?php } ?>
                        <?php if ($attribute_groups) { ?>
                         <li><a href="#tab-specification" data-toggle="tab"><?php echo $tab_attribute; ?></a></li>
                        <?php } ?>
                        <?php if ($review_status) { ?>
                            <li><a href="#tab-review" data-toggle="tab"><?php echo $tab_review; ?></a></li>
                        <?php } ?>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab-description"><?php echo $description; ?></div>
                        <?php if ($admission) { ?>
                            <div class="tab-pane" id="tab-admission"><?php echo $admission; ?></div>
                        <?php } ?>
						<?php if ($technical_info) { ?>
                            <div class="tab-pane" id="tab-technical_info"><?php echo $technical_info; ?></div>
                        <?php } ?>
                        <?php if ($attribute_groups) { ?>
                        <div class="tab-pane" id="tab-specification">
                            <table class="table table-bordered">
                                <?php foreach ($attribute_groups as $attribute_group) { ?>
                                <thead>
                                    <tr>
                                        <td colspan="2"><strong><?php echo $attribute_group['name']; ?></strong></td>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($attribute_group['attribute'] as $attribute) { ?>
                                    <tr>
                                        <td><?php echo $attribute['name']; ?></td>
                                        <td><?php echo $attribute['text']; ?></td>
                                    </tr>
                                <?php } ?>
                                </tbody>
                                <?php } ?>
                            </table>
                        </div>
                        <?php } ?>
                        <?php if ($review_status) { ?>
                        <div class="tab-pane" id="tab-review">
                            <form class="form-horizontal" id="form-review">
                                <div id="review"></div>
                                <div class="buttons clearfix">
                                    <div>
                                        <button type="button" id="button-show-review-modal" class="btn btn-primary"><?php echo $button_continue; ?></button>
                                    </div>
                                </div>
                                <!-- Modal -->
                                <div class="modal fade" id="createReviewModal" tabindex="-1" role="dialog" aria-labelledby="createReviewModalLabel">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Закрыть"><span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title" id="createReviewModalLabel">Создание отзыва</h4>
                                            </div>
                                            <div class="modal-body">
                                                <h2><?php echo $text_write; ?></h2>
                                                <?php if ($review_guest) { ?>
                                                <div class="form-group required">
                                                    <div class="col-sm-12">
                                                        <label class="control-label" for="input-name"><?php echo $entry_name; ?></label>
                                                        <input type="text" name="name" value="" id="input-name" class="form-control" />
                                                    </div>
                                                </div>
                                                <div class="form-group required">
                                                    <div class="col-sm-12">
                                                        <label class="control-label" for="input-review"><?php echo $entry_review; ?></label>
                                                        <textarea name="text" rows="5" id="input-review" class="form-control"></textarea>
                                                        <div class="help-block"><?php echo $text_note; ?></div>
                                                    </div>
                                                </div>
                                                <div class="form-group required">
                                                    <div class="col-sm-12">
                                                        <label class="control-label"><?php echo $entry_rating; ?></label>
                                                        &nbsp;&nbsp;&nbsp; <?php echo $entry_bad; ?>&nbsp;
                                                        <input type="radio" name="rating" value="1" />
                                                        &nbsp;
                                                        <input type="radio" name="rating" value="2" />
                                                        &nbsp;
                                                        <input type="radio" name="rating" value="3" />
                                                        &nbsp;
                                                        <input type="radio" name="rating" value="4" />
                                                        &nbsp;
                                                        <input type="radio" name="rating" value="5" />
                                                        &nbsp;<?php echo $entry_good; ?></div>
                                                </div>
                                                <?php if ($site_key) { ?>
                                                <div class="form-group">
                                                    <div class="col-sm-12">
                                                        <div class="g-recaptcha" data-sitekey="<?php echo $site_key; ?>"></div>
                                                    </div>
                                                </div>
                                                <?php } ?>
                                                <?php } else { ?>
                                                    <?php echo $text_login; ?>
                                                <?php } ?>
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                                                <button type="button" id="button-review" data-loading-text="<?php echo $text_loading; ?>" class="btn btn-primary"><?php echo $button_continue; ?></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    <?php } ?>
                    </div>
                </div>
            </div>
            <?php if ($products) { ?>
            <div class="similar-product">
                <div class="hed-prod">Вместе с этим товаром покупают:</div>
                <div class="flexslider slide-main">
                    <ul class="slides">
                        <?php 
                            $count = count($products);
                            $i = 1;
                        ?>
                        <li>
                            <?php foreach ($products as $product) { ?>
                            <div class="item">
                                <figure><a href="<?php echo $product['href']; ?>"><img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" /></a></figure>
                                <div class="txt-slide">
                                    <h3><a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a></h3>
                                    <span class="price"><?php echo $product['price']; ?> <i class="fa fa-rub"></i></span>
                                    <button class="btn btn-primary" type="button" onclick="cart.add('<?php echo $product['product_id']; ?>', 1);"><i class="glyphicon glyphicon-shopping-cart"></i></button>
                                </div>
                            </div>
                            <?php if (($i % 4) == 0 && $i !=$count) { ?>
                                </li>
                                <li>
                            <?php } ?>
                            <?php $i++; } ?>
                        </li>  

                    </ul>
                </div>
            </div>
        <?php } ?>
        </div>
    <?php echo $content_bottom; ?>
    </div>
</div>
<?php echo $footer; ?>
