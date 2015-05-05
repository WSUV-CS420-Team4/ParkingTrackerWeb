<?php $error = Session::get_flash('error');
  if ($error != null):
    foreach ($error as $e): ?>

  <div class="alert alert-danger alert-dismissable" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <strong>Error!</strong> <?= $e->get_message(); ?>
  </div>
  <?php endforeach; ?>
<?php endif;?>

<?= Form::open(array('action' => 'block/create', 'class' => 'form-inline')); ?>
<div class="form-group">
  <label for="block">Block Number</label>
  <input type="number" min="0" class="form-control" id="block" name="block" placeholder="Block Number" />
</div>
<div class="form-group">
  <label for="face">Block Face</label>
  <input type="text" maxlength="1" class="form-control" id="face" name="face" placeholder="Block Face" />
</div>
<div class="form-group">
  <label for="numStalls">Number of Stalls</label>
  <input type="number" min="0" class="form-control" id="numStalls" name="numStalls" placeholder="Number of Stalls" />
</div>
<button type="submit" class="btn btn-default">Submit</button>
<?= Form::close(); ?>
