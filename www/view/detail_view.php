<?php header("X-FRAME-OPTIONS: DENY"); ?>
<!DOCTYPE html>
<html lang="ja">
  <head>
  <?php include VIEW_PATH . 'templates/head.php'; ?>
  <link rel="stylesheet" href="<?php print(h(STYLESHEET_PATH . 'index.css')); ?>">
    <meta charset="UTF-8">
    <title>購入明細</title>
  </head>

  <body>
    <?php include VIEW_PATH . 'templates/header_logined.php'; ?>  
    <h1>購入明細</h1>

    <!-- メッセージ・エラーメッセージ -->
    <?php include VIEW_PATH. 'templates/messages.php'; ?>

    <!-- 購入明細 -->
    <table>
      <thead>
        <tr>
          <th>注文番号</th>
          <th>購入日時</th>
          <th>合計金額</th>
        </tr>
      </thead>
      <tbody>
      <?php foreach($detail_total as $detail_totals){ ?>
        <tr>
          <td><?php print(h($detail_totals['order_id'])); ?></td>
          <td><?php print(h($detail_totals['created'])); ?></td>
          <td><?php print(h($detail_totals['total'])); ?>円</td>
        </tr>
      <?php } ?>
      </tbody>
    </table>

    <!-- 購入明細 -->
    <table>
      <thead>
        <tr>
          <th>商品名</th>
          <th>価格</th>
          <th>購入数</th>
          <th>小計</th>
        </tr>
      </thead>
      <tbody>
      <?php foreach($details as $detail){ ?>
        <tr>
          <td><?php print(h($detail['name'])); ?></td>
          <td><?php print(h($detail['price'])); ?>円</td>
          <td><?php print(h($detail['amount'])); ?>個</td>
          <td><?php print(h($detail['subtotal'])); ?>円</td>
        </tr>
      <?php } ?>
      </tbody>
    </table>
  </body>
</html>