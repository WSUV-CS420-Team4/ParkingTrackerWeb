<?= Form::open('export/') ?>
<div class="form-group">
  <label for="date">Day</label>
  <input type="date" id="date" name="date" value="<?=date('Y-m-d')?>" />
</div>
<button type="submit" class="btn btn-default">Download</button>
<?= Form::close() ?>
