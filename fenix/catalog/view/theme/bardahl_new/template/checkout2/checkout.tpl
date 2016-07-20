<?php echo $header; ?>
<div class="middle">
    <?php echo $content_top; ?>   
    
    <div class="c-container">
        <?php if ($error_warning) { ?>
            <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
              <button type="button" class="close" data-dismiss="alert">&times;</button>
            </div>
        <?php } ?>
        
        
        <div class="checkout2_slider_conteiner">
            
            <form method="post" action="<?php echo $formAction?>" id="createOrder" class="form-horizontal">
                <table>
                    <input type="hidden" id="closed" name="closed" value="<?php echo $closed?>" />

                    <div class="checkout2_form">
                        <div class="form-group">
                            <tr>
                                    <td>
                                        Имя:&nbsp;
                                    </td>
                                    <td>
                                        <input type="text" name="firstname" required/><br>
                                    </td>
                                </tr>    
                                <tr>
                                    <td>
                                        Фамилия:&nbsp;
                                    </td>
                                    <td>
                                        <input type="text" name="lastname" required/><br>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Email:&nbsp;
                                    </td>
                                    <td>
                                        <input type="email" name="email" required/>
                                    </td>
                                </tr>
                                <tr>
                                    <td>

                                    </td>
                                    <td>
                                        <select>
                                            <option selected>--- Выберите город ---</option>
                                            <option value="">Москва</option>
                                            <option value="">Санкт-Петербург</option>
                                            <option value="">Воронеж</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="radio" name="delivery" value="pickup" />
                                    </td>
                                    <td>
                                        pickup text
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="radio" name="delivery" value="delivery" />
                                    </td>
                                    <td>
                                        delivery text
                                    </td>
                                </tr>
                        </div>
                    </div>
                    
                    <div class="checkout2_form"></div>
                    <div class="checkout2_form"></div>
                </table>
            </form>
            
            
            
        </div>
        
        
    </div>