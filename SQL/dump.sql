INSERT INTO `categories` (`id`, `name`, `category_id`, `created_at`, `updated_at`) VALUES
(1, 'Pizza', null,  '2020-03-18 09:39:04', '2020-03-18 09:40:02'),
(2, 'Pasta', null, '2020-03-18 09:40:14', '2020-03-18 09:40:14'),
(3, 'Desert', null, '2020-03-18 09:40:22', '2020-03-18 09:40:22'),
(4, 'Dranken', null, '2020-03-18 09:40:39', '2020-03-18 09:40:39'),
(5, 'Antipasti', null, '2020-03-18 09:41:52', '2020-03-18 09:41:52'),
(6, 'Overig', null, '2020-03-18 09:42:51', '2020-03-18 09:42:51'),
(7, 'Kwaliteits wijnen', 4, '2020-03-18 09:43:04', '2020-03-18 09:43:04'),
(8, 'Italiaanse wijnen', 4, '2020-03-18 09:43:24', '2020-03-18 09:43:24'),
(9, 'Aperatieven/ likeuren', 4, '2020-03-18 09:44:19', '2020-03-18 09:44:19'),
(10, 'Bieren', 4, '2020-03-18 09:44:36', '2020-03-18 09:44:36'),
(11, 'Overige dranken', 4, '2020-03-18 09:46:07', '2020-03-18 09:46:07'),
(12, 'Pane e olive (Brood en olijven)', 5, '2020-03-18 09:46:32', '2020-03-18 09:46:32'),
(13, 'Zuppe', 5, '2020-03-18 09:46:48', '2020-03-18 09:46:48'),
(14, 'Fredi (Koude voorgerechten)', 5, '2020-03-18 09:47:05', '2020-03-18 09:47:05'),
(15, 'Caldi (Warme voorgerechten)', 5, '2020-03-18 09:47:25', '2020-03-18 09:47:25'),
(16, 'Insalata', 5, '2020-03-18 09:47:43', '2020-03-18 09:47:43'),
(17, 'Bijgerechten', 5, '2020-03-18 09:48:11', '2020-03-18 09:48:11');


INSERT INTO `products` (`id`, `name`, `description`, `image_url`, `price`, `category_id`, `created_at`, `updated_at`) VALUES
(1, 'Prosciutto', 'Tomaten, kaas en ham', 'https://competa-api.dev.competa.com/images/pizza/prosciutto.png', '4.50', 1, '2020-03-18 10:07:07', '2020-03-18 10:07:07'),
(2, 'Salame', 'Tomaten, kaas en salami', 'https://competa-api.dev.competa.com/images/pizza/salami.png', '5.00', 1, '2020-03-18 10:09:19', '2020-03-18 10:09:19'),
(3, 'Funghi', 'Tomaten, kaas en champignons', 'https://competa-api.dev.competa.com/images/pizza/funghi.png', '6.45', 1, '2020-03-18 10:11:29', '2020-03-18 10:11:29'),
(4, 'Napolitana', 'Met tomatensaus, parmezaanse kaas en peterselie', 'https://competa-api.dev.competa.com/images/pasta/pasta.jpg', '4.50', 2, '2020-03-18 10:18:34', '2020-03-18 10:18:34');

