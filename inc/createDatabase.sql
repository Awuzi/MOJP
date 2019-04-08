SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE IF NOT EXISTS `ldb_orders` (
  `idldb_orders` int(45) NOT NULL,
  `idOrderPresta` int(10) UNSIGNED NOT NULL,
  `Ship` varchar(45) DEFAULT NULL,
  `RR_JP` varchar(45) DEFAULT NULL,
  `ReferencePresta` varchar(45) NOT NULL,
  `Note` varchar(150) DEFAULT NULL,
  `Actions` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


ALTER TABLE `ldb_orders`
  ADD PRIMARY KEY (`idldb_orders`),
  ADD KEY `id` (`idOrderPresta`);

ALTER TABLE `ldb_orders`
  MODIFY `idldb_orders` int(45) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

ALTER TABLE `ldb_orders`
  ADD CONSTRAINT `id` FOREIGN KEY (`idOrderPresta`) REFERENCES `prestashop`.`ps_orders` (`id_order`);
COMMIT;