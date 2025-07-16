
CREATE TABLE `cart_users` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `id_size` int(11) NOT NULL,
  `id_color` int(11) NOT NULL,
  `count` int(11) NOT NULL
)

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` tinytext NOT NULL
)

CREATE TABLE `subcategory` (
  `id` int(11) NOT NULL,
  `id_category` int(11) NOT NULL,
  `name` tinytext NOT NULL
)

CREATE TABLE `colors` (
  `id` int(11) NOT NULL,
  `name` tinytext NOT NULL
)

CREATE TABLE `sizes` (
  `id` int(11) NOT NULL,
  `number` int(11) NOT NULL
)

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `id_category` int(11) NOT NULL,
  `id_subcategory` int(11) DEFAULT NULL,
  `id_size` int(11) NOT NULL,
  `id_color` int(11) NOT NULL,
  `name` tinytext NOT NULL,
  `description` text NOT NULL,
  `price` int(11) NOT NULL,
  `discount` tinyint(4) NOT NULL,
  `count` int(11) NOT NULL
)

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` tinytext NOT NULL,
  `last_name` tinytext NOT NULL,
  `dob` date NOT NULL,
  `sex` tinytext NOT NULL,
  `telephone` tinytext NOT NULL,
  `address` text NOT NULL
)

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `id_size` int(11) NOT NULL,
  `id_color` int(11) NOT NULL,
  `count` int(11) NOT NULL,
  `price_for_one` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `address` text NOT NULL,
  `status` tinytext NOT NULL
)