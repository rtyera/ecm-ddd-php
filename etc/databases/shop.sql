CREATE TABLE `product` (
    `id` CHAR(36) NOT NULL,
    `name` VARCHAR(255) NOT NULL,
    `price` FLOAT NOT NULL,
    `stock_quantity` INT NOT NULL,
    `images` TEXT,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `review` (
    `id` CHAR(36) NOT NULL,
    `product` CHAR(36) NOT NULL,
    `author` VARCHAR(255) NOT NULL,
    `message` VARCHAR(255) NOT NULL,
    `create_on` DATE NOT NULL,
    `deliver` BOOLEAN,
    `checker` BOOLEAN,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;