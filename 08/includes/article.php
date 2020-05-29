<?php
/**
 * get the article base on the id
 *
 * @param [id] $id
 * @param [database connection] $dbc
 * @param [string] $column
 * @return array
 */
function getArticle($id, $dbc, $column="*") {
    $sql = "select $column from article where id = ?";
    $stmt = mysqli_prepare($dbc, $sql);
    if ($stmt === false) {
        echo mysqli_error($dbc);
        exit();
    } else {
        mysqli_stmt_bind_param($stmt, "i", $id);
        if (mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt);
            return mysqli_fetch_array($result, MYSQLI_ASSOC);
        }
    }
}

/**
 * validate the data aboute the article
 *
 * @param [string] $title
 * @param [string] $content
 * @param [string] $published_at
 * @return array
 */
function validateArticle($title, $content, $published_at) {
    $errors = [];
    if (empty($title)) {
        $errors[] = "please fill the title";
    }
    if (empty($content)) {
        $errors[] = "please fill the content";
    }
    if (isset($published_at)) {
        $published_at = date_create_from_format("Y-m-d H:i:s", $published_at);
        if ($published_at === false) {
            $errors[] = "invalid date and time";
        } else {
            $date_errors = date_get_last_errors();
            if ($date_errors["warnning_count"] > 0) {
                $errors[] = "invalid date and time";
            }
        }
    }
    return $errors;
}
?>