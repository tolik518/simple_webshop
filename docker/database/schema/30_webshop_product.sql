create table product
(
    product_id        int auto_increment
        primary key,
    name              varchar(128) null,
    description       text         null,
    short_description text         null,
    details           text         null,
    constraint product_product_id_uindex
        unique (product_id)
);

INSERT INTO webshop.product (product_id, name, description, short_description, details) VALUES (1, '{product_flyer_lang}', '{product_desc_flyer_lang}', '{product_short_desc_flyer_lang}', '{product_details_flyer_lang}');
INSERT INTO webshop.product (product_id, name, description, short_description, details) VALUES (2, '{product_poster_lang}', '{product_desc_poster_lang}', '{product_short_desc_poster_lang}', '{product_details_poster_lang}');
INSERT INTO webshop.product (product_id, name, description, short_description, details) VALUES (3, '{product_smallbox_lang}', '{product_desc_smallbox_lang}', '{product_short_desc_smallbox_lang}', '{product_details_smallbox_lang}');
INSERT INTO webshop.product (product_id, name, description, short_description, details) VALUES (4, '{product_sticker_lang}', '{product_desc_sticker_lang}', '{product_short_desc_sticker_lang}', '{product_details_sticker_lang}');
INSERT INTO webshop.product (product_id, name, description, short_description, details) VALUES (5, '{product_flag_lang}', '{product_desc_flag_lang}', '{product_short_desc_flag_lang}', '{product_details_flag_lang}');
INSERT INTO webshop.product (product_id, name, description, short_description, details) VALUES (6, '{product_kiosk_flag_lang}', '{product_desc_kiosk_flag_lang}', '{product_short_desc_kiosk_flag_lang}', '{product_details_kiosk_flag_lang}');
