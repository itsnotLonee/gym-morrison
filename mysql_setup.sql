# Payments
INSERT INTO `payment` (`id`, `description`, `price`, `days`) VALUES (NULL, 'Monthly Subscription', '20€', '30');
INSERT INTO `payment` (`id`, `description`, `price`, `days`) VALUES (NULL, 'Two months Subscription', '35€', '60');
INSERT INTO `payment` (`id`, `description`, `price`, `days`) VALUES (NULL, 'Three months Subscription', '50€', '90');

# ADMIN USERS
INSERT INTO `user` (`id`, `email`, `roles`, `password`, `dni`, `name`, `surname`, `sex`, `address`, `phone`, `birthdate`, `profile_photo`) VALUES (NULL, 'admin@admin.com', '[\"ROLE_ADMIN\"]', 'admin', '012345678Z', 'Admin1', 'Admin1', 'male', 'Admin', '000000000', '2020-06-01', '/images/avatar/admin.png');
INSERT INTO `user` (`id`, `email`, `roles`, `password`, `dni`, `name`, `surname`, `sex`, `address`, `phone`, `birthdate`, `profile_photo`) VALUES (NULL, 'admin@admin.com', '[\"ROLE_ADMIN\"]', 'admin', '012345678Z', 'Admin2', 'Admin1', 'male', 'Admin', '000000000', '2020-06-01', '/images/avatar/admin.png');
INSERT INTO `user` (`id`, `email`, `roles`, `password`, `dni`, `name`, `surname`, `sex`, `address`, `phone`, `birthdate`, `profile_photo`) VALUES (NULL, 'admin@admin.com', '[\"ROLE_ADMIN\"]', 'admin', '012345678Z', 'Admin3', 'Admin1', 'male', 'Admin', '000000000', '2020-06-01', '/images/avatar/admin.png');
