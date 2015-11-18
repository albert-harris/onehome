d:\program\mysql\bin\mysql -u root -e "drop database proper47_maindb"; 
d:\program\mysql\bin\mysql -u root -e "create database proper47_maindb DEFAULT CHARACTER SET utf8  DEFAULT COLLATE utf8_unicode_ci;";
d:\program\mysql\bin\mysql -u root proper47_maindb < proper47_maindb.sql
