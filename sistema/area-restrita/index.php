<?php 
require "src/app-config.php";

render_component("area-restrita/commons/cabecalho", [
    "page_title" => get_page_title("Bem-vindo(a) Usuário - Área Restrita")
]);

?>
    <div class="container">
        <h1>Bem-vindo(a) <strong>Usuário</strong>!</h1>
        <p>
            Utilize o menu acima para acessar os recursos disponíveis.
        </p>
    </div>
<?php
render_component("area-restrita/commons/rodape");