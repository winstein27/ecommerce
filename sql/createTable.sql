CREATE TABLE `scandiweb`.`product` (`id` INT NOT NULL AUTO_INCREMENT,
                                    `sku` VARCHAR(20) NOT NULL,
                                    `name` VARCHAR(50) NOT NULL,
                                    `price` DECIMAL(10, 2) NOT NULL,
                                    `type` ENUM('book', 'dvd', 'furniture', '') NOT NULL,
                                    `size` DECIMAL(10, 4) NULL,
                                    `weight` DECIMAL(10, 4) NULL,
                                    `height` DECIMAL(10, 4) NULL,
                                    `width` DECIMAL(10, 4) NULL,
                                    `length` DECIMAL(10, 4) NULL,
                                    PRIMARY KEY (`id`), UNIQUE (`sku`)
                                    ) ENGINE = InnoDB;