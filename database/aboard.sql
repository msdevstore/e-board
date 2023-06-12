/*
SQLyog Community v13.1.6 (64 bit)
MySQL - 10.4.24-MariaDB : Database - eboard
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`eboard` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_bin */;

USE `eboard`;

/*Table structure for table `boms` */

DROP TABLE IF EXISTS `boms`;

CREATE TABLE `boms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `qty` int(11) NOT NULL DEFAULT 0,
  `parts` varchar(50) COLLATE utf8_bin NOT NULL DEFAULT '',
  `description` varchar(50) COLLATE utf8_bin NOT NULL DEFAULT '',
  `package` varchar(50) COLLATE utf8_bin NOT NULL DEFAULT '',
  `productor` varchar(50) COLLATE utf8_bin NOT NULL DEFAULT '',
  `mpn` varchar(50) COLLATE utf8_bin NOT NULL DEFAULT '',
  `spn` varchar(50) COLLATE utf8_bin NOT NULL DEFAULT '',
  `remark` varchar(50) COLLATE utf8_bin NOT NULL DEFAULT '',
  `ebId` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2359 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

/*Data for the table `boms` */

insert  into `boms`(`id`,`qty`,`parts`,`description`,`package`,`productor`,`mpn`,`spn`,`remark`,`ebId`) values 
(1915,1,'BAT1','Coin Cell Battery Holder  FOR CR1220  (SMT)','CR1220','HARWIN','S8411-45R','','',36),
(1916,4,'C7, C27, C29, C31','Capacitor ceramic multilayer SMD/SMT 2200pF','0603','Murata','GRM1885C1H222JA01D','','',36),
(1917,1,'C3','12 pF ±10% 50V Ceramic Capacitor C0G, NP0 0805 (20','0805','KYOCERA AVX','08055A120KAT2A','','',36),
(1918,1,'C8','Capacitor ceramic multilayer SMD/SMT 150pF','0805','Murata','GRM2165C1H151JA01D','','',36),
(1919,17,'C1, C2, C9, C12, C14, C18, C20, C22, C23, C24, C25','CAP CER 0.1UF 50V X7R 0603','0603','Samsung Electro-Mechanics','CL10B104KB8NNWC','1276-1935-2-ND','',36),
(1920,2,'C10, C11','1 µF ±10% 50V Ceramic Capacitor X8L 0805 (2012 Met','0805','TDK Corporation','CGA4J1X8L1H105K125AC','','',36),
(1921,3,'C5, C17, C28','Capacitor ceramic SMD/SMT 10uF 16V','1206','TDK','GRM31CR71C106KA12L','','',36),
(1922,3,'C4, C21, C15','4.7 µF ±10% 6.3V Ceramic Capacitor X5R 0603 (1608 ','0603','YAGEO','CC0603KPX5R5BB475','','',36),
(1923,2,'C6, C19','Tantalum Capacitors SMD 47uF 6.3V Low ESR','3528   H = 1.9mm','Vishay','T55B476M6R3C0070','','',36),
(1924,2,'D1, D7','Double Schottky diode BAT54C Common Cathode SMT ','SOT23','Fairchild Semic.','BAT54C','','',36),
(1925,3,'D2, D3, D6','Schottky Diodes & Rectifiers Vrrm=20V , If =1A','SOD-123','NXP','PMEG2010ER,115','','',36),
(1926,2,'D4, D5','Double Schottky diode BAT54S Serial SMD/SMT ','SOT23','Rohm Semiconductor','BAT54SHYT116','','',36),
(1927,1,'F1','PTC  Resettable Fuse 15 V 0.5A SMD/SMT','1812','Bourns','MF-MSMF050-2','','',36),
(1928,1,'LED1','Standard LEDs SMD/SMT, Red','0805','Lite-On','LTST-C171KRKT','','',36),
(1929,1,'LED2','Standard LEDs SMD/SMT, Green','0805','Lite-On','LTST-C170GKT','','',36),
(1930,1,'LED3','Standard LEDs SMD/SMT, Yellow','0805','Lite-On','LTST-C170KSKT','','',36),
(1931,1,'L1','Power Inductors SMD/SMT 10uH  1.3A','4.0 mm x 4.0 mm','Bourns','SRN4018-100M','','',36),
(1932,1,'IC1','ARM® Cortex®-M4 series Microcontroller IC 32-Bit 1','64-LQFP','Microchip','ATSAMG55J19A-AUT','','Coating ZONE as per picture here close',36),
(1933,1,'IC2','Real Time Clock (RTC) IC Clock/Calendar - I²C','TSSOP-8','NXP','PCF8563TS/5,118','568-6651-2-ND','',36),
(1934,1,'IC3','Chip EEPROM  4K (512x8) 2-WIRE ','SOIC-8','Atmel','AT24C04C-SSHM-T','','',36),
(1935,1,'IC4','BUCK Converter whith FET, 380KHz','HTSOP-J8','  ROHM Semicond.','BD9328EFJ-E2','','',36),
(1936,1,'IC5','Voltage Regulator 3.3V 0.25A SMT','SOT23','Microchip Technology','MCP1700T-3302E/TT','MCP1700T3302ETTTR-ND','',36),
(1937,1,'IC6','Sensor Temperature  MCP9700','SOT23','MicroChip','MCP9700AT-E/TT','MCP9700AT-E/TTTR-ND','',36),
(1938,1,'IC7','I/O Expander 8 I²C, SMBus 400 kHz 16-HVQFN (4x4)','16-VQFN Exposed Pad','NXP','PCA9500BS,118','','',36),
(1939,1,'IC8','RFID Transponder IC 13.56MHz ISO 14443, NFC I²C','SOIC-8','STMicroelectronics','M24SR64-YMN6T/2','','',36),
(1940,1,'J4','Mini USB 2.0 Type B Vertical','MINI-USB','Wurth Elektronik','651005136421','732-2735-ND','',36),
(1941,1,'J3','Jack Modular Connector 8p8c (RJ45, Ethernet) 90° A','RJ45 8/8','CUI Devices','CRJ044-3-TH','','',36),
(1942,1,'QZ2','CRYSTAL 32.7680KHZ 12.5PF SMD','8.00mm x 3.80mm','ECS Inc','ECS-.327-12.5-17X-TR','','',36),
(1943,1,'R10','Resistor SMD/SMT  220R  5%','R1206','Vishay','CRCW1206220RJNEA','','',36),
(1944,2,'R13, R23','Resistor SMD/SMT  18R 5%','R0805','Panasonic','ERJ-6GEYJ180V','','',36),
(1945,1,'R5','Resistor SMD/SMT  33R 5%','R0805','Panasonic','ERJ-6GEYJ330V','','',36),
(1946,4,'R20, R24, R25, R28','Resistor SMD/SMT  120R  5%','R0805','Vishay','CRCW0805120RJNEA','','',36),
(1947,2,'R9, R29','Resistor SMD/SMT  510R 1%','R0805','Vishay','CRCW0805510RJNEA','','',36),
(1948,2,'R19, R33','Resistor SMD/SMT  150R  5%','R0603','Panasonic','ERJ-3EKF1500V','','',36),
(1949,5,'R1, R7, R16, R30, R36, R14','Resistor SMD/SMT  1k2  1%','R0603','Panasonic','ERJ-3EKF1201V','','',36),
(1950,2,'R18, R26','Resistor SMD/SMT  2k21 1%','R0603','Vishay','CRCW06032K21FKEA','','',36),
(1951,5,'R2, R3, R4, R11, R22','Resistor SMD/SMT  7k5  1%','R0603','Panasonic','ERJ-3EKF7501V','','',36),
(1952,7,'R6, R8, R12, R39, R21, R27, R34','Resistor SMD/SMT  10k 1%','R0603','Stackpole Electronics Inc','RMCF0603FT10K0','RMCF0603FT10K0TR-ND','',36),
(1953,1,'R32','Resistor SMD/SMT  18k2 1%','R0603','Panasonic','ERJ-3EKF1822V','','',36),
(1954,2,'R15, R38','RES 100K OHM 1% 1/10W 0603','R0603','Stackpole Electronics Inc','RMCF0603FT100K','RMCF0603FT100KTR-ND','',36),
(1955,2,'R31, R37','RES 39 OHM 1% 1/10W 0603','R0603','Stackpole Electronics Inc','RMCF0603FT39R0','RMCF0603FT39R0TR-ND','',36),
(1956,1,'R17','Resistor SMD/SMT  330k 1%','R0603','Vishay','CRCW0805330KJNEA','','',36),
(1957,1,'R35','Resistor SMD/SMT  1M 1%','R0603','Vishay','CRCW08051M00JNEA','','',36),
(1958,2,'TR1, TR2','Transistor npn SMD/SMT, IC=500mA  VCEO = 45V','SOT23-BEC','ON Semiconductor','BC817-40LT1G','','',36),
(1959,1,'TR3','Transistor npn SMD/SMT, LOW VCE(Sat) = 0.004V ','SOT23-BEC','Diodes Incorporated','ZXTN25020BFHTA','ZXTN25020BFHTR-ND','',36),
(1960,1,'SV1','Headers & Wire Housings 2mm, 14pin, 2 Row','Picth 2,0mm','Molex','87759-1450','','Add pickup Cap as shown in picture below',36),
(1961,1,'SW1','SWITCH SLIDE SPDT 300MA 6V','SPDT','APEM Inc.','MHSS1105','','',36),
(1962,1,'S1','SWITCH TACTILE SPST-NO 0.05A 12V','SPST-NO','TE Connectivity ALCOSWITCH Switches','FSM2JELGELTR','450-2152-2-ND','',36),
(1963,1,'CON1','5 Position FFC, FPC Connector Contacts','','Molex','512810594','WM12846TR-ND','',36),
(1964,1,'CON2','CONN HEADER SMD 8POS 2MM','','Molex','87759-0850','WM18651-ND','Add pickup Cap as shown in picture below',36),
(1965,1,'CON3','0.35 B/B REC ASSY 6CKT EMBSTP PK','','Molex','505413-0610','900-5054130610TR-ND','',36),
(1966,1,'J6','37 Position FPC Connector Contacts, Bottom 0.020\" ','','TE Connectivity AMP Connectors','3-1734592-7','A101318TR-ND','',36),
(1967,1,'LCD','2,8\" TFT LCD ( 240 x 320 ) , ILI9341V','','Shenzhen Microtech Technology Co.,Ltd','MTF0280QT-30A','','',36),
(1968,1,'Atmel-ICE','Microchip Atmel-ICE, Programming Kit for SAM and A','','Microchip','ATATMEL-ICE-BASIC','130-6123','',36),
(1969,1,'Programming Cable','“No Legs” 6-pin Plug-of-Nails™ Cable fitted with a','','Tag-Connect','TC2030-IDC-NL','','',36),
(1970,1,'BAT1','Coin Cell Battery Holder  FOR CR1220  (SMT)','CR1220','HARWIN','S8411-45R','','',37),
(1971,4,'C7, C27, C29, C31','Capacitor ceramic multilayer SMD/SMT 2200pF','0603','Murata','GRM1885C1H222JA01D','','',37),
(1972,1,'C3','12 pF ±10% 50V Ceramic Capacitor C0G, NP0 0805 (20','0805','KYOCERA AVX','08055A120KAT2A','','',37),
(1973,1,'C8','Capacitor ceramic multilayer SMD/SMT 150pF','0805','Murata','GRM2165C1H151JA01D','','',37),
(1974,17,'C1, C2, C9, C12, C14, C18, C20, C22, C23, C24, C25','CAP CER 0.1UF 50V X7R 0603','0603','Samsung Electro-Mechanics','CL10B104KB8NNWC','1276-1935-2-ND','',37),
(1975,2,'C10, C11','1 µF ±10% 50V Ceramic Capacitor X8L 0805 (2012 Met','0805','TDK Corporation','CGA4J1X8L1H105K125AC','','',37),
(1976,3,'C5, C17, C28','Capacitor ceramic SMD/SMT 10uF 16V','1206','TDK','GRM31CR71C106KA12L','','',37),
(1977,3,'C4, C21, C15','4.7 µF ±10% 6.3V Ceramic Capacitor X5R 0603 (1608 ','0603','YAGEO','CC0603KPX5R5BB475','','',37),
(1978,2,'C6, C19','Tantalum Capacitors SMD 47uF 6.3V Low ESR','3528   H = 1.9mm','Vishay','T55B476M6R3C0070','kkk','',37),
(1979,2,'D1, D7','Double Schottky diode BAT54C Common Cathode SMT ','SOT23','Fairchild Semic.','BAT54C','','',37),
(1980,3,'D2, D3, D6','Schottky Diodes & Rectifiers Vrrm=20V , If =1A','SOD-123','NXP','PMEG2010ER,115','','',37),
(1981,2,'D4, D5','Double Schottky diode BAT54S Serial SMD/SMT ','SOT23','Rohm Semiconductor','BAT54SHYT116','','',37),
(1982,1,'F1','PTC  Resettable Fuse 15 V 0.5A SMD/SMT','1812','Bourns','MF-MSMF050-2','','',37),
(1983,1,'LED1','Standard LEDs SMD/SMT, Red','0805','Lite-On','LTST-C171KRKT','','',37),
(1984,1,'LED2','Standard LEDs SMD/SMT, Green','0805','Lite-On','LTST-C170GKT','','',37),
(1985,1,'LED3','Standard LEDs SMD/SMT, Yellow','0805','Lite-On','LTST-C170KSKT','','',37),
(1986,1,'L1','Power Inductors SMD/SMT 10uH  1.3A','4.0 mm x 4.0 mm','Bourns','SRN4018-100M','','',37),
(1987,1,'IC1','ARM® Cortex®-M4 series Microcontroller IC 32-Bit 1','64-LQFP','Microchip','ATSAMG55J19A-AUT','','Coating ZONE as per picture here close',37),
(1988,1,'IC2','Real Time Clock (RTC) IC Clock/Calendar - I²C','TSSOP-8','NXP','PCF8563TS/5,118','568-6651-2-ND','',37),
(1989,1,'IC3','Chip EEPROM  4K (512x8) 2-WIRE ','SOIC-8','Atmel','AT24C04C-SSHM-T','','',37),
(1990,1,'IC4','BUCK Converter whith FET, 380KHz','HTSOP-J8','  ROHM Semicond.','BD9328EFJ-E2','','',37),
(1991,1,'IC5','Voltage Regulator 3.3V 0.25A SMT','SOT23','Microchip Technology','MCP1700T-3302E/TT','MCP1700T3302ETTTR-ND','',37),
(1992,1,'IC6','Sensor Temperature  MCP9700','SOT23','MicroChip','MCP9700AT-E/TT','MCP9700AT-E/TTTR-ND','',37),
(1993,1,'IC7','I/O Expander 8 I²C, SMBus 400 kHz 16-HVQFN (4x4)','16-VQFN Exposed Pad','NXP','PCA9500BS,118','','',37),
(1994,1,'IC8','RFID Transponder IC 13.56MHz ISO 14443, NFC I²C','SOIC-8','STMicroelectronics','M24SR64-YMN6T/2','','',37),
(1995,1,'J4','Mini USB 2.0 Type B Vertical','MINI-USB','Wurth Elektronik','651005136421','732-2735-ND','',37),
(1996,1,'J3','Jack Modular Connector 8p8c (RJ45, Ethernet) 90° A','RJ45 8/8','CUI Devices','CRJ044-3-TH','','',37),
(1997,1,'QZ2','CRYSTAL 32.7680KHZ 12.5PF SMD','8.00mm x 3.80mm','ECS Inc','ECS-.327-12.5-17X-TR','','',37),
(1998,1,'R10','Resistor SMD/SMT  220R  5%','R1206','Vishay','CRCW1206220RJNEA','','',37),
(1999,2,'R13, R23','Resistor SMD/SMT  18R 5%','R0805','Panasonic','ERJ-6GEYJ180V','','',37),
(2000,1,'R5','Resistor SMD/SMT  33R 5%','R0805','Panasonic','ERJ-6GEYJ330V','','',37),
(2001,4,'R20, R24, R25, R28','Resistor SMD/SMT  120R  5%','R0805','Vishay','CRCW0805120RJNEA','','',37),
(2002,2,'R9, R29','Resistor SMD/SMT  510R 1%','R0805','Vishay','CRCW0805510RJNEA','','',37),
(2003,2,'R19, R33','Resistor SMD/SMT  150R  5%','R0603','Panasonic','ERJ-3EKF1500V','','',37),
(2004,5,'R1, R7, R16, R30, R36, R14','Resistor SMD/SMT  1k2  1%','R0603','Panasonic','ERJ-3EKF1201V','','',37),
(2005,2,'R18, R26','Resistor SMD/SMT  2k21 1%','R0603','Vishay','CRCW06032K21FKEA','','',37),
(2006,5,'R2, R3, R4, R11, R22','Resistor SMD/SMT  7k5  1%','R0603','Panasonic','ERJ-3EKF7501V','','',37),
(2007,7,'R6, R8, R12, R39, R21, R27, R34','Resistor SMD/SMT  10k 1%','R0603','Stackpole Electronics Inc','RMCF0603FT10K0','RMCF0603FT10K0TR-ND','',37),
(2008,1,'R32','Resistor SMD/SMT  18k2 1%','R0603','Panasonic','ERJ-3EKF1822V','','',37),
(2009,2,'R15, R38','RES 100K OHM 1% 1/10W 0603','R0603','Stackpole Electronics Inc','RMCF0603FT100K','RMCF0603FT100KTR-ND','',37),
(2010,2,'R31, R37','RES 39 OHM 1% 1/10W 0603','R0603','Stackpole Electronics Inc','RMCF0603FT39R0','RMCF0603FT39R0TR-ND','',37),
(2011,1,'R17','Resistor SMD/SMT  330k 1%','R0603','Vishay','CRCW0805330KJNEA','','',37),
(2012,1,'R35','Resistor SMD/SMT  1M 1%','R0603','Vishay','CRCW08051M00JNEA','','',37),
(2013,2,'TR1, TR2','Transistor npn SMD/SMT, IC=500mA  VCEO = 45V','SOT23-BEC','ON Semiconductor','BC817-40LT1G','','',37),
(2014,1,'TR3','Transistor npn SMD/SMT, LOW VCE(Sat) = 0.004V ','SOT23-BEC','Diodes Incorporated','ZXTN25020BFHTA','ZXTN25020BFHTR-ND','',37),
(2015,1,'SV1','Headers & Wire Housings 2mm, 14pin, 2 Row','Picth 2,0mm','Molex','87759-1450','','Add pickup Cap as shown in picture below',37),
(2016,1,'SW1','SWITCH SLIDE SPDT 300MA 6V','SPDT','APEM Inc.','MHSS1105','','',37),
(2017,1,'S1','SWITCH TACTILE SPST-NO 0.05A 12V','SPST-NO','TE Connectivity ALCOSWITCH Switches','FSM2JELGELTR','450-2152-2-ND','',37),
(2018,1,'CON1','5 Position FFC, FPC Connector Contacts','','Molex','512810594','WM12846TR-ND','',37),
(2019,1,'CON2','CONN HEADER SMD 8POS 2MM','','Molex','87759-0850','WM18651-ND','Add pickup Cap as shown in picture below',37),
(2020,1,'CON3','0.35 B/B REC ASSY 6CKT EMBSTP PK','','Molex','505413-0610','900-5054130610TR-ND','',37),
(2021,1,'J6','37 Position FPC Connector Contacts, Bottom 0.020\" ','','TE Connectivity AMP Connectors','3-1734592-7','A101318TR-ND','',37),
(2022,1,'LCD','2,8\" TFT LCD ( 240 x 320 ) , ILI9341V','','Shenzhen Microtech Technology Co.,Ltd','MTF0280QT-30A','','',37),
(2023,1,'Atmel-ICE','Microchip Atmel-ICE, Programming Kit for SAM and A','','Microchip','ATATMEL-ICE-BASIC','130-6123','',37),
(2024,1,'Programming Cable','“No Legs” 6-pin Plug-of-Nails™ Cable fitted with a','','Tag-Connect','TC2030-IDC-NL','','',37);

/*Table structure for table `ebs` */

DROP TABLE IF EXISTS `ebs`;

CREATE TABLE `ebs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_code` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `version` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `description` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `last_update` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

/*Data for the table `ebs` */

insert  into `ebs`(`id`,`item_code`,`version`,`description`,`status`,`last_update`) values 
(36,'BoM_AELEBDTOU04','V18','This is ...kkkk',NULL,'2022-08-16 13:15:32'),
(37,'BoM_AELEBDTOU05','V19','That is ...kkkkk',NULL,'2022-08-16 13:16:20');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `password` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

/*Data for the table `users` */

insert  into `users`(`id`,`username`,`password`) values 
(10,'ms@koko.com','cb42e130d1471239a27fca6228094f0e');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
