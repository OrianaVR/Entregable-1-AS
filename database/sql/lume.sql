-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:8889
-- Tiempo de generación: 16-09-2026 a las 03:42:58
-- Versión del servidor: 5.7.24
-- Versión de PHP: 8.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `lume`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Cleansers', 'Gentle facial cleansers designed to purify and refresh the skin.', '2026-09-16 08:24:48', '2026-09-16 08:24:48'),
(2, 'Serums & Treatments', 'Concentrated active formulas targeting specific skin concerns.', '2026-09-16 08:24:48', '2026-09-16 08:24:48'),
(3, 'Moisturizers', 'Nourishing creams and gels to lock in moisture and protect the skin barrier.', '2026-09-16 08:24:48', '2026-09-16 08:24:48'),
(4, 'Sunscreens', 'Broad-spectrum UV protection essential for daily skin care.', '2026-09-16 08:24:48', '2026-09-16 08:24:48');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `items`
--

CREATE TABLE `items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` double NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `items`
--

INSERT INTO `items` (`id`, `quantity`, `price`, `product_id`, `order_id`, `created_at`, `updated_at`) VALUES
(1, 3, 34, 4, 1, '2026-09-16 08:30:16', '2026-09-16 08:30:16'),
(2, 2, 22.5, 2, 1, '2026-09-16 08:30:16', '2026-09-16 08:30:16'),
(3, 2, 38, 3, 2, '2026-09-16 08:31:21', '2026-09-16 08:31:21'),
(4, 5, 29.99, 7, 3, '2026-09-16 08:32:09', '2026-09-16 08:32:09');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` smallint(5) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_09_13_050849_create_orders_table', 1),
(5, '2026_09_13_210257_create_payments_table', 1),
(6, '2026_09_13_213839_create_items_table', 1),
(7, '2026_09_13_220246_create_reviews_table', 1),
(8, '2026_09_14_045407_create_categories_table', 1),
(9, '2026_09_14_054539_create_products_table', 1),
(10, '2026_09_14_060636_add_product_foreign_key_to_items_and_reviews_tables', 1),
(11, '2026_09_14_204713_add_featured_to_products_table', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `delivery_date` date NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `orders`
--

INSERT INTO `orders` (`id`, `address`, `state`, `delivery_date`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'Calle 1#56', 'inProcess', '2026-09-19', 2, '2026-09-16 08:30:16', '2026-09-16 08:30:16'),
(2, 'calle 1#45', 'inProcess', '2026-10-02', 2, '2026-09-16 08:31:21', '2026-09-16 08:31:21'),
(3, 'calle 1 #45', 'inProcess', '2026-09-19', 2, '2026-09-16 08:32:09', '2026-09-16 08:32:09');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `method` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` datetime NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `transaction_code` int(11) NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `payments`
--

INSERT INTO `payments` (`id`, `method`, `date`, `status`, `transaction_code`, `order_id`, `created_at`, `updated_at`) VALUES
(1, 'cash', '2026-09-16 03:30:16', 'pending', 836119, 1, '2026-09-16 08:30:16', '2026-09-16 08:30:16'),
(2, 'card', '2026-09-16 03:31:22', 'pending', 362833, 2, '2026-09-16 08:31:22', '2026-09-16 08:31:22'),
(3, 'cash', '2026-09-16 03:32:09', 'pending', 432121, 3, '2026-09-16 08:32:09', '2026-09-16 08:32:09');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `brand` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `stock` int(11) NOT NULL DEFAULT '0',
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `featured` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `products`
--

