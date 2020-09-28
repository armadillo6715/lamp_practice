-- 購入履歴テーブル
CREATE TABLE histories (
    order_id int(11) NOT NULL AUTO_INCREMENT,
    user_id int(11) NOT NULL,
    created datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `histories`
  ADD PRIMARY KEY (`order_id`);

--   購入明細テーブル
CREATE TABLE details (
    detail_id int(11) NOT NULL AUTO_INCREMENT,
    order_id int(11) NOT NULL,
    item_id int(11) NOT NULL,
    then_price int(11) NOT NULL,
    amount int(11) NOT NULL,
    created datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `details` 
  ADD PRIMARY KEY (`detail_id`);