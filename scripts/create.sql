CREATE TABLE `bignay`.`activity` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `date` DATETIME NOT NULL,
  `description` TEXT(500) NOT NULL,
  `deposit` FLOAT NULL,
  `withdrawal` FLOAT NULL,
  `balance` FLOAT NULL,
  PRIMARY KEY (`id`));

CREATE INDEX `id` ON `bignay`.`activity` (`id`);

INSERT INTO `bignay`.`activity` (date, description, deposit, withdrawal, balance) VALUES
('2000-01-01', "Dad's gift", 1000.00, null, 1000.00); 

INSERT INTO `bignay`.`activity` (date, description, deposit, withdrawal, balance) VALUES
('2002-02-02', "Mom's gift", 1000.00, null, 2000.00); 

INSERT INTO `bignay`.`activity` (date, description, deposit, withdrawal, balance) VALUES
('2003-03-03', "Brother's gift", 1000.00, null, 3000.00); 

INSERT INTO `bignay`.`activity` (date, description, deposit, withdrawal, balance) VALUES
('2004-04-04', "Bought a laptop for A", null, 500.00, 2500.00); 

INSERT INTO `bignay`.`activity` (date, description, deposit, withdrawal, balance) VALUES
('2005-05-05', "Bought a laptop for B", null, 500.00, 2000.00); 

INSERT INTO `bignay`.`activity` (date, description, deposit, withdrawal, balance) VALUES
('2005-05-05', "Bought a laptop for B", null, 500.00, 2000.00);

INSERT INTO `bignay`.`activity` (date, description, deposit, withdrawal, balance) VALUES
('2006-06-06', "Bought a laptop for c", null, 500.00, 1500.00),
('2007-07-07', "I Earned", 250.00, null, 2250.00),
('2008-08-08', "She earned", 250.00, null, 2500.00),
('2009-09-09', "Interest from bank", 500.00, null, 2500.00);