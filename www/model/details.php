<?php
// ユーザ毎の購入明細
function get_detail($db, $order_id){
    $sql = "
      SELECT
        items.price,
        details.amount,
        details.created,
        SUM(items.price * details.amount) AS subtotal,
        items.name
      FROM
        details
      JOIN
        items
      ON
        details.item_id = items.item_id
      WHERE
        order_id = ?
      GROUP BY
        items.price, details.amount, details.created, items.name
    ";
    return fetch_all_query($db, $sql, array($order_id));
}