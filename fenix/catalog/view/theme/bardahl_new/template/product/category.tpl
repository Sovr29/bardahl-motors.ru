<!-- Страница каталога товаров products -->>
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
							<li><a href="#">Моторные масла</a></li>
							<li><a href="#">Присадки</a></li>
							<li><a href="#">Трансмиссионные масла</a></li>
							<li><a href="#">Технические жидкости</a></li>
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
							<li>
							<span class="main-choose-tit">Для автомобилей</span>
								<ul  class="second-choose">
									<li><label><input type="checkbox"/> XTC C60 (90)</label></li>
									<li><label><input type="checkbox"/> XTC C60 (90)</label></li>
									<li><label><input type="checkbox"/> XTC C60 (90)</label></li>
									<li><label><input type="checkbox"/> XTC C60 (90)</label></li>
								</ul>
							</li>
							<li>
								<div class="main-choose-tit">Для мотоциклов</div>
								<ul  class="third-choose">
									<li><a href="#">2-х тактные двигатели</a></li>
										<ul  class="second-choose">
											<li><label><input type="checkbox"/> Подпункт</label></li>
											<li><label><input type="checkbox"/> Подпункт</label></li>
										</ul>
									</li>
									<li><a href="#">4-х тактные двигатели</a>
										<ul  class="second-choose">
											<li><label><input type="checkbox"/> Подпункт</label></li>
											<li><label><input type="checkbox"/> Подпункт</label></li>
										</ul>
									</li>
								</ul>
							</li>
							<li>
								<div class="main-choose-tit">Для Грузовиков</div>
								<ul  class="third-choose">
									<li><a href="#">2-х тактные двигатели</a></li>
										<ul  class="second-choose">
											<li><label><input type="checkbox"/> Подпункт</label></li>
											<li><label><input type="checkbox"/> Подпункт</label></li>
										</ul>
									</li>
									<li><a href="#">4-х тактные двигатели</a>
										<ul  class="second-choose">
											<li><label><input type="checkbox"/> Подпункт</label></li>
											<li><label><input type="checkbox"/> Подпункт</label></li>
										</ul>
									</li>
								</ul>
							</li>
						</ul>
					</div>
				</div>
				<span class="clr-filtr"><a href="#">Сбросить фильтр</a></span>
				<div class="stocks">
					<div class="stocks-tit">Акции</div>
					<div class="stock">
						<div class="stock-tit">Выгода на количестве - Легко!</div>
						<img src="catalog/view/theme/bardahl_new/img/1.jpg">
						<div class="stock-des">Только в начале апреля, покупать много - ВЫГОДНО! Да, это действительная выгода, не бонусы, а живые деньги!</div>
						<div class="stock-time">Акция действует с 6 марта по 30 апреля 2016 г.</div>
						<div class="stock-link"><a href="#">Узнать подробности</a></div>
					</div>
					<div class="stock">
						<div class="stock-tit">Очистка системы кондиционирования здесь и сейчас!</div>
						<img src="catalog/view/theme/bardahl_new/img/2.jpg">
						<div class="stock-des">Удали причину неприятного запаха в салоне! твоего автомобиля</div>
						<div class="stock-time">Акция действует с 4 по11 марта 2016 г.</div>
						<div class="stock-link"><a href="#">Узнать подробности</a></div>
					</div>
					<div class="stock">
						<div class="stock-tit">Bardahl. Будь лучшим во всем!</div>
						<img src="catalog/view/theme/bardahl_new/img/3.jpg">
						<div class="stock-des">Ограниченная акция на масло премиум-класса в Bardahl Motor!</div>
						<div class="stock-time">Акция действует с 31 января по 31 февраля 2016 г.</div>
						<div class="stock-link"><a href="#">Узнать подробности</a></div>
					</div>
					<div class="stock">
						<div class="stock-tit">Дизельный заряд энергии!</div>
						<img src="catalog/view/theme/bardahl_new/img/4.jpg">
						<div class="stock-des">На пути к качественному топливу!</div>
						<div class="stock-time">Акция действует с 9 по 31 января 2016 г.</div>
						<div class="stock-link"><a href="#">Узнать подробности</a></div>
					</div>
				</div>
			</div>
			<div class="content">
				<div class="pag">
					<ul>
					<li><a href="#">Главная</a></li>
					<li>&#187;</li>
					<li><a href="#">Каталог </a></li>
					<li>&#187;</li>
					<li><a href="#">Моторные масла</a></li>
					</ul>
				</div>
				<div class="clr"></div>
				<h1 class="catalog-tit">Купить масло Bardahl</h1>
				<div class="calalog-opt">
					<div class="sort">
						Сортировать по:  <a href="#">названию</a> <a href="#">цене</a> <a href="#">популярности</a>
					</div>
					<div class="show">
						Показать:  <a href="#">витриной</a> <a href="#">списком</a>
					</div>
				</div>
				<div class="search-tit">Найдено товаров по вашему запросу: <span>145</span></div>
				<div class="items">
					<div class="item">
						<img src="catalog/view/theme/bardahl_new/img/item.jpg">
						<div class="item-name">XTC C60 0W40 1 л.</div>
						<div class="item-des">Для дизельных двигателей, бензиновых, с турбонаддувом, атмосферных и с непосредственным впрыском топлива.</div>
						<div class="sep"></div>
						<div class="item-price-2">
							<div class="pr">1400 <span>&#8381;</span></div>
						    <div class="number">
                             <input type="text" value="1" />
                            </div>
                            <div class="clr">
							</div>
						</div>
						<div class="item-buy"><a href="#add-to-box" class="add-box">Купить</a></div>
					</div>
					<div class="item">
						<img src="catalog/view/theme/bardahl_new/img/item.jpg">
						<div class="item-name">XTC C60 0W40 1 л.</div>
						<div class="item-des">Для дизельных двигателей, бензиновых, с турбонаддувом, атмосферных и с непосредственным впрыском топлива.</div>
						<div class="sep"></div>
						<div class="item-price-2">
							<div class="pr">1400 <span>&#8381;</span></div>
						    <div class="number">
                             <input type="text" value="1" />
                            </div>
                            <div class="clr">
							</div>
						</div>
						<div class="item-buy"><a href="#add-to-box" class="add-box">Купить</a></div>
					</div>
					<div class="item">
						<img src="catalog/view/theme/bardahl_new/img/item.jpg">
						<div class="item-name">XTC C60 0W40 1 л.</div>
						<div class="item-des">Для дизельных двигателей, бензиновых, с турбонаддувом, атмосферных и с непосредственным впрыском топлива.</div>
						<div class="sep"></div>
						<div class="item-price-2">
							<div class="pr">1400 <span>&#8381;</span></div>
						    <div class="number">
                             <input type="text" value="1" />
                            </div>
                            <div class="clr">
							</div>
						</div>
						<div class="item-buy"><a href="#add-to-box" class="add-box">Купить</a></div>
					</div>
					<div class="item">
						<img src="catalog/view/theme/bardahl_new/img/item.jpg">
						<div class="item-name">XTC C60 0W40 1 л.</div>
						<div class="item-des">Для дизельных двигателей, бензиновых, с турбонаддувом, атмосферных и с непосредственным впрыском топлива.</div>
						<div class="sep"></div>
						<div class="item-price-2">
							<div class="pr">1400 <span>&#8381;</span></div>
						    <div class="number">
                             <input type="text" value="1" />
                            </div>
                            <div class="clr">
							</div>
						</div>
						<div class="item-buy"><a href="#add-to-box" class="add-box">Купить</a></div>
					</div>
					<div class="item">
						<img src="catalog/view/theme/bardahl_new/img/item.jpg">
						<div class="item-name">XTC C60 0W40 1 л.</div>
						<div class="item-des">Для дизельных двигателей, бензиновых, с турбонаддувом, атмосферных и с непосредственным впрыском топлива.</div>
						<div class="sep"></div>
						<div class="item-price-2">
							<div class="pr">1400 <span>&#8381;</span></div>
						    <div class="number">
                             <input type="text" value="1" />
                            </div>
                            <div class="clr">
							</div>
						</div>
						<div class="item-buy"><a href="#add-to-box" class="add-box">Купить</a></div>
					</div>
					<div class="item">
						<img src="catalog/view/theme/bardahl_new/img/item.jpg">
						<div class="item-name">XTC C60 0W40 1 л.</div>
						<div class="item-des">Для дизельных двигателей, бензиновых, с турбонаддувом, атмосферных и с непосредственным впрыском топлива.</div>
						<div class="sep"></div>
						<div class="item-price-2">
							<div class="pr">1400 <span>&#8381;</span></div>
						    <div class="number">
                             <input type="text" value="1" />
                            </div>
                            <div class="clr">
							</div>
						</div>
						<div class="item-buy"><a href="#add-to-box" class="add-box">Купить</a></div>
					</div>
					<div class="item">
						<img src="catalog/view/theme/bardahl_new/img/item.jpg">
						<div class="item-name">XTC C60 0W40 1 л.</div>
						<div class="item-des">Для дизельных двигателей, бензиновых, с турбонаддувом, атмосферных и с непосредственным впрыском топлива.</div>
						<div class="sep"></div>
						<div class="item-price-2">
							<div class="pr">1400 <span>&#8381;</span></div>
						    <div class="number">
                             <input type="text" value="1" />
                            </div>
                            <div class="clr">
							</div>
						</div>
						<div class="item-buy"><a href="#add-to-box" class="add-box">Купить</a></div>
					</div>
					<div class="item">
						<img src="catalog/view/theme/bardahl_new/img/item.jpg">
						<div class="item-name">XTC C60 0W40 1 л.</div>
						<div class="item-des">Для дизельных двигателей, бензиновых, с турбонаддувом, атмосферных и с непосредственным впрыском топлива.</div>
						<div class="sep"></div>
						<div class="item-price-2">
							<div class="pr">1400 <span>&#8381;</span></div>
						    <div class="number">
                             <input type="text" value="1" />
                            </div>
                            <div class="clr">
							</div>
						</div>
						<div class="item-buy"><a href="#add-to-box" class="add-box">Купить</a></div>
					</div>
					<div class="item">
						<img src="catalog/view/theme/bardahl_new/img/item.jpg">
						<div class="item-name">XTC C60 0W40 1 л.</div>
						<div class="item-des">Для дизельных двигателей, бензиновых, с турбонаддувом, атмосферных и с непосредственным впрыском топлива.</div>
						<div class="sep"></div>
						<div class="item-price-2">
							<div class="pr">1400 <span>&#8381;</span></div>
						    <div class="number">
                             <input type="text" value="1" />
                            </div>
                            <div class="clr">
							</div>
						</div>
						<div class="item-buy"><a href="#add-to-box" class="add-box">Купить</a></div>
					</div>
					<div class="item">
						<img src="catalog/view/theme/bardahl_new/img/item.jpg">
						<div class="item-name">XTC C60 0W40 1 л.</div>
						<div class="item-des">Для дизельных двигателей, бензиновых, с турбонаддувом, атмосферных и с непосредственным впрыском топлива.</div>
						<div class="sep"></div>
						<div class="item-price-2">
							<div class="pr">1400 <span>&#8381;</span></div>
						    <div class="number">
                             <input type="text" value="1" />
                            </div>
                            <div class="clr">
							</div>
						</div>
						<div class="item-buy"><a href="#add-to-box" class="add-box">Купить</a></div>
					</div>
					<div class="item">
						<img src="catalog/view/theme/bardahl_new/img/item.jpg">
						<div class="item-name">XTC C60 0W40 1 л.</div>
						<div class="item-des">Для дизельных двигателей, бензиновых, с турбонаддувом, атмосферных и с непосредственным впрыском топлива.</div>
						<div class="sep"></div>
						<div class="item-price-2">
							<div class="pr">1400 <span>&#8381;</span></div>
						    <div class="number">
                             <input type="text" value="1" />
                            </div>
                            <div class="clr">
							</div>
						</div>
						<div class="item-buy"><a href="#add-to-box" class="add-box">Купить</a></div>
					</div>
					<div class="item">
						<img src="catalog/view/theme/bardahl_new/img/item.jpg">
						<div class="item-name">XTC C60 0W40 1 л.</div>
						<div class="item-des">Для дизельных двигателей, бензиновых, с турбонаддувом, атмосферных и с непосредственным впрыском топлива.</div>
						<div class="sep"></div>
						<div class="item-price-2">
							<div class="pr">1400 <span>&#8381;</span></div>
						    <div class="number">
                             <input type="text" value="1" />
                            </div>
                            <div class="clr">
							</div>
						</div>
						<div class="item-buy"><a href="#add-to-box" class="add-box">Купить</a></div>
					</div>
					<div class="item">
						<img src="catalog/view/theme/bardahl_new/img/item.jpg">
						<div class="item-name">XTC C60 0W40 1 л.</div>
						<div class="item-des">Для дизельных двигателей, бензиновых, с турбонаддувом, атмосферных и с непосредственным впрыском топлива.</div>
						<div class="sep"></div>
						<div class="item-price-2">
							<div class="pr">1400 <span>&#8381;</span></div>
						    <div class="number">
                             <input type="text" value="1" />
                            </div>
                            <div class="clr">
							</div>
						</div>
						<div class="item-buy"><a href="#add-to-box" class="add-box">Купить</a></div>
					</div>
					<div class="item">
						<img src="catalog/view/theme/bardahl_new/img/item.jpg">
						<div class="item-name">XTC C60 0W40 1 л.</div>
						<div class="item-des">Для дизельных двигателей, бензиновых, с турбонаддувом, атмосферных и с непосредственным впрыском топлива.</div>
						<div class="sep"></div>
						<div class="item-price-2">
							<div class="pr">1400 <span>&#8381;</span></div>
						    <div class="number">
                             <input type="text" value="1" />
                            </div>
                            <div class="clr">
							</div>
						</div>
						<div class="item-buy"><a href="#add-to-box" class="add-box">Купить</a></div>
					</div>
					<div class="item">
						<img src="catalog/view/theme/bardahl_new/img/item.jpg">
						<div class="item-name">XTC C60 0W40 1 л.</div>
						<div class="item-des">Для дизельных двигателей, бензиновых, с турбонаддувом, атмосферных и с непосредственным впрыском топлива.</div>
						<div class="sep"></div>
						<div class="item-price-2">
							<div class="pr">1400 <span>&#8381;</span></div>
						    <div class="number">
                             <input type="text" value="1" />
                            </div>
                            <div class="clr">
							</div>
						</div>
						<div class="item-buy"><a href="#add-to-box" class="add-box">Купить</a></div>
					</div>
					<div class="item">
						<img src="catalog/view/theme/bardahl_new/img/item.jpg">
						<div class="item-name">XTC C60 0W40 1 л.</div>
						<div class="item-des">Для дизельных двигателей, бензиновых, с турбонаддувом, атмосферных и с непосредственным впрыском топлива.</div>
						<div class="sep"></div>
						<div class="item-price-2">
							<div class="pr">1400 <span>&#8381;</span></div>
						    <div class="number">
                             <input type="text" value="1" />
                            </div>
                            <div class="clr">
							</div>
						</div>
						<div class="item-buy"><a href="#add-to-box" class="add-box">Купить</a></div>
					</div>
					<div class="item">
						<img src="catalog/view/theme/bardahl_new/img/item.jpg">
						<div class="item-name">XTC C60 0W40 1 л.</div>
						<div class="item-des">Для дизельных двигателей, бензиновых, с турбонаддувом, атмосферных и с непосредственным впрыском топлива.</div>
						<div class="sep"></div>
						<div class="item-price-2">
							<div class="pr">1400 <span>&#8381;</span></div>
						    <div class="number">
                             <input type="text" value="1" />
                            </div>
                            <div class="clr">
							</div>
						</div>
						<div class="item-buy"><a href="#add-to-box" class="add-box">Купить</a></div>
					</div>
					<div class="item">
						<img src="catalog/view/theme/bardahl_new/img/item.jpg">
						<div class="item-name">XTC C60 0W40 1 л.</div>
						<div class="item-des">Для дизельных двигателей, бензиновых, с турбонаддувом, атмосферных и с непосредственным впрыском топлива.</div>
						<div class="sep"></div>
						<div class="item-price-2">
							<div class="pr">1400 <span>&#8381;</span></div>
						    <div class="number">
                             <input type="text" value="1" />
                            </div>
                            <div class="clr">
							</div>
						</div>
						<div class="item-buy"><a href="#add-to-box" class="add-box">Купить</a></div>
					</div>
					<div class="item">
						<img src="catalog/view/theme/bardahl_new/img/item.jpg">
						<div class="item-name">XTC C60 0W40 1 л.</div>
						<div class="item-des">Для дизельных двигателей, бензиновых, с турбонаддувом, атмосферных и с непосредственным впрыском топлива.</div>
						<div class="sep"></div>
						<div class="item-price-2">
							<div class="pr">1400 <span>&#8381;</span></div>
						    <div class="number">
                             <input type="text" value="1" />
                            </div>
                            <div class="clr">
							</div>
						</div>
						<div class="item-buy"><a href="#add-to-box" class="add-box">Купить</a></div>
					</div>
					<div class="item">
						<img src="catalog/view/theme/bardahl_new/img/item.jpg">
						<div class="item-name">XTC C60 0W40 1 л.</div>
						<div class="item-des">Для дизельных двигателей, бензиновых, с турбонаддувом, атмосферных и с непосредственным впрыском топлива.</div>
						<div class="sep"></div>
						<div class="item-price-2">
							<div class="pr">1400 <span>&#8381;</span></div>
						    <div class="number">
                             <input type="text" value="1" />
                            </div>
                            <div class="clr">
							</div>
						</div>
						<div class="item-buy"><a href="#add-to-box" class="add-box">Купить</a></div>
					</div>
					<div class="item">
						<img src="catalog/view/theme/bardahl_new/img/item.jpg">
						<div class="item-name">XTC C60 0W40 1 л.</div>
						<div class="item-des">Для дизельных двигателей, бензиновых, с турбонаддувом, атмосферных и с непосредственным впрыском топлива.</div>
						<div class="sep"></div>
						<div class="item-price-2">
							<div class="pr">1400 <span>&#8381;</span></div>
						    <div class="number">
                             <input type="text" value="1" />
                            </div>
                            <div class="clr">
							</div>
						</div>
						<div class="item-buy"><a href="#add-to-box" class="add-box">Купить</a></div>
					</div>
					<div class="item">
						<img src="catalog/view/theme/bardahl_new/img/item.jpg">
						<div class="item-name">XTC C60 0W40 1 л.</div>
						<div class="item-des">Для дизельных двигателей, бензиновых, с турбонаддувом, атмосферных и с непосредственным впрыском топлива.</div>
						<div class="sep"></div>
						<div class="item-price-2">
							<div class="pr">1400 <span>&#8381;</span></div>
						    <div class="number">
                             <input type="text" value="1" />
                            </div>
                            <div class="clr">
							</div>
						</div>
						<div class="item-buy"><a href="#add-to-box" class="add-box">Купить</a></div>
					</div>
					<div class="item">
						<img src="catalog/view/theme/bardahl_new/img/item.jpg">
						<div class="item-name">XTC C60 0W40 1 л.</div>
						<div class="item-des">Для дизельных двигателей, бензиновых, с турбонаддувом, атмосферных и с непосредственным впрыском топлива.</div>
						<div class="sep"></div>
						<div class="item-price-2">
							<div class="pr">1400 <span>&#8381;</span></div>
						    <div class="number">
                             <input type="text" value="1" />
                            </div>
                            <div class="clr">
							</div>
						</div>
						<div class="item-buy"><a href="#add-to-box" class="add-box">Купить</a></div>
					</div>
					<div class="item">
						<img src="catalog/view/theme/bardahl_new/img/item.jpg">
						<div class="item-name">XTC C60 0W40 1 л.</div>
						<div class="item-des">Для дизельных двигателей, бензиновых, с турбонаддувом, атмосферных и с непосредственным впрыском топлива.</div>
						<div class="sep"></div>
						<div class="item-price-2">
							<div class="pr">1400 <span>&#8381;</span></div>
						    <div class="number">
                             <input type="text" value="1" />
                            </div>
                            <div class="clr">
							</div>
						</div>
						<div class="item-buy"><a href="#add-to-box" class="add-box">Купить</a></div>
					</div>
				</div>
				<div class="clr"></div>
				<div class="bottom-pagination">
					<div class="prev"><a href="">&#60; Предыдущая страница</a></div>
					<div class="pages">
						Страница  <a href="#" class="active">1</a></li> <a href="#">2</a>
					</div>
					<div class="ntx"><a href="">Следующая страница &#62;</a></div>
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
