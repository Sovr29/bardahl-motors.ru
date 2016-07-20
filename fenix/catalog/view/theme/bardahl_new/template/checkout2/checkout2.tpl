<?php echo $header; ?>

<div class="middle">
    <?php echo $content_top; ?>   
    
    <div class="c-container">
        <?php if ($error_warning) { ?>
            <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
              <button type="button" class="close" data-dismiss="alert">&times;</button>
            </div>
        <?php } ?>
            
            <form method="POST" 
                  action="javascript:void(0);"
                  id="checkout2Form" 
                  class="form-horizontal">
			<input type="hidden" id="closed" name="closed" value="<?php echo $closed?>" />
                
					<div class="checkout2_slider_conteiner">
                                            <div id="checkout2Step1" style="outline:none;">
                                                    <h1>Контактная информация</h1>
                                                    
                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label" title="Введите имя" for="checkout2CustomerFirstName">Имя</label>
                                                        
                                                        <div class="col-sm-4">
                                                            <input type="text" 
                                                                   name="firstname" 
                                                                   value="<?php echo $firstname?>" 
                                                                   id="checkout2CustomerFirstName" 
                                                                   class="form-control" 
                                                                   placeholder="Имя" 
                                                                   title="Необходимо указать имя" required />
                                                        
                                                        </div>
                                                    </div>
                                                        
                                                    <div class="form-group">    
                                                                <label class="col-sm-2 control-label" for="checkout2CustomerLastName">Фамилия</label>
                                                        <div class="col-sm-4">
                                                                <input type="text" 
                                                                       name="lastname"
                                                                       value="<?php echo $lastname?>"
                                                                       id="checkout2CustomerLastName"
                                                                       class="form-control"
                                                                       placeholder="Фамилия"
                                                                       title="Необходимо указать фамилию"
                                                                       required/>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="form-group">
                                                                <label class="col-sm-2 control-label" for="checkout2CustomerEmail">E-Mail</label>
                                                        <div class="col-sm-4">
                                                                <input type="email" 
                                                                       name="email" 
                                                                       value="<?php echo $email?>"
                                                                       placeholder="E-mail"
                                                                       class="form-control"
                                                                       data-val-regex-pattern="^([0-9a-zA-Z]+[-._+&amp;])*[0-9a-zA-Z]+@([-0-9a-zA-Z]+[.])+[a-zA-Z]{2,6}$"
                                                                       id="checkout2CustomerEmail" 
                                                                       title="Необходимо указать корректный email вида somebody@server.never"
                                                                       required/>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">        
                                                                <label class="col-sm-2 control-label" for="checkout2CustomerPhone">Телефон</label>
                                                        <div class="col-sm-4">
                                                                <input type="tel" 
                                                                       name="telephone" 
                                                                       value="<?php echo $telephone?>"
                                                                       id="checkout2CustomerPhone" 
                                                                       placeholder="Телефон"
                                                                       class="form-control valid"
                                                                       data-val="true"
                                                                       title="Необходимо указать телефон"
                                                                       required/>
                                                        </div>
                                                    </div>
							
                                                    <div class="form-group">
                                                                <label class="col-sm-2 control-label" for="checkout2-input-coupon">Купон на скидку</label>
							<div class="col-sm-5">
                                                            <div class="input-group">
                                                                <input type="text" 
                                                                       id="checkout2-input-coupon" 
                                                                       name="coupon"
                                                                       value="<?php echo $coupon?>"
                                                                       placeholder="Код купона на скидку"
                                                                       class="form-control"/>
                                                                
                                                                <span class="input-group-btn">
                                                                    <input type="button" 
                                                                                 value="Примененить" 
                                                                                 id="checkout2-button-coupon" 
                                                                                 data-loading-text="Загрузка..." 
                                                                                 class="btn btn-primary" />
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>	   
                                                                
                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label" for="checkout2CitySelect">Город</label>
                                                        <div class="col-sm-4">
                                                            <select name="city" 
                                                                           id="checkout2CitySelect" 
                                                                           class="form-control"
                                                                           title="Необходимо указать город"
                                                                           required>
                                                                        <option value="" selected>--- Выберите город ---</option>
                                                                        <option value="msk">Москва</option>
                                                                        <option value="spb">Санкт-Петербург</option>
                                                                        <option value="vrn">Воронеж</option>
                                                                        <option value="tul">Тула</option>
                                                                        <option value="other">Другие города</option>
                                                            </select>
                                                        </div>
                                                    </div>     
                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label" for="checkout2CustomerAddress">Адрес</label>
                                                        <div class="col-sm-4">
                                                            <input type="text" 
                                                                   name="address_1" 
                                                                   value="<?php echo $address_1?>"
                                                                   placeholder="Адрес" 
                                                                   id="checkout2CustomerAddress" 
                                                                   class="form-control" 
                                                                   data-val="true" 
                                                                   title="Необходимо заполнить поле Адрес" required>
                                                        </div>
                                                    </div> 
                                                                       
                                                                       
                                                                
                                                    <div class="form-group">  
                                                        <label class="col-sm-2 control-label" for="checkout2CustomerPhone">Комментарий</label>
                                                        <div class="col-sm-4">
                                                            <textarea id="checkout2-payment-comment" 
                                                                              name="comment" 
                                                                              rows="8" 
                                                                              class="form-control" 
                                                                              placeholder="Комментарий к заказу"><?php echo $comment?></textarea>
                                                            <br />
                                                            <div class="checkout2_next btn btn-primary">Вперед</div>
                                                        </div>
                                                        
                                                    </div>
                                                          
                                                          
                                                    
                                                </div>
						<div id="checkout2Step2" style="outline:none;">
                                                    <h1>Способ доставки</h1>
                                                    <div id="checkout2PickupContent"></div>
                                                    <div id="checkout2DeliveryContent"></div>
                                                    <div id="checkout2DeliveryToRegionsContent"></div>
                                                    <br/>
                                                    <br/>
                                                    <div class="checkout2_prev  btn btn-primary">Назад</div>
                                                    <div class="checkout2_next  btn btn-primary">Вперед</div>
                                                    
                                                </div>
						<div id="checkout2Step3" style="outline:none;">
                                                    
                                                    <h2>Способ оплаты</h2>
                                                    
                                                    <div id="checkout2PaymentConteiner"></div>
                                                    <div class="checkout2_prev  btn btn-primary">Назад</div>
                                                    <input type="submit" class="btn btn-primary" id="checkout2Submit" value="Оформить заказ" />
                                                </div>
					</div>
                
            </form>
        
        <table class="table table-bordered cartTable" style="width: 100%;">
            <?php foreach ($products as $product) { ?>
            <tr>
                <td class="image text-center"><?php if ($product['thumb']) { ?>
                    <a href="<?php echo $product['href']; ?>"><img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" title="<?php echo $product['name']; ?>" class="img-thumbnail" /></a>
                <?php } ?></td>
                <td class="product"><a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a>
                    <?php if (!$product['stock']) { ?>
                    <span class="text-danger">***</span>
                    <?php } ?>
                    <?php if ($product['option']) { ?>
                    <?php foreach ($product['option'] as $option) { ?>
                    <br />
                    <small><?php echo $option['name']; ?>: <?php echo $option['value']; ?></small>
                    <?php } ?>
                    <?php } ?>
                    <?php if ($product['reward']) { ?>
                    <br />
                    <small><?php echo $product['reward']; ?></small>
                    <?php } ?>
                    <?php if ($product['recurring']) { ?>
                    <br />
                    <span class="label label-info"><?php echo $text_recurring_item; ?></span> <small><?php echo $product['recurring']; ?></small>
                    <?php } ?>
                </td>         
                <td class="quantity"><div class="input-group btn-block">
                    <?php echo $product['quantity']; ?> (<a href="<?php echo $cart;?>">Изменить</a>)
                </td>
                <td class="price text-right"><span><?php echo $product['price']; ?> <i class="fa fa-rub"></i></span></td>
                <td class="price text-right" ><span style="margin-left: 200px;" class="checkout2Total"><?php echo $product['total']; ?> <i class="fa fa-rub"></i></span></td>
                
            </tr>
            <?php } ?>      
        </table>
            
            
            
        
        
       
    </div>
    <?php echo $footer?> 
