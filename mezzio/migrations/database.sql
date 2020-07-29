CREATE TABLE `contacts`
(
    `id`     int(10) unsigned NOT NULL AUTO_INCREMENT,
    `guid`   varchar(36)  DEFAULT NULL,
    `name`   varchar(100) DEFAULT NULL,
    `number` varchar(100) DEFAULT NULL,
    `type`   varchar(100) DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;
