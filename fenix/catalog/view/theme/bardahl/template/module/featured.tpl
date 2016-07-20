<section class="featured">
    <div class="table">
        <?php foreach ($products as $product) { ?>
        <article class="table-cell<?php if($product['special']){?> special<?php }?>">
                    <figure>
                        <a href="<?php echo $product['href']; ?>"><img src="<?php echo $product['thumb']; ?>" alt="" /></a>
                    </figure>
                    <div class="txt-premium">
                        <h4><a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a></h4>
                        <?php if ($product['price']) { ?>
                            <span class="input-group-addon price bold">
                                <?php echo (($product['special']) ? $product['special'] : $product['price']); ?>
                                <i class="fa fa-rub"></i>
                            </span>
                        <?php } ?>
                        <button class="btn btn-primary" type="button" onclick="cart.add('<?php echo $product['product_id']; ?>', 1);">Купить</button>
                    </div>
                </article>
         <?php } ?>
    </div>
    <div class="separator">
        <span class="first">Доставка по всей России</span>
        <span class="second">Гарантия качества</span>
        <span class="third">Клиентская служба поддержки</span>
    </div>
</section>