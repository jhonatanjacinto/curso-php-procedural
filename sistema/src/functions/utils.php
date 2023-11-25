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