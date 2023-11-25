<?php 
require "src/app-config.php";

render_component('site/commons/cabecalho', [
    "page_title" => get_page_title('Sobre'),
    "active_item" => "sobre"
]); 

render_component('site/commons/cabecalho-pagina', [
    "titulo" => "Sobre a OdontoVida"
]);
?>
    <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Sit totam minima quo enim ut, magni facere placeat corrupti omnis quia atque temporibus vitae natus id odit dolor dolores recusandae perspiciatis.</p>
    <p>Quibusdam numquam qui repellat quidem voluptatibus fugiat accusantium illo rerum repudiandae ipsam rem doloremque pariatur consequatur, nisi maxime optio quia magnam neque quisquam nam maiores? Ad, ipsam. Officiis, ullam officia.</p>
<?php 
render_component('site/home/banner-sobre');
render_component('site/commons/rodape');
