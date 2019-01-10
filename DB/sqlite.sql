CREATE TABLE IF NOT EXISTS `Users` (
  `id` INT,
  `chat_id` INT NOT NULL,
  `token` TEXT NOT NULL,
  PRIMARY KEY (`id`)
);