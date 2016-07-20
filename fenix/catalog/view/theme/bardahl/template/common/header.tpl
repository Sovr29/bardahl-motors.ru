<!DOCTYPE html>
<html dir="<?php echo $direction; ?>" lang="<?php echo $lang; ?>">
<head>
    <meta charset="utf-8" />
    
    <title><?php echo $title; ?></title>
    <base href="<?php echo $base; ?>" />
	<meta name="google-site-verification" content="ytkJZdZAkpeFtw55CK73nPKxsTRnMtyHWwxCZKvNO24" />
    <?php if ($description) { ?>
    <meta name="description" content="<?php echo $description; ?>" />
    <?php } ?>
    <?php if ($keywords) { ?>
    <meta name="keywords" content= "<?php echo $keywords; ?>" />
    <?php } ?>
    <?php foreach ($links as $link) { ?>
    <link href="<?php echo $link['href']; ?>" rel="<?php echo $link['rel']; ?>" />
    <?php } ?>
    <link rel="stylesheet" href="catalog/view/javascript/bootstrap/css/bootstrap.css?v=1.0" type="text/css" />
    <link rel="stylesheet" href="catalog/view/javascript/font-awesome/css/font-awesome.min.css?v=1.0" type="text/css" />
    <link rel="stylesheet" href="catalog/view/theme/bardahl/stylesheet/flexslider.css?v=1.0" type="text/css" />
    <link rel="stylesheet" href="catalog/view/theme/bardahl/stylesheet/style.css?v=1.25" type="text/css" />
    
    <!-- slick start -->
    <link rel="stylesheet" type="text/css" href="catalog/view/theme/bardahl/slick/slick/slick.css"/>
    <link rel="stylesheet" type="text/css" href="catalog/view/theme/bardahl/slick/slick/slick-theme.css"/>
    <!-- slick end -->
    
    <!--[if lt IE 9]><link rel="stylesheet" type="text/css" href="catalog/view/theme/bardahl/stylesheet/ie.css?v=1.0"><![endif]-->
    <!--[if IE]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
    <?php foreach ($styles as $style) { ?>
    <link href="<?php echo $style['href']; ?>?v=1.0" type="text/css" rel="<?php echo $style['rel']; ?>" media="<?php echo $style['media']; ?>" />
    <?php } ?>
    
    <?php echo $google_analytics; ?>
    
    
