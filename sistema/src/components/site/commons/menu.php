<?php 
$active_item ??= "home";
$menu_items = array(
    'home' => array(
        'label' => 'Home', 
        'url' => get_page_url('/')
    ),
    'sobre' => array(
        'label' => 'Sobre',
        'url' => get_page_url('/sobre.php')
    ),
    'informacoes-paciente' => array(
        'label' => 'Informações ao Paciente',
        'url' => get_page_url('/informacoes-paciente.php'),
    ),
    'servicos' => array(
        'label' => 'Serviços',
        'url' => get_page_url('/servicos.php'),
    ),
    'blog' => array(
        'label' => 'Blog',
        'url' => get_page_url('/blog.php'),
    ),
    'contato' => array(
        'label' => 'Contato',
        'url' => get_page_url('/contato.php'),
    ),
    'agendar-consulta' => array(
        'label' => 'Agendar Consulta',
        'url' => get_page_url('/agendar-consulta.php'),
        'class' => 'btn'
    )
);

?>
<nav id="site-menu" class="flex">
    <?php foreach ($menu_items as $key => $menu_item) : 
            $active_class = $key === $active_item ? "active" : null;   
    ?>
        <a href="<?= $menu_item['url'] ?>" class="menu-item <?= $menu_item['class'] ?? '' ?> <?= $active_class ?>">
            <?= $menu_item['label'] ?>
        </a>
    <?php endforeach ?>
</nav>