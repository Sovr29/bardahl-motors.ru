<!-- Страница каталога товаров products -->
<?php echo $header; ?>
<div class="middle">
    <div class="c-container">
        <?php echo $content_top; ?>
				<div class="main">
		<div class="container">
			<div class="sidebar">
				<div class="widg">
					<div class="widg-head">Категории</div>
					<div class="widg-content">
						<ul class="cats">
							<?php foreach ($categories as $category) { ?>
								<li><a href="<?php echo $category['href']; ?>"><?php echo $category['name']; ?></a></li>
							<?php } ?>
						</ul>
					</div>
				</div>
				<div class="widg">
					<div class="widg-head">Фильтр товаров</div>
					<p class="widd-des">Диапазон цен От и До</p>
					<div id="options" class="widg-content">
						<form>
							<label for="price">От
								<input type="text" name="price" id="price">
							</label>
							<label for="price2">До
								<input type="text" name="price2" id="price2">
							</label>
						</form>
						<div id="slider_price"></div>
					</div>
					<div class="check">
						<label><input type="checkbox"/> Есть в наличии</label>
					</div>
				</div>
				<div class="widg">
					<div class="widg-head">Моторные масла</div>
					<div class="widg-content">
						<ul id="my-menu" class="main-choose">
							<?php foreach ($categories[0]['children'] as $child) {?>
								<li>
								<span class="main-choose-tit"><?php echo $child['name']; ?></span>
									<ul  class="second-choose">
										<li><label><input type="checkbox"/> XTC C60 (90)</label></li>
										<li><label><input type="checkbox"/> XTC C60 (90)</label></li>
										<li><label><input type="checkbox"/> XTC C60 (90)</label></li>
										<li><label><input type="checkbox"/> XTC C60 (90)</label></li>
									</ul>
								</li>
							<?php } ?>
						</ul>
					</div>
				</div>
				<span class="clr-filtr"><a href="#">Сбросить фильтр</a></span>
				<div class="stocks">
					<div class="stocks-tit">Акции</div>
					<?php for ($i = 0; $i < 4; $i++) { ?>
						<div class="stock">
							<div class="stock-tit"><?php echo $promotions[$i]['title']?></div>
							<img src="<?php echo $promotions[$i]['image']?>">
							<div class="stock-des"><?php echo $promotions[$i]['description']?></div>
							<div class="stock-time">Акция действует с <?php echo $promotions[$i]['date_begin']?> по <?php echo $promotions[$i]['date_end']?></div>
							<div class="stock-link"><a href="<?php echo $promotions[$i]['view']?>">Узнать подробности</a></div>
						</div>
					<?php } ?>
				</div>
			</div>
			<div class="content">
				<div class="pag">
					<ul>
						<?php foreach ($breadcrumbs as $breadcrumb){ ?>
							<li><a href="<?php echo $breadcrumb['href']?>"><?php echo $breadcrumb['text']?></a></li>
							<li>&#187;</li>
						<?php } ?>
					</ul>
				</div>
				<div class="clr"></div>
				<h1 class="catalog-tit">Купить масло Bardahl</h1>
				<div class="calalog-opt">
					<div class="sort">
						Сортировать по:
						<?php foreach ($sorts as $sort) { ?>
							<a href="<?php echo $sort['href']?>"><?php echo $sort['text']?></a>
						<?php  } ?>
					</div>
					<div class="show">
						Показать:  <a href="#">витриной</a> <a href="#">списком</a>
					</div>
				</div>
				<div class="search-tit">Найдено товаров по вашему запросу: <span><?php echo count($products); ?></span></div>
				<div class="items">
					<?php for ($i = $offset; $i < $count; $i++) { ?>
						<div class="item">
							<img src="<?php echo $products[$i]['thumb']; ?>" alt="Нет фото">
							<div class="item-name"><?php echo $products[$i]['name']; ?></div>
							<div class="item-des"><?php echo $products[$i]['description']; ?></div>
							<div class="sep"></div>
							<div class="item-price-2">
								<div class="pr"><?php echo $products[$i]['price']; ?> <span>&#8381;</span></div>
							    <div class="number">
	                             <input type="text" value="<?php echo $products[$i]['quantity']; ?>" />
	                            </div>
	                            <div class="clr">
								</div>
							</div>
							<div class="item-buy"><a href="#add-to-box" class="add-box">Купить</a></div>
						</div>
					<?php } ?>
				</div>
				<div class="clr"></div>
				<div class="bottom-pagination">
					<div class="prev"><a href=""></a></div>
					<?php echo $pagination; ?>
					<div class="ntx"><a href=""></a></div>
				</div>
				<div class="clr"></div>
				<div class="bottom-text">
					<div class="bottom-text-tit">Обзор моторных масел Bardahl</div>
					<div class="bottom-text-des">
						<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							На сегодняшний день компания Bardahl предлагает на российском рынке несколько серий моторного масла, которые отличаются по составу и области применения.
						</p>
						<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							XTR С60 Racing – эксклюзивная серия, которая разрабатывалась специально для двигателей гоночных автомобилей. Широкое распространение такое масло получило в гонках серии Гран-При и 24 часа Ле-Мана и даже на Формуле 1. На нашем рынке представлены модели XTR 60 Racing 10W60 и 20W60. Применяются преимущественно на двигателях высокого объема и мощности, например, бензиновых V8 и V12, особенно рекомендуются для двигателей американского производства.
						</p>
						<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							Technos C60 S – серия моторных масел и присадок с пониженным содержанием серы, сульфатной золы и фосфорных соединений. Применяется на двигателях последнего поколения с использованием новейших систем очистки и фильтрации выхлопных газов. Благодаря специальной формуле в составе, масло обладает высокой степенью вязкости, а за счет специальных защитных присадок обеспечивает антикорозийные свойства и защищает различные компоненты двигателя.
						</p>
						<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							Серия XTC C60 – масла премиум-класса для легковых и грузовых автомобилей, предназначены для повседневного использования. Данная серия получила наибольшее распространение в нашей стране за счет универсальной формулы в составе и относительно приемлемой цены по сравнению с ценами других именитых производителей, представленных на нашем рынке.
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>
        <?php echo $content_bottom; ?>
    </div>
</div>
<?php echo $footer; ?>
