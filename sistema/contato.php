<?php 
require "src/app-config.php";

render_component('site/commons/cabecalho', [
    "page_title" => get_page_title('Contato'),
    "active_item" => "contato"
]);
?>
    <h1>Contato</h1>
<?php 
render_component('site/commons/rodape');
