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
      //   ligne_cn_entier int(11) NOT NULL,
      //   ligne_cn_decimal decimal(5,3) NOT NULL,
    //     ligne_cn_type varchar(20) NOT NULL,
    //     ligne_ftstd_decimal decimal(5,3) NOT NULL,
    //     ligne_ftstd_type varchar(20) NOT NULL,
    //     groupe varchar(20) NOT NULL,
    //     PRIMARY KEY  (ID)
    // ) $charset_collate;";

    // $reference_machine_table_name = $wpdb->prefix . 'reference_machine';

    // $reference_machine = "CREATE TABLE IF NOT EXISTS $reference_machine_table_name (
    //     ID bigint(20) unsigned NOT NULL auto_increment,
    //     valeur_mesure decimal(7,4) NOT NULL default '',
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
            
 
//     CREATE TABLE IF NOT EXISTS wp_donnees_techniques (
//       ID bigint(20) unsigned NOT NULL auto_increment,
//       reference varchar(40) NOT NULL default '',
//       vitesse_transport1 decimal(7,2) NOT NULL,
//       vitesse_transport2 decimal(7,2) NOT NULL,
//       vitesse_transport3 decimal(7,2) NOT NULL,
//       prix int(10) NOT NULL,
//       longueur_machine_ts int(10) NOT NULL,
//       puissance_installe decimal(7,1) NOT NULL,
//       puissance_consommee decimal(7,1) NOT NULL,
//       vitesse_debit1 int(10) NOT NULL,
//       vitesse_debit2 int(10) NOT NULL,
//       vitesse_debit3 int(10) NOT NULL,
//       remplissage_eau_chaude decimal(7,2) NOT NULL,
//       debit_rejete int(10) NOT NULL,
//       temperature_rejet int(10) NOT NULL,
//       humidite_relative int(10) NOT NULL,
//       ratio_humidite decimal(7,2) NOT NULL,
//       chaleur_sensible decimal(7,1) NOT NULL,
//       chaleur_latente decimal(7,1) NOT NULL,
//       vaisselle decimal(7,2) NOT NULL,
//       PRIMARY KEY  (ID)
//   );
   
// reference | vitesse_transport1 | vitesse_transport2 | vitesse_transport3 | prix | longueur_machine_ts | puissance_installe | puissance_consommee | vitesse_debit1 | vitesse_debit2 | vitesse_debit3 | remplissage_eau_chaude | debit_rejete | temperature_rejet | humidite_relative | ratio_humidite | chaleur_sensible | chaleur_latente  | vaisselle 

