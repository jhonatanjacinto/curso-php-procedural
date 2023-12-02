<?php 

/**
 * Exibe a estrutura de uma variável de forma legível para debug.
 * @param mixed $var            Variável a ser debugada/exibida.
 * @param bool $exit            Indica se a função deve parar a execução da aplicação ou não
 * @return void 
 */
function debug_print(mixed $var, bool $exit = false): void {
    print "<pre>";
    print_r($var);
    print "</pre>";
    if ($exit) exit();
}

/**
 * Renderiza um componente na tela.
 * @param string $component_name            Nome do componente a ser renderizado
 * @param array $vars                       Variáveis a serem passadas para o componente
 * @return void 
 */
function render_component(string $component_name, array $vars = []): void {
    $component_file = COMPONENTS_DIR . '/' . $component_name . '.php';
    if (!file_exists($component_file)) {
        exit("Componente <strong>$component_name</strong> inválido!");
    }
    extract($vars);
    require COMPONENTS_DIR . '/' . $component_name . '.php';
}

/**
 * Retorna o título da página atual.
 * @param string $title 
 * @param bool $is_home_page 
 * @return string 
 */
function get_page_title(string $title = '', bool $is_home_page = false): string {
    if ($is_home_page) {
        return SITE_NAME . ' - ' . SITE_SLOGAN;
    }
    
    return $title . ' - ' . SITE_NAME;
}

/**
 * Retorna a URL de uma página dentro da aplicação
 * @param string $page_name             Nome da página
 * @param bool $is_restricted_area      Indica se a página está na área restrita ou não
 * @return string 
 */
function get_page_url(string $page_name, bool $is_restricted_area = false): string {
    if ($is_restricted_area) {
        return SITE_URL . '/area-restrita' . $page_name;
    }

    return SITE_URL . $page_name;
}

/**
 * Retorna a URL de uma imagem.
 * @param string $image_name        Nome da imagem
 * @return string 
 */
function get_image_url(string $image_name): string {
    return IMG_URL . '/' . $image_name;
}

/**
 * Recebe um texto e o diminui levando em consideração a quantidade de palavras informada
 * @param string $str               Texto original a ser "truncado"
 * @param int $words_qty            Quantidade de palavras a ser considerada
 * @return string 
 */
function shorten_string(string $str, int $words_qty = 1): string {
    if (empty($str)) {
        return $str;
    }

    $words = explode(" ", $str);
    if (count($words) <= $words_qty) {
        return $str;
    }

    $truncated_str = join(" ", array_slice($words, 0, $words_qty)) . "...";
    return $truncated_str;
}

function validate_update(
    array $file_info, 
    int $max_weight = 5, // MB
    int $image_min_width = 100, 
    int $image_min_height = 100, 
    array $mime_types = [], 
    array $extensions = []
): bool {
    
    $check_uploaded_file = function($file_name, $file_tmp_name, $file_type) use ($max_weight, $image_min_height, $image_min_width, $mime_types, $extensions)
    {
        $image_extensions = array("jpg", "jpeg", "png", "gif", "webp", "svg");
        $image_mime_types = array("image/jpg", "image/jpeg", "image/gif", "image/webp", "image/svg+xml");
        $extension = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

        // Por padrão valida o upload de arquivos como imagens apenas,
        // se os mime_types forem especificados na função, usa os tipos definidos
        $types = $image_mime_types;
        if ($mime_types) {
            $types = $mime_types;
        }

        $extensions_check = $image_extensions;
        if ($extensions) {
            $extensions_check = $extensions;
        }

        if (!in_array($file_type, $types)) {
            if (!in_array($extension, $extensions_check)) {
                throw new Exception("Extensão/Tipo do arquivo é inválido!");
            }
        }

        // Verifica se o tamanho do arquivo está dentro do peso permitido
        $weight = filesize($file_tmp_name);
        if ($weight / (1024 * 1024) > $max_weight) {
            throw new Exception("O arquivo enviado deve ter no máximo {$max_weight} MB.");
        }

        $is_image = in_array($file_type, $image_mime_types) || in_array($extension, $image_extensions);
        if ($is_image) {
            // [0] = largura da imagem / [1] = altura da imagem
            $image_size = getimagesize($file_tmp_name);
            if ($image_min_width and $image_size[0] < $image_min_width) {
                throw new Exception("A imagem deve ter no mínimo {$image_min_width}px de largura!");
            }

            if ($image_min_height and $image_size[1] < $image_min_height) {
                throw new Exception("A imagem deve ter no mínimo {$image_min_height}px de altura!");
            }
        }
    };

    // se "type" é uma string, então está sendo feito o upload de apenas um arquivo
    if (is_string($file_info["type"]) && trim($file_info["type"]) != "") {
        $check_uploaded_file();
    } 
    // se "type" é array, então o usuário está realizando o envio de múltiplos arquivos
    else if (is_array($file_info["type"])) {
        for ($i = 0; $i < count($file_info["name"]); $i++) {
            $file_type = $file_info["type"][$i];
            $file_tmp_name = $file_info["tmp_name"][$i];
            $file_name = $file_info["name"][$i];

            $check_uploaded_file($file_name, $file_tmp_name, $file_type);
        }
    } 
    else {
        throw new Exception("Os dados do(s) arquivo(s) não são válidos!");
    }

    return true;
}

