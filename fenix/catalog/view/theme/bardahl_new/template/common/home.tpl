<?php echo $header; ?>
<?php echo $content_top; ?>

<!-- Желательно потом выделить этот блое в отдельный модуль trade -->
    <div id="about">
        <div style="border-top: 1px solid #cbcbcb" class="h_wrapper">
            <span class="aboutHeader">О марке</span>
             <iframe class="aboutVideo" width="510" height="290" src="https://www.youtube.com/embed/majgwlI4oWU" frameborder="0" allowfullscreen></iframe>
            <p class="aboutText">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab culpa saepe sequi fugiat, animi in porro atque. Perferendis, et debitis corporis id, architecto, ea quod illo repellendus, dolor porro magnam. <br> Lorem
				<a class="first-banner" href="#first-banner" style="text-transform: uppercase; color: red; font-weight: bold;">Первый баннер</a> adipisicing
				<a class="first-banner" href="#second-banner" style="text-transform: uppercase; color: red; font-weight: bold;">Второй баннер</a> elit. Ab culpa saepe sequi fugiat, animi in porro atque. Perferendis, et debitis corporis id, architecto, ea quod illo repellendus, dolor porro magnam.Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab culpa saepe sequi fugiat, animi in porro atque. Perferendis, et debitis corporis id, architecto, ea quod illo repellendus, dolor porro magnam.
            </p>
           <a class="aboutBtn" href="/products">ПОСМОТЕТЬ АССОРТИМЕНТ!</a>
        </div>

    </div>

<!-- Желательно потом выделить этот блое в отдельный модуль advantages -->
 	<div id="pros">
       <span class="prosTitle">Наши преимущества</span>
        <div class="h_wrapper">
            <ul class="prosList">
                <li><span>Гарантируем качество</span><br><img style="margin-top:22px;" src="catalog/view/theme/bardahl_new/img/pros1.png" alt=""></li>
                <li style="background:#F2F2F2;"><span>Компетентная поддержка</span><br><img style="margin-top:22px;" src="catalog/view/theme/bardahl_new/img/pros2.png" alt=""></li>
                <li><span>Гибкие условия доставки</span><br><img style="margin-top:22px;" src="catalog/view/theme/bardahl_new/img/pros3.png" alt=""></li>
                <li style="background:#F2F2F2;"><span>Возврат денег</span><br><img style="margin-top:22px;" src="catalog/view/theme/bardahl_new/img/pros4.png" alt=""></li>
            </ul>
            <div class="clr"></div>
        </div>
        <div class="prosSep"></div>
    </div>

<!-- Желательно потом выделить этот блое в отдельный модуль socialnet -->
    <div id="socialBlock">
        <div class="h_wrapper">
           <!--FB-->
           <div class="fb-page" data-href="https://www.facebook.com/bardahlmotor" data-tabs="timeline" data-width="340" data-height="720" data-small-header="false" data-adapt-container-width="false" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/bardahlmotor" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/bardahlmotor">Bardahl Motor</a></blockquote></div>

           <!--VK-->
            <div id="vk_post_-81601808_1920"></div>
            <script type="text/javascript">
              (function(d, s, id) { var js, fjs = d.getElementsByTagName(s)[0]; if (d.getElementById(id)) return; js = d.createElement(s); js.id = id; js.src = "//vk.com/js/api/openapi.js?122"; fjs.parentNode.insertBefore(js, fjs); }(document, 'script', 'vk_openapi_js'));
              (function() {
                if (!window.VK || !VK.Widgets || !VK.Widgets.Post || !VK.Widgets.Post("vk_post_-81601808_1920", -81601808, 1920, 'xbx60lCZ5epofG_xBTxYmpvihjKq', {width: 850})) setTimeout(arguments.callee, 50);
              }());
            </script>
            <ul style="margin-top:-28px;margin-left:970px;float:left;" class="socialLinksHeader">
                    <li><a target="_blank" href="https://vk.com/bardahlmotor"><img width="30"  src="catalog/view/theme/bardahl_new/img/vk.png" alt=""></a></li>
                    <li><a target="_blank" href="https://www.facebook.com/bardahlmotor"><img width="30"  src="catalog/view/theme/bardahl_new/img/fb.png" alt=""></a></li>
                    <li><a target="_blank" href="https://www.instagram.com/bardahl_motor.ru/"><img width="30"  src="catalog/view/theme/bardahl_new/img/inst.png" alt=""></a></li>
                    <li><a target="_blank" href="https://www.youtube.com/channel/UCB-JDizLOaF0y4OQvFr_a8Q"><img width="65" src="catalog/view/theme/bardahl_new/img/yt.png" alt=""></a></li>
            </ul>
        </div>
    </div>

<!-- Желательно потом выделить этот блое в отдельный модуль garanty -->
    <div id="lastBlock">
        <div class="h_wrapper">
            <a class="lastPrev"><img src="catalog/view/theme/bardahl_new/img/prev2.png" alt=""></a>
            <a class="lastNext"><img src="catalog/view/theme/bardahl_new/img/next2.png" alt=""></a>
            <a class="reviewPrev"><img src="catalog/view/theme/bardahl_new/img/prev2.png" alt=""></a>
            <a class="reviewNext"><img src="catalog/view/theme/bardahl_new/img/next2.png" alt=""></a>
            <span class="lastTitle">Гарантии качества</span>
            <div id="review">
                <?php for ($i = 1; $i < 4; $i++) { ?>
                <div class="revItem">
                    <img src="catalog/view/theme/bardahl_new/img/avatar.png" width="118" height="118" alt="">
                    <span class="revAuthName">Владимир</span>
                    <p>Сегодня поменял ваше масло. Вибрации пропали, мотор стал работать ЗАМЕТНО тише и такое ощущение, что машине стало как-будто легче... В общем пока доволен и явно вижу отличия от оригинального масла. Спасибо! <br><br><b>Автомобиль</b>: Infiniti G37 Cabrio</p>
                    <a href="https://vk.com/id2993275">https://vk.com/id2993275</a>
                </div>
                <?php } ?>
            </div>
            <div id="sertificats">
               <?php for ($i = 1; $i <= 2; $i++) { ?>
                <div class="serItem">
                   <?php for ($i = 1; $i <= 4; $i++) { ?>
                    <span class="sertBox"><a class="fancybox" rel="group" href="catalog/view/theme/bardahl_new/img/sertificat.jpg"><span class="sertHover"></span><img src="catalog/view/theme/bardahl_new/img/sertificat.jpg" width="140" height="200" alt="Sertificat"></a></span>
                   <?php } ?>
                </div>
               <?php } ?>
            </div>
        </div>
    </div>

<div class="middle grid-container no-top-padding">
	<div class="c-container">
		<?php echo $content_bottom; ?>
	</div>
</div>
<?php echo $footer; ?>