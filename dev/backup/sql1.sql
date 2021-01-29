create type grabability as enum ( 'none', 'small', 'big' );

create type respawn as enum ( 'n/a', 'none', 'change room', 'off-screen' );

create table enemy
(
    enemy_id int not null generated always as identity primary key,
    enemy_name varchar(255) not null unique,
    enemy_name_jp varchar(255),
    enemy_name_jp_romaji varchar(255),
    enemy_name_jp_translation varchar(255),
    enemy_what_it_is text,
    enemy_what_it_does text,
    enemy_what_you_can_do text,
    enemy_grabability grabability not null,
    enemy_respawn respawn not null,
    enemy_sleeps_at_night bool
);

create table enemy_level
(
    enemy_level_id int not null generated always as identity primary key,
    enemy_level_enemy_id int not null references enemy(enemy_id),
    enemy_level_level_id int not null references level(level_id)
);