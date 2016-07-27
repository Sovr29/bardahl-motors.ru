	<div id="footer">
        <div class="h_wrapper">
            <div class="firstCol">
                <ul>
                    <li> &#169 2015 - BARDAHL MOTOR.
                    <li>Все права защищены.</li>
                    <li><?php echo $city['email'][0]; ?></li>
                </ul>
                <span style="font-size:20px;font-weight:500;line-height:31px;"><a class="various nu" href="#call"><img style="margin: 4px 8px 4px 0px;display:block;float:left" src="catalog/view/theme/bardahl_new/img/phone2.png" alt=""><?php echo ($city['phone'][""]); ?></a></span><br><br>
                <a href="#">Политика конфиденциальности</a>
            </div>
            <div class="secondCol">
                <ul>
                	<?php foreach ($categories as $category) { ?>
      				<li><a href="<?php echo $category['href']; ?>">
      					<?php echo $category['name']; ?></a>
      				</li>
					<?php } ?>
				</ul>

            </div>
            <div class="thirdCol">
                Мы в соц. сетях: <br>
                <span class="footSep"></span>

                <ul class="socialLinksHeader">
                    <li><a target="_blank" href="https://vk.com/bardahlmotor"><img  src="catalog/view/theme/bardahl_new/img/vk.png" alt=""></a></li>
                    <li><a target="_blank" href="https://www.facebook.com/bardahlmotor"><img  src="catalog/view/theme/bardahl_new/img/fb.png" alt=""></a></li>
                    <li><a target="_blank" href="https://www.instagram.com/bardahl_motor.ru/"><img  src="catalog/view/theme/bardahl_new/img/inst.png" alt=""></a></li>
                    <li><a target="_blank" href="https://www.youtube.com/channel/UCB-JDizLOaF0y4OQvFr_a8Q"><img width="105" src="catalog/view/theme/bardahl_new/img/yt.png" alt=""></a></li>
                </ul><br><br><br>
                <span><a href="contacts.html" class="nu">Адрес: г. Москва, ул. Брянская д. 32 с.6 <br>Время работы: Пн - Пт 09:00-21:00 Сб - <br>Вск 12:00-19:00</a></span>
            </div>
            <div class="fourthCol">
                <p>
                    Design by Beybulatov Kirill (<a href="http://lakreon.ru/" target="_blank">lakreon</a>) <br><br>
                    Использование материалов возможно <br> только с письменного разрешения вла-<br>дельцев сайта.

                </p>
            </div>
        </div>
    </div>
	<div id="call" style="display: none">
		<div class="f-call">
			<div class="f-call-tit">Отправить контакты для связи</div>
			<div class="f-call-subtit">Мы свяжемся с Вами в течении часа.</div>
			<form name="test" method="post" action="p">
				<input type="text" placeholder="Имя:" required="required">
				<input type="text" placeholder="Ваш номер телефона:" required="required">
				<div class="clr"></div>
				<div class="f-call-small-ic"></div>
				<div class="f-call-small">Гарантируем конфиденциальность ваших персональных данных</div>
				<input type="submit" value="Отправить">
			</form>
		</div>
	</div>



	<div id="first-banner" style="display: none">
		<div class="f-first-banner">
			<div class="f-first-banner-tit">Оставьте свои контакты для получения скидки</div>
			<form name="test" method="post" action="p">
				<input type="text" placeholder="Имя:" required="required">
				<input type="text" placeholder="Ваш номер телефона:" required="required">
				<div class="clr"></div>
				<div class="f-first-banner-small-ic"></div>
				<div class="f-first-banner-small">Гарантируем конфиденциальность ваших персональных данных</div>
				<input type="submit" value="Отправить">
			</form>
		</div>
	</div>

	<div id="second-banner" style="display: none">
		<div class="f-second-banner">
			<div class="f-second-banner-tit">Получить скидку 500 руб.<br> при заказе от 5000 руб!</div>
			<a href="#">Хочу скидку!</a>
		</div>
	</div>

    <!-- Add mousewheel plugin (this is optional) -->
    <script type="text/javascript" src="catalog/view/theme/bardahl_new/fancybox/lib/jquery.mousewheel-3.0.6.pack.js"></script>

    <!-- Add fancyBox -->

    <script type="text/javascript" src="catalog/view/theme/bardahl_new/fancybox/source/jquery.fancybox.pack.js?v=2.1.5"></script>

    <!-- Optionally add helpers - button, thumbnail and/or media -->

    <script type="text/javascript" src="catalog/view/theme/bardahl_new/fancybox/source/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>
    <script type="text/javascript" src="catalog/view/theme/bardahl_new/fancybox/source/helpers/jquery.fancybox-media.js?v=1.0.6"></script>

    <script type="text/javascript" src="catalog/view/theme/bardahl_new/fancybox/source/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>

	<!-- Carousel Custom-->>
    <script src="catalog/view/theme/bardahl_new/js/script.js"></script>

	<script type='text/javascript' src='catalog/view/theme/bardahl_new/js/SmoothScroll.js'></script>
	<script type="text/javascript" src="catalog/view/theme/bardahl_new/js/main.js"></script>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.10/jquery-ui.min.js"></script>
	<script type="text/javascript" src="http://onlinehtmltools.com/tab-generator/skinable_tabs.min.js"></script>
	<script type="text/javascript">
  $('.tabs_holder').skinableTabs({
    effect: 'basic_display',
    skin: 'skin11',
    position: 'left'
  });
</script>
</body>
</html>