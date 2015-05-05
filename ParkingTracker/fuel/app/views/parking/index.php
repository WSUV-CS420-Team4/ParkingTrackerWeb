<table class="table sortable">
  <thead>
    <tr><th>Plate</th><th>Location</th><th>Time</th><th>Attributes</th></tr>
  </thead>
  <tbody>
  <?php foreach ($parking as $stall): ?>
    <tr><td><?=$stall['Plate']?></td><td><?=$stall['Block']?><?=$stall['Face']?>:<?=$stall['Stall']?></td><td><?=$stall['Time']?></td><td><?=$stall['Attr']?></td></tr>
  <?php endforeach; ?>
  </tbody>
</table>
