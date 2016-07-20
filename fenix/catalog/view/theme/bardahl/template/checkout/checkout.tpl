<?php echo $header; ?>
<div class="middle">
    <?php echo $content_top; ?>   
<div class="c-container">
  <?php if ($error_warning) { ?>
  <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
    <button type="button" class="close" data-dismiss="alert">&times;</button>
  </div>
  <?php } ?>
    <?php $class= $coupon ? 'col-sm-2' : 'col-sm-1' ?>
      	<form method="POST" action="<?php echo $formAction;?>" id="createOrder" class="form-horizontal">
            <input type="hidden" id="closed" name="closed" value="<?php echo($closed) ?>"/>
		      <div class="form-group">
		        <label class="<?php echo($class) ?> control-label" for="input-payment-lastname"><?php echo $entry_lastname; ?></label>
		        <div class="col-sm-4">
			        <input type="text" name="lastname" value="<?php echo $lastname; ?>" placeholder="<?php echo $entry_lastname; ?>" id="input-payment-lastname" class="form-control" data-val="true" data-val-required="Необходимо заполнить поле <?php echo $entry_lastname; ?>"/>
			        <span class="glyphicon glyphicon-asterisk form-control-feedback red" aria-hidden="true"></span>
			        <span class="field-validation-valid" data-valmsg-for="lastname" data-valmsg-replace="true"></span>
		        </div>
		      </div>
		      <div class="form-group">
		        <label class="<?php echo($class) ?> control-label" for="input-payment-firstname"><?php echo $entry_firstname; ?></label>
		        <div class="col-sm-4">
			        <input type="text" name="firstname" value="<?php echo $firstname; ?>" placeholder="<?php echo $entry_firstname; ?>" id="input-payment-firstname" class="form-control" data-val="true" data-val-required="Необходимо заполнить поле <?php echo $entry_firstname; ?>"/>
			        <span class="glyphicon glyphicon-asterisk form-control-feedback red" aria-hidden="true"></span>
			        <span class="field-validation-valid" data-valmsg-for="firstname" data-valmsg-replace="true"></span>
		        </div>
		      </div>
		      <div class="form-group">
		        <label class="<?php echo($class) ?> control-label" for="input-payment-email"><?php echo $entry_email; ?></label>
		        <div class="col-sm-4">
			        <input type="text" name="email" value="<?php echo $email; ?>" placeholder="<?php echo $entry_email; ?>" id="input-payment-email" class="form-control" data-val="true" data-val-required="Необходимо заполнить поле <?php echo $entry_email; ?>" data-val-regex="Не корректный e-mail адрес" data-val-regex-pattern="^([0-9a-zA-Z]+[-._+&amp;amp;])*[0-9a-zA-Z]+@([-0-9a-zA-Z]+[.])+[a-zA-Z]{2,6}$"/>
			        <span class="glyphicon glyphicon-asterisk form-control-feedback red" aria-hidden="true"></span>
			        <span class="field-validation-valid" data-valmsg-for="email" data-valmsg-replace="true"></span>
		        </div>
		      </div>
		      <div class="form-group">
		        <label class="<?php echo($class) ?> control-label" for="input-payment-telephone"><?php echo $entry_telephone; ?></label>
		        <div class="col-sm-4">
			        <input type="text" name="telephone" value="<?php echo $telephone; ?>" placeholder="<?php echo $entry_telephone; ?>" id="input-payment-telephone" class="form-control" data-val="true" data-val-required="Необходимо заполнить поле <?php echo $entry_telephone; ?>"/>
			        <span class="glyphicon glyphicon-asterisk form-control-feedback red" aria-hidden="true"></span>
			        <span class="field-validation-valid" data-valmsg-for="telephone" data-valmsg-replace="true"></span>
		        </div>
		      </div>
		      <?php if($shipping_type != 'pickup'){?>
			      	<?php if($shipping_code != 'moscowMKAD'){?>
				      <div class="form-group">
				        <label class="<?php echo($class) ?> control-label" for="input-payment-city"><?php echo $entry_city; ?></label>
				        <div class="col-sm-4">
					        <input type="text" name="city" value="<?php echo $city; ?>" placeholder="<?php echo $entry_city; ?>" id="input-payment-city" class="form-control" data-val="true" data-val-required="Необходимо заполнить поле <?php echo $entry_city; ?>"/>
					        <span class="glyphicon glyphicon-asterisk form-control-feedback red" aria-hidden="true"></span>
					        <span class="field-validation-valid" data-valmsg-for="city" data-valmsg-replace="true"></span>
				        </div>
				      </div>
			      	<?php } ?>
			      <div class="form-group">
			        <label class="<?php echo($class) ?> control-label" for="input-payment-address-1"><?php echo $entry_address_1; ?></label>
			        <div class="col-sm-4">
				        <input type="text" name="address_1" value="<?php echo $address_1; ?>" placeholder="<?php echo $entry_address_1; ?>" id="input-payment-address-1" class="form-control" data-val="true" data-val-required="Необходимо заполнить поле <?php echo $entry_address_1; ?>"/>
				        <span class="glyphicon glyphicon-asterisk form-control-feedback red" aria-hidden="true"></span>
				        <span class="field-validation-valid" data-valmsg-for="address_1" data-valmsg-replace="true"></span>
			        </div>
			      </div>
		      <?php } ?>
		      <div class="form-group">
		        <label class="<?php echo($class) ?> control-label" for="input-payment-comment"><?php echo $entry_comment; ?></label>
		        <div class="col-sm-4">
		        	<textarea id="input-payment-comment" name="comment" rows="8" class="form-control"><?php echo $comment; ?></textarea>
		        </div>
		      </div>
                      <?php if ($coupon) { echo $coupon; } ?>
          
          <div class="payMethod">
              <strong>Способ оплаты:</strong> 
              <?php $counter = 0;foreach ($payment_methods as $pm) { 
			  if($shipping_code == 'deliveryTK' || $shipping_code == 'selectedTK'){
				  if($pm['code'] == 'sb_transfer' || $pm['code'] == 'bill' || $pm['code'] == 'unitpay')
				  {?>
					  <label><input type="radio" name="payMethod" <?php echo ($counter==0 ? 'checked':'') ?> value="<?php echo $pm['code'] ?>"> <?php echo $pm['title'] ?></label>
				  <?php $counter++;}
			  }else{
              	if(
                        (
                            ($pm['code'] == 'card' && ($shipping_code == 'spb' || $shipping_code == 'pickup_spb' || $shipping_code == 'pickup_spb_2' || $shipping_code == 'pickup_msk'))
                            || 
                            $pm['code'] != 'card'
                        ) 
                        && 
                        ($pm['code'] != 'sb_transfer' && $pm['code'] != 'bill')
                        &&
                        (
                            $pm['code'] != 'unitpay'
                            ||
                            ($pm['code'] == 'unitpay' && ($shipping_code == 'pickup_msk' || $shipping_code == 'moscowMKAD' || $shipping_code == 'moscowMKAD15' || $shipping_code == 'moscowArea'))
                        )
                ){?>
              <label><input type="radio" name="payMethod" <?php echo ($counter==0 ? 'checked':'') ?> value="<?php echo $pm['code'] ?>"> <?php echo $pm['title'] ?></label>
              <?php $counter++;}
			  }
              } ?>
          </div>
          
          <div class="cartTableDiv">
              <div class="hSimple">Подтверждение заказа</div>
          <table class="table table-bordered cartTable">
            <thead>
              <tr>
                <td class="text-center"><?php echo $column_image; ?></td>
                <td class="text-left"><?php echo $column_name; ?></td>
                <td class="text-left"><?php echo $column_quantity; ?></td>
                <td class="text-right"><?php echo $column_price; ?></td>
                <td class="text-right"><?php echo $column_total; ?></td>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($products as $product) { ?>
              <tr>
                <td class="image text-center"><?php if ($product['thumb']) { ?>
                  <a href="<?php echo $product['href']; ?>"><img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" title="<?php echo $product['name']; ?>" class="img-thumbnail" /></a>
                  <?php } ?></td>
                <td class="product"><a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a>
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
                <td class="quantity"><div class="input-group btn-block">
                    <?php echo $product['quantity']; ?> (<a href="<?php echo $cart;?>">Изменить</a>)
                </td>
                <td class="price text-right"><span><?php echo $product['price']; ?> <i class="fa fa-rub"></i></span></td>
                <td class="price text-right"><span><?php echo $product['total']; ?> <i class="fa fa-rub"></i></span></td>
              </tr>
              <?php } ?>      
            </tbody>
          </table>
          <div class="row cartTotalPrice">
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
            </div>
             <input type="submit" value="Подтвердить" class="btn btn-primary" id="checkout_submit_btn">
          </div>
      </form>
      
  <?php echo $content_bottom; ?>
</div>
</div>

<?php echo $footer; ?>