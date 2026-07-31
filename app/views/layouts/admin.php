<?php

declare(strict_types=1);

?>


<!DOCTYPE html>

<html lang="en">


<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">


<title>

<?= htmlspecialchars($title ?? 'Admin Panel') ?>

</title>


<link rel="stylesheet" href="/assets/css/admin.css">


</head>



<body>



<div class="admin-wrapper">



<aside class="admin-sidebar">


<h2>
Travel Admin
</h2>



<nav>


<a href="/admin/dashboard">
Dashboard
</a>


<a href="/admin/bookings">
Bookings
</a>


<a href="/admin/packages">
Packages
</a>


<a href="/logout">
Logout
</a>


</nav>


</aside>




<main class="admin-content">


<?= $content ?? '' ?>


</main>




</div>



</body>


</html>
