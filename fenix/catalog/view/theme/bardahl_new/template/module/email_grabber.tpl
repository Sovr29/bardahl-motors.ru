<!-- email grabber modal -->
<div class="modal fade" id="emailGrabberModal" tabindex="-1" role="dialog" aria-labelledby="emailGrabberModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Закрыть"><span aria-hidden="true">&times;</span></button>
        <div class="h4 modal-title" id="emailGrabberModalLabel">&nbsp;</div>
      </div>
        <div class="modal-body">
            <?php echo($form); ?>
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary"><?php echo($button_text); ?></button>
      </div>
    </div>
  </div>
</div>