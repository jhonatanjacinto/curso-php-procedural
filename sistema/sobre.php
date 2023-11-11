<?php 
require "src/app-config.php";

render_component('site/commons/cabecalho', [
    "page_title" => get_page_title('Sobre'),
    "active_item" => "sobre"
]); 
?>
    <h1>Sobre</h1>
<?php 
render_component('site/commons/rodape');
