-- Create the database
drop database if exists auth_db;
create database auth_db;
use auth_db;

-- Create the users table
create table users (
    id int auto_increment primary key,
    username varchar(50) not null unique,
    email varchar(100) not null unique,
    password varchar(255) not null,
    created_at timestamp default current_timestamp
);
