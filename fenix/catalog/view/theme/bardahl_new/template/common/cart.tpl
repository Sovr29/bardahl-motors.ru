<?php if($showOnlyTotal == 1){ ?>
    <div class="col-sm-4 col-sm-offset-8">
      <table id="total" class="table table-bordered">
        <?php foreach ($totals as $total) { ?>
        <tr>
          <?php if($total['show_possible_discount']){?>
                <td colspan="2"  class="text-right success"><?php echo $total['title']; ?> <?php echo $total['text']; ?> <i class="fa fa-rub"></i></td>
            <?php } else { ?>
                <td class="text-right"><strong><?php echo $total['title']; ?></strong></td>
                <td class="text-right"><?php echo $total['text']; ?> <i class="fa fa-rub"></i></td>
            <?php } ?>
        </tr>
        <?php } ?>
      </table>
    </div>
<?php } else{ ?>
    <div id="cart" class="btn-group btn-block">
        <button type="button" data-toggle="dropdown" data-loading-text="<?php echo $text_loading; ?>" class="btn btn-inverse btn-block btn-sm dropdown-toggle"><i class="glyphicon glyphicon-shopping-cart"></i> <span id="cart-total"><?php echo $text_items; ?></span></button>
        <ul class="dropdown-menu pull-right">
          <?php if ($products || $vouchers) { ?>
          <li class="items">
              <form action="http://bardahl-motor.ru/index.php?route=checkout/cart/edit" method="post" enctype="multipart/form-data">
                  <input type="hidden" name="redirect" value="<?php echo $hidden_redirect_value; ?>"/>
                    <table class="table table-striped">
                  <?php foreach ($products as $product) { ?>
                  <tr>
                    <td class="text-center"><?php if ($product['thumb']) { ?>
                      <a href="<?php echo $product['href']; ?>"><img style="width: 80%;" src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" title="<?php echo $product['name']; ?>" class="img-thumbnail" /></a>
                      <?php } ?></td>
                    <td class="text-left"><a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a>
                      <?php if ($product['option']) { ?>
                      <?php foreach ($product['option'] as $option) { ?>
                      <br />
                      - <small><?php echo $option['name']; ?> <?php echo $option['value']; ?></small>
                      <?php } ?>
                      <?php } ?>
                      <?php if ($product['recurring']) { ?>
                      <br />
                      - <small><?php echo $text_recurring; ?> <?php echo $product['recurring']; ?></small>
                      <?php } ?></td>
                    <td class="text-right" style="width: 15%;">
                        <!--x <?php echo $product['quantity']; ?>-->
                        <input type="text" name="quantity[<?php echo $product['key']; ?>]" value="<?php echo $product['quantity']; ?>" size="1" class="form-control" />
                    </td>
                    <td class="text-right"><?php echo $product['total']; ?> <i class="fa fa-rub"></i></td>
                    <td class="text-center" style="width: 10%;">
                        <span class="input-group-btn">
                            <button style="margin-right: 5px; height: 32px;" type="submit" data-toggle="tooltip" title="Обновить" class="btn btn-primary"><i class="fa fa-refresh"></i></button>
                            <button style="height: 32px; width: 35px;" type="button" onclick="cart.remove('<?php echo $product['key']; ?>');" title="Удалить" class="btn btn-danger btn-xs"><i class="fa fa-times"></i></button>
                        </span>
                        <!--<button type="button" onclick="cart.remove('<?php echo $product['key']; ?>');" title="<?php echo $button_remove; ?>" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-remove"></i></button>-->
                    </td>
                  </tr>
                  <?php } ?>
                  <?php foreach ($vouchers as $voucher) { ?>
                  <tr>
                    <td class="text-center"></td>
                    <td class="text-left"><?php echo $voucher['description']; ?></td>
                    <td class="text-right">x&nbsp;1</td>
                    <td class="text-right"><?php echo $voucher['amount']; ?></td>
                    <td class="text-center text-danger"><button type="button" onclick="voucher.remove('<?php echo $voucher['key']; ?>');" title="<?php echo $button_remove; ?>" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-remove"></i></button></td>
                  </tr>
                  <?php } ?>
                </table>
              </form>
          </li>
          <li>
            <div>
              <table class="table table-bordered">
                <?php foreach ($totals as $total) { ?>
                <tr>
                    <?php if($total['show_possible_discount']){?>
                        <td colspan="2" class="text-right success"><?php echo $total['title']; ?> <?php echo $total['text']; ?> <i class="fa fa-rub"></i></td>
                    <?php } else { ?>
                        <td class="text-right"><strong><?php echo $total['title']; ?></strong></td>
                        <td class="text-right"><?php echo $total['text']; ?> <i class="fa fa-rub"></i></td>
                    <?php } ?>
                </tr>
                <?php } ?>
              </table>
              <p class="text-right"><a href="<?php echo $cart; ?>"><strong><i class="glyphicon glyphicon-shopping-cart"></i> <?php echo $text_cart; ?></strong></a>&nbsp;&nbsp;&nbsp;<a  href="<?php echo $checkout; ?>" data-href="<?php echo $checkout; ?>"><strong><i class="glyphicon glyphicon-share-alt"></i> <?php echo $text_checkout; ?></strong></a></p><!-- id="showShippingModal" -->
            </div>
          </li>
          <?php } else { ?>
          <li>
            <p class="text-center"><?php echo $text_empty; ?></p>
          </li>
          <?php } ?>
        </ul>
    </div>
<?php }?>