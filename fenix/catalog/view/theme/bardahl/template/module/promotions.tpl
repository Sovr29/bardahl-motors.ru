<?php echo $header; ?>
<div class="middle">
    <div class="c-container">
        <div class="promotions">
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="#discount" aria-controls="discount" role="tab" data-toggle="tab" aria-expanded="true">Разовая скидка</a></li>
                <li role="presentation" class=""><a href="#discounts" aria-controls="discounts" role="tab" data-toggle="tab" aria-expanded="true">Накопительная скидка</a></li>
                <?php if(count($promotions) > 0) { ?>
                <li role="presentation" class=""><a href="#promotions" aria-controls="promotions" role="tab" data-toggle="tab" aria-expanded="true">Акции</a></li>
                <?php } ?>
            </ul>
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="discount">		
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th class="centered" style="width:60%;">Сумма заказа</th>
                                <th class="centered" style="width:40%;">Скидка</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>от 15000</td>
                                <td>5%</td>
                            </tr>
                            <tr>
                                <td>от 30000</td>
                                <td>10%</td>
                            </tr>
                            <tr>
                                <td>от 50000</td>
                                <td>15%</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div role="tabpanel" class="tab-pane" id="discounts">		
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th class="centered" style="width:60%;">Сумма заказа</th>
                                <th class="centered" style="width:40%;">Скидка</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>от 30000</td>
                                <td>5%</td>
                            </tr>
                            <tr>
                                <td>от 45000</td>
                                <td>7%</td>
                            </tr>
                            <tr>
                                <td>от 60000</td>
                                <td>10%</td>
                            </tr>
                            <tr>
                                <td>от 75000</td>
                                <td>15%</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div role="tabpanel" class="tab-pane" id="promotions">
					<div class="promotions_description"><?php echo($promotions_description) ?></div>
                    <div class="table">
                    <?php
                    $counter = 0;
                    foreach ($promotions as $promotion) {
                            if($counter%3 == 0){
                                    if($counter > 0){
                                            echo '</div>';
                                    }
                                    echo '<div class="table-row">';
                            }?>
                        <article class="promotions_article">
                            <div class="inner">
                                <div class="images">
                                    <a href="<?php echo $promotion['view']; ?>"><img src="<?php echo $promotion['image']; ?>" alt="<?php echo $promotion['title']; ?>" /></a>
                                </div>
                                <div class="table actions">
                                    <div class="table-cell">
                                        <ul class="promotion-meta">
                                            <li><i class="fa fa-bookmark-o"></i></li>
                                            <li class="date"><span class="long"><?php echo $promotion['date_begin']; ?> - <?php echo $promotion['date_end']; ?></span></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="h2"><a href="<?php echo $promotion['view']; ?>"><?php echo $promotion['title']; ?></a></div>
								<div class="content">
									<a href="<?php echo $promotion['view']; ?>">
										<?php echo $promotion['description']; ?>
									</a>
								</div>
                            </div>
                        </article>
                    <?php 
                    $counter++;
                    }echo '</div>'; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php echo $content_bottom; ?>
<?php echo $footer; ?>