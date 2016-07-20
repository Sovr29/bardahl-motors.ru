<?php echo $header; ?>
<div class="middle">
    <div class="c-container">
      <div class="row">
        <div id="content"><?php echo $content_top; ?>
          <h2><?php echo $text_search; ?></h2>
          <?php if ($products) { ?>
          <div class="row search-params">
            <div class="col-sm-1 text-right">
              <label class="control-label" for="input-sort"><?php echo $text_sort; ?></label>
            </div>
            <div class="col-sm-3 text-right">
              <select id="input-sort" class="form-control input-sm col-sm-3" onchange="location = this.value;">
                <?php foreach ($sorts as $sorts) { ?>
                <?php if ($sorts['value'] == $sort . '-' . $order) { ?>
                <option value="<?php echo $sorts['href']; ?>" selected="selected"><?php echo $sorts['text']; ?></option>
                <?php } else { ?>
                <option value="<?php echo $sorts['href']; ?>"><?php echo $sorts['text']; ?></option>
                <?php } ?>
                <?php } ?>
              </select>
            </div>
            <div class="col-sm-1 text-right">
              <label class="control-label" for="input-limit"><?php echo $text_limit; ?></label>
            </div>
            <div class="col-sm-2 text-right">
              <select id="input-limit" class="form-control input-sm" onchange="location = this.value;">
                <?php foreach ($limits as $limits) { ?>
                <?php if ($limits['value'] == $limit) { ?>
                <option value="<?php echo $limits['href']; ?>" selected="selected"><?php echo $limits['text']; ?></option>
                <?php } else { ?>
                <option value="<?php echo $limits['href']; ?>"><?php echo $limits['text']; ?></option>
                <?php } ?>
                <?php } ?>
              </select>
            </div>
          </div>
          <br />
          <div class="catalog-premium">
            <?php foreach ($products as $i => $product) { ?>
            <article <?php if($product['special']){?> class="special" <?php }?>>
                    <figure>
                        <a href="<?php echo $product['href']; ?>"><img src="<?php echo $product['thumb']; ?>" alt="" /></a>
                        <?php if(!$product['quantity'] > 0){?><span class="outofstock bold">Нет в наличии</span><?php }?>
                    </figure>
                    <div class="txt-premium">
                        <h4><a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a></h4>
                        <p class="prem-text"><?php echo $product['short_description']; ?></p>
                        <div class="input-group input-group-sm">
                            <?php if ($product['price']) { ?>
                                <span class="input-group-addon price bold">
                                    <?php echo (($product['special']) ? $product['special'] : $product['price']); ?>
                                    <i class="fa fa-rub"></i>
                                </span>
                            <?php } ?>
                            <div class="input-group input-group-sm product_ammount">
                                <span class="input-group-btn">
                                  <button class="btn btn-default" type="button" id="product_ammount_down_<?php echo $product['product_id']; ?>" <?php echo ($product['quantity'] > 0 ? '':'disabled');?>><i class="glyphicon glyphicon-minus"></i></button>
                                </span>
                                <input type="text" class="form-control" value="<?php echo $product['minimum']; ?>" id="product_ammount_<?php echo $product['product_id']; ?>" <?php echo ($product['quantity'] > 0 ? '':'disabled');?>>
                                <span class="input-group-btn">
                                  <button class="btn btn-default" type="button" id="product_ammount_up_<?php echo $product['product_id']; ?>" <?php echo ($product['quantity'] > 0 ? '':'disabled');?>><i class="glyphicon glyphicon-plus"></i></button>
                                </span>
                            </div>
                            <span class="input-group-btn">
                                <button class="btn btn-primary" type="button" onclick="cart.add('<?php echo $product['product_id']; ?>', $('#product_ammount_<?php echo $product['product_id']; ?>').val());" <?php echo ($product['quantity'] > 0 ? '':'disabled');?>><i class="glyphicon glyphicon-shopping-cart"></i></button>
                            </span>
                        </div>
                    </div>
                </article>
            <?php } ?>
          </div>
          <div class="row">
            <div class="col-sm-6 text-left"><?php echo $pagination; ?></div>
            <div class="col-sm-6 text-right search-results"><?php echo $results; ?></div>
          </div>
          <?php } else { ?>
          <p><?php echo $text_empty; ?></p>
          <?php } ?>
          <?php echo $content_bottom; ?></div>
        <?php echo $column_right; ?></div>
    </div>
</div>
<?php echo $footer; ?>