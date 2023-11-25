<?php 

require "src/app-config.php";

$msg = [];

try {
    if ($_POST) {
        $titulo = $_POST["titulo"] ?? "";
        $descricao = $_POST["descricao"] ?? "";
        $icone = $_POST["icone"] ?? "";
        $ativo = isset($_POST["ativo"]);
        $id = (int) ($_POST["id"] ?? 0);
        
        atualizar_servico($titulo, $descricao, $icone, $ativo, $id);
        
        $msg = [
            "message" => "Serviço atualizado com sucesso!",
            "css_class" => "alert-success"
        ];
    }
} catch (Exception $exc) {
    $msg = [
        "message" => $exc->getMessage(),
        "css_class" => "alert-danger"
    ];
}

$id = (int) ($_GET["id"] ?? 0);
$servico = get_servico_por_id($id);
if (!$servico) {
    header("Location: " . get_page_url("/servicos", true));
    exit();
}

render_component("area-restrita/commons/cabecalho", [
    "page_title" => get_page_title("Editar Serviço - Área Restrita"),
    "active_item" => "servicos"
]);
?>
    <div class="container my-3">
        <h2>Editar Serviço</h2>
        <p>
            Preencha o formulário abaixo para editar um serviço:
        </p>
        <hr>
        <a href="<?= get_page_url("/servicos/", true) ?>" class="btn btn-primary btn-sm">
            Voltar para Listagem
        </a>
        <form method="POST" class="mt-3">
            
            <?php if ($msg) : ?>
                <div class="alert <?= $msg["css_class"] ?>">
                    <?= $msg["message"] ?>
                </div>
            <?php endif; ?>

            <div class="mb-3">
                <label for="titulo" class="form-label">Título:</label>
                <input type="text" class="form-control" name="titulo" id="titulo" value="<?= $servico["titulo"] ?? "" ?>" placeholder="Ex: Restauração" />
            </div>
            <div class="mb-3">
                <label for="descricao" class="form-label">Descrição:</label>
                <textarea name="descricao" id="descricao" cols="1" rows="10" class="form-control"><?= $servico["descricao"] ?? "" ?></textarea>
            </div>
            <div class="mb-3">
                <label for="icone" class="form-label">Ícone:</label>
                <input type="text" class="form-control" name="icone" id="icone" value="<?= $servico["icone"] ?? "" ?>" placeholder="Ex: icone-1.svg" />
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" name="ativo" id="ativo" value="1" class="form-check-input" <?= $servico["ativo"] ? "checked" : null ?> />
                <label for="form-check-label">Marcar esse serviço como ativo</label>
            </div>
            <button type="submit" class="btn btn-primary">
                Salvar
            </button>
            <input type="hidden" name="id" value="<?= $servico["id"] ?? 0 ?>" />
        </form>
    </div>
<?php
render_component("area-restrita/commons/rodape");