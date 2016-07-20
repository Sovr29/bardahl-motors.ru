<section class="featured">
    <div class="h_wrapper">
        <span class="hitsHeader">Хиты продаж</span>
        	<a class="hitPrev"><img src="catalog/view/theme/bardahl_new/img/arrroPrev.png" alt=""></a>
			<a class="hitNext"><img src="catalog/view/theme/bardahl_new/img/arrowNext.png" alt=""></a>
        <div id="hitsOwl" class="owl-carousel owl-theme">
        	<?php foreach ($products as $product) { ?>
				<div class="hitItem">
                    <div class="hitImg"><img width="127" height="127" src="<?php echo $product['thumb']; ?>" alt=""></div>
                    <span class="hitTitle"><?php echo $product['name']; ?></span>
                    <span class="hitInfo"><span style="color:#de2c18;">3120</span> <span style="text-decoration:underline;"><?php echo $product['description']; ?></span></span>
                    <span  class="hitPrice"><?php echo $product['price']; ?></span>
                    <a href="cart.add('<?php echo $product['product_id']; ?>" class="hitBtn add-box" >КУПИТЬ</a>
                </div>
        	 <?php } ?>
         </div>
    </div>
</section>
