<?php echo $header; ?>
<div class="middle">
    <?php echo $content_top; ?>
    <div class="c-container">
		<div class="clr"></div>
		<div class="globalWrapper">
			<div class="wrapper">

					<div class="pag-2">
						<ul>
							<li><a href="#">Главная</a></li>
							<li>&#187;</li>
							<li class="active"><a href="#"><?php echo $text_account; ?></a></li>
						</ul>
					</div>
				<div class="clr"></div>
				<div class="cont">
					<div class="cont-tit"><?php echo $text_edit; ?></div>
						<div class="prof-menu-wrapper tabs_holder">
							<img src="catalog/view/theme/bardahl_new/img/profile-menu.png">
							<ul class="profile-menu">
								<!-- Нужно потом вынести меню в отдельный модуль -->
								<li class="tab_selected"><a href="<?php echo $edit; ?>">Основные данные</a></li>
								<li><a href="<?php echo $password; ?>">Сменить пароль</a></li>
								<li><a href="<?php echo $reward; ?>">Бонусы</a></li>
								<li><a href="<?php echo $order; ?>">История покупок</a></li>
								<li><a href="<?php echo $logout; ?>">Выйти</a></li>
							</ul>
						</div>
						<div id="profile-main" class="right-cont-wrapper">
							<form name="test" method="post" action="<?php echo $action; ?>" enctype="multipart/form-data">
								<div class="prof-col">
									<div class="prof-tit">Контактная информация</div>
									<div class="input-wrapper">
										<span>Имя*</span>
										<input type="text" required="required">
									</div>
									<div class="input-wrapper">
										<span>Фамилия*</span>
										<input type="text" required="required">
									</div>
									<div class="input-wrapper">
										<span>E-mail*</span>
										<input type="text" value="<?php echo $email; ?>" required="required">
									</div>
									<div class="input-wrapper">
										<span>Телефон</span>
										<input type="text">
									</div>
									<div class="prof-tit">Основной способ коммуникации</div>
									<div class="input-wrapper-check">
									    <div class="radio-but"><input type="radio" name="gender"> SMS</div>
									    <div class="radio-but"><input type="radio" name="gender" checked> E-mail</div>
									    <div class="radio-but"><input type="radio" name="gender"> SMS + E-mail</div>
									</div>
									<div class="input-wrapper-check">
										<div class="check-but"><input type="checkbox"> Подписка на новости и акции</div>
									</div>
									<div class="prof-tit">Дополнительная информация</div>
									<div class="input-wrapper">
										<span>Отчество</span>
										<input type="text">
									</div>
									<div class="input-wrapper-select">
										<span>Пол</span>
										<select>
										  <option>Жен.</option>
										  <option>Муж.</option>
										</select>
									</div>
									<div class="input-wrapper">
										<span>Дата рождения</span>
										<input type="text">
									</div>
								</div>
								<div class="prof-col">
									<div class="prof-tit">Адрес доставки</div>
									<div class="input-wrapper">
										<span>Город</span>
										<input type="text">
									</div>
									<div class="input-wrapper">
										<span>Улица</span>
										<input type="text">
									</div>
									<div class="input-wrapper">
										<span>Дом</span>
										<input type="text">
									</div>
									<div class="input-wrapper">
										<span>Квартира / Офис</span>
										<input type="text">
									</div>
									<div class="mail-img"><img src="catalog/view/theme/bardahl_new/img/mail.png"></div>
									<div class="clr"></div>
									<input type="submit" value="">
								</div>
							</form>
						</div>
					<div class="clr"></div>
				</div>
			</div>
		</div>
		<div class="clr"></div>
<?php echo $content_bottom; ?>
    </div>
</div>
<?php echo $footer; ?>