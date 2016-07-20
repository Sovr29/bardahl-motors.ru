<!-- email grabber modal -->
<div class="modal fade" id="oversellModal" tabindex="-1" role="dialog" aria-labelledby="oversellModalLabel">
  <div class="modal-dialog modal-lg modal-oversell" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Закрыть"><span aria-hidden="true">&times;</span></button>
        <div class="h4 modal-title" id="oversellModalLabel">&nbsp;</div>
      </div>
        <div class="modal-body">
            <?php echo($text); ?>
            <div class="catalog-premium">
                <?php foreach ($products as $i => $product) { ?>
                <article>
                        <figure>
                            <a href="<?php echo $product['href']; ?>"><img src="<?php echo $product['thumb']; ?>" alt="" /></a>
                        </figure>
                        <div class="txt-premium">
                            <h4><a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a></h4>
                            <p class="prem-text"><?php echo $product['short_description']; ?></p>
                            <div class="input-group input-group-sm">
                                <?php if ($product['price']) { ?>
                                    <span class="input-group-addon price bold">
                                        <?php echo $product['price']; ?>
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
                                    <button class="btn btn-primary" type="button" onclick="cart.add('<?php echo $product['product_id']; ?>', $('#product_ammount_<?php echo $product['product_id']; ?>').val(), 1, addCallback());" <?php echo ($product['quantity'] > 0 ? '':'disabled');?>><i class="glyphicon glyphicon-shopping-cart"></i></button>
                                </span>
                            </div>
                        </div>
                    </article>
                <?php } ?>
              </div>
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo($button_text); ?></button>
      </div>
    </div>
  </div>
</div>