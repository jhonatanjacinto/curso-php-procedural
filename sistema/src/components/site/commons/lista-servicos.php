<?php 
$lista_servicos = get_servicos();
?>
<div class="lista-servicos">
    <h2>Tudo que você precisa num único lugar</h2>
    <div class="icones">

        <?php foreach ($lista_servicos as $servico) : ?>
            <div class="bloco-icone">
                <img src="<?= IMG_URL . "/icones/" . $servico["icone"] ?>" alt="<?= $servico["titulo"] ?>">
                <h3><?= $servico["titulo"] ?></h3>
                <p><?= $servico["descricao"] ?></p>
            </div>
        <?php endforeach; ?>

    </div>
</div>