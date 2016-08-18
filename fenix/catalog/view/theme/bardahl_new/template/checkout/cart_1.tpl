<?php echo $header; ?>
<div class="c_middle">
    <?php echo $content_top; ?>
	<div class="wrapper">
		<div class="pag-2">
			<ul>
				<?php foreach($data['breadcrumbs'] as $breadcrumb) { ?>
					<li><a href="<?php echo $breadcrumb ["href"]; ?>"><?php echo $breadcrumb ["text"]; ?></a></li>
					<li>&#187;</li>
				<?php } ?>
			</ul>
		</div>
		<div class="clr"></div>
		<div class="cont-del">
			<div class="cont-tit"><?php echo $heading_title; ?></div>
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

			<div class="discount-wrp">
                <table class="cart_table">
                	<tr class="tbl_title">
                        <td><?php echo $column_image; ?></td>
                        <td><?php echo $column_name; ?></td>
                        <td><?php echo $column_price; ?></td>
                        <td><?php echo $column_quantity; ?></td>
                        <td><?php echo $column_total; ?></td>
                    </tr>
                    <?php foreach ($products as $product) { ?>
	                    <tr>
	                        <td>
	                            <img class="remove" onclick="cart.remove('<?php echo $product['key']; ?>');" src="catalog/view/theme/bardahl_new/img/remove.png" alt="" title="Удалить">
	                            <?php if ($product['thumb']) { ?>
	                            	<img class="cart_foto" src="<?php echo $product['thumb']; ?>" alt="Нет фото">
	                            <?php } ?>
	                        </td>
	                        <td>
	                            <p class="tbl_cat">Моторное масло</p>
	                            <a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a>
	                        </td>
	                        <td class="tbl_price"><?php echo $product['price']; ?> ₽</td>
	                        <td>
	                           <div class="tbl_box">
	                                <span class="tbl_minus">-</span>
	                                <input type="text" value="<?php echo $product['quantity']; ?>">
	                                <span class="tbl_plus">+</span>
	                           </div>
	                        </td>
	                        <td class="tbl_price"><?php echo $product['total']; ?> ₽</td>
	                    </tr>
                    <?php } ?>
                </table>
			</div>

			<div class="clr"></div>
		</div>
		<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" class="cont_order">
                <div class="info-left">
                    <p class="info-title">Как вы хотите получить товар?</p>
                    <div class="style-select">
                        <select name="" id="">
                            <option value="">Доставка курьером +500 ₽</option>
                        </select>
                    </div>
                    <input type="text" placeholder="Город">
                    <input type="text" placeholder="Улица">
                    <input type="text" placeholder="Дом">
                    <input type="text" placeholder="Квартира">
                    <textarea name="comment" cols="30" rows="4" placeholder="Комментарий к адресу доставки"></textarea>
                </div>
                <div class="sum-right">
                    <p class="info-title">Сумма заказа</p>
                    <?php foreach ($totals as $total) { ?>
	                    <div class="sum_info">
	                        <p class="sum_left"><?php echo $total['title']; ?></p>
	                        <p class="sum_right">
	                        	<?php if ($total['title'] == 'Итого') { ?>
	                        		<span><?php echo $total['text']; ?> ₽</span></p>
	                        	<?php } else { ?>
	                        		<?php echo $total['text']; ?> ₽</p>
	                        	<?php } ?>
	                    </div>
					<?php } ?>
                    <div class="submit">
                        <input type="text" placeholder="Введите код...">
                        <button name="discount">Купон на скидку</button><br>
                        <a href="<?php echo $checkout; ?>" class="ready">Оформить заказ</a>
                        <a href="<?php echo $continue; ?>" class="continue"><?php echo $button_shopping; ?></a>
                    </div>
                </div>
		</form>
	</div>
  	<?php echo $content_bottom; ?>
</div>
<?php echo $footer; ?>