<!DOCTYPE html>
<html dir="<?php echo $direction; ?>" lang="<?php echo $lang; ?>">

<head>
    <meta charset="UTF-8">

    <title><?php echo $title; ?></title>
    <base href="<?php echo $base; ?>" />
	<meta name="google-site-verification" content="ytkJZdZAkpeFtw55CK73nPKxsTRnMtyHWwxCZKvNO24" />
    <?php if ($description) { ?>
    <meta name="description" content="<?php echo $description; ?>" />
    <?php } ?>
    <?php if ($keywords) { ?>
    <meta name="keywords" content= "<?php echo $keywords; ?>" />
    <?php } ?>

	<?php foreach ($styles as $style) { ?>
		<link rel="stylesheet" href="<?php echo $style['href']; ?>">
	<?php } ?>

    <link rel="stylesheet" href="catalog/view/theme/bardahl_new/fancybox/source/jquery.fancybox.css?v=2.1.5" type="text/css" media="screen" />

    <!-- Default Theme -->
    <link rel="stylesheet" href="catalog/view/theme/bardahl_new/fancybox/source/helpers/jquery.fancybox-buttons.css?v=1.0.5" type="text/css" media="screen" />
    <link rel="stylesheet" href="catalog/view/theme/bardahl_new/fancybox/source/helpers/jquery.fancybox-thumbs.css?v=1.0.7" type="text/css" media="screen" />

	<link rel="stylesheet" href="catalog/view/theme/bardahl_new/stylesheet/style.css">
	<link rel="stylesheet" href="catalog/view/javascript/font-awesome/css/font-awesome.min.css">

	<!-- Owl Carousel CSS -->
	<link rel="stylesheet" href="catalog/view/theme/bardahl_new/owl-carousel/owl.carousel.css">
	<link rel="stylesheet" href="catalog/view/theme/bardahl_new/owl-carousel/owl.theme.css">

    <!--  jQuery -->
    <script src="catalog/view/theme/bardahl_new/script/jquery.js"></script>
	<script type="text/javascript" src="catalog/view/theme/bardahl_new/js/jquery-1.7.2.min.js"></script>

	<!-- Owl Carousel JS -->
	<script type="text/javascript" src="catalog/view/theme/bardahl_new/owl-carousel/owl.carousel.min.js"></script>

	<?php foreach ($scripts as $script) { ?>
		<script type="text/javascript" src="<?php echo $script; ?>">
	<?php } ?>

    <!--[if lt IE 9]><link rel="stylesheet" type="text/css" href="catalog/view/theme/bardahl_new/stylesheet/ie.css?v=1.0"><![endif]-->
    <!--[if IE]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->

    <?php echo $google_analytics; ?>

