-- create database if not exists prepare;

-- use prepare;

CREATE TABLE IF NOT EXISTS accounts
(
    id serial PRIMARY KEY,
    login VARCHAR (50) NOT NULL,
    balance BIGINT DEFAULT 0 NOT NULL,
    created_at TIMESTAMP DEFAULT now()
);

INSERT INTO accounts (login, balance) VALUES ('petya', 1000);
INSERT INTO accounts (login, balance) VALUES ('vasya', 2000);
INSERT INTO accounts (login, balance) VALUES ('mark', 500);
