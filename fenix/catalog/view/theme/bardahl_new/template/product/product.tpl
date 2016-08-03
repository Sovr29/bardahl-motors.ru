<?php

echo $header; ?>
<div class="middle">
    <div class="c-container">
		<div class="main-content">
        <div class="container container--padding">
            <div class="main-breadcrumbs">
                <a href="#">Главная</a> > <a href="#">Каталог</a> > <a href="#">Моторные масла</a> >
                <a href="#">Для автомобилей</a> > <a href="#">Серии XTC C60</a> > <?php echo $heading_title; ?>
            </div>
            <article class="card-product">
                <h1><?php echo $heading_title; ?></h1>
                <div class="card-product__vendor-code">Артикул: <?php echo $sku; ?></div>
                <div class="card-product__box">
                    <div class="gallery-box">
                        <div class="gallery-box__view">
                            <div class="gallery-box__big-image">
                                <?php if ($thumb) { ?>
                        			<img class="js-big-image" src="<?php echo $thumb; ?>" title="<?php echo $heading_title; ?>" alt="<?php echo $heading_title; ?>" />
                        		<?php } ?>
                            </div>
                        </div>
                        <div class="gallery-box__thumbnails">
                    <a class="gallery-box__thumbnails-item js-gallery-item" href="img/good-big.jpg">
                        <img src="img/good.png" alt="Моторное масло XTC C60 0W40 1 л.">
                    </a>
                    <a class="gallery-box__thumbnails-item js-gallery-item" href="img/good-big-1.jpg">
                        <img src="img/good-1.jpg" alt="Моторное масло XTC C60 0W40 1 л.">
                    </a>
                    <a class="gallery-box__thumbnails-item js-gallery-item" href="img/good-big-2.jpg">
                        <img src="img/good-2.jpg" alt="Моторное масло XTC C60 0W40 1 л.">
                    </a>
                    </div>
                    </div>
                    <div class="card-product__price">
                        <div class="card-product__old-price">2199 руб.</div>
                        <div class="card-product__new-price"><?php echo $price; ?> <span>руб.</span></div>

                        <a class="btn btn--big add-box" href="cart.add('<?php echo $product_id; ?>', '<?php echo 1 ?>');"  <?php echo ($quantity > 0 ? '':'disabled');?>><?php if($quantity > 0){?>Купить<?php }else{?>Нет в наличии<?php }?></a><br>
                        <a href="#add-to-box" class="cart-block__buy-one-click add-box">Купить в один клик</a><br>
                        <a href="#add-to-box" class="cart-block__buy-to-credit add-box">Оформить в кредит</a>
                    </div>
                </div>
                <div class="tabs js-tabs">
                    <ul class="tabs__list">
                        <li>Описание</li>
                        <li>Допуски</li>
                        <li>Технические характеристики</li>
                        <li>Отзывы</li>
                    </ul>
                    <div class="tabs__container">
                <div class="tabs__item">
                    <p><?php echo $tab_description; ?></p>
                </div>
                <div class="tabs__item">
                            <p>Допуски</p>
                </div>
                <div class="tabs__item">
                            <p>Технические характеристики</p>
                </div>
                <div class="tabs__item">
                            <div class="reviews">
                                <div class="reviews__list">

                                    <div class="reviews__item">
                                    	<?php echo $tab_review; ?>
                                    	<!--
                                        <div class="reviews__info">
                                            <span class="reviews__author">Семен,</span>
                                            <span class="reviews__date">8 октября, 2015</span>
                                        </div>
                                        <div class="reviews__rating">
                                            <i class="icon-star icon-star--like"></i>
                                            <i class="icon-star icon-star--like"></i>
                                            <i class="icon-star icon-star--like"></i>
                                            <i class="icon-star"></i>
                                            <i class="icon-star"></i>
                                        </div>
                                        <div class="reviews__text">
                                            залили это масло в автомобиль шкода 2014 г.в. с пробегом 7000 км,мотор 1.8 турбо,разницу заметили почти сразу,мотор мягче работает,и плюс большой что в городе раньше была температура масла 115-120 градусов,теперь выше 100 не поднимается
                                        </div>
                                        -->
                                    </div>
                                </div>
                                <div class="reviews__add">
                                    <div class="reviews__add-title">Оставить отзыв</div>
                                    <form class="reviews__form" action="" method="post">
                                        <div class="reviews__rating">
                                                <span class="reviews__form-title">Оцените товар</span>
                                                <i class="icon-star icon-star--like"></i>
                                                <i class="icon-star"></i>
                                                <i class="icon-star"></i>
                                                <i class="icon-star"></i>
                                                <i class="icon-star"></i>
                                        </div>
                                        <label class="reviews__form-title" for="name">Ваше имя</label><br>
                                        <input type="text" id="name" name="name"><br>
                                        <label class="reviews__form-title" for="comment">Комментарий</label><br>
                                        <textarea id="comment" name="comment"></textarea><br>
                                        <button class="btn btn--big">Отправить отзыв</button>
                                    </form>
                                </div>
                            </div>
                </div>
            </div>
                </div>
            </article>
            <?php if ($products) { ?>
            <section class="similar-products">
                <div class="similar-products__title">Поохожие товары</div>
                <div class="similar-products__list">
                    <ul class="js-carousel">
                    	<?php foreach ($products as $product) {?>
                        <li class="similar-products__item">
                            <div class="similar-products__photo">
                                <img src="<?php echo $product['thumb']; ?>" alt="Нет фото">
                            </div>
                            <div class="similar-products__content">
	                            <div class="similar-products__name">
	                                <?php echo $product['name']; ?>
	                            </div>
	                            <div class="similar-products__descr">
	                                <?php echo $product['description']; ?>
	                            </div>
	                        </div>
	                        <div class="similar-products__footer">
	                            <div class="similar-products__price"><?php echo $product['price']; ?></div>
	                            <form action="" method="post">
	                                <div class="similar-products__count">
	                                    <div class="similar-products__minus js-products-minus">-</div>
	                                    <input class="similar-products__num js-products-num" type="text" name="count" value="1">
	                                    <div class="similar-products__plus js-products-plus">+</div>
	                                </div>
	                                <button class="btn btn--min"><a href="#add-to-box" class="add-box">Купить</a></button>
	                            </form>
	                    	</div>
                        </li>
                        <?php } ?>
                    </ul>
                    <div class="similar-products__navigation">
                        <a class="similar-products__prev js-prev" href="#"></a>
                        <div class="similar-products__pager js-pager"></div>
                        <a class="similar-products__next js-next" href="#"></a>
                    </div>
                </div>
            </section>
            <?php } ?>
        </div>
    </div>
    <?php echo $content_bottom; ?>
    </div>
</div>
<?php echo $footer; ?>
