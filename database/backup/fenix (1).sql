-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Ноя 15 2024 г., 20:19
-- Версия сервера: 8.0.30
-- Версия PHP: 8.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `fenix`
--

-- --------------------------------------------------------

--
-- Структура таблицы `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `fx_app_users`
--

CREATE TABLE `fx_app_users` (
  `session_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `birth_date` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fcm_token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `platform` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tester` tinyint NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `fx_app_users`
--

INSERT INTO `fx_app_users` (`session_id`, `gender`, `birth_date`, `fcm_token`, `platform`, `tester`, `created_at`, `updated_at`) VALUES
('793df79f-8e9c-43a0-a99d-e0d28c16c02e', 'male', '2000-07-01T00:00:00.000', 'dtmJkxe4RKyvxqg6zh7PeO:APA91bHI8imEIrUQmOAB5ZzU4BCi47qvL_G9FSIommCUEq_ysmeHHIh1RL8FfqefUwVMTFKyjXBglfNwL7RKd-d3KELluM4GcL56xRGUGhbo_THVfP_x7eE', 'android', 0, '2024-11-15 13:49:28', '2024-11-15 13:49:28'),
('79ad33c5-478b-4629-a1d2-791261fb90fb', 'male', '2003-08-01T00:00:00.000', 'dKwiUg23RK6jdrORkL1lWY:APA91bHi4nANOiJC91bu25Nwt0HKS8myxsLAnTFaB3vx7Dq6eNR18-e5Oi1qA2RnuMGzUNZmSFyVu9U9zIN8bic2_FnjZ4CB5HpfCBqXkSuOzYIaK7i-gp0', NULL, 1, '2024-11-15 10:10:47', '2024-11-15 10:47:17'),
('a34bd59d-8527-4558-9156-1473bd200f0d', 'male', '2000-01-01T00:00:00.000', 'eb37ukAfQ2e8KFC8dU_4_b:APA91bHxaVIYKsgF1lZiVAQw7S2xhsoZyzif9RKV2eQ8P262yr9AXyvBjvqM8quSJbIioVvk_lTjAQj9YN79YZT266UpXSTBVln8kXdj31s9e3mmoQfvGT4', NULL, 0, '2024-11-14 13:08:13', '2024-11-14 13:08:13'),
('e45c1abc-6f4c-4a33-beea-3a87af650128', 'male', '2000-07-01T00:00:00.000', 'd52ieLD4SsefphME_DGSTd:APA91bEnHFoy4NACahCCCF9Mm76BYIXLVQdjkGZXADHXBGRQtdjz6w3Vqwwadjb3Hfo7YzcnuMvqpyL9uYgadDAqvjIeSfTTZ80DA_o-xCpjJWN4ar9490A', 'android', 0, '2024-11-15 11:11:12', '2024-11-15 11:11:12'),
('session123', 'dwadwa2', 'dadwad1', 'sdadwa1', NULL, 1, '2024-10-10 01:30:33', '2024-11-14 13:47:59'),
('session456', 'dwadwa', 'dadwad', 'sdadwa', 'ios', 0, '2024-11-14 13:47:15', '2024-11-14 13:47:15'),
('session456dwad', 'dwadwa', 'dadwad', 'sdadwa', 'android', 0, '2024-11-15 11:00:47', '2024-11-15 11:00:47');

-- --------------------------------------------------------

--
-- Структура таблицы `fx_beer_sorts`
--

CREATE TABLE `fx_beer_sorts` (
  `id` bigint UNSIGNED NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `descr` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `fx_beer_sorts`
--

INSERT INTO `fx_beer_sorts` (`id`, `image`, `descr`, `created_at`, `updated_at`) VALUES
(13, 'public/uploads/sorts/6.jpg', 'Сорт «Самурай» - это яркий представитель светлого пива. Тело у этого пива достаточно плотное и насыщенное. В послевкусии улавливается утонченная хмелевая горечь', '2024-11-15 12:31:30', '2024-11-15 12:43:03'),
(14, 'public/uploads/sorts/7.jpg', 'Пшеничное пиво в классическом немецком стиле. Пиво мутноватое, соломенно-золотистого цвета со стойкой белой пеной. В послевкусии приятная фруктовость и пикантность специй', '2024-11-15 12:31:31', '2024-11-15 12:31:31'),
(15, 'public/uploads/sorts/135.jpg', 'Обладает высокой плотностью и выраженным солодовым вкусом. Имеет неповторимый ароматный букет с нотками карамели. Сварен по оригинальному рецепту! Отлично сочетается с мясными блюдами и снэками.', '2024-11-15 12:31:32', '2024-11-15 12:31:32'),
(16, 'public/uploads/sorts/photo.jpg', 'Русский имперский стаут Мощный, насыщенный темный сорт, который имеет богатый, сложный вкус с нотками кофе, шоколада и сухофруктов. Этот стиль пива часто ассоциируется с царской Россией, ведь согласно легенде данный сорт пришелся по вкусу императрице Екатерине II, и по заказу двора Ее Величества его поставляли в Санкт-Петербург. Традиционно имеет высокое содержание алкоголя, плотность и насыщенный солодовый характер. Пиво с густой текстурой и бархатистым послевкусием, что делает его идеальным выбором для наслаждения в холодные зимние дни.', '2024-11-15 12:31:33', '2024-11-15 12:31:33'),
(17, 'public/uploads/sorts/photo.png', 'Ржаной эль янтарного цвета с выраженным солодовым характером. Слегка пряный аромат и красивая, устойчивая пена. Присутствует приятная, умеренная горчинка.', '2024-11-15 12:31:34', '2024-11-15 12:31:34'),
(18, 'public/uploads/sorts/photo.jpg', 'Данный сорт отличается преимущественным использованием Мюнхенского солода, с добавлением Венского и Чешского, и большим содержанием хмеля. Пиво традиционно имеет более высокую начальную плотность по сравнению с другими сортами. Мягкий, солодовый вкус в сочетании с лёгкой горечью ароматных хмелей Цитра и Халертау Бланк создают гармоничный и сбалансированный вкус и изумительный аромат. Имеет насыщенный янтарно-золотой цвет.', '2024-11-15 12:31:34', '2024-11-15 12:31:34'),
(19, 'public/uploads/sorts/3.jpg', 'Современная интерпретация традиционного британского стиля пива. IPA- сильно охмеленное плотное пиво карамельного цвета. Аромат свежего хмеля с цитрусовыми нотками, выраженная горчинка во вкусе', '2024-11-15 12:31:35', '2024-11-15 12:31:35'),
(20, 'public/uploads/sorts/130.jpg', 'Легкое светлое фильтрованное пиво. Сварено из финского солода. Обладает освежающим вкусом и утонченным послевкусием', '2024-11-15 12:31:36', '2024-11-15 12:31:36'),
(21, 'public/uploads/sorts/_.jpg', 'Легкое светлое нефильтрованное пиво. Сварено из финского солода. Обладает освежающим вкусом и утонченным послевкусием', '2024-11-15 12:31:38', '2024-11-15 12:31:38'),
(22, 'public/uploads/sorts/_.jpg', 'Питкое, нефильтрованное светлое пиво. С легкой горечью и хмелевым ароматом', '2024-11-15 12:31:39', '2024-11-15 12:31:39'),
(23, 'public/uploads/sorts/_.jpg', 'Питкое, светлое фильтрованное пиво. С легкой горечью и хмелевым ароматом', '2024-11-15 12:31:40', '2024-11-15 12:31:40'),
(24, 'public/uploads/sorts/103.jpg', 'Светлое фильтрованное пиво. С приятной горечью и хмелевым ароматом, начальная плотность 10%', '2024-11-15 12:31:42', '2024-11-15 12:31:42');

-- --------------------------------------------------------

--
-- Структура таблицы `fx_news`
--

CREATE TABLE `fx_news` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `fx_news`
--

INSERT INTO `fx_news` (`id`, `title`, `description`, `image`, `created_at`, `updated_at`) VALUES
(1, 'Чесночные гренки к пиву', 'Большое содержание небольшой новости', 'public/uploads/news/Ce59I5JaLY5wrvNbQmgKbtC3REwrq3ASOZ4jaZgH.jpg', '2024-10-08 14:01:53', '2024-11-15 11:50:14');

-- --------------------------------------------------------

--
-- Структура таблицы `fx_stores`
--

CREATE TABLE `fx_stores` (
  `id` bigint UNSIGNED NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `uptitle` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hours` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `weekend_plan` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `fx_stores`
