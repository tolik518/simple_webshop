create table users
(
    user_id    int auto_increment
        primary key,
    username   varchar(45)                        not null,
    password   varchar(60)                        not null,
    user_role  int                                not null,
    created_at datetime default CURRENT_TIMESTAMP not null,
    constraint users_user_id_uindex
        unique (user_id)
);

INSERT INTO webshop.users (user_id, username, password, user_role, created_at) VALUES (1, 'mod', '$2a$12$a.FmEGD3ftpU0L4f2mxMSe3XX.poZEFTqT/VbOoTl19.ggaluBmly', 9001, '2022-02-02 09:28:43');
