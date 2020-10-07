<?php header("X-FRAME-OPTIONS: DENY"); ?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <?php include VIEW_PATH . 'templates/head.php'; ?>
  
  <title>商品一覧</title>
  <link rel="stylesheet" href="<?php print(h(STYLESHEET_PATH . 'index.css')); ?>">
</head>
<body>
  <?php include VIEW_PATH . 'templates/header_logined.php'; ?>
  

  <div class="container">
    <h1>商品一覧</h1>
    <?php include VIEW_PATH . 'templates/messages.php'; ?>

    <div class="card-deck">
      <div class="row">
      <?php foreach($item_range as $item){ ?>
        <div class="col-6 item">
          <div class="card h-100 text-center">
            <div class="card-header">
              <?php print h($item['name']); ?>
            </div>
            <figure class="card-body">
              <img class="card-img" src="<?php print h(IMAGE_PATH . $item['image']); ?>">
              <figcaption>
                <?php print h(number_format($item['price'])); ?>円
                <?php if($item['stock'] > 0){ ?>
                  <form action="index_add_cart.php" method="post">
                    <input type="submit" value="カートに追加" class="btn btn-primary btn-block">
                    <input type="hidden" name="item_id" value="<?php print h($item['item_id']); ?>">
                    <input type="hidden" name="token" value="<?php print h($token); ?>">
                  </form>
                <?php } else { ?>
                  <p class="text-danger">現在売り切れです。</p>
                <?php } ?>
              </figcaption>
            </figure>
          </div>
        </div>
      <?php } ?>
      </div>
    </div>
  </div>
  <table>
    <tr>
      <th>順位</th>
      <th>商品名</th>
      <th>価格</th>
      <th>売却数</th>
    </tr>
    <?php foreach($ranking as $rank){ ?>
    <tr>
      <td><?php print h($i++); ?>位</td>
      <td><?php print h($rank['name']); ?></td>
      <td><?php print h($rank['price']); ?>円</td>
      <td><?php print h($rank['total_amount']); ?>個</td>
    </tr>
    <?php } ?>
  </table>
  <?php if($now_page>1) { ?>
    <a href="/index.php?page=<?php print h($now_page - 1);?>">前へ</a>
  <?php } ?>
  <?php for($i=1;$i<=$total_page;$i++){ ?>
    <?php if($i == $now_page) { ?>
      <a href="#"><?php print h($i); ?></a>
    <?php }else{ ?>
      <a href="/index.php?page=<?php print h($i); ?>"><?php print h($i); ?></a>
    <?php } ?>
  <?php } ?>
  <?php if($now_page<$total_page) { ?>
    <a href="/index.php?page=<?php print h($now_page + 1);?>">次へ</a>
  <?php } ?>
  <p>
    <?php print h($total_item['total_item']); ?>件中の<?php print h($start_item+1); ?>-
    <?php if ($start_item+MAX_VIEW > $total_item['total_item']) {
      print h($total_item['total_item']);
    }else{
      print h($start_item+MAX_VIEW); 
    }
    ?>件目の商品
  </p>
</body>
</html>