</head>
<body>
    <!--FB-->
    <div id="fb-root"></div>
    <script>(function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = "//connect.facebook.net/ru_RU/sdk.js#xfbml=1&version=v2.6&appId=1611250525813164";
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>

	<div id="header">
		<div class="h_wrapper">
			<a class="logoLink" href="<?php echo $home; ?>"><img src="<?php echo $logo; ?>" alt="<?php echo $name; ?>"></a>
			<span class="titleSpan"><?php echo $name; ?></span>
			<span class="headerInfoSpan"><a href="contacts.html"><?php echo($city['name']) ?><br>
			Адрес: ул. Брянская д. 32 с.6 <br>
			Время работы: Пн - Пт 09:00-21:00 Сб - Вск 12:00-19:00</a></span>
			<div class="phoneAndSocial">
				<span style="font-size:18px;font-weight:500;"><a class="various" href="#call"><img style="margin: 4px;display:block;float:left" src="catalog/view/theme/bardahl_new/img/phone.png" alt=""><?php echo($city['phone'][""])?></a></span><br>
				<input class="searchInput" placeholder="Поиск..." type="text"><br>
				<ul class="socialLinksHeader">
					<li><a target="_blank" href="https://vk.com/bardahlmotor"><img width="26" src="catalog/view/theme/bardahl_new/img/vk.png" alt=""></a></li>
					<li><a target="_blank" href="https://www.facebook.com/bardahlmotor"><img width="26" src="catalog/view/theme/bardahl_new/img/fb.png" alt=""></a></li>
					<li><a target="_blank" href="https://www.instagram.com/bardahl_motor.ru/"><img width="26" src="catalog/view/theme/bardahl_new/img/inst.png" alt=""></a></li>
					<li><a target="_blank" href="https://www.youtube.com/channel/UCB-JDizLOaF0y4OQvFr_a8Q"><img width="58" src="catalog/view/theme/bardahl_new/img/yt.png" alt=""></a></li>
				</ul>
			</div>
			<div id="shopBucket">
				<span>Товаров: 2 шт.<br>
				На сумму: <b>1390 р.</b></span>
				<img src="catalog/view/theme/bardahl_new/img/bucket.png" alt="">
			</div>
			<div class="clr"></div>
			<div class="box-list">
				<span class="arrow-box"></span>
				<div class="box-list-items">
					<div class="box-list-item">
						<div class="box-list-item-img">
							<img src="catalog/view/theme/bardahl_new/img/box-list-item-1.png">
						</div>
						<div class="box-list-item-tit"><p>XTC C60 0W40, 1 л. x1</p></div>
						<div class="box-list-item-price"><p>1390 руб.</p></div>
						<div class="item-price">
							   <div class="box-number">
	                            <input type="text" value="1" />
	                           </div>
						</div>
						<div class="clr"></div>
						<span class="del-box-item"><a href="#"></a></span>
					</div>
					<div class="box-list-item">
						<div class="box-list-item-img">
							<img src="catalog/view/theme/bardahl_new/img/box-list-item-2.png">
						</div>
						<div class="box-list-item-tit"><p>3120 - Gear Oil 1 л.	x 1</p></div>
						<div class="box-list-item-price"><p>700 руб.</p></div>
						<div class="item-price">
							   <div class="box-number">
	                            <input type="text" value="1" />
	                           </div>
						</div>
						<div class="clr"></div>
						<span class="del-box-item"><a href="#"></a></span>
					</div>
				</div>
				<div class="price-table">
					<table>
						<tr>
							<td>Сума</td>
							<td>1390<span> &#8381;</span></td>
						</tr>
						<tr>
							<td>Самовывоз из магазина</td>
							<td>0<span> &#8381;</span></td>
						</tr>
						<tr>
							<td>Итого</td>
							<td>1390<span> &#8381;</span></td>
						</tr>
					</table>
				</div>
				<div class="how-to-discount">*Вам осталось 4556 рублей до получения скидки 15%</div>
				<a href="#" class="box-link-l">Оформить заказ сейчас</a>
				<a href="#" class="box-link-r">Посмотреть корзину</a>
			</div>
			<div class="clr"></div>
		</div>
	</div>
    <div id="mainMenu">
        <div class="h_wrapper">
            <ul class="mainMenuList">
				<?php
                	$counter = 0;
						foreach ($informations as $information) {
							$counter++;
                            $class = 'class="dropdown ';
                            if($information_id == $information['information_id'] || $counter == count($informations))
                            	{
									if($information_id == $information['information_id']){
										$class = $class.'active';
									}
                                    if($counter == count($informations)){
                                                $class = $class.' last';
                                    }
                            }
                            $class = $class.'"';
                ?>
                	<li <?php echo $class ?>>
                		<a href="<?php echo isset($information['children']) ? '#' : $information['href']; ?>" <?php echo( isset($information['children']) ? 'class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"' : '') ?> ><?php echo $information['title']; ?></a>
               		</li>
                <?php } ?>
            </ul>
            <a class="profileLink" href="#"><img src="catalog/view/theme/bardahl_new/img/profile.png" alt=""></a>
        </div>
    </div>
