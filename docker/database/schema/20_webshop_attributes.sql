create table attributes
(
    attribute_id int auto_increment
        primary key,
    name         varchar(128) null,
    description  text         null,
    constraint attributes_attribute_id_uindex
        unique (attribute_id)
);

INSERT INTO webshop.attributes (attribute_id, name, description) VALUES (1, 'attributes_quantity', '{attributes_description_quantity}');
INSERT INTO webshop.attributes (attribute_id, name, description) VALUES (2, 'attributes_format', '{attributes_description_format}');
INSERT INTO webshop.attributes (attribute_id, name, description) VALUES (3, 'attributes_fold', '{attributes_description_fold}');
INSERT INTO webshop.attributes (attribute_id, name, description) VALUES (4, 'attributes_orientation', '{attributes_description_orientation}');
INSERT INTO webshop.attributes (attribute_id, name, description) VALUES (5, 'attributes_thinkness', '{attributes_description_thinkness}');
INSERT INTO webshop.attributes (attribute_id, name, description) VALUES (6, 'attributes_rounded', '{attributes_description_rounded}');
INSERT INTO webshop.attributes (attribute_id, name, description) VALUES (7, 'attributes_shipping', '{attributes_description_shipping}');
INSERT INTO webshop.attributes (attribute_id, name, description) VALUES (8, 'attributes_material', '{attributes_description_material}');
INSERT INTO webshop.attributes (attribute_id, name, description) VALUES (9, 'attributes_shape', '{attributes_description_shape}');
INSERT INTO webshop.attributes (attribute_id, name, description) VALUES (10, 'attributes_flagsize', '{attributes_description_flagsize}');
INSERT INTO webshop.attributes (attribute_id, name, description) VALUES (11, 'attributes_fabric', '{attributes_description_fabric}');
