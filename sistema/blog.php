<?php 
require "src/app-config.php";

render_component('site/commons/cabecalho', [
    "page_title" => get_page_title('Blog'),
    "active_item" => "blog"
]);
render_component('site/commons/cabecalho-pagina', [
    "titulo" => "Blog"
]);
?>
    <p>
        Página de Blog...
    </p>
<?php 
render_component('site/commons/rodape');