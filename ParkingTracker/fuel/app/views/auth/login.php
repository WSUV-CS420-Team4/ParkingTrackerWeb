<?php $error = Session::get_flash('error');
  if ($error != null):
    foreach ($error as $e): ?>

  <div class="alert alert-danger alert-dismissable" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <strong>Error!</strong> <?= $e->get_message(); ?>
  </div>
  <?php endforeach; ?>
<?php endif;?>

<?= Form::open(array('action' => 'auth/login', 'class' => 'form-inline')); ?>
<div class="form-group">
  <label for="username">Username</label>
  <input type="text" required class="form-control" id="username" name="username" placeholder="Username" />
</div>
<div class="form-group">
  <label for="face">Password</label>
  <input type="password" required class="form-control" id="password" name="password" placeholder="Password" />
</div>
<button type="submit" class="btn btn-default">Submit</button>
<?= Form::close(); ?>
