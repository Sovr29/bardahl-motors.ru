<div class="form-group">
    <label class="col-sm-2 control-label" for="input-payment-comment"><?php echo $entry_coupon; ?></label>
    <div class="col-sm-5">
        <div class="input-group">
            <input type="text" name="coupon" value="<?php echo $coupon; ?>" placeholder="<?php echo $entry_coupon; ?>" id="input-coupon" class="form-control" />
            <span class="input-group-btn">
                <input type="button" value="<?php echo $button_coupon; ?>" id="button-coupon" data-loading-text="<?php echo $text_loading; ?>"  class="btn btn-primary" />
            </span>
        </div>
    </div>
</div>
