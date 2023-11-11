<?php 
$page_title = isset($page_title) && !empty($page_title) ? $page_title : "Sem Título";
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $page_title ?></title>
    <link rel="stylesheet" href="<?= CSS_URL ?>/site.css">
    <script src="<?= JS_URL ?>/site.js" defer></script>
</head>
<body>
    <header id="site-top" class="flex">
        <div class="logo">
            <a href="<?= get_page_url('/') ?>">
                <img src="<?= get_image_url('logo.png') ?>" alt="<?= SITE_NAME ?>">
            </a>
        </div>
        <?php render_component('site/commons/menu', ["active_item" => $active_item ?? "home"]); ?>
    </header>
    <main>