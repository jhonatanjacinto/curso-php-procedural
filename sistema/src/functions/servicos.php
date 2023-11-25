<?php 

/*
*  Funções relacionadas ao gerenciamento de serviços dentro da aplicação OdontoVida
*/

/**
 * Retorna a lista completa de serviços cadastrados na aplicação.
 * @return array 
 */
function get_servicos(): array 
{
    $sql = "SELECT * FROM odvx_servicos";
    $servicos = db_query_many($sql);

    return $servicos;
}

/**
 * Retorna os dados de um único serviço pelo ID
 * @param int $id               ID do serviço
 * @return null|array 
 * @throws Exception 
 */
function get_servico_por_id(int $id): ?array
{
    $sql = "SELECT * FROM odvx_servicos WHERE id = ?";
    $param_types = "i";
    $param_values = [$id];

    $servico_encontrado = db_query_one($sql, $param_types, $param_values);
    return $servico_encontrado;
}

/**
 * Cadastra um serviço novo no banco de dados
 * @param string $titulo            Título do serviço
 * @param string $descricao         Descrição do serviço
 * @param string $icone             Ícone do serviço
 * @param bool $ativo               Se o serviço deve ser marcado como ativo ou não
 * @return bool 
 * @throws Exception 
 */
function cadastrar_servico(string $titulo, string $descricao, string $icone, bool $ativo = true): bool
{
    // Validamos os dados enviados
    $titulo = filter_var($titulo, FILTER_DEFAULT) ?: throw new Exception("Título é obrigatório!");
    $descricao = filter_var($descricao, FILTER_DEFAULT) ?: throw new Exception("Descrição é obrigatório!");
    $icone = filter_var($icone, FILTER_DEFAULT) ?: throw new Exception("Ícone do serviço é obrigatório!");

    // Cadastramos as informações no banco
    $sql = "INSERT INTO odvx_servicos (titulo, descricao, icone, ativo) VALUES (?, ?, ?, ?)";
    $param_types = "sssi";
    $param_values = [$titulo, $descricao, $icone, $ativo];
    $is_cadastrado = db_execute_sql($sql, $param_types, $param_values);

    return $is_cadastrado;
}

/**
 * Atualiza os dados do serviço no banco de dados
 * @param string $titulo 
 * @param string $descricao 
 * @param string $icone 
 * @param bool $ativo 
 * @param int $id 
 * @return bool 
 * @throws Exception 
 */
function atualizar_servico(string $titulo, string $descricao, string $icone, bool $ativo, int $id): bool 
{
    // Validamos os dados enviados
    $titulo = filter_var($titulo, FILTER_DEFAULT) ?: throw new Exception("Título é obrigatório!");
    $descricao = filter_var($descricao, FILTER_DEFAULT) ?: throw new Exception("Descrição é obrigatório!");
    $icone = filter_var($icone, FILTER_DEFAULT) ?: throw new Exception("Ícone do serviço é obrigatório!");
    $id = $id > 0 ? $id : throw new Exception("ID inválido!");

    // Atualizamos as informações no banco
    $sql = "UPDATE odvx_servicos SET titulo = ?, descricao = ?, icone = ?, ativo = ? WHERE id = ?";
    $param_types = "sssii";
    $param_values = [$titulo, $descricao, $icone, $ativo, $id];
    $is_atualizado = db_execute_sql($sql, $param_types, $param_values);

    return $is_atualizado;
}

/**
 * Exclui um serviço do banco de dados
 * @param int $id 
 * @return bool 
 * @throws Exception 
 */
function excluir_servico(int $id): bool
{
    if ($id <= 0) {
        throw new Exception("ID inválido para exclusão!");
    }

    $sql = "DELETE FROM odvx_servicos WHERE id = ?";
    $param_types = "i";
    $param_values = [$id];
    $is_excluido = db_execute_sql($sql, $param_types, $param_values);

    return $is_excluido;
}