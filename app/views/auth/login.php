<?php

declare(strict_types=1);

?>


<section class="login-section">


<div class="container">


<form class="login-form"
method="post"
action="/login/authenticate">


<h1>
Admin Login
</h1>



<?php if(isset($error)): ?>

<p class="error-message">

<?= htmlspecialchars($error) ?>

</p>

<?php endif; ?>




<div class="form-group">

<label>
Email
</label>


<input
type="email"
name="email"
required
>

</div>




<div class="form-group">

<label>
Password
</label>


<input
type="password"
name="password"
required
>

</div>




<button type="submit">

Login

</button>



</form>


</div>


</section>
