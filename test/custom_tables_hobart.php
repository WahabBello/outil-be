<?php

/**
 * Si inexistante, on créée la table SQL "casiers_metres" après l'activation du thème
 */
    // require_once('../wp-load.php');

    // global $wpdb;
    // $charset_collate = $wpdb->get_charset_collate();

    // $casiers_metres_table_name = $wpdb->prefix . 'casiers_metres';

    // $casiers_metres = "CREATE TABLE IF NOT EXISTS $casiers_metres_table_name (
    //     ID bigint(20) unsigned NOT NULL auto_increment,
    //     ligne_cn_entier int(11) NOT NULL,
    //     ligne_cn_decimal decimal(5,3) NOT NULL,
    //     ligne_cn_type varchar(20) NOT NULL,
    //     ligne_ftstd_decimal decimal(5,3) NOT NULL,
    //     ligne_ftstd_type varchar(20) NOT NULL,
    //     groupe varchar(20) NOT NULL,
    //     PRIMARY KEY  (ID)
    // ) $charset_collate;";

    // $reference_machine_table_name = $wpdb->prefix . 'reference_machine';

    // $reference_machine = "CREATE TABLE IF NOT EXISTS $reference_machine_table_name (
    //     ID bigint(20) unsigned NOT NULL auto_increment,
    //     valeur_mesure varchar(20) NOT NULL default '',
    //     type_machine varchar(20) NOT NULL,
    //     vitesse1 varchar(10) NOT NULL default '',
    //     vitesse2 varchar(10) NOT NULL default '',
    //     vitesse3 varchar(10) NOT NULL default '',
    //     longueur_machine varchar(10) NOT NULL default '',
    //     budget_c20 varchar(20) NOT NULL default '',
    //     budget_chp varchar(20) NOT NULL default '',
    //     budget_c25 varchar(20) NOT NULL default '',
    //     budget_fhp varchar(20) NOT NULL default '',
    //     type_mesure varchar(20) NOT NULL,
    //     gamme varchar(20) NOT NULL default '',
    //     PRIMARY KEY  (ID)
    // ) $charset_collate;";

    // require_once(ABSPATH . '../wp-admin/includes/upgrade.php');
    // dbDelta($reference_machine);
    // dbDelta($casiers_metres);
            
 
            
    // INSERT INTO wp_reference_machine (valeur_mesure, type_machine, vitesse1, vitesse2, vitesse3 , longueur_machine, budget_c20, budget_chp, budget_c25, budget_fhp, type_mesure, gamme)
    // VALUES
    // ('0', '0', '0', '0', '0', '0', '0', '0', '', '', 'CASIERS', 'PROFI'),
    // ('1', 'C N -E2-A-DS', '80', '95', '150', '2200', 'A', '', '', '', 'CASIERS', 'PROFI'),
    // ('96', 'CN -E2-E-A-DS', '100', '125', '190', '2700', 'B', '', '', '', 'CASIERS', 'PROFI'), 
    // ('126', 'CN-E2-L-A-DS', '120', '135', '200', '2850', 'C', '', '', '', 'CASIERS', 'PROFI'), 
    // ('136', 'CN-E2-S-A-DS', '120', '150', '220', '3100', 'D', '', '', '', 'CASIERS', 'PROFI'), 
    // ('151', 'CN-E2-E-S-A-DS', '120', '180', '250', '3600', 'E', '', '', '', 'CASIERS', 'PROFI'), 
    // ('181', 'CN-E2-S-A-A-DS', '120', '190', '280', '4000', 'F', '', '', '', 'CASIERS', 'PROFI'), 
    // ('191', 'CN-E2-E-S-A-A-DS', '150', '210', '320', '4500', 'G', '', '', '', 'CASIERS', 'PROFI'),
    // ('211', 'CONTACTEZ HOBART', '0', '0', '0', '', 'CONTACTEZ HOBART',	'CONTACTEZ HOBART', '', '', 'CASIERS','PROFI'), 
    // ('600', '0', '0', '0', '0', '', '', '',  '', '', 'CASIERS', 'PROFI'), 
    // ('0', '0', '', '', '0', '0', '', '', '0', '0', 'METRES', 'PROFI'),
    // ('0.1', 'FTNi E-A-R-DL', '0.70', '1.02', '1.16', '5350', '', '', 'A', '', 'METRES', 'PROFI'),
    // ('1.03', 'FTNi L-A-R-DL', '0.88', '1.15', '1.35', '5450', '', '', 'B', '', 'METRES', 'PROFI'),
    // ('1.16', 'FTNi S-A-R-DS', '0.98', '1.30', '1.56', '6350', '', '', 'C', '', 'METRES', 'PROFI'),
    // ('1.31', 'FTNi E-S-A-R-DS', '1.18', '1.55', '1.83', '6850', '', '', 'D', '', 'METRES', 'PROFI'),
    // ('1.61', 'FTNi S-A-A-R-DS', '1.38', '1.75', '2.46', '7250', '', '', 'F', '', 'METRES', 'PROFI'),
    // ('1.76', 'FTNi E-S-A-A-R-DS', '1.48', '2.00', '2.64', '7750', '', '', 'G', '', 'METRES', 'PROFI'),
    // ('2.01', 'FTNi S-A-A-A-R-DS', '1.68', '2.20', '3.08', '8150', '', '', 'H', '', 'METRES', 'PROFI'),
    // ('2.21', 'FTNi E-S-A-A-A-R-DS', '1.78', '2.45', '3.38', '8650', '', '', 'I', '', 'METRES', 'PROFI'),
    // ('2.46', 'CONTACTEZ HOBART', '', '', '', '', '', '', '', '', 'METRES', 'PROFI'),
    // ('3.3', '', '', '', '', '', '', '', '', '', 'METRES', 'PROFI'),					
    // ('121', 'CP-L-A-DS', '120', '180', '240', '2850', '', '', '', '', 'CASIERS', 'PREMAX'),  		
    // ('151', 'CP-L-A-DS', '120', '180', '240', '2850', '', '', '', '', 'CASIERS', 'PREMAX'),  		
    // ('181', 'CP-S-A-DS', '120', '190', '300', '3100', '', '', '', '', 'CASIERS', 'PREMAX'),  		
    // ('191', 'CP-E-S-A-DS', '150', '200', '320', '3600', '', '', '', '', 'CASIERS', 'PREMAX'),  		
    // ('201', 'CONTACTEZ HOBART', '0', '0', '0', '', '', '', '', '', 'CASIERS', 'PREMAX'),     
    // ('0', '0', '0', '0', '0', '', '', '', '', '', 'METRES', 'PREMAX'),                	
    // ('1.03', '0', '0', '0', '0', '0', '', '', '', '', 'METRES', 'PREMAX'),                   
    // ('1.16', 'FTPi L-A-R-DS', '0.98', '1.30', '1.56', '6050', '', '', '', '', 'METRES', 'PREMAX'),                	
    // ('1.31', 'FTPi S-A-R-DS', '1.18', '1.55', '1.85', '6350', '', '', '', '', 'METRES', 'PREMAX'),                	
    // ('1.56', 'FTPi E-S-A-R-DS', '1.35', '1.70', '2.5', '6850', '', '', '', '', 'METRES', 'PREMAX'),               	
    // ('1.71', 'FTPi S-D-A-R-DS', '1.50', '1.98', '2.66', '6850', '', '', '', '', 'METRES', 'PREMAX'),                	
    // ('1.99', 'FTPi S-A-A-R-DS', '1.65', '2.40', '3.4', '7250', '', '', '', '', 'METRES', 'PREMAX'),                	
    // ('2.41', 'CONTACTEZ HOBART', '0', '0','0', '', '', '', '', '', 'METRES', 'PREMAX'),                
    // ('3.3', '', '' , '', '', '', '', '', '', '', 'METRES', 'PREMAX'),                
    // ('CONTACTEZ HOBART', '', '0', '0','0', '0', '', '', '0', '', 'METRES', 'PREMAX');                	
    