<table class="table sortable">
  <thead>
    <tr>
      <th>Stall</th>
      <?php foreach ($times as $time): ?><th><?=$time?></th><?php endforeach; ?>
    </tr>
  </thead>
  <tbody>
  <?php foreach ($stalls as $stall): ?>
    <tr>
      <td><?=$stall['StallStr']?></td>
      <?php foreach($times as $time): ?>
        <td><?php if (array_key_exists($time, $stall)) { echo $stall[$time]['Plate']; } ?></td>
      <?php endforeach; ?>
    </tr>
  <?php endforeach; ?>
  </tbody>
</table>
