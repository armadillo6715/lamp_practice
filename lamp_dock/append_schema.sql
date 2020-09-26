-- 購入履歴テーブル
create table historys (
    order_id int(11) AUTO_INCREMENT not null,
    user_id int(11) not null,
    item_id int(11) not null,
    amount int(11) not null,
    total_price int(11) not null,
    create_datetime datetime not null,
    primary key(order_id)
);

-- 購入詳細テーブル
create table details (
    order_id int(11) AUTO_INCREMENT not null,
    user_id int(11) not null,
    item_id int(11) not null,
    then_price int(11) not null,
    amount int(11) not null,
    total_price int(11) not null,
    create_datetime datetime not null,
    primary key(order_id)
);