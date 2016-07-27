
<div id="shopBucket">
	<span id="cart-total"><?php echo preg_replace("/\(.*/", '',$text_items)." шт."; ?><br>
	На сумму: <b><?php echo $subtotal; ?> р.</b></span>
	<img src="catalog/view/theme/bardahl_new/img/bucket.png" alt="">
</div>
<div class="clr"></div>
<div class="box-list">
	<?php if ($products || $vouchers) { ?>
	<span class="arrow-box"></span>
	<div class="box-list-items">
		<?php foreach ($products as $product) { ?>
			<div class="box-list-item">
				<div class="box-list-item-img">
					<img src="<?php echo $product['thumb']; ?>">
				</div>
				<div class="box-list-item-tit"><p><?php echo $product['name']; ?></p></div>
				<div class="box-list-item-price"><p><?php echo $product['total']; ?> руб.</p></div>
				<div class="item-price">
					   <div class="box-number">
						<input type="text" value="<?php echo $product['quantity']; ?>" />
						<span class="plus" onclick="addto(this);">+</span>
						<span class="minus" onclick="addto(this,1);">-</span>
					   </div>
				</div>
				<div class="clr"></div>
				<button type="button" class="del-box-item btn-danger" onclick="cart.remove('<?php echo $product['key']; ?>');"></button>
			</div>
		<?php } ?>
	</div>
		<div class="price-table">
			<table>
				<?php foreach ($totals as $total) { ?>
					<tr>
						<td><?php echo $total['title']; ?></td>
						<td><span><?php echo $total['text']; ?></span></td>
					</tr>
				<?php } ?>
			</table>
		</div>
	<div class="how-to-discount">*Вам осталось 4556 рублей до получения скидки 15%</div>
	<a href="<?php echo $checkout; ?>" class="box-link-l"><?php echo $text_checkout; ?></a>
	<a href="<?php echo $cart; ?>" class="box-link-r"><?php echo $text_cart; ?></a>

	<?php } else { ?>
		<p class="text-center"><?php echo $text_empty; ?></p>
	<?php } ?>
</div>
<div class="clr"></div>

<div id="add-to-box" style="display: none">
	<div class="f-add-to-box">
		<div class="add-to-box-tit">Вы добавили товар в корзину</div>
		<div class="add-to-box-subtit">Нажмите «Оформить заказ» или закройте окно, чтобы<br> продолжить покупки</div>
		<a href="<?php echo $checkout; ?>"><?php echo $text_checkout; ?></a>
	</div>
</div>