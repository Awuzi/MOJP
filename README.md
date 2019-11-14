# Bienvenue sur le projet Meccha Orders Japan Postal (MOJP)

MOJP est une application web sur laquelle il est possible de consulter des informations concernant 
des commandes passées sur une boutique de commerce en ligne, cette dernière est créée avec le CMS Prestashop.

---

## Installation : 

### **Assurez vous d'avoir d'abord installer Prestashop v1.7.x.**
### **Lors de l'installation de Prestashop, assurez de configurez les tables de manières à ce qu'elles commencent par "ps_" (ex: ps_orders).**

---

> **Executer les commandes suivantes sur PhpMyAdmin**

---

```sql 
CREATE DATABASE IF NOT EXISTS projet_mojp;
CREATE TABLE IF NOT EXISTS `projet_mojp`.`ldb_orders` (
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
```



> **Lancez votre serveur web & enjoy**
