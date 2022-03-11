create table attributes2attribute_types
(
    attrubutes_attribute_types_id int auto_increment
        primary key,
    attribute_id                  int null,
    attribute_types_id            int null,
    constraint attributes_attribute_types_attrubutes_attribute_types_id_uindex
        unique (attrubutes_attribute_types_id),
    constraint attributes_attribute_types_attribute_types_attribute_types_id_fk
        foreign key (attribute_types_id) references attribute_types (attribute_types_id),
    constraint attributes_attribute_types_attributes_attribute_id_fk
        foreign key (attribute_id) references attributes (attribute_id)
);

INSERT INTO webshop.attributes2attribute_types (attrubutes_attribute_types_id, attribute_id, attribute_types_id) VALUES (4, 1, 34);
INSERT INTO webshop.attributes2attribute_types (attrubutes_attribute_types_id, attribute_id, attribute_types_id) VALUES (5, 1, 35);
INSERT INTO webshop.attributes2attribute_types (attrubutes_attribute_types_id, attribute_id, attribute_types_id) VALUES (6, 1, 36);
INSERT INTO webshop.attributes2attribute_types (attrubutes_attribute_types_id, attribute_id, attribute_types_id) VALUES (7, 1, 37);
INSERT INTO webshop.attributes2attribute_types (attrubutes_attribute_types_id, attribute_id, attribute_types_id) VALUES (8, 1, 38);
INSERT INTO webshop.attributes2attribute_types (attrubutes_attribute_types_id, attribute_id, attribute_types_id) VALUES (9, 1, 39);
INSERT INTO webshop.attributes2attribute_types (attrubutes_attribute_types_id, attribute_id, attribute_types_id) VALUES (10, 1, 40);
INSERT INTO webshop.attributes2attribute_types (attrubutes_attribute_types_id, attribute_id, attribute_types_id) VALUES (11, 1, 41);
INSERT INTO webshop.attributes2attribute_types (attrubutes_attribute_types_id, attribute_id, attribute_types_id) VALUES (12, 1, 42);
INSERT INTO webshop.attributes2attribute_types (attrubutes_attribute_types_id, attribute_id, attribute_types_id) VALUES (13, 1, 43);
INSERT INTO webshop.attributes2attribute_types (attrubutes_attribute_types_id, attribute_id, attribute_types_id) VALUES (14, 1, 44);
INSERT INTO webshop.attributes2attribute_types (attrubutes_attribute_types_id, attribute_id, attribute_types_id) VALUES (15, 1, 45);
INSERT INTO webshop.attributes2attribute_types (attrubutes_attribute_types_id, attribute_id, attribute_types_id) VALUES (16, 1, 46);
INSERT INTO webshop.attributes2attribute_types (attrubutes_attribute_types_id, attribute_id, attribute_types_id) VALUES (17, 2, 1);
INSERT INTO webshop.attributes2attribute_types (attrubutes_attribute_types_id, attribute_id, attribute_types_id) VALUES (18, 2, 2);
INSERT INTO webshop.attributes2attribute_types (attrubutes_attribute_types_id, attribute_id, attribute_types_id) VALUES (19, 2, 3);
INSERT INTO webshop.attributes2attribute_types (attrubutes_attribute_types_id, attribute_id, attribute_types_id) VALUES (20, 2, 4);
INSERT INTO webshop.attributes2attribute_types (attrubutes_attribute_types_id, attribute_id, attribute_types_id) VALUES (21, 2, 5);
INSERT INTO webshop.attributes2attribute_types (attrubutes_attribute_types_id, attribute_id, attribute_types_id) VALUES (22, 2, 6);
INSERT INTO webshop.attributes2attribute_types (attrubutes_attribute_types_id, attribute_id, attribute_types_id) VALUES (23, 2, 7);
INSERT INTO webshop.attributes2attribute_types (attrubutes_attribute_types_id, attribute_id, attribute_types_id) VALUES (24, 2, 8);
INSERT INTO webshop.attributes2attribute_types (attrubutes_attribute_types_id, attribute_id, attribute_types_id) VALUES (25, 3, 13);
INSERT INTO webshop.attributes2attribute_types (attrubutes_attribute_types_id, attribute_id, attribute_types_id) VALUES (26, 3, 14);
INSERT INTO webshop.attributes2attribute_types (attrubutes_attribute_types_id, attribute_id, attribute_types_id) VALUES (27, 3, 15);
INSERT INTO webshop.attributes2attribute_types (attrubutes_attribute_types_id, attribute_id, attribute_types_id) VALUES (28, 4, 11);
INSERT INTO webshop.attributes2attribute_types (attrubutes_attribute_types_id, attribute_id, attribute_types_id) VALUES (29, 4, 12);
INSERT INTO webshop.attributes2attribute_types (attrubutes_attribute_types_id, attribute_id, attribute_types_id) VALUES (30, 5, 16);
INSERT INTO webshop.attributes2attribute_types (attrubutes_attribute_types_id, attribute_id, attribute_types_id) VALUES (31, 5, 17);
INSERT INTO webshop.attributes2attribute_types (attrubutes_attribute_types_id, attribute_id, attribute_types_id) VALUES (32, 5, 18);
INSERT INTO webshop.attributes2attribute_types (attrubutes_attribute_types_id, attribute_id, attribute_types_id) VALUES (33, 5, 19);
INSERT INTO webshop.attributes2attribute_types (attrubutes_attribute_types_id, attribute_id, attribute_types_id) VALUES (34, 5, 20);
INSERT INTO webshop.attributes2attribute_types (attrubutes_attribute_types_id, attribute_id, attribute_types_id) VALUES (35, 5, 21);
INSERT INTO webshop.attributes2attribute_types (attrubutes_attribute_types_id, attribute_id, attribute_types_id) VALUES (36, 5, 22);
INSERT INTO webshop.attributes2attribute_types (attrubutes_attribute_types_id, attribute_id, attribute_types_id) VALUES (37, 5, 23);
INSERT INTO webshop.attributes2attribute_types (attrubutes_attribute_types_id, attribute_id, attribute_types_id) VALUES (38, 5, 24);
INSERT INTO webshop.attributes2attribute_types (attrubutes_attribute_types_id, attribute_id, attribute_types_id) VALUES (39, 5, 25);
INSERT INTO webshop.attributes2attribute_types (attrubutes_attribute_types_id, attribute_id, attribute_types_id) VALUES (40, 5, 26);
INSERT INTO webshop.attributes2attribute_types (attrubutes_attribute_types_id, attribute_id, attribute_types_id) VALUES (41, 5, 27);
INSERT INTO webshop.attributes2attribute_types (attrubutes_attribute_types_id, attribute_id, attribute_types_id) VALUES (42, 6, 9);
INSERT INTO webshop.attributes2attribute_types (attrubutes_attribute_types_id, attribute_id, attribute_types_id) VALUES (43, 6, 10);
INSERT INTO webshop.attributes2attribute_types (attrubutes_attribute_types_id, attribute_id, attribute_types_id) VALUES (44, 7, 47);
INSERT INTO webshop.attributes2attribute_types (attrubutes_attribute_types_id, attribute_id, attribute_types_id) VALUES (45, 7, 48);
INSERT INTO webshop.attributes2attribute_types (attrubutes_attribute_types_id, attribute_id, attribute_types_id) VALUES (46, 7, 49);
INSERT INTO webshop.attributes2attribute_types (attrubutes_attribute_types_id, attribute_id, attribute_types_id) VALUES (47, 7, 50);
INSERT INTO webshop.attributes2attribute_types (attrubutes_attribute_types_id, attribute_id, attribute_types_id) VALUES (48, 8, 28);
INSERT INTO webshop.attributes2attribute_types (attrubutes_attribute_types_id, attribute_id, attribute_types_id) VALUES (49, 8, 29);
INSERT INTO webshop.attributes2attribute_types (attrubutes_attribute_types_id, attribute_id, attribute_types_id) VALUES (50, 8, 30);
INSERT INTO webshop.attributes2attribute_types (attrubutes_attribute_types_id, attribute_id, attribute_types_id) VALUES (51, 9, 51);
INSERT INTO webshop.attributes2attribute_types (attrubutes_attribute_types_id, attribute_id, attribute_types_id) VALUES (52, 9, 52);
INSERT INTO webshop.attributes2attribute_types (attrubutes_attribute_types_id, attribute_id, attribute_types_id) VALUES (53, 9, 53);
INSERT INTO webshop.attributes2attribute_types (attrubutes_attribute_types_id, attribute_id, attribute_types_id) VALUES (54, 9, 54);
INSERT INTO webshop.attributes2attribute_types (attrubutes_attribute_types_id, attribute_id, attribute_types_id) VALUES (55, 10, 55);
INSERT INTO webshop.attributes2attribute_types (attrubutes_attribute_types_id, attribute_id, attribute_types_id) VALUES (56, 10, 56);
INSERT INTO webshop.attributes2attribute_types (attrubutes_attribute_types_id, attribute_id, attribute_types_id) VALUES (57, 10, 57);
INSERT INTO webshop.attributes2attribute_types (attrubutes_attribute_types_id, attribute_id, attribute_types_id) VALUES (58, 10, 58);
INSERT INTO webshop.attributes2attribute_types (attrubutes_attribute_types_id, attribute_id, attribute_types_id) VALUES (59, 11, 59);
INSERT INTO webshop.attributes2attribute_types (attrubutes_attribute_types_id, attribute_id, attribute_types_id) VALUES (60, 11, 60);
INSERT INTO webshop.attributes2attribute_types (attrubutes_attribute_types_id, attribute_id, attribute_types_id) VALUES (61, 11, 61);
