<?php header("X-FRAME-OPTIONS: DENY"); ?>
<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8">
    <title>購入明細</title>
  </head>

  <body>
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
      <?php foreach($histories as $history){ ?>
        <tr>
          <td><?php print(h($history['order_id'])); ?></td>
          <td><?php print(h($history['created'])); ?></td>
          <td><?php print(h($history['total'])); ?>円</td>
          <td>
            <form method="post" action="details.php">
              <input type="submit" value="購入明細表示">
              <input type="hidden" name="order_id" value="<?php print(h($history['order_id'])); ?>">
            </form>
          </td>
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