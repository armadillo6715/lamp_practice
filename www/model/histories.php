<?php
require_once MODEL_PATH. 'functions.php';
require_once MODEL_PATH. 'db.php';

// ユーザ毎の購入履歴
function get_history($db, $user_id){
    $sql = "
      SELECT
        histories.order_id,
        histories.created,
        SUM(items.price * details.amount) AS total
      FROM
        histories
      JOIN
        details
      ON
        histories.order_id = details.order_id
      JOIN
        items
      ON
        details.item_id = items.item_id
      WHERE
        user_id = ?
      GROUP BY
        order_id
      ORDER BY
        created desc
    ";
    return fetch_all_query($db, $sql, array($user_id));
}