</head>
<body>
    <div class="layout">
        <div class="wrap">
            <div class="fixed">
                <div class="header_info table">
                    <div class=""></div>
                    <div class="city"><a href="#"><span class="glyphicon glyphicon-map-marker"></span><?php echo($city['name']) ?></a></div>
                    <div class="email">
                        <?php foreach ($city['email'] as $email) {?>
                        <a href="mailto:<?php echo $email?>"><span class="glyphicon glyphicon-envelope"></span><?php echo $email?></a>
                        <?php } ?>
                    </div>
                    <div class="phone bold">
                        <div class="table" data-city="<?php echo($city['code'])?>">
                            <div class="table-cell"><div class="phone_img"></div></div>
                            <div class="table-cell">
								<?php $count_city_phones = count($city['phone'])?>
                                <?php if($count_city_phones > 1){ ?>
                                    <div class="table multi">
									
                                        <?php foreach ($city['phone'] as $key => $value) { ?>
											<?php foreach ($value as $name => $number){ ?>
                                        <div class="table-row" data-phone="<?php echo($number)?>">
                                            <div class="table-cell side"><a href="#"><?php if(strlen($name) > 0) {echo($name . ": ");}?>&nbsp;</a></div>
                                            <div class="table-cell">
                                                <a href="#">
                                                    <?php if($city['code'] === 'msk'){ // was if($city['phone']['code'] == 'msk'){?>
                                                        <span class="lptracker_phone"><?php echo($number)?></span>
                                                    <?php } else { ?>
                                                        <?php echo($number)?>
                                                    <?php }?>
                                                </a>
                                            </div>
                                        </div>
                                        <?php 
											}
										} ?>
                                    </div>
                                <?php } else { ?>
                                    <a href="#"><?php echo($city['phone'][""])?></a>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <div class="social">
                        <a href="https://vk.com/bardahlmotor" class="vk" target="_blank" rel="nofollow"></a>
                        <a href="https://www.facebook.com/bardahlmotor" class="fb" target="_blank" rel="nofollow"></a>
                        <a href="https://www.instagram.com/bardahl_motor/" class="insta" target="_blank" rel="nofollow"></a>
                    </div>
                </div>
            </div>
            <div class="fixed">
                <header class="header grid-container">
                    <div class="header_content">
                        <div class="logo">
                            <h1>
                                    <a href="<?php echo $home; ?>"><img src="catalog/view/theme/bardahl/img/logo.png" title="<?php echo $name; ?>" alt="<?php echo $name; ?>" /></a>
                            </h1>
                        </div>
                        <div class="data">
                            <menu role="navigation">
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
                                        <?php if (isset($information['children'])) { ?>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenu_info_<?php echo $information['information_id']; ?>">
                                                <?php foreach ($information['children'] as $child) { ?>
                                                    <li>
                                                        <a class="nowrap" href="<?php echo $child['href']; ?>">
                                                            <?php echo $child['title']; ?>
                                                        </a>
                                                    </li>
                                                <?php } ?>
                                            </ul>
                                        <?php } ?>
                                    </li>
                                <?php } ?>
                            </menu>
                            <div class="search">
                                <div class="input">
                                    <?php echo $search; ?>
                                </div>
                                <div class="button"><?php echo $cart; ?></div>
                            </div>
                            <menu class="categories" role="navigation">
                                <?php $counter = 0; foreach ($categories as $category) { $counter++;?>
                                <li class="<?php echo ($counter==count($categories) ? 'last ':'' ) ?>dropdown">
                                    <a href="<?php echo $category['href']; ?>" id="dropdownMenu<?php echo $category['category_id']; ?>" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                        <?php echo $category['name']; ?>
                                    </a>
                                    <?php if ($category['children']) { ?>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenu<?php echo $category['category_id']; ?>">
                                            <?php foreach ($category['children'] as $child) { ?>
                                                <li>
                                                    <div class="table">
                                                        <div class="table-cell">
                                                            <a class="nowrap" href="<?php echo $child['href']; ?>">
                                                                <img alt="" src="<?php echo $child['image']; ?>"/>
                                                            </a>
                                                        </div>
                                                        <div class="table-cell">
                                                            <a class="nowrap" href="<?php echo $child['href']; ?>">
                                                                <?php echo $child['name']; ?>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </li>
                                            <?php } ?>
                                        </ul>
                                    <?php } ?>
                                </li>
                                <?php } ?> 
                            </menu>
                        </div>
                    </div>
                    <!-- Modal -->
                    <div class="modal fade" id="callBackModal" tabindex="-1" role="dialog" aria-labelledby="callBackModalLabel">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Закрыть"><span aria-hidden="true">&times;</span></button>
                            <div class="h4 modal-title" id="myModalLabel">Запрос обратного звонка</div>
                          </div>
                          <div class="modal-body">
                            <div class="alert alert-success hidden">
                                <i class="fa fa-check-circle"></i>Запрос на обратный звонок успешно отправлен</div>
                            <div class="alert alert-danger hidden">
                                <i class="fa fa-check-circle"></i>Произошла ошибка при попытке отправить запрос на обратный звонок</div>
                              <form class="form-horizontal" id="callBack">
                                  <input type="hidden" val="" id="callBackCity" name="callBackCity" />
                                  <input type="hidden" val="" id="callBackSelectedPhone" name="callBackSelectedPhone" />
                                  <div class="form-group">
                                    <label for="callBackName" class="col-sm-2 control-label">Имя</label>
                                    <div class="col-sm-10">
                                      <input type="text" class="form-control" id="callBackName" name="callBackName" data-val="true" data-val-required="Пожалуйста, укажите Ваше имя">
                                      <span class="field-validation-error" data-valmsg-for="callBackName" data-valmsg-replace="true"></span>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label for="callBackPhone" class="col-sm-2 control-label">Номер телефона</label>
                                    <div class="col-sm-10">
                                      <input type="text" class="form-control" id="callBackPhone" name="callBackPhone" data-val="true" data-val-required="Пожалуйста, укажите Ваш номер телефона">
                                      <span class="field-validation-error" data-valmsg-for="callBackPhone" data-valmsg-replace="true"></span>
                                    </div>
                                  </div>
                              </form>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
                            <button type="button" class="btn btn-primary">Отправить</button>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- Shipping modal -->
                    <div class="modal fade" id="shippingModal" tabindex="-1" role="dialog" aria-labelledby="shippingModalLabel">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Закрыть"><span aria-hidden="true">&times;</span></button>
                            <div class="h4 modal-title" id="myModalLabel">Укажите способ доставки</div>
                          </div>
                            <div class="modal-body"></div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
                            <button type="button" class="btn btn-primary">Продолжить</button>
                          </div>
                        </div>
                      </div>
                    </div>
                </header><!-- /header-->
            </div>