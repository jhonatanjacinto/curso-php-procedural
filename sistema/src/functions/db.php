<?php 

/**
 * Retorna uma conexão com o banco de dados MySQL
 * @return mysqli 
 */
function get_db_connection() : mysqli 
{
    $connection = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    if (mysqli_connect_errno()) {
        exit("Erro ao conectar ao banco de dados!");
        error_log(mysqli_connect_error());
    }

    return $connection;
}

/**
 * Executa uma query no banco de dados que retorna nenhum ou muitos resultados.
 * @param string $sql               Query SQL
 * @param string $param_types       Tipos dos parâmetros da query
 * @param array $params             Parâmetros da query
 * @return array 
 */
function db_query_many(string $sql, string $param_types = "", array $params = []) : array
{
    $rows = [];
    $stmt = null;
    $connection = get_db_connection();

    $stmt = mysqli_prepare($connection, $sql);
    if (!$stmt) {
        goto end_result;
    }

    if ($param_types && $params) {
        mysqli_stmt_bind_param($stmt, $param_types, ...$params);
    }

    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    // Retorna os dados do banco de dados num array associativo onde cada chave do array
    // corresponde ao nome da coluna do dado no banco 
    $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);

    end_result:
    if ($stmt) mysqli_stmt_close($stmt);
    mysqli_close($connection);

    return $rows;
}

/**
 * Executa uma query no banco e retorna nenhum ou um único resultado
 * @param string $sql               Query SQL
 * @param string $param_types       Tipos dos parâmetros da Query
 * @param array $params             Parâmetros da Query
 * @return array|null  
 */
function db_query_one(string $sql, string $param_types = "", array $params = []) : ?array 
{
    $rows = db_query_many($sql, $param_types, $params);

    if (empty($rows)) {
        return null;
    }

    return $rows[0];
}

/**
 * Executa instruções SQL que não retornam resultados como INSERT, UDPATE e DELETE
 * @param string $sql                   Query SQL
 * @param string $param_types           Tipos dos parâmetros usados
 * @param array $params                 Parâmetros da query
 * @param bool $return_id               Indica se a função deve retornar o ID gerado pelo INSERT ou não
 * @return bool|int 
 */
function db_execute_sql(string $sql, string $param_types = "", array $params = [], bool $return_id = false) : bool|int 
{
    $result = false;
    $stmt = null;
    $connection = get_db_connection();

    $stmt = mysqli_prepare($connection, $sql);
    if (!$stmt) {
        goto end_result;
    }

    if ($param_types && $params) {
        mysqli_stmt_bind_param($stmt, $param_types, ...$params);
    }

    $result = mysqli_stmt_execute($stmt);
    if ($return_id) {
        $result = mysqli_stmt_insert_id($stmt);
    }

    end_result:
    if ($stmt) mysqli_stmt_close($stmt);
    mysqli_close($connection);
    return $result;
}