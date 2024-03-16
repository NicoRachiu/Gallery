

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";



CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `photo_id` int(11) NOT NULL,
  `author` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



INSERT INTO `comments` (`id`, `photo_id`, `author`, `body`, `created`) VALUES
(22, 81, 'ok1', 'ok', '2023-12-30 12:22:42'),
(23, 81, 'ok', 'ok', '2023-12-30 12:22:42'),
(24, 81, 'ok', 'ok', '2023-12-30 12:22:42'),
(25, 81, 'ok', 'ok', '2023-12-30 12:22:42'),
(29, 0, 'gbgbxg', 'xgbxgb', '2024-01-01 21:57:19');



CREATE TABLE `photos` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `caption` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `alternative_text` varchar(255) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `type` varchar(11) NOT NULL,
  `size` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



INSERT INTO `photos` (`id`, `title`, `caption`, `description`, `alternative_text`, `filename`, `type`, `size`) VALUES
(79, 'Macchina blu', '', '', 'ok', 'images-3 copy.jpg', 'image/jpeg', 18096),
(81, '', '', '', '', 'images-10 copy.jpg', 'image/jpeg', 20401);



CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `user_image` varchar(255) NOT NULL,
  `email` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO `users` (`id`, `username`, `password`, `first_name`, `last_name`, `user_image`, `email`) VALUES
(176, 'ok', '', 'ok', 'ok', '_large_image_2.jpg', 'ciao@gmail.com'),
(212, 'chhncghhcghhm', 'hvhjcghcjgj', 'fhfyhffn', 'fnfjvmcgmcg', '_large_image_2.jpg', '');


ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `photo_id` (`photo_id`);


ALTER TABLE `photos`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;


ALTER TABLE `photos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;


ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=218;
COMMIT;