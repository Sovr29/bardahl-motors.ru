<?php echo $header; ?>
<div class="middle">
    <div class="c-container">
        <?php echo $content_top; ?>
        <?php if ($products) { ?>
        <section class="motor-premium">
            <div class="c-container">
            <?php foreach ($products as $i => $product) {  ?>
                <?php if(!isset($ctype) || $ctype != $product['type']['type_id'] ) { ?>
                <?php if(isset($ctype)) {?>
                    </div>
                    </div>
                    </section>
                    <section class="motor-premium">
                    <div class="c-container">
                <?php } ?>

                <h3><?php echo $product['type']['name'] ;?></h3>
                <?php echo $product['type']['description'] ;?>
                <div class="catalog-premium">
                <?php } ?>                            
                <article <?php if($product['special']){?> class="special" <?php }?>>
                    <figure>
                        <a href="<?php echo $product['href']; ?>"><img src="<?php echo $product['thumb']; ?>" alt="" /></a>
                        <?php if($product['quantity'] <= 0){?><span class="outofstock bold">Нет в наличии</span><?php }?>
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
                <?php if(($i+1) == count($products)) {?>
                    </div>
                    </div>
                    </section>
                <?php } ?>
            <?php $ctype = $product['type']['type_id'];  } ?>
        <?php } ?>
        <?php echo $content_bottom; ?>
    </div>
</div>
<?php echo $footer; ?>
<script type="text/javascript"><!--
    (function($) {
        function changeAmmount(id, inc){
            var productId = parseInt(id.substring((inc ? 'product_ammount_up_' : 'product_ammount_down_').length), 10);
            if(productId > 0)
            {
                var ammount = parseInt($('#product_ammount_' + productId).val(), 10);
                if(ammount === undefined || ammount === null || isNaN(ammount))
                {
                    ammount = 1;
                }
                if(inc)
                {
                    ammount++;
                }
                else{
                    if(ammount-1 > 0)
                    {
                        ammount--;
                    }
                }
                $('#product_ammount_' + productId).val(ammount);
            }
        };
        $(document).ready(function(){
            $('button[id^=product_ammount_down_]').click(function(){
                changeAmmount($(this).prop('id'), false);
            });
            $('button[id^=product_ammount_up_]').click(function(){
                changeAmmount($(this).prop('id'), true);
            });
            $('input[id^=product_ammount_]').change(function() {
                var val = parseInt($(this).val(), 10);
                if(val === undefined || val === null || isNaN(val) || val < 1)
                {
                    val = 1;
                }
                $(this).val(val);
              });
        });
    })(jQuery);
--></script>
