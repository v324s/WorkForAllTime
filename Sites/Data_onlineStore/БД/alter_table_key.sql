
ALTER TABLE `cart_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_product` (`id_product`),
  ADD KEY `id_size` (`id_size`),
  ADD KEY `id_color` (`id_color`);


ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `colors`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_product` (`id_product`),
  ADD KEY `id_size` (`id_size`),
  ADD KEY `id_color` (`id_color`);


ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_category` (`id_category`),
  ADD KEY `id_subcategory` (`id_subcategory`),
  ADD KEY `id_size` (`id_size`),
  ADD KEY `id_color` (`id_color`);


ALTER TABLE `sizes`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `subcategory`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_category` (`id_category`);


ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);





  