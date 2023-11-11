<?php 
declare(strict_types=1);
require "src/app-config.php";

// Cabeçalho
render_component('site/commons/cabecalho', [
    "page_title" => get_page_title('', true),
    "active_item" => "home"
]);

// Componentes do Meio da Página
render_component('site/home/main-banner');
render_component('site/home/banner-sobre');
render_component('site/commons/lista-servicos');

// Rodapé
render_component('site/commons/rodape');
