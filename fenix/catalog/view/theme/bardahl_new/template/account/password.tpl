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
					<div class="cont-tit"><?php echo $heading_title; ?></div>
						<div class="prof-menu-wrapper tabs_holder">
							<img src="catalog/view/theme/bardahl_new/img/profile-menu.png">
							<ul class="profile-menu">
								<!-- Нужно потом вынести меню в отдельный модуль -->
								<li><a href="<?php echo $edit; ?>">Основные данные</a></li>
								<li class="tab_selected"><a href="<?php echo $edit_password; ?>">Сменить пароль</a></li>
								<li><a href="<?php echo $reward; ?>">Бонусы</a></li>
								<li><a href="<?php echo $order; ?>">История покупок</a></li>
								<li><a href="<?php echo $logout; ?>">Выйти</a></li>
							</ul>
						</div>
						<div id="profile-main" class="right-cont-wrapper">
							<form name="test" method="post" action="<?php echo $action; ?>" enctype="multipart/form-data">
								<div class="prof-col" style="width: 431px;">
									<div class="prof-tit"><?php echo $text_password; ?></div>
									<div class="input-wrapper">
										<span><?php echo $entry_password; ?>*</span>
										<input type="text" required="required">
									</div>
									<div class="input-wrapper">
										<span><?php echo $entry_confirm; ?>*</span>
										<input type="text" required="required">
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