--

INSERT INTO `fx_stores` (`id`, `image`, `uptitle`, `title`, `phone`, `hours`, `weekend_plan`, `created_at`, `updated_at`) VALUES
(8, 'public/uploads/stores/67376ed3f0528_photo.jpg', NULL, 'Дуси Ковальчук, 394', '+7 (383) 2-000-193', 'с 10.00 до 22.00', 'Без выходных', '2024-11-15 12:55:00', '2024-11-15 13:30:59'),
(9, 'public/uploads/stores/67376ed45d912_photo.jpg', NULL, 'Ленина, 94', '+7 (383) 381-43-90', 'с 10.00 до 22.00', 'Без выходных', '2024-11-15 12:55:00', '2024-11-15 12:55:00'),
(10, 'public/uploads/stores/67376ed50128f_noroot.png', NULL, 'ул. Блюхера, 4', '+7 (953) 888-60-95', 'с 10.00 до 00.00', 'Без выходных', '2024-11-15 12:55:01', '2024-11-15 12:55:01'),
(11, 'public/uploads/stores/67376ed6029b7__WhatsApp_2023-10-26.jpg', NULL, 'Первомайская, 236', '+7(913) 397‒68‒88', 'с 10:00 до 02:00', 'Без выходных', '2024-11-15 12:55:02', '2024-11-15 12:55:02'),
(12, 'public/uploads/stores/67376ed6407eb_WhatsApp_Image_2022-.jpeg', 'Фирменный отдел в магазине \"Светлое и Темное\"', 'ул. Гаранина, 29', '+7 (923) 190-64-67', 'Пн-Чт, Вс 09.00 до 22.00\nПт-Сб 09.00 до 00.00', 'Без выходных', '2024-11-15 12:55:02', '2024-11-15 12:55:02'),
(13, 'public/uploads/stores/67376ed681dad_WhatsApp_Image_2021-.jpeg', 'Фирменный отдел в магазине \"Светлое и Темное\"', 'Красина 51', '+7 (923) 148-77-65', 'Вс.-Чт. с 10.00 до 23.00\nПт.-Сб. с 10.00 до 24.00', 'Без выходных', '2024-11-15 12:55:02', '2024-11-15 12:55:02'),
(14, 'public/uploads/stores/67376ed6be3fe_WhatsApp_Image_2022-.jpeg', 'Фирменный отдел в магазине \"Светлое и Темное\"', 'Варшавская, 15', '+7 (923) 148-77-65', 'Вс.-Чт. с 09.00 до 22.00\nПт.-Сб. с 09.00 до 23.00', 'Без выходных', '2024-11-15 12:55:02', '2024-11-15 12:55:02');

