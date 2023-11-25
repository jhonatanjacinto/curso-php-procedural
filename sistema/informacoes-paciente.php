<?php 
require "src/app-config.php";

render_component('site/commons/cabecalho', [
    "page_title" => get_page_title('Informações ao Paciente'),
    "active_item" => "informacoes-paciente"
]);
render_component('site/commons/cabecalho-pagina', [
    "titulo" => "Informações ao Paciente"
]);
?>
    <p>
        Página de informações para o Paciente...
    </p>
<?php 
render_component('site/commons/rodape');