<?php 

require "src/app-config.php";

$msg = [];

try {
    if ($_POST) {
        debug_print($_FILES, true);
        $titulo = $_POST["titulo"] ?? "";
        $descricao = $_POST["descricao"] ?? "";
        $icone = $_POST["icone"] ?? "";
        $ativo = isset($_POST["ativo"]);
        
        cadastrar_servico($titulo, $descricao, $icone, $ativo);
        unset($titulo, $descricao, $icone, $ativo);
        
        $msg = [
            "message" => "Serviço cadastrado com sucesso!",
            "css_class" => "alert-success"
        ];
    }
} catch (Exception $exc) {
    $msg = [
        "message" => $exc->getMessage(),
        "css_class" => "alert-danger"
    ];
}

render_component("area-restrita/commons/cabecalho", [
    "page_title" => get_page_title("Cadastrar Serviço - Área Restrita"),
    "active_item" => "servicos"
]);
?>
    <div class="container my-3">
        <h2>Cadastrar Serviço</h2>
        <p>
            Preencha o formulário abaixo para cadastrar um novo serviço:
        </p>
        <hr>
        <a href="<?= get_page_url("/servicos/", true) ?>" class="btn btn-primary btn-sm">
            Voltar para Listagem
        </a>
        <form method="POST" class="mt-3" enctype="multipart/form-data">
            
            <?php if ($msg) : ?>
                <div class="alert <?= $msg["css_class"] ?>">
                    <?= $msg["message"] ?>
                </div>
            <?php endif; ?>

            <div class="mb-3">
                <label for="titulo" class="form-label">Título:</label>
                <input type="text" class="form-control" name="titulo" id="titulo" value="<?= $titulo ?? "" ?>" placeholder="Ex: Restauração" />
            </div>
            <div class="mb-3">
                <label for="descricao" class="form-label">Descrição:</label>
                <textarea name="descricao" id="descricao" cols="1" rows="10" class="form-control"><?= $descricao ?? "" ?></textarea>
            </div>
            <div class="mb-3">
                <label for="icone" class="form-label">Ícone:</label>
                <input type="file" class="form-control" name="icone" id="icone" />
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" name="ativo" id="ativo" value="1" class="form-check-input" <?= (isset($ativo) && $ativo) ? "checked" : null ?> />
                <label for="form-check-label">Marcar esse serviço como ativo</label>
            </div>
            <button type="submit" class="btn btn-primary">
                Salvar
            </button>
        </form>
    </div>
<?php
render_component("area-restrita/commons/rodape");