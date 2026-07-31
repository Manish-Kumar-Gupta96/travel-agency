<?php

declare(strict_types=1);


$meta = $meta ?? [];

?>


<meta charset="UTF-8">


<meta 
name="viewport"
content="width=device-width, initial-scale=1.0"
>



<title>

<?= htmlspecialchars(
    $meta['title']
    ??
    'Travel Website'
) ?>

</title>



<meta

name="description"

content="<?= htmlspecialchars(
    $meta['description']
    ??
    ''
) ?>"

>


<meta

name="robots"

content="index, follow"

>



<link

rel="canonical"

href="<?= $_SERVER['REQUEST_URI'] ?>"

>
