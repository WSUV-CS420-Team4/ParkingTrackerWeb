<table class="table sortable">
  <thead>
    <tr><th>Plate</th><th>Location</th><th>Time</th><th>Attributes</th><th class="text-center">Actions</th></tr>
  </thead>
  <tbody>
  <?php foreach ($parking as $stall): ?>
    <tr><td><?=$stall['Plate']?></td><td><?=$stall['Block']?><?=$stall['Face']?>:<?=$stall['Stall']?></td><td><?=$stall['Time']?></td><td><?=$stall['Attr']?></td>
      <td>
        <div class="btn-group btn-group-xs pull-right" style="margin-left: 5px;">
          <button class="btn btn-default" data-goto-url="<?=Uri::base()?>plate/delete/<?=$stall['ParkingId']?>" title="Remove entry">
            <span class="glyphicon glyphicon-remove" aria-hidden="true" aria-label="Remove entry"></span>
          </button>
        </div>
      </td>
    </tr>
  <?php endforeach; ?>
  </tbody>
</table>
