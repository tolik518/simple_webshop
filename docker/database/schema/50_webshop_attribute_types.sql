create table attribute_types
(
    attribute_types_id int auto_increment
        primary key,
    name               varchar(128) null,
    value              varchar(64)  null,
    price              double       null,
    constraint attribute_types_attribute_types_id_uindex
        unique (attribute_types_id)
);

INSERT INTO webshop.attribute_types (attribute_types_id, name, value, price) VALUES (1, 'attributes_format', 'attributes_format_A2', 0.0271);
INSERT INTO webshop.attribute_types (attribute_types_id, name, value, price) VALUES (2, 'attributes_format', 'attributes_format_A3', 0.0181);
INSERT INTO webshop.attribute_types (attribute_types_id, name, value, price) VALUES (3, 'attributes_format', 'attributes_format_A4', 0.011);
INSERT INTO webshop.attribute_types (attribute_types_id, name, value, price) VALUES (4, 'attributes_format', 'attributes_format_A5', 0.0081);
INSERT INTO webshop.attribute_types (attribute_types_id, name, value, price) VALUES (5, 'attributes_format', 'attributes_format_A6', 0.0071);
INSERT INTO webshop.attribute_types (attribute_types_id, name, value, price) VALUES (6, 'attributes_format', 'attributes_format_A7', 0.0061);
INSERT INTO webshop.attribute_types (attribute_types_id, name, value, price) VALUES (7, 'attributes_format', 'attributes_format_A8', 0.0055);
INSERT INTO webshop.attribute_types (attribute_types_id, name, value, price) VALUES (8, 'attributes_format', 'attributes_format_DINLang', 0.0081);
INSERT INTO webshop.attribute_types (attribute_types_id, name, value, price) VALUES (9, 'attributes_rounded', 'attributes_rounded_no', 0);
INSERT INTO webshop.attribute_types (attribute_types_id, name, value, price) VALUES (10, 'attributes_rounded', 'attributes_rounded_yes', 0.005);
INSERT INTO webshop.attribute_types (attribute_types_id, name, value, price) VALUES (11, 'attributes_orientation', 'attributes_orientation_horizontal', 0);
INSERT INTO webshop.attribute_types (attribute_types_id, name, value, price) VALUES (12, 'attributes_orientation', 'attributes_orientation_vertical', 0);
INSERT INTO webshop.attribute_types (attribute_types_id, name, value, price) VALUES (13, 'attributes_fold', 'attributes_fold_0', 0.0001);
INSERT INTO webshop.attribute_types (attribute_types_id, name, value, price) VALUES (14, 'attributes_fold', 'attributes_fold_1', 0.00557);
INSERT INTO webshop.attribute_types (attribute_types_id, name, value, price) VALUES (15, 'attributes_fold', 'attributes_fold_2', 0.00656);
INSERT INTO webshop.attribute_types (attribute_types_id, name, value, price) VALUES (16, 'attributes_thinkness', 'attributes_thinkness_70', 0.0002);
INSERT INTO webshop.attribute_types (attribute_types_id, name, value, price) VALUES (17, 'attributes_thinkness', 'attributes_thinkness_90', 0.0005);
INSERT INTO webshop.attribute_types (attribute_types_id, name, value, price) VALUES (18, 'attributes_thinkness', 'attributes_thinkness_100', 0.0011);
INSERT INTO webshop.attribute_types (attribute_types_id, name, value, price) VALUES (19, 'attributes_thinkness', 'attributes_thinkness_115', 0.0023);
INSERT INTO webshop.attribute_types (attribute_types_id, name, value, price) VALUES (20, 'attributes_thinkness', 'attributes_thinkness_120', 0.0034);
INSERT INTO webshop.attribute_types (attribute_types_id, name, value, price) VALUES (21, 'attributes_thinkness', 'attributes_thinkness_135', 0.0045);
INSERT INTO webshop.attribute_types (attribute_types_id, name, value, price) VALUES (22, 'attributes_thinkness', 'attributes_thinkness_170', 0.0056);
INSERT INTO webshop.attribute_types (attribute_types_id, name, value, price) VALUES (23, 'attributes_thinkness', 'attributes_thinkness_190', 0.0067);
INSERT INTO webshop.attribute_types (attribute_types_id, name, value, price) VALUES (24, 'attributes_thinkness', 'attributes_thinkness_250', 0.007);
INSERT INTO webshop.attribute_types (attribute_types_id, name, value, price) VALUES (25, 'attributes_thinkness', 'attributes_thinkness_300', 0.008);
INSERT INTO webshop.attribute_types (attribute_types_id, name, value, price) VALUES (26, 'attributes_thinkness', 'attributes_thinkness_350', 0.009);
INSERT INTO webshop.attribute_types (attribute_types_id, name, value, price) VALUES (27, 'attributes_thinkness', 'attributes_thinkness_400', 0.01);
INSERT INTO webshop.attribute_types (attribute_types_id, name, value, price) VALUES (28, 'attributes_material', 'attributes_material_gloss', 0.0069);
INSERT INTO webshop.attribute_types (attribute_types_id, name, value, price) VALUES (29, 'attributes_material', 'attributes_material_frosted', 0.0023);
INSERT INTO webshop.attribute_types (attribute_types_id, name, value, price) VALUES (30, 'attributes_material', 'attributes_material_recycled', 0.0011);
INSERT INTO webshop.attribute_types (attribute_types_id, name, value, price) VALUES (31, 'attributes_quantity', 'attributes_quantity_10', 33);
INSERT INTO webshop.attribute_types (attribute_types_id, name, value, price) VALUES (32, 'attributes_quantity', 'attributes_quantity_20', 33);
INSERT INTO webshop.attribute_types (attribute_types_id, name, value, price) VALUES (33, 'attributes_quantity', 'attributes_quantity_50', 33);
INSERT INTO webshop.attribute_types (attribute_types_id, name, value, price) VALUES (34, 'attributes_quantity', 'attributes_quantity_100', 33);
INSERT INTO webshop.attribute_types (attribute_types_id, name, value, price) VALUES (35, 'attributes_quantity', 'attributes_quantity_200', 33);
INSERT INTO webshop.attribute_types (attribute_types_id, name, value, price) VALUES (36, 'attributes_quantity', 'attributes_quantity_500', 32);
INSERT INTO webshop.attribute_types (attribute_types_id, name, value, price) VALUES (37, 'attributes_quantity', 'attributes_quantity_1000', 30);
INSERT INTO webshop.attribute_types (attribute_types_id, name, value, price) VALUES (38, 'attributes_quantity', 'attributes_quantity_2000', 27);
INSERT INTO webshop.attribute_types (attribute_types_id, name, value, price) VALUES (39, 'attributes_quantity', 'attributes_quantity_5000', 22);
INSERT INTO webshop.attribute_types (attribute_types_id, name, value, price) VALUES (40, 'attributes_quantity', 'attributes_quantity_10000', 17);
INSERT INTO webshop.attribute_types (attribute_types_id, name, value, price) VALUES (41, 'attributes_quantity', 'attributes_quantity_20000', 12);
INSERT INTO webshop.attribute_types (attribute_types_id, name, value, price) VALUES (42, 'attributes_quantity', 'attributes_quantity_50000', 5);
INSERT INTO webshop.attribute_types (attribute_types_id, name, value, price) VALUES (43, 'attributes_quantity', 'attributes_quantity_100000', 0);
INSERT INTO webshop.attribute_types (attribute_types_id, name, value, price) VALUES (44, 'attributes_quantity', 'attributes_quantity_200000', -200);
INSERT INTO webshop.attribute_types (attribute_types_id, name, value, price) VALUES (45, 'attributes_quantity', 'attributes_quantity_500000', -600);
INSERT INTO webshop.attribute_types (attribute_types_id, name, value, price) VALUES (46, 'attributes_quantity', 'attributes_quantity_1000000', -2000);
INSERT INTO webshop.attribute_types (attribute_types_id, name, value, price) VALUES (47, 'attributes_shipping', 'attributes_shipping_standart', 5.99);
INSERT INTO webshop.attribute_types (attribute_types_id, name, value, price) VALUES (48, 'attributes_shipping', 'attributes_shipping_premium', 9.99);
INSERT INTO webshop.attribute_types (attribute_types_id, name, value, price) VALUES (49, 'attributes_shipping', 'attributes_shipping_express', 18.99);
INSERT INTO webshop.attribute_types (attribute_types_id, name, value, price) VALUES (50, 'attributes_shipping', 'attributes_shipping_overnight', 49.98);
INSERT INTO webshop.attribute_types (attribute_types_id, name, value, price) VALUES (51, 'attributes_shape', 'attributes_shape_round', 0.0008);
INSERT INTO webshop.attribute_types (attribute_types_id, name, value, price) VALUES (52, 'attributes_shape', 'attributes_shape_oval', 0.00089);
INSERT INTO webshop.attribute_types (attribute_types_id, name, value, price) VALUES (53, 'attributes_shape', 'attributes_shape_standard', 0);
INSERT INTO webshop.attribute_types (attribute_types_id, name, value, price) VALUES (54, 'attributes_shape', 'attributes_shape_custom', 0.005);
INSERT INTO webshop.attribute_types (attribute_types_id, name, value, price) VALUES (55, 'attributes_flagsize', 'attributes_flagsize_1,2x3m', 1.06);
INSERT INTO webshop.attribute_types (attribute_types_id, name, value, price) VALUES (56, 'attributes_flagsize', 'attributes_flagsize_1,2x4m', 1.507);
INSERT INTO webshop.attribute_types (attribute_types_id, name, value, price) VALUES (57, 'attributes_flagsize', 'attributes_flagsize_1,5x3,5m', 1.508);
INSERT INTO webshop.attribute_types (attribute_types_id, name, value, price) VALUES (58, 'attributes_flagsize', 'attributes_flagsize_1,5x4m', 2.0041);
INSERT INTO webshop.attribute_types (attribute_types_id, name, value, price) VALUES (59, 'attributes_fabric', '110gflagfabric', 1.112);
INSERT INTO webshop.attribute_types (attribute_types_id, name, value, price) VALUES (60, 'attributes_fabric', '120gperforatedmaterial', 1.421);
INSERT INTO webshop.attribute_types (attribute_types_id, name, value, price) VALUES (61, 'attributes_fabric', '150gsilk', 3.125);
