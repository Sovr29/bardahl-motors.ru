<?php echo $header; ?>
<div class="middle">
    <?php echo $content_top; ?>   
<div class="c-container">
      <h1 id="header_title"><?php echo $heading_title; ?></h1>
        <?php if ($attention) { ?>
            <div class="alert alert-info"><i class="fa fa-info-circle"></i> <?php echo $attention; ?>
              <button type="button" class="close" data-dismiss="alert">&times;</button>
            </div>
        <?php } ?>
        <?php if ($success) { ?>
            <div class="alert alert-success"><i class="fa fa-check-circle"></i> <?php echo $success; ?>
              <button type="button" class="close" data-dismiss="alert">&times;</button>
            </div>
        <?php } ?>
        <?php if ($error_warning) { ?>
            <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
              <button type="button" class="close" data-dismiss="alert">&times;</button>
            </div>
        <?php } ?>
      <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
        <div class="table-responsive">
          <table class="table table-bordered cartTable">
            <thead>
              <tr>
                <td class="text-center"><?php echo $column_image; ?></td>
                <td class="text-center"><?php echo $column_name; ?></td>
                <td class="text-center"><?php echo $column_quantity; ?></td>
                <td class="text-right"><?php echo $column_price; ?></td>
                <td class="text-right"><?php echo $column_total; ?></td>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($products as $product) { ?>
              <tr>
                <td class="text-center image"><?php if ($product['thumb']) { ?>
                  <a href="<?php echo $product['href']; ?>"><img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" title="<?php echo $product['name']; ?>" class="img-thumbnail" /></a>
                  <?php } ?></td>
                <td class="text-left"><a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a>
                  <?php if (!$product['stock']) { ?>
                  <span class="text-danger">***</span>
                  <?php } ?>
                  <?php if ($product['option']) { ?>
                  <?php foreach ($product['option'] as $option) { ?>
                  <br />
                  <small><?php echo $option['name']; ?>: <?php echo $option['value']; ?></small>
                  <?php } ?>
                  <?php } ?>
                  <?php if ($product['reward']) { ?>
                  <br />
                  <small><?php echo $product['reward']; ?></small>
                  <?php } ?>
                  <?php if ($product['recurring']) { ?>
                  <br />
                  <span class="label label-info"><?php echo $text_recurring_item; ?></span> <small><?php echo $product['recurring']; ?></small>
                  <?php } ?></td>
                <td class="text-center"><div class="input-group btn-block" style="max-width: 200px; margin:auto;">
                        <?php 
                            $update_value = $product['quantity'] + 1;
                            $remove_value = $product['quantity'] - 1;
                        ?>
                    
                    
                    <input type="text" name="quantity[<?php echo $product['key']; ?>]" value="<?php echo $product['quantity']; ?>" size="1" class="form-control" />
                    <span class="input-group-btn">
                        <button type="button" data-toggle="tooltip" title="<?php echo $button_update; ?>" class="btn btn-primary" onclick="cart.custUpdate('<?php  echo $product['key']; ?>', '<?php echo $update_value;?>');">+</button>
                        
                        <?php
                            if($product['quantity'] > 1){
                                ?>
                                <button type="button" data-toggle="tooltip" title="Вычесть единицу товара" class="btn btn-primary" onclick="cart.custUpdate('<?php  echo $product['key']; ?>', '<?php echo $remove_value;?>');">-</button>
                                <?php
                            }
                            else{
                            ?>
                                <button type="button" data-toggle="tooltip" title="<?php  echo $button_remove; ?>" class="btn btn-danger" onclick="cart.remove('<?php echo $product['key']; ?>');"><i class="fa fa-times-circle"></i></button></span></div></td>
                            <?php
                            }
                        ?>
                        
                    <!--<button type="submit" data-toggle="tooltip" title="<?php echo $button_update; ?>" class="btn btn-primary"><i class="fa fa-refresh"></i></button>-->
                    <!--<button type="button" data-toggle="tooltip" title="<?php echo $button_remove; ?>" class="btn btn-danger" onclick="cart.remove('<?php echo $product['key']; ?>');"><i class="fa fa-times-circle"></i></button></span></div></td>-->
                <td class="text-right"><?php echo $product['price']; ?> <i class="fa fa-rub"></i></td>
                <td class="text-right"><?php echo $product['total']; ?> <i class="fa fa-rub"></i></td>
              </tr>
              <?php } ?>
              <?php foreach ($vouchers as $vouchers) { ?>
              <tr>
                <td></td>
                <td class="text-left"><?php echo $vouchers['description']; ?></td>
                <td class="text-left"></td>
                <td class="text-left"><div class="input-group btn-block" style="max-width: 200px;">
                    <input type="text" name="" value="1" size="1" disabled="disabled" class="form-control" />
                    <span class="input-group-btn"><button type="button" data-toggle="tooltip" title="<?php echo $button_remove; ?>" class="btn btn-danger" onclick="voucher.remove('<?php echo $vouchers['key']; ?>');"><i class="fa fa-times-circle"></i></button></span></div></td>
                <td class="text-right"><?php echo $vouchers['amount']; ?></td>
                <td class="text-right"><?php echo $vouchers['amount']; ?></td>
              </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </form>
    <div class="row cartTotalPrice">
        <div class="col-sm-4 col-sm-offset-8">
          <table id="total" class="table table-bordered">
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
        </div>
    </div>
    <?php echo $shipping_method; ?>
    <div class="buttonsChekout">       
     <a href="<?php echo $checkout; ?>" data-href="<?php echo $checkout; ?>" class="btnCheckout">Оформить заказ</a>
     <a href="<?php echo $continue; ?>" class="btnBack"><?php echo $button_shopping; ?></a>
    </div>
  <?php echo $content_bottom; ?>
</div>
</div>
<?php echo $footer; ?>