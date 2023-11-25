<?php
$active_item ??= "";
$menu_items = array(
    "clientes" => array("label" => "Clientes", "url" => get_page_url("/clientes", true)),
    "exames" => array("label" => "Exames", "url" => get_page_url("/exames", true)),
    "servicos" => array("label" => "Serviços", "url" => get_page_url("/servicos", true)),
    "blog" => array("label" => "Blog", "url" => get_page_url("/blog", true)),
    "administradores" => array("label" => "Administradores", "url" => get_page_url("/administradores", true)),
);
?>
<ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center">
    <?php foreach ($menu_items as $key => $item) : 
            $item_class = $active_item === $key ? "link-secondary" : "link-dark";
    ?>
        <li>
            <a href="<?= $item["url"] ?>" class="nav-link px-2 <?= $item_class ?>">
                <?= $item["label"] ?>
            </a>
        </li>
    <?php endforeach; ?>
</ul>