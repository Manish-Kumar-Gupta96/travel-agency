<?php

declare(strict_types=1);

?>


<section class="admin-section">


<div class="container">


<div class="admin-header">


<h1>
Manage Destinations
</h1>


<a href="/admin/destinations/create">
Add Destination
</a>


</div>




<div class="admin-grid">


<?php foreach($destinations as $destination): ?>


<div class="admin-card">


<img

src="<?= htmlspecialchars($destination['image']) ?>"

alt="<?= htmlspecialchars($destination['name']) ?>"

>



<h3>

<?= htmlspecialchars($destination['name']) ?>

</h3>



<p>

<?= htmlspecialchars($destination['country']) ?>

</p>



<a href="/admin/destinations/edit?id=<?= $destination['id'] ?>">

Edit

</a>



</div>


<?php endforeach; ?>


</div>


</div>


</section>