-- --------------------------------------------------------

--
-- Структура таблицы `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2024_10_08_160855_create_fx_news_table', 2),
(7, '2024_10_09_173325_create_fx_app_users_table', 3),
(8, '2024_11_14_163723_add_test_column_to_fx_app_users', 4),
(9, '2024_11_15_135459_add_platform_column_to_fx_app_users', 5),
(11, '2024_11_15_150955_create_fx_beer_sorts_table', 6),
(13, '2024_11_15_154610_create_fx_stores_table', 7);

-- --------------------------------------------------------

--
-- Структура таблицы `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(2, 'Super Admin', 'fenix@fenix.ru', NULL, '$2y$10$cdYcQaF0IdjCd0bHOghDjeUwAlfN7EAC1Y6Um6lDfX0epGhy4Rt8G', 'PkafENcetQfVVEXjLckD729jrZmCOBWP7EL1Go7FNQgbtatlevLVNDscJWUI', '2024-10-08 12:27:18', '2024-10-08 12:27:18');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Индексы таблицы `fx_app_users`
--
ALTER TABLE `fx_app_users`
  ADD PRIMARY KEY (`session_id`);

--
-- Индексы таблицы `fx_beer_sorts`
--
ALTER TABLE `fx_beer_sorts`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `fx_news`
--
ALTER TABLE `fx_news`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `fx_stores`
--
ALTER TABLE `fx_stores`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Индексы таблицы `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `fx_beer_sorts`
--
ALTER TABLE `fx_beer_sorts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT для таблицы `fx_news`
--
ALTER TABLE `fx_news`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `fx_stores`
--
ALTER TABLE `fx_stores`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT для таблицы `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT для таблицы `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