// INSERT INTO wp_donnees_techniques (reference, vitesse_transport1, vitesse_transport2, vitesse_transport3, prix, longueur_machine_ts, puissance_installe, puissance_consommee, vitesse_debit1, vitesse_debit2, vitesse_debit3, remplissage_eau_chaude, debit_rejete, temperature_rejet, humidite_relative, ratio_humidite, chaleur_sensible, chaleur_latente, vaisselle)
// VALUES
// ('CN-E2-A-DS-C20', 80, 95, 150, 57826, 2200, 27.6, 20.7, 150, 160, 170, 110.00, 280, 25, 95, 2.70, 3.2, 3.7, 4.30),
// ('CN-E2-A-DS-CHP', 80, 95, 150, 83782, 2200, 22.1, 16.6, 150, 160, 170, 110.00, 350, 17, 95, -0.30, 2.7, 0.6, 4.30),
// ('CN-E2-E-A-DS-C20', 100, 125, 190, 71080, 2700, 27.8, 20.8, 150, 160, 170, 125.00, 280, 25, 95, 2.70, 3.4, 3.8, 5.40),
// ('CN-E2-E-A-DS-CHP', 100, 125, 190, 97036, 2700, 22.3, 16.7, 150, 160, 170, 125.00, 350, 17, 95, -0.30, 2.9, 0.4, 5.40),
// ('CN-E2-L-A-DS-C20', 120, 135, 200, 75897, 2850, 29.1, 21.8, 160, 170, 180, 165.00, 280, 25, 95, 2.70, 3.7, 1.6, 7.30),
// ('CN-E2-L-A-DS-CHP', 120, 135, 200, 101853, 2850, 23.6, 17.7, 160, 170, 180, 165.00, 350, 17, 95, -0.30, 3.2, 0.5, 7.30),
// ('CN-E2-S-A-DS-C20', 120, 150, 220, 77426, 3100, 29.4, 22.0, 160, 170, 180, 215.00, 280, 25, 95, 2.70, 3.9, 4, 8.10),
// ('CN-E2-S-A-DS-CHP', 120, 150, 220, 103382, 3100, 23.9, 17.9, 160, 170, 180, 215.00, 350, 17, 95, -0.30, 3.4, 0.5, 8.10),
// ('CN-E2-E-S-A-DS-C20', 120, 180, 250, 88722, 3600, 31.1, 23.4, 140, 180, 200, 230.00, 280, 25, 95, 2.70, 4, 4, 9.70),
// ('CN-E2-E-S-A-DS-CHP', 120, 180, 250, 114678, 3600, 24.1, 18.4, 140, 180, 200, 230.00, 350, 17, 95, -0.30, 3.5, 0.6, 9.70),
// ('CP-L-A-DS-C20', 120, 180, 240, 89856, 2850, 32.1, 19.9, 140, 160, 190, 165.00, 280, 25, 95, 3.10, 4.1, 4.1, 9.70),
// ('CP-L-A-DS-CHP', 120, 180, 240, 115759, 2850, 25.1, 15.5, 140, 160, 190, 165.00, 350, 17, 95, -0.30, 3.6, 0.7, 9.70),
// ('CP-S-A-DS-C20', 120, 190, 300, 91104, 3100, 32.4, 20.0, 140, 170, 200, 215.00, 280, 25, 95, 3.10, 4.3, 4.1, 10.30),
// ('CP-S-A-DS-CHP', 120, 190, 300, 117007, 3100, 25.4, 15.7, 140, 170, 200, 215.00, 350, 17, 95, -0.30, 3.8, 0.7, 10.30),
// ('CN-E2-S-A-A-DS-C20', 120, 190, 280, 92285, 4000, 40.2, 26.9, 140, 200, 230, 320.00, 280, 25, 95, 2.70, 4.6, 4.3, 10.30),
// ('CN-E2-S-A-A-DS-CHP', 120, 190, 280, 118241, 4000, 33.2, 22.2, 140, 200, 230, 320.00, 350, 17, 95, -0.30, 4.1, 0.8, 10.30),
// ('CP-E-S-A-DS-C20', 120, 200, 320, 99321, 3600, 32.6, 19.5, 140, 170, 200, 230.00, 280, 25, 95, 3.10, 4.6, 4.3, 10.80),
// ('CP-E-S-A-DS-CHP', 120, 200, 320, 125224, 3600, 25.6, 15.3, 140, 170, 200, 230.00, 350, 17, 95, -0.30, 4.1, 0.8, 10.80),
// ('CN-E2-E-S-A-A-DS-C20', 120, 210, 320, 104171, 4500, 40.4, 27.0, 140, 220, 240, 335.00, 280, 25, 95, 2.70, 4.8, 4.3, 11.30),
// ('CN-E2-E-S-A-A-DS-CHP', 120, 210, 320, 130127,  4500, 36.4, 23.4, 140, 220, 240, 335.00, 350, 17,  95, -0.30, 4.3, 0.9,  11.30),
// ('FTNi E-A-R-DL-C25', 0.78, 1.09, 1.24, 114454,  5350, 35.5, 26.5, 150, 160, 180, 159.50, 200, 33, 95, 1.70, 3.9, 3.7, 7.10),
// ('FTNi L-A-R-DL-C25', 0.88, 1.15, 1.35, 119849, 5450, 33.8, 25.4, 150, 160, 180, 264.00, 200, 25, 95, 1.70, 4.1, 3.7, 7.70),
// ('FTNi L-A-R-DL-FHP', 0.88, 1.15, 1.35, 142073, 5450, 22.3, 16.7, 150, 160, 180, 264.00, 350, 17, 95, -0.30, 4.1, 1.5, 7.70),
// ('FTNi S-A-R-DS-C25', 0.98, 1.3, 1.56, 122673, 6350, 30.8, 23.1, 150, 160, 180, 264.00, 200, 25, 95, 1.70, 4.3, 3.7, 8.70),
// ('FTNi S-A-R-DS-FHP', 0.98, 1.3, 1.56, 144926, 6350, 22.3, 16.7, 150, 160, 180, 264.00, 350, 17, 95, -0.30, 4.3, 1.5, 8.70),
// ('FTNi E-S-A-R-DS-C25', 1.18, 1.55, 1.83, 130932, 6850, 30.8, 23.1, 150, 160, 180, 284.50, 200, 25, 95, 1.70, 4.5, 3.7, 10.50),
// ('FTNi E-S-A-R-DS-FHP', 1.18, 1.55, 1.83, 153185, 6850, 22.3, 16.7, 150, 160, 180, 284.50, 350, 17, 95, -0.30, 4.5, 1.5, 10.50),
// ('FTPi L-A-R-DS-FHP', 1.05, 1.3, 1.6, 195872, 6050, 25.3, 15.2, 120, 130, 180, 273.00, 350, 17, 95, -0.30, 4.4, 1.8, 8.80),
// ('FTPi S-A-R-DS-FHP', 1.2, 1.55, 1.85, 200104, 6350, 25.3, 15.2, 120, 130, 180, 273.00, 350, 17, 95, -0.30, 4.6, 1.8, 10.70),
// ('FTPi E-S-A-R-DS-FHP', 1.35, 1.7, 2.5, 209103, 6850, 25.3, 14.8, 120, 130, 180, 293.50, 350, 17, 95, -0.30, 4.9, 1.8, 11.80),
// ('FTNi S-A-A-R-DS-C25', 1.38, 1.75, 2.46, 141623, 7250, 39.8, 26.7, 170, 180, 210, 389.00, 200, 25, 95, 1.70, 4.7, 4.5, 11.90),
// ('FTNi S-A-A-R-DS-FHP', 1.38, 1.75, 2.46, 186111, 7250, 29.8, 19.3, 170, 180, 210, 389.00, 350, 17, 95, -0.30, 4.7, 1.7, 11.90),
// ('FTNi E-S-A-A-R-DS-C25', 1.48, 2, 2.64, 141623, 7750, 39.8, 26.7, 170, 180, 210, 409.50, 200, 25, 95, 1.70, 5, 4.7, 13.80),
// ('FTNi E-S-A-A-R-DS-FHP', 1.48, 2, 2.64, 194271, 7750, 29.8, 19.3, 170, 180, 210, 409.50, 350, 17, 95, -0.30, 5, 1.8, 13.80),
// ('FTPi S-D-A-R-DS-FHP', 1.5, 1.98, 2.66, 213194, 6850, 34.3, 20.8, 140, 150, 200, 273.00, 350, 17, 95, -0.30, 5.1, 2.1, 15.50),
// ('FTPi S-A-A-R-DS-FHP', 1.65, 2.4, 3.4, 232216, 7250, 37.3, 21.9, 150, 160, 210, 398.00, 350, 17, 95, -0.30, 5.3, 2.1, 16.90),
// ('FTNi S-A-A-A-R-DS-C25', 1.68, 2.2, 3.08, 160437, 8150, 47.3, 31.7, 180, 190, 240, 514.00, 200, 25, 95, 1.70, 5.2, 4.9, 15.50),
// ('FTNi S-A-A-A-R-DS-FHP', 1.68, 2.2, 3.08, 206104, 8150, 34.3, 22.3, 180, 190, 240, 514.00, 350, 17, 95, -0.30, 5.2, 2, 15.50),
// ('FTNi E-S-A-A-A-R-DS-C25', 1.78, 2.45, 3.38, 168569, 8650, 47.3, 31.7, 180, 190, 240, 534.50, 200, 25, 95, 1.70, 5.5, 5.1, 16.90),
// ('FTNi E-S-A-A-A-R-DS-FHP', 1.78, 2.45, 3.38, 214235, 8650, 34.3, 22.3, 180, 190, 240, 534.50, 350, 17, 95, -0.30, 5.5, 2.1, 16.90);

 
   //  INSERT INTO wp_reference_machine (valeur_mesure, type_machine, vitesse1, vitesse2, vitesse3 , longueur_machine, budget_c20, budget_chp, budget_c25, budget_fhp, type_mesure, gamme)
   //  VALUES
   //  (0, '0', '0', '0', '0', '0', '0', '0', '', '', 'CASIERS', 'PROFI'),
   //  (1, 'C N -E2-A-DS', '80', '95', '150', '2200', 'A', '', '', '', 'CASIERS', 'PROFI'),
   //  (96, 'CN -E2-E-A-DS', '100', '125', '190', '2700', 'B', '', '', '', 'CASIERS', 'PROFI'), 
   //  (126, 'CN-E2-L-A-DS', '120', '135', '200', '2850', 'C', '', '', '', 'CASIERS', 'PROFI'), 
   //  (136, 'CN-E2-S-A-DS', '120', '150', '220', '3100', 'D', '', '', '', 'CASIERS', 'PROFI'), 
   //  (151, 'CN-E2-E-S-A-DS', '120', '180', '250', '3600', 'E', '', '', '', 'CASIERS', 'PROFI'), 
   //  (181, 'CN-E2-S-A-A-DS', '120', '190', '280', '4000', 'F', '', '', '', 'CASIERS', 'PROFI'), 
   //  (191, 'CN-E2-E-S-A-A-DS', '150', '210', '320', '4500', 'G', '', '', '', 'CASIERS', 'PROFI'),
   //  (211, 'CONTACTEZ HOBART', '0', '0', '0', '', 'CONTACTEZ HOBART',	'CONTACTEZ HOBART', '', '', 'CASIERS','PROFI'), 
   //  (600, '0', '0', '0', '0', '', '', '',  '', '', 'CASIERS', 'PROFI'), 
   //  (0, '0', '', '', '0', '0', '', '', '0', '0', 'METRES', 'PROFI'),
   //  (0.1, 'FTNi E-A-R-DL', '0.70', '1.02', '1.16', '5350', '', '', 'A', '', 'METRES', 'PROFI'),
   //  (1.03, 'FTNi L-A-R-DL', '0.88', '1.15', '1.35', '5450', '', '', 'B', '', 'METRES', 'PROFI'),
   //  (1.16, 'FTNi S-A-R-DS', '0.98', '1.30', '1.56', '6350', '', '', 'C', '', 'METRES', 'PROFI'),
   //  (1.31, 'FTNi E-S-A-R-DS', '1.18', '1.55', '1.83', '6850', '', '', 'D', '', 'METRES', 'PROFI'),
   //  (1.61, 'FTNi S-A-A-R-DS', '1.38', '1.75', '2.46', '7250', '', '', 'F', '', 'METRES', 'PROFI'),
   //  (1.76, 'FTNi E-S-A-A-R-DS', '1.48', '2.00', '2.64', '7750', '', '', 'G', '', 'METRES', 'PROFI'),
   //  (2.01, 'FTNi S-A-A-A-R-DS', '1.68', '2.20', '3.08', '8150', '', '', 'H', '', 'METRES', 'PROFI'),
   //  (2.21, 'FTNi E-S-A-A-A-R-DS', '1.78', '2.45', '3.38', '8650', '', '', 'I', '', 'METRES', 'PROFI'),
   //  (2.46, 'CONTACTEZ HOBART', '', '', '', '', '', '', '', '', 'METRES', 'PROFI'),
   //  (3.3, '', '', '', '', '', '', '', '', '', 'METRES', 'PROFI'),					
   //  (121, 'CP-L-A-DS', '120', '180', '240', '2850', '', '', '', '', 'CASIERS', 'PREMAX'),  		
   //  (151, 'CP-L-A-DS', '120', '180', '240', '2850', '', '', '', '', 'CASIERS', 'PREMAX'),  		
   //  (181, 'CP-S-A-DS', '120', '190', '300', '3100', '', '', '', '', 'CASIERS', 'PREMAX'),  		
   //  (191, 'CP-E-S-A-DS', '150', '200', '320', '3600', '', '', '', '', 'CASIERS', 'PREMAX'),  		
   //  (201, 'CONTACTEZ HOBART', '0', '0', '0', '', '', '', '', '', 'CASIERS', 'PREMAX'),     
   //  (0, '0', '0', '0', '0', '', '', '', '', '', 'METRES', 'PREMAX'),                	
   //  (1.03, '0', '0', '0', '0', '0', '', '', '', '', 'METRES', 'PREMAX'),                   
   //  (1.16, 'FTPi L-A-R-DS', '0.98', '1.30', '1.56', '6050', '', '', '', '', 'METRES', 'PREMAX'),                	
   //  (1.31, 'FTPi S-A-R-DS', '1.18', '1.55', '1.85', '6350', '', '', '', '', 'METRES', 'PREMAX'),                	
   //  (1.56, 'FTPi E-S-A-R-DS', '1.35', '1.70', '2.5', '6850', '', '', '', '', 'METRES', 'PREMAX'),               	
   //  (1.71, 'FTPi S-D-A-R-DS', '1.50', '1.98', '2.66', '6850', '', '', '', '', 'METRES', 'PREMAX'),                	
   //  (1.99, 'FTPi S-A-A-R-DS', '1.65', '2.40', '3.4', '7250', '', '', '', '', 'METRES', 'PREMAX'),                	
   //  (2.41, 'CONTACTEZ HOBART', '0', '0','0', '', '', '', '', '', 'METRES', 'PREMAX'),                
   //  (3.3, '', '' , '', '', '', '', '', '', '', 'METRES', 'PREMAX');
