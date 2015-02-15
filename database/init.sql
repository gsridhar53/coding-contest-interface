create database coding ;

use coding ;

create table users
(
name varchar(20),
actual_name varchar(20),
pass varchar(20),
sem varchar(20),
phone varchar(20),
email varchar(40),
primary key (name)
) ;

create table leaderboard
(
id int(11) AUTO_INCREMENT,
team varchar(20),
problem_1 int(11) default NULL,
total_time int(11) default NULL,
total_stars int(11) default NULL,
foreign key (team) references users(name),
primary key (id)
) ;

create table questions
(
num int(11),
star int(11) default NULL,
name varchar(100) default NULL,
descrip varchar(10000) default NULL,
inputs varchar(10000) default NULL,
output varchar(10000) default NULL,
const varchar(10000) default NULL,
examp varchar(10000) default NULL,
primary key (num)
) ;

