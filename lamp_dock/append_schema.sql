-- 購入履歴テーブル
CREATE TABLE histories (
    order_id int(11) NOT NULL,
    user_id int(11) NOT NULL,
    total_price int(11) NOT NULL,
    created datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE histories
  MODIFY order_id int(11) NOT NULL AUTO_INCREMENT,
  ADD PRIMARY KEY (order_id),
  ADD KEY user_id (user_id);

--   購入明細テーブル
CREATE TABLE details (
    order_id int(11) NOT NULL,
    item_id int(11) NOT NULL,
    then_price int(11) NOT NULL,
    amount int(11) NOT NULL,
    created datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE details
  ADD KEY item_id (item_id);