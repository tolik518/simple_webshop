create table orders
(
    order_id    int auto_increment
        primary key,
    customer_id int                                null,
    ordered_at  datetime default CURRENT_TIMESTAMP null,
    price       double                             null,
    constraint orders_order_id_uindex
        unique (order_id),
    constraint orders_customers_customer_id_fk
        foreign key (customer_id) references customers (customer_id)
);

INSERT INTO webshop.orders (order_id, customer_id, ordered_at, price) VALUES (32, 37, '2022-02-01 09:41:23', 53609.98);
INSERT INTO webshop.orders (order_id, customer_id, ordered_at, price) VALUES (33, 38, '2022-02-01 10:24:39', 41707.8);
INSERT INTO webshop.orders (order_id, customer_id, ordered_at, price) VALUES (34, 39, '2022-02-01 11:05:28', 191.86);
INSERT INTO webshop.orders (order_id, customer_id, ordered_at, price) VALUES (35, 40, '2022-02-01 11:21:42', 106.49);
INSERT INTO webshop.orders (order_id, customer_id, ordered_at, price) VALUES (36, 41, '2022-02-01 13:08:54', 18317.97);
INSERT INTO webshop.orders (order_id, customer_id, ordered_at, price) VALUES (37, 42, '2022-02-01 13:31:28', 86.38);
INSERT INTO webshop.orders (order_id, customer_id, ordered_at, price) VALUES (38, 43, '2022-02-01 13:46:32', 1495.99);
INSERT INTO webshop.orders (order_id, customer_id, ordered_at, price) VALUES (39, 44, '2022-02-01 14:40:12', 88629.97);
INSERT INTO webshop.orders (order_id, customer_id, ordered_at, price) VALUES (40, 45, '2022-02-02 07:50:37', 149365.7);
INSERT INTO webshop.orders (order_id, customer_id, ordered_at, price) VALUES (41, 46, '2022-02-02 08:01:49', 45.49);
INSERT INTO webshop.orders (order_id, customer_id, ordered_at, price) VALUES (42, 47, '2022-02-02 08:05:04', 146.49);
INSERT INTO webshop.orders (order_id, customer_id, ordered_at, price) VALUES (43, 48, '2022-02-02 10:39:58', 137.97);
INSERT INTO webshop.orders (order_id, customer_id, ordered_at, price) VALUES (44, 49, '2022-02-02 11:40:56', 304.44);
INSERT INTO webshop.orders (order_id, customer_id, ordered_at, price) VALUES (45, 50, '2022-02-02 13:23:32', 2500.99);
INSERT INTO webshop.orders (order_id, customer_id, ordered_at, price) VALUES (46, 51, '2022-02-02 14:43:40', 87.98);
INSERT INTO webshop.orders (order_id, customer_id, ordered_at, price) VALUES (47, 52, '2022-02-02 14:55:00', 176.37);
INSERT INTO webshop.orders (order_id, customer_id, ordered_at, price) VALUES (48, 53, '2022-02-02 16:28:15', 115.99);
INSERT INTO webshop.orders (order_id, customer_id, ordered_at, price) VALUES (49, 54, '2022-02-02 23:26:37', 366.55);
INSERT INTO webshop.orders (order_id, customer_id, ordered_at, price) VALUES (50, 55, '2022-02-03 07:46:01', 100.88);
INSERT INTO webshop.orders (order_id, customer_id, ordered_at, price) VALUES (51, 56, '2022-02-03 08:51:34', 90.98);
INSERT INTO webshop.orders (order_id, customer_id, ordered_at, price) VALUES (52, 57, '2022-02-03 11:46:53', 2391.99);
INSERT INTO webshop.orders (order_id, customer_id, ordered_at, price) VALUES (53, 58, '2022-02-03 13:54:53', 45.49);
INSERT INTO webshop.orders (order_id, customer_id, ordered_at, price) VALUES (54, 59, '2022-02-03 15:54:46', 7505.99);
INSERT INTO webshop.orders (order_id, customer_id, ordered_at, price) VALUES (55, 60, '2022-02-04 08:55:45', 26765.98);
INSERT INTO webshop.orders (order_id, customer_id, ordered_at, price) VALUES (56, 61, '2022-02-04 11:31:31', 4726.98);
INSERT INTO webshop.orders (order_id, customer_id, ordered_at, price) VALUES (57, 62, '2022-02-04 13:08:43', 9105.99);
INSERT INTO webshop.orders (order_id, customer_id, ordered_at, price) VALUES (58, 63, '2022-02-04 14:24:19', 34118.99);
INSERT INTO webshop.orders (order_id, customer_id, ordered_at, price) VALUES (59, 64, '2022-02-05 08:20:05', 45.49);
INSERT INTO webshop.orders (order_id, customer_id, ordered_at, price) VALUES (60, 65, '2022-02-05 11:22:19', 9105.99);
INSERT INTO webshop.orders (order_id, customer_id, ordered_at, price) VALUES (61, 66, '2022-02-06 08:42:01', 27205.99);
INSERT INTO webshop.orders (order_id, customer_id, ordered_at, price) VALUES (62, 67, '2022-02-07 09:56:52', 12285.99);
INSERT INTO webshop.orders (order_id, customer_id, ordered_at, price) VALUES (63, 68, '2022-02-07 13:58:06', 6655.99);
INSERT INTO webshop.orders (order_id, customer_id, ordered_at, price) VALUES (64, 69, '2022-02-08 08:20:22', 3465.99);
INSERT INTO webshop.orders (order_id, customer_id, ordered_at, price) VALUES (65, 70, '2022-02-08 09:03:12', 2489.98);
INSERT INTO webshop.orders (order_id, customer_id, ordered_at, price) VALUES (66, 71, '2022-02-08 11:15:54', 2202);
INSERT INTO webshop.orders (order_id, customer_id, ordered_at, price) VALUES (67, 72, '2022-02-08 13:21:49', 1695.99);
INSERT INTO webshop.orders (order_id, customer_id, ordered_at, price) VALUES (68, 73, '2022-02-08 14:27:50', 10309.99);
INSERT INTO webshop.orders (order_id, customer_id, ordered_at, price) VALUES (69, 74, '2022-02-08 17:56:26', 109.98);
INSERT INTO webshop.orders (order_id, customer_id, ordered_at, price) VALUES (70, 75, '2022-02-09 07:43:19', 2211.66);
INSERT INTO webshop.orders (order_id, customer_id, ordered_at, price) VALUES (71, 76, '2022-02-09 08:48:11', 45.49);
INSERT INTO webshop.orders (order_id, customer_id, ordered_at, price) VALUES (72, 77, '2022-02-09 10:14:38', 12549.98);
INSERT INTO webshop.orders (order_id, customer_id, ordered_at, price) VALUES (73, 78, '2022-02-09 11:15:41', 3009.99);
INSERT INTO webshop.orders (order_id, customer_id, ordered_at, price) VALUES (74, 79, '2022-02-09 15:18:04', 45.49);
INSERT INTO webshop.orders (order_id, customer_id, ordered_at, price) VALUES (75, 80, '2022-02-10 07:10:37', 2409.99);
INSERT INTO webshop.orders (order_id, customer_id, ordered_at, price) VALUES (76, 81, '2022-02-11 09:01:00', 13490.99);
INSERT INTO webshop.orders (order_id, customer_id, ordered_at, price) VALUES (77, 82, '2022-02-11 12:24:00', 37.29);
INSERT INTO webshop.orders (order_id, customer_id, ordered_at, price) VALUES (78, 83, '2022-02-12 08:02:38', 7551.48);
INSERT INTO webshop.orders (order_id, customer_id, ordered_at, price) VALUES (79, 84, '2022-02-12 09:58:52', 51141.96);
INSERT INTO webshop.orders (order_id, customer_id, ordered_at, price) VALUES (80, 85, '2022-02-12 13:00:09', 23923.94);
INSERT INTO webshop.orders (order_id, customer_id, ordered_at, price) VALUES (81, 86, '2022-02-13 08:00:57', 5490.99);
INSERT INTO webshop.orders (order_id, customer_id, ordered_at, price) VALUES (82, 87, '2022-02-13 09:05:37', 17745.97);
INSERT INTO webshop.orders (order_id, customer_id, ordered_at, price) VALUES (83, 88, '2022-02-13 11:06:42', 34755.98);
INSERT INTO webshop.orders (order_id, customer_id, ordered_at, price) VALUES (84, 89, '2022-02-13 14:07:32', 7672.17);
INSERT INTO webshop.orders (order_id, customer_id, ordered_at, price) VALUES (85, 90, '2022-03-04 13:19:42', 3655.99);
