CREATE TABLE `product` (
    `id` CHAR(36) NOT NULL,
    `name` VARCHAR(255) NOT NULL,
    `price` FLOAT NOT NULL,
    `stock_quantity` INT NOT NULL,
    `images` TEXT,
    `rating` INT,
    `reviews` JSON,
    CHECK(
            JSON_SCHEMA_VALID(
                '{
                    "type":"array",
                    "properties":{
                        "author":{"type":"string"},
                        "message":{"type":"string"}
                    },
                    "required": ["author", "message"]
                }',
                `reviews`
		    )
            AND (
                `rating` >= 0
            )
    ),
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;