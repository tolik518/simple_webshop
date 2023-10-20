create table product_attributes
(
    product_attributes_id      int auto_increment
        primary key,
    product_id                 int null,
    attribute_id               int null,
    standart_attribute_type_id int null,
    constraint product_attributes_product_attributes_id_uindex
        unique (product_attributes_id),
    constraint product_attributes_attribute_types_attribute_types_id_fk
        foreign key (standart_attribute_type_id) references attribute_types (attribute_types_id),
    constraint product_attributes_attributes_attribute_id_fk
        foreign key (attribute_id) references attributes (attribute_id),
    constraint product_attributes_product_product_id_fk
        foreign key (product_id) references product (product_id)
);

INSERT INTO webshop.product_attributes (product_attributes_id, product_id, attribute_id, standart_attribute_type_id) VALUES (1, 1, 1, 37);
INSERT INTO webshop.product_attributes (product_attributes_id, product_id, attribute_id, standart_attribute_type_id) VALUES (2, 1, 2, 4);
INSERT INTO webshop.product_attributes (product_attributes_id, product_id, attribute_id, standart_attribute_type_id) VALUES (3, 1, 3, 13);
INSERT INTO webshop.product_attributes (product_attributes_id, product_id, attribute_id, standart_attribute_type_id) VALUES (4, 1, 4, 12);
INSERT INTO webshop.product_attributes (product_attributes_id, product_id, attribute_id, standart_attribute_type_id) VALUES (5, 1, 5, 16);
INSERT INTO webshop.product_attributes (product_attributes_id, product_id, attribute_id, standart_attribute_type_id) VALUES (6, 1, 6, 9);
INSERT INTO webshop.product_attributes (product_attributes_id, product_id, attribute_id, standart_attribute_type_id) VALUES (7, 1, 7, 47);
INSERT INTO webshop.product_attributes (product_attributes_id, product_id, attribute_id, standart_attribute_type_id) VALUES (8, 1, 8, 30);
INSERT INTO webshop.product_attributes (product_attributes_id, product_id, attribute_id, standart_attribute_type_id) VALUES (9, 2, 1, 37);
INSERT INTO webshop.product_attributes (product_attributes_id, product_id, attribute_id, standart_attribute_type_id) VALUES (10, 2, 2, 2);
INSERT INTO webshop.product_attributes (product_attributes_id, product_id, attribute_id, standart_attribute_type_id) VALUES (11, 2, 4, 12);
INSERT INTO webshop.product_attributes (product_attributes_id, product_id, attribute_id, standart_attribute_type_id) VALUES (12, 2, 5, 16);
INSERT INTO webshop.product_attributes (product_attributes_id, product_id, attribute_id, standart_attribute_type_id) VALUES (13, 2, 7, 47);
INSERT INTO webshop.product_attributes (product_attributes_id, product_id, attribute_id, standart_attribute_type_id) VALUES (14, 2, 8, 30);
INSERT INTO webshop.product_attributes (product_attributes_id, product_id, attribute_id, standart_attribute_type_id) VALUES (15, 3, 1, 37);
INSERT INTO webshop.product_attributes (product_attributes_id, product_id, attribute_id, standart_attribute_type_id) VALUES (16, 3, 7, 47);
INSERT INTO webshop.product_attributes (product_attributes_id, product_id, attribute_id, standart_attribute_type_id) VALUES (17, 3, 8, 30);
INSERT INTO webshop.product_attributes (product_attributes_id, product_id, attribute_id, standart_attribute_type_id) VALUES (21, 4, 1, 37);
INSERT INTO webshop.product_attributes (product_attributes_id, product_id, attribute_id, standart_attribute_type_id) VALUES (22, 4, 2, 4);
INSERT INTO webshop.product_attributes (product_attributes_id, product_id, attribute_id, standart_attribute_type_id) VALUES (23, 4, 9, 53);
INSERT INTO webshop.product_attributes (product_attributes_id, product_id, attribute_id, standart_attribute_type_id) VALUES (24, 4, 7, 47);
INSERT INTO webshop.product_attributes (product_attributes_id, product_id, attribute_id, standart_attribute_type_id) VALUES (25, 4, 8, 30);
INSERT INTO webshop.product_attributes (product_attributes_id, product_id, attribute_id, standart_attribute_type_id) VALUES (26, 5, 1, 37);
INSERT INTO webshop.product_attributes (product_attributes_id, product_id, attribute_id, standart_attribute_type_id) VALUES (27, 5, 10, 55);
INSERT INTO webshop.product_attributes (product_attributes_id, product_id, attribute_id, standart_attribute_type_id) VALUES (28, 5, 11, 59);
INSERT INTO webshop.product_attributes (product_attributes_id, product_id, attribute_id, standart_attribute_type_id) VALUES (29, 6, 1, 37);
INSERT INTO webshop.product_attributes (product_attributes_id, product_id, attribute_id, standart_attribute_type_id) VALUES (30, 6, 5, 16);
INSERT INTO webshop.product_attributes (product_attributes_id, product_id, attribute_id, standart_attribute_type_id) VALUES (31, 6, 8, 30);
INSERT INTO webshop.product_attributes (product_attributes_id, product_id, attribute_id, standart_attribute_type_id) VALUES (32, 5, 7, 47);
INSERT INTO webshop.product_attributes (product_attributes_id, product_id, attribute_id, standart_attribute_type_id) VALUES (33, 6, 7, 47);
