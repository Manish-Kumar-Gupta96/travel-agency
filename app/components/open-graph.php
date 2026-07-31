<?php

declare(strict_types=1);


$seo = $seo ?? [];

?>


<meta 
property="og:title"
content="<?= htmlspecialchars(
    $seo['title'] ?? ''
) ?>"
>


<meta 
property="og:description"
content="<?= htmlspecialchars(
    $seo['description'] ?? ''
) ?>"
>


<meta 
property="og:type"
content="website"
>


<meta 
property="og:url"
content="<?= $_SERVER['REQUEST_URI'] ?>"
>


<meta 
property="og:image"
content="<?= htmlspecialchars(
    $seo['image'] ?? ''
) ?>"
>



<meta 
name="twitter:card"
content="summary_large_image"
>


<meta 
name="twitter:title"
content="<?= htmlspecialchars(
    $seo['title'] ?? ''
) ?>"
>


<meta 
name="twitter:description"
content="<?= htmlspecialchars(
    $seo['description'] ?? ''
) ?>"
>
