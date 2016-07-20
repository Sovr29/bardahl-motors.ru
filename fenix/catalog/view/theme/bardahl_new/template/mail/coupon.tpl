<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/1999/REC-html401-19991224/strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Купон на скидку</title>
</head>
<body style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; color: #000000;">
<div style="width: 680px;"><a href="<?php echo $store_url; ?>" title="<?php echo $store_name; ?>"><img src="<?php echo $logo; ?>" alt="<?php echo $store_name; ?>" style="margin-bottom: 20px; border: none;" /></a>
  <p style="margin-top: 0px; margin-bottom: 20px;"><?php echo $text_greeting; ?></p>
  
  <p style="margin-top: 0px; margin-bottom: 20px;">Вы получили персональный подарочный сертификат c промокодом <?php echo $coupon_code ?> на <?php echo $coupon_discount?> для получения скидки в нашем магазине Bardahl-Motor.Ru при покупке от <?php echo $coupon_min_price ?> рублей.</p>
  <p style="margin-top: 0px; margin-bottom: 20px;">Вы можете воспользоваться сертификатом сами, можете подарить другу.</p> 
  <p style="margin-top: 0px; margin-bottom: 20px;">Для его использования введите код во время оформления заказа.</p>
  <p style="margin-top: 0px; margin-bottom: 20px;">Срок действия сертификата до <?php echo $coupon_date_end ?></p>
  <p style="margin-top: 0px; margin-bottom: 20px;">Подарочные сертификаты не суммируются.</p>
  <p style="margin-top: 0px; margin-bottom: 20px;"><img src="<?php echo $coupon_img; ?>" alt="купон" style="margin-bottom: 20px; border: none;" /></p>
</div>
</body>
</html>
