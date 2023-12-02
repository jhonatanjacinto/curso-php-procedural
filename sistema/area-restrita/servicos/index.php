<?php 

require "src/app-config.php";

$msg = [];

try {
    if (isset($_GET["excluir"])) {
        $id = (int) ($_GET["excluir"] ?? 0);
        excluir_servico($id);
    }

    if (isset($_GET["visualizar"])) {
        $id = (int) ($_GET["visualizar"] ?? 0);
        visualizar_servico_pdf($id);
    }
} catch (Exception $exc) {
    $msg = ["message" => $exc->getMessage(), "css_class" => "alert-danger"];
}

$pagina = (int) ($_GET["pagina"] ?? 1);
$servicos = get_servicos($pagina, 2);
render_component("area-restrita/commons/cabecalho", [
    "page_title" => get_page_title("Serviços - Área Restrita"),
    "active_item" => "servicos"
]);
?>

    <div class="container my-3">
        <h2>Serviços</h2>
        <p>
            Confira abaixo os serviços cadastrados no sistema:
        </p>
        <hr>
        <a href="<?= get_page_url("/servicos/cadastro.php", true) ?>" class="btn btn-primary btn-sm">
            Cadastrar Novo
        </a>

        <?php if ($msg) : ?>
            <div class="my-3 alert <?= $msg["css_class"] ?>">
                <?= $msg["message"] ?>
            </div>
        <?php endif; ?>

        <table class="table table-stripped mt-3">
            <thead>
                <tr>
                    <th>Ícone</th>
                    <th>Título</th>
                    <th>Descrição</th>
                    <th>Status</th>
                    <th colspan="3" width="5%"></th>
                </tr>
            </thead>
            <tbody>

                <?php foreach ($servicos as $servico) : 
                        $id = $servico["id"];
                        $icone = "icones/" . $servico["icone"];
                        $editar_url = get_page_url("/servicos/editar.php?id=$id", true);
                        $delete_url = get_page_url("/servicos/index.php?excluir=$id", true);
                        $visualizar_url = get_page_url("/servicos/index.php?visualizar=$id", true);
                ?>
                    <tr>
                        <td><img src="<?= get_image_url($icone) ?>" width="50" height="50" /></td>
                        <td><?= $servico["titulo"] ?></td>
                        <td><?= $servico["descricao"] ?></td>
                        <td>
                            <?= $servico["ativo"] ? "Ativo" : "Inativo"; ?>
                        </td>
                        <td>
                            <a href="<?= $editar_url ?>" class="btn btn-success btn-sm">
                                Editar
                            </a>
                        </td>
                        <td>
                            <a href="<?= $delete_url ?>" class="btn btn-danger btn-sm">
                                Excluir
                            </a>
                        </td>
                        <td>
                            <a href="<?= $visualizar_url ?>" class="btn btn-info btn-sm">
                                Visualizar PDF
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>

            </tbody>
        </table>
    </div>

<?php
render_component("area-restrita/commons/rodape");