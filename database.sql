SET PASSWORD FOR 'root'@'localhost' = PASSWORD('nick');

create table users (
id int primary key auto_increment,
username varchar(255) not null unique,
password text not null, 
addDate datetime,
changeDate datetime
); 

INSERT INTO users (username, password, addDate, changeDate) VALUES ('nick', 'nick', now(), now() ); 

select * from users; 

update users set password = sha1(password), changeDate = now() where id = 1;  

INSERT INTO users (username, password, addDate, changeDate) VALUES ('test', sha1('pass'), now(), now() ); 

insert into users (username, password, addDate, changeDate) values ('guest', sha1('guest'), now(), now() ); 