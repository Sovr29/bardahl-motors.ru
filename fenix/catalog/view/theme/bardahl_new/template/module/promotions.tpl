<?php echo $header; ?>
<div class="middle">
    <div class="c-container">
			<div class="wrapper">
			<div class="pag-2">
				<ul>
					<li><a href="#">Главная</a></li>
					<li>&#187;</li>
					<li class="active"><a href="#">Скидки и акции</a></li>
				</ul>
			</div>
		<div class="clr"></div>
		<div class="cont-del">
			<div class="cont-tit">Скидки и акции</div>
			<div class="discount-wrp">
				<div class="discount-item f-left">
					<div class="discount-tit">Разовая скидка</div>
					<div class="sep-7"></div>
					<img src="/catalog/view/theme/bardahl_new/img/discount-item-left.jpg">
				</div>
				<div class="discount-item f-right">
					<div class="discount-tit">Накопительная скидка</div>
					<div class="sep-7"></div>
					<img src="/catalog/view/theme/bardahl_new/img/discount-item-right.jpg">
				</div>
				<div class="clr"></div>
				<div class="discount-des">
					<div class="discount-des-tit">Текущие акции</div>
					<div class="discount-des-sep"></div>
					<div class="discount-des-text">Скидочная программа действительна на весь ассортимент продукции, за исключением сервисных объемов (50 литров и более). На данные позиции указана рекомендуемая розничная цена со скидкой.
					На данный момент акционные предложения действительны для заказов с  Москвы и Московской области и региональных заказов (за исключением магазинов Санкт-Петербурга и Воронежа).</div>
				</div>
				<div class="discount-stocks">
					<?php foreach ($promotions as $promotion) { ?>
						<div class="discount-stock">
							<div class="discount-stock-tit"><?php echo $promotion['title']; ?></div>
							<img src="<?php echo $promotion['image']; ?>" alt="Нет фото">
							<div class="discount-stock-des"><?php echo $promotion['description']; ?></div>
							<div class="discount-stock-time">Акция действует с <?php echo $promotion['date_begin']; ?> по <?php echo $promotion['date_end']; ?></div>
							<div class="discount-stock-link"><a href="<?php echo $promotion['view']; ?>">Узнать подробности</a></div>
						</div>
					<?php } ?>
				</div>
			</div>
			<div class="clr"></div>
		</div>
	</div>
    </div>
</div>
<?php echo $content_bottom; ?>
<?php echo $footer; ?>