INSERT INTO `products` (`id`, `name`, `brand`, `price`, `description`, `stock`, `image`, `category_id`, `created_at`, `updated_at`, `featured`) VALUES
(1, 'Gentle Foaming Cleanser', 'LUMÉ SKIN', '24.99', 'Sulfate-free cleanser that removes makeup and impurities without drying the skin.', 50, 'cleanser1.jpg', 1, '2026-09-16 08:24:48', '2026-09-16 08:24:48', 0),
(2, 'Hydrating Amino Gel Cleanser', 'LUMÉ SKIN', '22.50', 'Soothing gel cleanser rich in amino acids for daily moisture balance.', 38, 'cleanser2.jpg', 1, '2026-09-16 08:24:48', '2026-09-16 08:34:33', 0),
(3, 'Vitamin C Glow Serum', 'LUMÉ SKIN', '38.00', 'Potent antioxidant serum formulated to brighten tone and reduce spots.', 33, 'serum1.jpg', 2, '2026-09-16 08:24:48', '2026-09-16 08:33:47', 1),
(4, 'Hyaluronic Acid Hydration Booster', 'LUMÉ SKIN', '34.00', 'Multi-molecular hyaluronic serum providing deep, long-lasting hydration.', 57, 'serum2.jpg', 2, '2026-09-16 08:24:48', '2026-09-16 08:30:16', 0),
(5, 'Barrier Repair Moisture Cream', 'LUMÉ SKIN', '42.00', 'Rich nourishing cream packed with ceramides to restore skin softness.', 30, 'moisturizer1.jpg', 3, '2026-09-16 08:24:48', '2026-09-16 08:35:17', 1),
(6, 'Ultra-Light Water Gel Cream', 'LUMÉ SKIN', '36.50', 'Oil-free hydrator with a featherlight texture ideal for oily skin types.', 45, 'moisturizer2.jpg', 3, '2026-09-16 08:24:48', '2026-09-16 08:33:16', 1),
(7, 'Invisible Daily Defense SPF 50', 'LUMÉ SKIN', '29.99', 'Lightweight broad-spectrum UV protection with no white cast or greasy feel.', 45, 'sunscreen1.jpg', 4, '2026-09-16 08:24:48', '2026-09-16 08:32:09', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reviews`
--

CREATE TABLE `reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `rating` int(11) NOT NULL,
  `comment` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `reviews`
--

INSERT INTO `reviews` (`id`, `rating`, `comment`, `user_id`, `product_id`, `created_at`, `updated_at`) VALUES
(1, 5, 'It is an amazing product', 2, 6, '2026-09-16 08:33:16', '2026-09-16 08:33:16'),
(2, 5, 'The best serum I have ever purchased', 2, 3, '2026-09-16 08:33:47', '2026-09-16 08:33:47'),
(3, 2, 'There are better moisturizers than this trash', 2, 2, '2026-09-16 08:34:33', '2026-09-16 08:34:33'),
(4, 4, 'Nice!', 2, 5, '2026-09-16 08:35:16', '2026-09-16 08:35:16');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('UiE856SEgZYz4ugn5oZPA6bKwHZqWICgYffNY3nq', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.137.0 Chrome/148.0.7778.280 Electron/42.10.0 Safari/537.36', 'eyJfdG9rZW4iOiJUQm1qcWxnV3d6RTRYNjgyT0dyd3NWcVlJYXYwOXN1Tlc2dVlzZjZwIiwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJfcHJldmlvdXMiOnsidXJsIjoiaHR0cDpcL1wvMTI3LjAuMC4xOjgwMDAiLCJyb3V0ZSI6ImhvbWUuaW5kZXgifSwibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiOjJ9', 1789529733);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `phone`, `address`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Main Administrator', 'admin@example.com', NULL, '$2y$12$.CMWixfQzcbqDbOW9GymTefaLhpZ1RoRzF9TsCEpjrYAbDWGWbCX2', '3001234567', '123 Main Street', 'admin', NULL, '2026-09-16 08:24:44', '2026-09-16 08:24:44'),
(2, 'Lila Perez', 'user@example.com', NULL, '$2y$12$0R0YYyDQRqxnzpkCvmMpjONcdpaTYmrahJNPN6QjH3dZLGSA/72fG', '3119876543', '456 Second Avenue', 'user', NULL, '2026-09-16 08:24:45', '2026-09-16 08:24:45'),
(3, 'Clyde Haag', 'victor63@example.org', '2026-09-16 08:24:47', '$2y$12$o5oLDh0aERF4MnR6EG0pmuVpPFw819Q.SAi4FlcoHjT8NkQtnk5Y2', '386.241.4673', '590 Melvina Springs\nNorth Kathlyn, ND 06456', 'user', 'G2cXtaaIXE', '2026-09-16 08:24:47', '2026-09-16 08:24:47'),
(4, 'Rene Parisian', 'windler.marcia@example.com', '2026-09-16 08:24:47', '$2y$12$o5oLDh0aERF4MnR6EG0pmuVpPFw819Q.SAi4FlcoHjT8NkQtnk5Y2', '+1-515-757-3387', '82059 Murray Trail\nMetzburgh, NE 40883', 'user', 'CuMStM7mb2', '2026-09-16 08:24:47', '2026-09-16 08:24:47'),
(5, 'Dell Dickinson II', 'marian.spinka@example.org', '2026-09-16 08:24:47', '$2y$12$o5oLDh0aERF4MnR6EG0pmuVpPFw819Q.SAi4FlcoHjT8NkQtnk5Y2', '234.258.7895', '683 Koelpin Circles\nBashirianstad, MA 60041', 'user', 'mxTYNqcTq7', '2026-09-16 08:24:47', '2026-09-16 08:24:47'),
(6, 'Prudence Haley', 'dudley01@example.com', '2026-09-16 08:24:47', '$2y$12$o5oLDh0aERF4MnR6EG0pmuVpPFw819Q.SAi4FlcoHjT8NkQtnk5Y2', '+1-704-459-5915', '64657 Elena Landing Apt. 787\nBridgetteland, LA 64486', 'user', 'TauSwFNLXU', '2026-09-16 08:24:47', '2026-09-16 08:24:47'),
(7, 'Lafayette O\'Conner', 'krista23@example.org', '2026-09-16 08:24:47', '$2y$12$o5oLDh0aERF4MnR6EG0pmuVpPFw819Q.SAi4FlcoHjT8NkQtnk5Y2', '(463) 612-9207', '83846 Cruickshank Points\nEast Mikayla, KS 42806', 'user', 'acwOCCPzy1', '2026-09-16 08:24:47', '2026-09-16 08:24:47'),
(8, 'Trystan Kuhlman', 'andres.erdman@example.org', '2026-09-16 08:24:47', '$2y$12$o5oLDh0aERF4MnR6EG0pmuVpPFw819Q.SAi4FlcoHjT8NkQtnk5Y2', '1-279-986-1634', '485 Franecki Mall\nProhaskahaven, MO 58817', 'user', 'siY16jlmdH', '2026-09-16 08:24:47', '2026-09-16 08:24:47'),
(9, 'Prof. Melany Walter', 'lueilwitz.ruthe@example.org', '2026-09-16 08:24:47', '$2y$12$o5oLDh0aERF4MnR6EG0pmuVpPFw819Q.SAi4FlcoHjT8NkQtnk5Y2', '+1-775-905-6389', '420 Koelpin Pike\nVickystad, VT 80717', 'user', 'Ad12nW7wus', '2026-09-16 08:24:47', '2026-09-16 08:24:47'),
(10, 'Robbie Schaefer IV', 'jarret.schuster@example.net', '2026-09-16 08:24:47', '$2y$12$o5oLDh0aERF4MnR6EG0pmuVpPFw819Q.SAi4FlcoHjT8NkQtnk5Y2', '(434) 751-3704', '2451 O\'Connell Plaza Apt. 971\nWest Kailyn, ND 82849', 'user', 'JmdFDjQt8d', '2026-09-16 08:24:47', '2026-09-16 08:24:47'),
(11, 'Mr. Kyle Blick', 'morris85@example.org', '2026-09-16 08:24:47', '$2y$12$o5oLDh0aERF4MnR6EG0pmuVpPFw819Q.SAi4FlcoHjT8NkQtnk5Y2', '+1 (617) 514-1331', '993 Mante Well\nWest Nathanmouth, KY 65488', 'user', '0nUQfv8Uhh', '2026-09-16 08:24:47', '2026-09-16 08:24:47'),
(12, 'Queen Greenfelder', 'raleigh.ankunding@example.org', '2026-09-16 08:24:47', '$2y$12$o5oLDh0aERF4MnR6EG0pmuVpPFw819Q.SAi4FlcoHjT8NkQtnk5Y2', '+1-901-414-3609', '446 Leonard Roads Apt. 141\nRicestad, IL 49106-1958', 'user', 'N6ctUqi7iB', '2026-09-16 08:24:47', '2026-09-16 08:24:47');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indices de la tabla `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indices de la tabla `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`),
  ADD KEY `failed_jobs_connection_queue_failed_at_index` (`connection`,`queue`,`failed_at`);

--
-- Indices de la tabla `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `items_order_id_foreign` (`order_id`),
  ADD KEY `items_product_id_foreign` (`product_id`);

--
-- Indices de la tabla `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indices de la tabla `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_user_id_foreign` (`user_id`);

--
-- Indices de la tabla `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indices de la tabla `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payments_order_id_foreign` (`order_id`);

--
-- Indices de la tabla `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_category_id_foreign` (`category_id`);

--
-- Indices de la tabla `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reviews_user_id_foreign` (`user_id`),
  ADD KEY `reviews_product_id_foreign` (`product_id`);

--
-- Indices de la tabla `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `items`
--
ALTER TABLE `items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reviews_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
