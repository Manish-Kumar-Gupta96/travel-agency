<?php

declare(strict_types=1);


$schema = [

    "@context" => "https://schema.org",

    "@type" => "TravelAgency",

    "name" => "Premium Travel",

    "description" =>
    "Premium travel packages and destinations.",

    "url" =>
    $_SERVER['HTTP_HOST'] ?? '',


];

?>


<script type="application/ld+json">

<?= json_encode(
    $schema,
    JSON_UNESCAPED_SLASHES
) ?>

</script>
