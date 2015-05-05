<table class="table sortable">
  <thead>
    <tr><th>Block Number</th><th>Block Face</th><th>Number of Stalls</th></tr>
  </thead>
  <tbody>
  <?php foreach ($blocks as $block): ?>
    <tr><td><?=$block['Block']?></td><td><?=$block['Face']?></td><td><?=$block['numStalls']?></td></tr>
  <?php endforeach; ?>
  </tbody>
</table>
