<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../wp-content/themes/twentytwenty/outil.css">
    <title>Document</title>
    <script>
        function affichageElement(choix) {
            document.getElementById('PLATEAU-1').style.display = "block";
            document.getElementById('PLATEAU-2').style.display = "block";
            document.getElementById('PLATEAU-3').style.display = "block";
            document.getElementById('PLATEAU-4').style.display = "block";
            document.getElementById('PLATEAU-5').style.display = "block";
            if (choix == "HOPITAL-PATIENT") { // Cacher la div qui n'est pas sélectionnée
                document.getElementById('PLATEAU-1').style.display = "none";
                document.getElementById('PLATEAU-2').style.display = "none";
            } else if (choix == "") {
                return
            } else {
                document.getElementById('PLATEAU-3').style.display = "none";
                document.getElementById('PLATEAU-4').style.display = "none";
                document.getElementById('PLATEAU-5').style.display = "none";
            }
            document.getElementById('plateauType').value = "";
        }


        function calculdebit(choix) {
            debit = document.getElementById('debit');
            mesures = document.getElementById('casiers_metres');
            nbCouvertsSurHeureDePointe = document.getElementById('nbCouvertsSurHeureDePointe').value;

            if (choix == 1) {
                mesures.textContent = "CASIERS/H.";
            } else {
                mesures.textContent = "METRES/MIN.";
            }
        }

        function calculPointe() {
            nbCouverts = document.getElementById('nbCouverts').value;
            duree = document.getElementById('duree').value;
            nbconvives = document.getElementById('nbconvives').value;
            nbCouvertsSurHeureDePointe = document.getElementById('nbCouvertsSurHeureDePointe');

            if (duree <= 60) {
                nbCouvertsSurHeureDePointe.value = Math.round(nbCouverts / duree * 60);
            } else {
                nbCouvertsSurHeureDePointe.value = Math.round(nbCouverts * nbconvives / 100);
            }
        }

        function selectionMachine(choix) {
            machineChoisie = document.getElementById('machineChoisie');
            machineChoisie.textContent = choix;
        }

        function selectionMachine(choix) {
            // machineChoisie = document.getElementById('machineChoisie');
            text_option = choix.options[choix.selectedIndex].text;
            document.getElementById('donnes_profi').style.display = "block";
            document.getElementById('donnes_premax').style.display = "block";
            document.getElementById('prix_profi').style.display = "block";
            document.getElementById('prix_premax').style.display = "block";
            document.getElementById('produit_profi').style.display = "block";
            document.getElementById('produit_premax').style.display = "block";

            if (text_option == '-C20' || text_option == '-C25' || text_option == '-CHP' || text_option == '-FHP' || text_option.includes('CONTACTEZ HOBART')) {
                machineChoisie.textContent = 'Aucun produit choisi';
            } else {
                machineChoisie.textContent = text_option;
            }
            
            if (choix.value == 1) {
                document.getElementById('donnes_premax').style.display = "none";
                document.getElementById('prix_premax').style.display = "none";
                document.getElementById('produit_premax').style.display = "none";
            } else {
                document.getElementById('donnes_profi').style.display = "none";
                document.getElementById('prix_profi').style.display = "none";
                document.getElementById('produit_profi').style.display = "none";
            }
        }
    </script>
</head>

