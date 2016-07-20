<div class="shipping">
    <div class="hBig">Как Вы хотите получить товар?</div>
    <div class="left">
        <div class="hSmall">Самовывоз:</div>
        <?php foreach ($shipping_methods['pickup']['quote'] as $shipping_method) { ?>
                            <label>
            <input type="radio" name="shipping_method" value="<?php echo $shipping_method['code']; ?>">
            <?php echo $shipping_method['address']; ?>
            </label>
                    <?php }?>
    </div>
    <div class="right">
        <div class="hSmall">Доставка:</div>
        <?php foreach ($shipping_methods['delivery']['quote'] as $shipping_method) { ?>
                            <label>
                    <input type="radio" name="shipping_method" value="<?php echo $shipping_method['code']; ?>" >
                    <?php echo $shipping_method['address']; ?>
                </label>
                    <?php }?>
        <br/><br/>
                    <div class="hSmall"><a href="/delivery">Бесплатная доставка по Москве и Петербургу при заказе от 8 000 <i class="fa fa-rub"></i></a></div>
    </div>
    <div class="clear"></div>
</div>
<div class="shipping_errors text-danger"></div>