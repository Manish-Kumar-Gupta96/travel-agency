<?php

declare(strict_types=1);

?>


<section class="admin-form-section">


<div class="container">


<h1>
Create Package
</h1>



<form method="post"
action="/admin/packages/store">


<div class="form-group">

<label>
Package Title
</label>

<input
type="text"
name="title"
required
>

</div>




<div class="form-group">

<label>
Destination
</label>

<input
type="text"
name="destination"
required
>

</div>




<div class="form-group">

<label>
Duration
</label>

<input
type="text"
name="duration"
>

</div>




<div class="form-group">

<label>
Price
</label>

<input
type="text"
name="price"
>

</div>




<button type="submit">

Save Package

</button>



</form>


</div>


</section>
