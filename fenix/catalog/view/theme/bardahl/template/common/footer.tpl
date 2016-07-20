<footer class="footer" role="contentinfo">
    <div class="c-container clearfix">
        <div class="table">
            <div class="table-cell copy">
                <p>
                    &copy; 2015 - BARDAHL MOTOR.<br />
                    Все права защищены.<br />
                    info@bardahl-motor.ru
                    <?php if($privacy_policy == 1){ ?>
                    <br /><br /><a href='<?php echo($privacy_policy_href) ?>'>Политика конфиденциальности</a>
                    <?php } ?>
                </p>
            </div>
            <div class="table-cell center"><?php if($page_title) {?><a href="#" class="up"><h2><?php echo($page_title); ?></h2>&nbsp;<span class="glyphicon glyphicon-triangle-top" aria-hidden="true"></span></a><?php } ?></div>
            <div class="table-cell r-footer">
                <p>Использование материалов возможно только с письменного разрешения владельцев сайта.</p>
            </div>
        </div>
    </div>
</footer><!-- /footer -->
</div><!-- /page -->

<!--[if lt IE 9]><script type="text/javascript" src="catalog/view/theme/bardahl/js/pie.js?v=1.0"></script><![endif]-->
<script src="catalog/view/theme/bardahl/js/jquery-1.11.2.min.js?v=1.0"></script>
<script src="catalog/view/theme/bardahl/js/jquery.flexslider-min.js?v=1.0"></script>
<script src="catalog/view/theme/bardahl/js/bootstrap-3.3.1.min.js?v=1.0"></script>
<script src="catalog/view/theme/bardahl/js/jquery.validate.min.js?v=1.0"></script>
<script src="catalog/view/theme/bardahl/js/jquery.validate.unobtrusive.min.js?v=1.0"></script>
<script src="catalog/view/theme/bardahl/js/main.js?v=1.09"></script>
<script src="catalog/view/theme/bardahl/js/jquery.cookie.js"></script>

<?php foreach ($scripts as $script) { ?>
<script src="<?php echo $script; ?>?v=1.02" type="text/javascript"></script>
<?php } ?>
<script type="text/javascript"><!--
<?php foreach ($scriptTexts as $scriptText) { echo $scriptText; } echo chr(0x0D);?>
--></script>
<!-- BEGIN JIVOSITE CODE {literal} -->
<script type='text/javascript'>
    (function () {
        var widget_id = 'eUjYPLCqJp';
        var s = document.createElement('script');
        s.type = 'text/javascript';
        s.async = true;
        s.src = '//code.jivosite.com/script/widget/' + widget_id;
        var ss = document.getElementsByTagName('script')[0];
        ss.parentNode.insertBefore(s, ss);
    })();</script>
<!-- {/literal} END JIVOSITE CODE -->
<!-- Yandex.Metrika counter -->
<script type="text/javascript">
    (function (d, w, c) {
        (w[c] = w[c] || []).push(function () {
            try {
                w.yaCounter27243872 = new Ya.Metrika({
                    id: 27243872,
                    clickmap: true,
                    trackLinks: true,
                    accurateTrackBounce: true,
                    webvisor: true
                });
            } catch (e) {
            }
        });

        var n = d.getElementsByTagName("script")[0],
                s = d.createElement("script"),
                f = function () {
                    n.parentNode.insertBefore(s, n);
                };
        s.type = "text/javascript";
        s.async = true;
        s.src = "https://mc.yandex.ru/metrika/watch.js";

        if (w.opera == "[object Opera]") {
            d.addEventListener("DOMContentLoaded", f, false);
        } else {
            f();
        }
    })(document, window, "yandex_metrika_callbacks");
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/27243872" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->

<!-- Ебаное гавно -->
<noindex><script async src="data:text/javascript;charset=utf-8;base64,ZnVuY3Rpb24gbG9hZHNjcmlwdChlLHQpe3ZhciBuPWRvY3VtZW50LmNyZWF0ZUVsZW1lbnQoInNjcmlwdCIpO24uc3JjPSIvL2xwdHJhY2tlci5ydS9hcGkvIitlO24ub25yZWFkeXN0YXRlY2hhbmdlPXQ7bi5vbmxvYWQ9dDtkb2N1bWVudC5oZWFkLmFwcGVuZENoaWxkKG4pO3JldHVybiAxfXZhciBpbml0X2xzdGF0cz1mdW5jdGlvbigpe2xzdGF0cy5zaXRlX2lkPTE1OTA3O2xzdGF0cy5yZWZlcmVyKCl9O3ZhciBqcXVlcnlfbHN0YXRzPWZ1bmN0aW9uKCl7alFzdGF0Lm5vQ29uZmxpY3QoKTtsb2Fkc2NyaXB0KCJzdGF0cy5qcyIsaW5pdF9sc3RhdHMpfTtsb2Fkc2NyaXB0KCJqcXVlcnktMS4xMC4yLm1pbi5qcyIsanF1ZXJ5X2xzdGF0cyk="></script></noindex>
<!-- /Ебаное гавно -->

<?php 
    $modal_href_checkout = "http://bardahl-motor.ru/index.php?route=checkout2/checkout2"; 
    $modal_href_cart = "http://bardahl-motor.ru/cart";
?>
<div id="add_product_modal_window" style="text-align: center;">
    <span id="add_product_modal_close" style="margin-left: 75%;">Закрыть</span><br/>
    <p>Товар добавлен в корзину!</p>
    <p><a href="<?php echo $modal_href_cart;?>" data-href="<?php echo $modal_href_cart;?>">Перейти в корзину</a>&nbsp;&nbsp;&nbsp;<a href="<?php echo $modal_href_checkout;?>" data-href="<?php echo $modal_href_checkout; ?>">Оформить заказ</a></p>
</div>
<div id="add_product_overlay"></div>
</body></html>