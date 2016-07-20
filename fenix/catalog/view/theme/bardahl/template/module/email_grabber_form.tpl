<?php echo($body); ?>
<form class="form-horizontal emailGrabberForm" action="<?php echo($action);?>" method="POST">
    <div class="form-group required">
        <label for="emailGrabberName" class="col-sm-2 control-label">Имя</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="emailGrabberName" name="email_grabber_name" placeholder="Имя" data-val="true" data-val-required="<?php echo($error_name)?>">
          <span class="field-validation-error" data-valmsg-for="email_grabber_name" data-valmsg-replace="true"></span>
        </div>
    </div>
    <div class="form-group required">
        <label for="emailGrabberEmail" class="col-sm-2 control-label">Email</label>
        <div class="col-sm-10">
          <input type="email" class="form-control" id="emailGrabberEmail" name="email_grabber_email" placeholder="Email" data-val="true" data-val-required="<?php echo($error_email)?>" data-val-email="Вы ввели не корректный Email адрес">
          <span class="field-validation-error" data-valmsg-for="email_grabber_email" data-valmsg-replace="true"></span>
        </div>
    </div>
    <div class="form-group">
        <label for="emailGrabberPhone" class="col-sm-2 control-label">Телефон</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="emailGrabberPhone" name="email_grabber_phone" placeholder="Телефон">
        </div>
    </div>
</form>