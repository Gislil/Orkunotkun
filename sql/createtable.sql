create table if not exists `login`.`orku_users` (
    `user_id` int(11) not null auto_increment,
    `user_email` varchar(64) collate utf8_unicode_ci not null,
    `user_password_hash` char(255) not null,
    primary key (`user_id`),
    unique key `user_email` (`user_email`)
) engine=InnoDb default charset=utf8 collate=utf8_unicode_ci comment='the user data';