<body>
    <?php
    // require_once('../wp-load.php');

    // $posts = $wpdb->get_results("SELECT ID, post_title, post_content FROM $wpdb->posts WHERE post_title = 'GC-10B'");

    // Echo the title of the first scheduled post
    // echo $posts[0]->post_title;
    // echo "<pre>"; print_r($posts); echo "<pre>";
    ?>
    <section class="outil_be">

        <form action="" method="get">
            <div>
                <!-- Type d'établissement -->
                <div id="section-1">
                    <h5 class="">Type d'établissement</h5>
                </div>
                <div id="select-1" class="champ_outil">
                    <label for="select-1-label">QUEL EST LE TYPE D'ETABLISSEMENT ?</label><select id="select-1" name="typeDetablissement" data-placeholder="" tabindex="0" onchange="affichageElement(this.value)">
                        <option value=""></option>
                        <option id="HOPITAL-PATIENT" value="HOPITAL-PATIENT"> HOPITAL PATIENT </option>
                        <option id="HOPITAL-SELF" value="HOPITAL-SELF"> HOPITAL SELF </option>
                        <option id="COLLEGE" value="COLLEGE">COLLEGE</option>
                        <option id="LYCEE" value="LYCEE">LYCEE</option>
                        <option id="UNIVERSITE" value="UNIVERSITE"> UNIVERSITE </option>
                        <option id="ENTREPRISE" value="ENTREPRISE"> ENTREPRISE </option>
                    </select>
                </div>
                <div id="select-2" class="champ_outil">
                    <label for="select-2-label">QUEL EST LE PLATEAU TYPE</label><select id="plateauType" name="plateauType" data-placeholder="" tabindex="0">
                        <option value="1"></option>
                        <option id="PLATEAU-1" value="2"> PLATEAU-1 </option>
                        <option id="PLATEAU-2" value="3"> PLATEAU-2 </option>
                        <option id="PLATEAU-3" value="4"> PLATEAU-3 </option>
                        <option id="PLATEAU-4" value="5"> PLATEAU-4 </option>
                        <option id="PLATEAU-5" value="6"> PLATEAU-5 </option>
                    </select>
                </div>
                <div id="select-3" class="champ_outil">
                    <label for="select-3-label">JE LAVE LES PLATEAUX EN DIFFERE OU SUR UNE MACHINE SPECIFIQUE
                        ?</label><select id="plateauxEnDiffere" name="plateauxEnDiffere" data-placeholder="" tabindex="0">
                        <option value=""></option>
                        <option value="1">NON</option>
                        <option value="2">OUI</option>
                    </select>
                </div>
                <div id="select-11" class="champ_outil">
                    <label for="select-11-label">JE LAVE LES VERRES EN DIFFERE OU SUR UNE MACHINE SPECIFIQUE
                        ?</label><select id="verresEnDiffere" name="verresEnDiffere" data-placeholder="" tabindex="0">
                        <option value=""></option>
                        <option value="1">NON</option>
                        <option value="2">OUI</option>
                    </select>
                </div>
                <div id="select-12" class="champ_outil">
                    <label for="select-12-label">JE LAVE LES COUVERTS EN DIFFERE OU SUR UNE MACHINE SPECIFIQUE
                        ?</label><select id="couvertsEnDiffere" name="couvertsEnDiffere" data-placeholder="" tabindex="0">
                        <option value=""></option>
                        <option value="1">NON</option>
                        <option value="2">OUI</option>
                    </select>
                </div>
                <!-- Type d'établissement -->

                <!-- Determination de la pointe -->
                <div id="section-2">
                    <h5 class="">Determination de la pointe</h5>
                </div>
                <div id="text-1" class="champ_outil">
                    <label for="">NOMBRE DE COUVERTS SUR LE SERVICE LE PLUS FORT ?</label><input id="nbCouverts" type="number" name="nbCouverts" value="950" onchange="calculPointe()" maxlength="4" />
                </div>
                <div id="text-2" class="champ_outil">
                    <label for="">DUREE DU SERVICE ?</label><input id="duree" type="number" name="duree" value="90" onchange="calculPointe()" maxlength="4" />
                </div>
                <div id="select-6" class="champ_outil">
                    <label for="select-6-label">ESTIMATION DU NOMBRE DE CONVIVES SUR L'HEURE DE POINTE ?</label><select id="nbconvives" name="nbconvives" data-placeholder="" tabindex="0" onchange="calculPointe()">
                        <option value="50">50%</option>
                        <option value="55">55%</option>
                        <option value="60">60%</option>
                        <option value="65">65%</option>
                        <option value="70">70%</option>
                        <option value="75">75%</option>
                        <option value="80">80%</option>
                        <option value="85">85%</option>
                        <option value="90">90%</option>
                        <option value="95">95%</option>
                        <option value="100">100%</option>
                    </select>
                </div>
                <div class="champ_outil">
                    <label for="calculation-1-field">NOMBRE DE COUVERTS SUR L'HEURE DE POINTE</label>
                    <input name="nbCouvertsSurHeureDePointe" id="nbCouvertsSurHeureDePointe" />
                </div>
                <!-- Determination de la pointe -->
                <!-- Mon type de machine -->
                <div id="section-3">
                    <h5 class="">Mon type de machine</h5>
                </div>
                <div id="select-8" class="champ_outil">
                    <label for="select-8-label">JE PRECONISE UNE MACHINE : A CASIERS / A CONVOYEUR ?</label><select id="select-8" name="select-8" data-placeholder="" tabindex="0" onchange="calculdebit(this.value)">
                        <option value="Selectionner">
                            Selectionner
                        </option>
                        <option value="1">MACHINE A AVANCEMENT AUTOMATIQUE DES CASIERS</option>
                        <option value="2">MACHINE A AVANCEMENT AUTOMATIQUE A CONVOYEUR A DOIGTS</option>
                    </select>
                </div>
                <div id="select-7" class="champ_outil">
                    <label for="select-7-label">JE PRECONISE UNE POMPE A CHALEUR ?</label><select id="select-7" name="select-7" data-placeholder="" tabindex="0">
                        <option value="Oui">Oui</option>
                        <option value="Non">Non</option>
                    </select>
                </div>
                <!-- Mon type de machine -->

                <!-- Faire le choix -->
                <div>
                    <button type="submit" class="validation">
                        Valider
                    </button>
                </div>

        </form>

        <!-- Faire le choix -->
        <div id="section-4">
            <h5 class="">
                Le choix entre le mieux ou le meilleur ?
            </h5>
        </div>
        <!-- table de choix -->
        <div class="champ_outil">
            <table class="choix">
                <tr>
                    <td></td>
                    <td>LE MIEUX</td>
                    <td></td>
                    <td>LE MEILLEUR</td>
                </tr>
                <tr>
                    <td></td>
                    <td class="profi">PROFI</td>
                    <td></td>
                    <td class="premax">PREMAX</td>
                </tr>
                <tr>
                    <td class="mesures">DEBIT NECESSAIRE DE LA MACHINE SELON DIN 10510 ET 10534</td>
                    <td colspan="3"><span id="debit"></span> <span id="casiers_metres"></span></td>
                </tr>
                <tr>
                    <td class="mesures">REFERENCE DE LA MACHINE HOBART</td>
                    <td class="profi">FI-GGV-VGV</td>
                    <td></td>
                    <td class="premax">CS-GGV-VGV</td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td>VITESSE DIN</td>
                    <td></td>
                </tr>
                <tr>
                    <td class="mesures">CAPACITES EN CASIERS PAR HEURE SELON DIN 10510 ET 10534</td>
                    <td>215</td>
                    <td></td>
                    <td>554</td>
                </tr>
                <tr>
                    <td class="mesures">LONGUEUR DE LA MACHINE ENTRE TABLES ?</td>
                    <td>242</td>
                    <td>(en mm)</td>
                    <td>224</td>
                </tr>
            </table>
        </div>

        <!-- table de choix -->
        <div id="select-9" class="champ_outil">
            <label for="select-9-label"> JE SELECTIONNE LA MACHINE ?</label><select id="select-9" name="select-9" data-placeholder="" tabindex="0" onchange="selectionMachine(this.value)">
                <option value="choix-1">FI-GGV-VGV</option>
                <option value="choix-2">CS-GGV-VGV</option>
            </select>
        </div>

        <!-- Le prix -->
        <div id="section-9">
            <div>
                <h5 class="">J'AI MON PRIX ?</h5>
            </div>
        </div>
        <div id="calculation-10" class="champ_outil">
            <div>
                <label for="calculation-10-field">PRIX TARIF ?</label>
                <span id="tarif_produit"> </span>
            </div>
        </div>
        <!-- Le prix -->
        <!-- Je choisis mon plan -->
        <div id="section-10">
            <div>
                <h5 class="">JE CHOISIS MON PLAN ?</h5>
            </div>
        </div>
        <div class="champ_outil">
            <div>
                <h4><a href=""><span id="machineChoisie"> </span></a></h4>
            </div>
        </div>
        <!-- Je choisis mon plan -->


        <div id="section-11" class="champ_outil">
            <div>
                <h5 class="">DONNEES TECHNIQUES</h5>
            </div>
            <!-- DONNES TECHNIQUES -->
            <div>
                <table class="donnees_techniques">
                    <tr class="titre_tableau">
                        <td>LONGUEUR MACHINE AVEC TUNNEL DE SECHAGE</td>
                        <td> 3 600 </td>
                        <td>mm </td>
                    </tr>
                    <tr class="titre_tableau">
                        <td>PERFORMANCES</td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>VITESSE 1</td>
                        <td>120,2</td>
                        <td>Casiers par heure</td>
                    </tr>
                    <tr>
                        <td>VITESSE 2</td>
                        <td>180</td>
                        <td>Casiers par heure</td>
                    </tr>
                    <tr>
                        <td>VITESSE 3</td>
                        <td>250</td>
                        <td>Casiers par heure</td>
                    </tr>
                    <tr class="titre_tableau">
                        <td>ELECTRICITE</td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>PUISSANCE INSTALLEE</td>
                        <td>120,2</td>
                        <td>kw</td>
                    </tr>
                    <tr>
                        <td>PUISSANCE CONSOMMEE</td>
                        <td>180</td>
                        <td>kW/h</td>
                    </tr>
                    <tr class="titre_tableau">
                        <td>FLUIDES</td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>CONSOMMATION HORAIRE EAU FROIDE ADOUCIE 5-7°TH</td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>VITESSE 1</td>
                        <td>120,2</td>
                        <td>litres par heure</td>
                    </tr>
                    <tr>
                        <td>VITESSE 2</td>
                        <td>180</td>
                        <td>litres par heure</td>
                    </tr>
                    <tr>
                        <td>VITESSE 3</td>
                        <td>250</td>
                        <td>litres par heure</td>
                    </tr>
                    <tr>
                        <td>REMPLISSAGE EAU CHAUDE ADOUCIE 5-7°TH</td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr class="titre_tableau">
                        <td>EXTRACTION</td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>DEBIT REJETE</td>
                        <td>120,2</td>
                        <td>m3 par heure</td>
                    </tr>
                    <tr>
                        <td>TEMPERATURE DE REJET</td>
                        <td>180</td>
                        <td>°C</td>
                    </tr>
                    <tr>
                        <td>HUMIDITE RELATIVE</td>
                        <td>250</td>
                        <td>%</td>
                    </tr>
                    <tr>
                        <td>RATIO D'HUMIDITE</td>
                        <td>0,30</td>
                        <td>litres par heure</td>
                    </tr>
                    <tr class="titre_tableau">
                        <td>DEGAGEMENT CALORIFIQUE</td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>CHALEUR SENSIBLE (kW)</td>
                        <td>0,30</td>
                        <td>kw</td>
                    </tr>
                    <tr>
                        <td>CHALEUR LATENTE (kW)</td>
                        <td>0,30</td>
                        <td>kw</td>
                    </tr>
                    <tr>
                        <td>VAISELLE (kW)</td>
                        <td>0,30</td>
                        <td>kw</td>
                    </tr>
                </table>
            </div>
            <!-- DONNES TECHNIQUES -->
        </div>
    </section>
</body>

</html>