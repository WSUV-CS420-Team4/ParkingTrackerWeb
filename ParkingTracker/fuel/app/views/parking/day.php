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
      <td><?=$stall['Stall']?></td>
      <?php foreach($times as $time): ?>
        <td><?=$stall[$time]?></td>
      <?php endforeach; ?>
    </tr>
  <?php endforeach; ?>
  </tbody>
</table>
