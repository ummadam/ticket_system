create table chats
(
	id int auto_increment
		primary key,
	ticketId int null,
	sender varchar(250) null,
	rcpt varchar(250) null,
	body varchar(500) null
);