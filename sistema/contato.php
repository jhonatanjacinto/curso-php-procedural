<?php 
require "src/app-config.php";

render_component('site/commons/cabecalho', [
    "page_title" => get_page_title('Contato'),
    "active_item" => "contato"
]);

render_component('site/commons/cabecalho-pagina', [
    "titulo" => "Contato"
]);
?>
    <p>
        Preencha o formulário abaixo para entrar em contato com a gente:
    </p>
<?php 
render_component('site/commons/rodape');
