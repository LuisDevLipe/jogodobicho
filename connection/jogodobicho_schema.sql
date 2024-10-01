CREATE TABLE `Apostas` (
  `id` integer PRIMARY KEY,
  `user_id` integer,
  `aposta` varchar(255),
  `aposta_tipo` varchar(255),
  `valor` integer,
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE `Users` (
  `id` integer PRIMARY KEY,
  `fullname` varchar(255),
  `dob` date,
  `gender` varchar(255),
  `mothername` varchar(255),
  `cpf` varchar(255),
  `email` varchar(255),
  `celular` varchar(255),
  `fixo` varchar(255),
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE `Credentials` (
  `username` varchar(255) PRIMARY KEY,
  `user_id` integer,
  `password` varchar(255),
  `rootuser` boolean,
  `updated_at` timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE `TwoFactorAuth` (
  `id` integer PRIMARY KEY,
  `user_id` integer,
  `mothername` varchar(255),
  `dob` varchar(255),
  `cep` varchar(255)
);

CREATE TABLE `Adress` (
  `id` integer PRIMARY KEY,
  `user_id` integer,
  `cep` varchar(255),
  `street` varchar(255),
  `number` varchar(255),
  `city` varchar(255),
  `state` varchar(255),
  `country` varchar(255),
  `updated_at` timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE `userLog` (
  `id` integer PRIMARY KEY AUTO_INCREMENT,
  `username` varchar(255),
  `login_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  `logout_at` timestamp DEFAULT NULL,
  `TwoFA_id` integer,
  `TwoFA_Answer` varchar(255)
);

CREATE TABLE `Resultados` (
  `id` integer PRIMARY KEY AUTO_INCREMENT,
  `primeiro` integer,
  `segundo` integer,
  `terceiro` integer,
  `quarto` integer,
  `quinto` integer,
  `horario` integer,
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE `Animais` (
  `id` integer AUTO_INCREMENT,
  `animal` varchar(255) NOT NULL,
  `grupo_id` integer,
  PRIMARY KEY (`id`, `animal`)
);

CREATE TABLE `Grupos` (
  `id` integer AUTO_INCREMENT,
  `grupo` varchar(255) NOT NULL,
  PRIMARY KEY (`id`, `grupo`)
);

ALTER TABLE `Credentials` ADD FOREIGN KEY (`user_id`) REFERENCES `Users` (`id`);

ALTER TABLE `TwoFactorAuth` ADD FOREIGN KEY (`user_id`) REFERENCES `Credentials` (`user_id`);

ALTER TABLE `Adress` ADD FOREIGN KEY (`user_id`) REFERENCES `Users` (`id`);

ALTER TABLE `userLog` ADD FOREIGN KEY (`username`) REFERENCES `Credentials` (`username`);

ALTER TABLE `userLog` ADD FOREIGN KEY (`TwoFA_id`) REFERENCES `TwoFactorAuth` (`id`);

ALTER TABLE `Animais` ADD FOREIGN KEY (`grupo_id`) REFERENCES `Grupos` (`id`);

ALTER TABLE `Apostas` ADD FOREIGN KEY (`user_id`) REFERENCES `Users` (`id`);
