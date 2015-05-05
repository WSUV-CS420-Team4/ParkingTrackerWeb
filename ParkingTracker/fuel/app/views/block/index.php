<div class="panel panel-default">
  <div class="panel-body">
    <?= Html::anchor('block/create', "Add blockface") ?>
  </div>
</div>

<table class="table sortable">
  <thead>
    <tr><th>Block Number</th><th>Block Face</th><th>Number of Stalls</th><th class="text-center">Actions</th></tr>
  </thead>
  <tbody>
  <?php foreach ($blocks as $block): ?>
    <tr><td><?=$block['Block']?></td><td><?=$block['Face']?></td><td><?=$block['numStalls']?></td>
      <td>
        <div class="btn-group btn-group-xs pull-right" style="margin-left: 5px;">
          <button class="btn btn-default" data-goto-url="<?=Uri::base()?>block/edit/<?=$block['Block']?>/<?=$block['Face']?>" title="Edit entry">
            <span class="glyphicon glyphicon-pencil" aria-hidden="true" aria-label="Edit entry"></span>
          </button>
          <button class="btn btn-default" data-goto-url="<?=Uri::base()?>block/delete/<?=$block['Block']?>/<?=$block['Face']?>" title="Remove entry">
            <span class="glyphicon glyphicon-remove" aria-hidden="true" aria-label="Remove entry"></span>
          </button>
        </div>
      </td>
    </tr>
  <?php endforeach; ?>
  </tbody>
</table>
