<?php
// ユーザ毎の購入明細
function get_detail($db, $order_id){
    $sql = "
      SELECT
        details.then_price,
        details.amount,
        details.created,
        SUM(details.then_price * details.amount) AS subtotal,
        items.name
      FROM
        details
      JOIN
        items
      ON
        details.item_id = items.item_id
      WHERE
        order_id = :order_id
      GROUP BY
        details.detail_id
    ";
    return fetch_all_query($db, $sql, array('order_id'=>$order_id));
}

function get_detail_total($db, $order_id){
    $sql = "
      SELECT
        histories.order_id,
        histories.created,
        SUM(details.then_price * details.amount) AS total
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
        histories.order_id = :order_id
      GROUP BY
        histories.order_id
      ORDER BY
        created desc
    ";
    return fetch_all_query($db, $sql, array('order_id'=>$order_id));
}