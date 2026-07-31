<?php

declare(strict_types=1);

?>


<section class="admin-section">


<div class="container">


<div class="admin-header">


<h1>
Manage Packages
</h1>


<a href="/admin/packages/create">
Add Package
</a>


</div>



<table class="admin-table">


<thead>

<tr>

<th>
Title
</th>

<th>
Destination
</th>

<th>
Price
</th>

<th>
Action
</th>

</tr>

</thead>



<tbody>


<?php foreach($packages as $package): ?>


<tr>


<td>
<?= htmlspecialchars($package['title']) ?>
</td>



<td>
<?= htmlspecialchars($package['destination']) ?>
</td>



<td>
<?= htmlspecialchars($package['price']) ?>
</td>



<td>

<a href="/admin/packages/edit?id=<?= $package['id'] ?>">
Edit
</a>

</td>


</tr>


<?php endforeach; ?>


</tbody>


</table>


</div>


</section>
