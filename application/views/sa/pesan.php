
<div class="modal <?php echo $mode; ?> fade" id="modal-default">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">INFO</h4>
      </div>
      <div class="modal-body">
        <p><?php echo $pesan;?>&hellip;</p>
      </div>

<?php if($mode="modal-warning"){ ?>
      <div class="modal-footer">
        <a href="<?php echo$page; ?>" class="btn btn-danger">Tutup</a>
      </div>
<?php } ?>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

