<?php 
require "src/app-config.php";

render_component('site/commons/cabecalho', [
    "page_title" => get_page_title('Serviços'),
    "active_item" => "servicos"
]);
render_component('site/commons/cabecalho-pagina', [
    "titulo" => "Serviços"
]);
?>
    <p>
        Página de Serviços...
    </p>
<?php 
render_component('site/commons/rodape');