# create database if not exists bank;

# use bank;

create table if not exists accounts
(
    id int unsigned auto_increment
        primary key,
    login varchar(255) not null,
    balance bigint default 0 not null,
    created_at timestamp default now()
) collate=utf8mb4_unicode_ci;

insert into accounts (login, balance) values ('petya', 1000);
insert into accounts (login, balance) values ('vasya', 2000);
insert into accounts (login, balance) values ('mark', 500);


insert into accounts (login, balance) values ('ivan', 750);
insert into accounts (login, balance) values ('alice', 650);
insert into accounts (login, balance) values ('tanya', 850);
insert into accounts (login, balance) values ('jenya', 550);
insert into accounts (login, balance) values ('anton', 2000);
insert into accounts (login, balance) values ('aleks', 2000);

DELETE FROM accounts WHERE login = 'jenya';

UPDATE accounts SET balance = 2500 WHERE login = 'petya';
UPDATE accounts SET balance = 2200 WHERE login = 'anton';
UPDATE accounts SET balance = 3200 WHERE login = 'anton';


UPDATE accounts SET balance = 4000 WHERE login = 'petya';
UPDATE accounts SET balance = 4000 WHERE login = 'anton';
COMMIT;

UPDATE accounts SET balance = 2000 WHERE login = 'anton';
UPDATE accounts SET balance = 2000 WHERE login = 'petya';
COMMIT;