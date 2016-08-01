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
						<li class="tab_selected"><a href="<?php echo $edit; ?>">Основные данные</a></li>
						<li><a href="<?php echo $edit_password; ?>">Сменить пароль</a></li>
						<li><a href="<?php echo $reward; ?>">Бонусы</a></li>
						<li><a href="<?php echo $order; ?>">История покупок</a></li>
						<li><a href="<?php echo $logout; ?>">Выйти</a></li>
					</ul>
				</div>
					<div id="profile-main" class="right-cont-wrapper">

					  <?php if ($orders) { ?>
				      <div class="table-responsive">
				        <table class="table table-bordered table-hover">
				          <thead>
				            <tr>
				              <td class="text-right"><?php echo $column_order_id; ?></td>
				              <td class="text-left"><?php echo $column_status; ?></td>
				              <td class="text-left"><?php echo $column_date_added; ?></td>
				              <td class="text-right"><?php echo $column_product; ?></td>
				              <td class="text-left"><?php echo $column_customer; ?></td>
				              <td class="text-right"><?php echo $column_total; ?></td>
				              <td></td>
				            </tr>
				          </thead>
				          <tbody>
				            <?php foreach ($orders as $order) { ?>
				            <tr>
				              <td class="text-right">#<?php echo $order['order_id']; ?></td>
				              <td class="text-left"><?php echo $order['status']; ?></td>
				              <td class="text-left"><?php echo $order['date_added']; ?></td>
				              <td class="text-right"><?php echo $order['products']; ?></td>
				              <td class="text-left"><?php echo $order['name']; ?></td>
				              <td class="text-right"><?php echo $order['total']; ?></td>
				              <td class="text-right"><a href="<?php echo $order['href']; ?>" data-toggle="tooltip" title="<?php echo $button_view; ?>" class="btn btn-info"><i class="fa fa-eye"></i></a></td>
				            </tr>
				            <?php } ?>
				          </tbody>
				        </table>
				      </div>
				      <div class="text-right"><?php echo $pagination; ?></div>
				      <?php } else { ?>
				      	<p><?php echo $text_empty; ?></p>
				      <?php } ?>
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