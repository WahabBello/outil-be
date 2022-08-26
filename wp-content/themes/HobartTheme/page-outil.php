<?php

/**
 * 
 *  Template Name: Outil BE
 * 
 * The template for displaying single posts and pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */
get_header();
?>

<!-- Differents fonction pour les calculs  -->
<?php

// Arrondir un chiffre decimal comme la fonction excel ARRONDI.SUP() Ex: round_up(12,341, 2) = 12,35 (au lieu de 12,34)
function round_up($value, $places = 0)
{
	if ($places < 0) {
		$places = 0;
	}
	$mult = pow(10, $places);
	return ceil($value * $mult) / $mult;
}

// Calcul du debit necessaire de la machine soit en metres/min ou en casiers/h
function calculdebit()
{
	global $wpdb;
	$typePlateaux =  $_POST['plateauType'];
	$lavagePlateaux = ($_POST['plateauxEnDiffere'] == 1) ? 100 : 200;
	$lavageVerres = ($_POST['verresEnDiffere'] == 2) ? 300 : 100;
	$lavageCouverts = ($_POST['couvertsEnDiffere'] == 2) ? 2000 : 1000;
	$mesures =  $_POST['type_mesures'];
	$nbCouvertsSurHeureDePointe =  $_POST['nbCouvertsSurHeureDePointe'];
	$resultat = new stdClass;

	$somme = $typePlateaux + $lavagePlateaux + $lavageVerres + $lavageCouverts;
	$data = $wpdb->get_results("SELECT * FROM " . $wpdb->prefix . "casiers_metres WHERE ligne_cn_entier='$somme'");

	$resultat->metres = round_up(($nbCouvertsSurHeureDePointe * $data[0]->ligne_ftstd_decimal / 60), 2);
	$resultat->casiers = round($nbCouvertsSurHeureDePointe * $data[0]->ligne_cn_decimal);

	return $resultat;
}

// Recherche des machines de profi et de premax correspondant au debit calculé dans la fonction précedente calculdebit()
function referencesMachines()
{
	global $wpdb;
	$mesures =  $_POST['type_mesures'];
	$machines = new stdClass;
	$valeur_debit =  calculdebit();

	if (isset($_POST['submit'])) {
		if ($mesures == 1) {
			$machines->profiCasiers = $wpdb->get_results("SELECT * FROM " . $wpdb->prefix . "reference_machine WHERE valeur_mesure<='$valeur_debit->casiers' AND gamme='PROFI' AND type_mesure='CASIERS' ORDER BY valeur_mesure DESC LIMIT 1");
			$machines->premaxCasiers = $wpdb->get_results("SELECT * FROM " . $wpdb->prefix . "reference_machine WHERE valeur_mesure<='$valeur_debit->casiers' AND gamme='PREMAX' AND type_mesure='CASIERS' ORDER BY valeur_mesure DESC LIMIT 1");
			$machines->profi = $machines->profiCasiers;
			$machines->premax = $machines->premaxCasiers;
		} else {
			$machines->profiMetres = $wpdb->get_results("SELECT * FROM " . $wpdb->prefix . "reference_machine WHERE valeur_mesure<='$valeur_debit->metres' AND gamme='PROFI' AND type_mesure='METRES' ORDER BY valeur_mesure DESC LIMIT 1");
			$machines->premaxMetres = $wpdb->get_results("SELECT * FROM " . $wpdb->prefix . "reference_machine WHERE valeur_mesure<='$valeur_debit->metres' AND gamme='PREMAX' AND type_mesure='METRES' ORDER BY valeur_mesure DESC LIMIT 1");
			$machines->profi = $machines->profiMetres;
			$machines->premax = $machines->premaxMetres;
		}
	}

	return $machines;
}

// Affichage des machines profi et premax selon son type de mesure et avec ou sans pompe a chaleur dans l'input de selection
function choixProduit()
{
	$produits = new stdClass;

	$profiMetres = referencesMachines()->profiMetres[0]->type_machine;
	$premaxMetres = referencesMachines()->premaxMetres[0]->type_machine;
	$profiCasiers = referencesMachines()->profiCasiers[0]->type_machine;
	$premaxCasiers = referencesMachines()->premaxCasiers[0]->type_machine;
	$profiMetresAvecouSansPompes =  $_POST['pompeAChaleur'] === '1' ? $profiMetres . '-C25' : $profiMetres . '-FHP';
	$premaxMetresAvecouSansPompes =  $_POST['pompeAChaleur'] === '1' ? $premaxMetres . '-C25' : $premaxMetres . '-FHP';
	$profiCasiersAvecouSansPompes =  $_POST['pompeAChaleur'] === '1' ? $profiCasiers . '-C20' : $profiCasiers . '-CHP';
	$premaxCasiersAvecouSansPompes =  $_POST['pompeAChaleur'] === '1' ?  $premaxCasiers . '-C20' :  $premaxCasiers . '-CHP';

	if ($_POST['type_mesures'] == 2) {
		$produits->profi = $profiMetresAvecouSansPompes;
		$produits->premax = $premaxMetresAvecouSansPompes;
	} else {
		$produits->profi = $profiCasiersAvecouSansPompes;
		$produits->premax = $premaxCasiersAvecouSansPompes;
	}

	return $produits;
}

// Requette pour afficher les données techniques et le prix du produit choisi 
function dooneesProduit()
{
	global $wpdb;
	$produits = new stdClass;
	$profi = choixProduit()->profi;
	$premax = choixProduit()->premax;

	$produits->profi =  $wpdb->get_results("SELECT * FROM " . $wpdb->prefix . "donnees_techniques WHERE reference='$profi'");
	$produits->premax =  $wpdb->get_results("SELECT * FROM " . $wpdb->prefix . "donnees_techniques WHERE reference='$premax'");


	return $produits;
}

// Requête pour chercher le lien correspondant au produit exact dans la table wp_posts
function produitPost()
{
	global $wpdb;
	$produits = new stdClass;
	$profi = choixProduit()->profi;
	$premax = choixProduit()->premax;

	$produits->profi =  $wpdb->get_results("SELECT * FROM " . $wpdb->prefix . "posts WHERE post_title='$profi'");
	$produits->premax =  $wpdb->get_results("SELECT * FROM " . $wpdb->prefix . "posts WHERE post_title='$premax'");

	return $produits;
}

// echo "<pre>";
// print_r(calculdebit());
// print_r(referencesMachines());
// echo "<pre>";
?>
<!-- <pre> <?= var_dump(referencesMachines()) ?> </pre>
<pre> <?= var_dump(choixProduit()) ?> </pre>
<pre> <?= var_dump(dooneesProduit()) ?> </pre>
<pre> <?= var_dump(produitPost()) ?> </pre> -->


<main id="site-content">

	<section class="outil_be">
		<section class="formulaire">
			<form action="#affichage" method="POST">
				<div>
					<!-- Type d'établissement -->
					<div id="section-1">
						<h5 class="">Type d'établissement</h5>
					</div>
					<div id="select-1" class="champ_outil">
						<label for="select-1-label">QUEL EST LE TYPE D'ETABLISSEMENT ?</label><select id="select-1" name="typeDetablissement" onchange="affichageElement(this.value)">
							<option value=""></option>
							<option <?= (isset($_POST['typeDetablissement']) && $_POST['typeDetablissement'] === 'HOPITAL-PATIENT') ? 'selected' : ''; ?> id="HOPITAL-PATIENT" value="HOPITAL-PATIENT"> HOPITAL PATIENT </option>
							<option <?= (isset($_POST['typeDetablissement']) && $_POST['typeDetablissement'] === 'HOPITAL-SELF') ? 'selected' : ''; ?> id="HOPITAL-SELF" value="HOPITAL-SELF"> HOPITAL SELF </option>
							<option <?= (isset($_POST['typeDetablissement']) && $_POST['typeDetablissement'] === 'COLLEGE') ? 'selected' : ''; ?> id="COLLEGE" value="COLLEGE">COLLEGE</option>
							<option <?= (isset($_POST['typeDetablissement']) && $_POST['typeDetablissement'] === 'LYCEE') ? 'selected' : ''; ?> id="LYCEE" value="LYCEE">LYCEE</option>
							<option <?= (isset($_POST['typeDetablissement']) && $_POST['typeDetablissement'] === 'UNIVERSITE') ? 'selected' : ''; ?> id="UNIVERSITE" value="UNIVERSITE"> UNIVERSITE </option>
							<option <?= (isset($_POST['typeDetablissement']) && $_POST['typeDetablissement'] === 'ENTREPRISE') ? 'selected' : ''; ?> id="ENTREPRISE" value="ENTREPRISE"> ENTREPRISE </option>
						</select>
					</div>
					<div id="select-2" class="champ_outil">
						<label for="select-2-label">QUEL EST LE PLATEAU TYPE</label><select id="plateauType" name="plateauType">
							<option value="1"></option>
							<option id="PLATEAU-1" value="2" <?= (isset($_POST['plateauType']) && $_POST['plateauType'] === '2') ? 'selected' : ''; ?>> PLATEAU-1 </option>
							<option id="PLATEAU-2" value="3" <?= (isset($_POST['plateauType']) && $_POST['plateauType'] === '3') ? 'selected' : ''; ?>> PLATEAU-2 </option>
							<option id="PLATEAU-3" value="4" <?= (isset($_POST['plateauType']) && $_POST['plateauType'] === '4') ? 'selected' : ''; ?>> PLATEAU-3 </option>
							<option id="PLATEAU-4" value="5" <?= (isset($_POST['plateauType']) && $_POST['plateauType'] === '5') ? 'selected' : ''; ?>> PLATEAU-4 </option>
							<option id="PLATEAU-5" value="6" <?= (isset($_POST['plateauType']) && $_POST['plateauType'] === '6') ? 'selected' : ''; ?>> PLATEAU-5 </option>
						</select>
					</div>
					<div id="select-3" class="champ_outil">
						<label for="select-3-label">JE LAVE LES PLATEAUX EN DIFFERE OU SUR UNE MACHINE SPECIFIQUE
							?</label><select id="plateauxEnDiffere" name="plateauxEnDiffere">
							<option value="1" <?= (isset($_POST['plateauxEnDiffere']) && $_POST['plateauxEnDiffere'] === '1') ? 'selected' : ''; ?>>NON</option>
							<option value="2" <?= (isset($_POST['plateauxEnDiffere']) && $_POST['plateauxEnDiffere'] === '2') ? 'selected' : ''; ?>>OUI</option>
						</select>
					</div>
					<div id="select-11" class="champ_outil">
						<label for="select-11-label">JE LAVE LES VERRES EN DIFFERE OU SUR UNE MACHINE SPECIFIQUE
							?</label><select id="verresEnDiffere" name="verresEnDiffere">
							<option value="1" <?= (isset($_POST['verresEnDiffere']) && $_POST['verresEnDiffere'] === '1') ? 'selected' : ''; ?>>NON</option>
							<option value="2" <?= (isset($_POST['verresEnDiffere']) && $_POST['verresEnDiffere'] === '2') ? 'selected' : ''; ?>>OUI</option>
						</select>
					</div>
					<div id="select-12" class="champ_outil">
						<label for="select-12-label">JE LAVE LES COUVERTS EN DIFFERE OU SUR UNE MACHINE SPECIFIQUE
							?</label><select id="couvertsEnDiffere" name="couvertsEnDiffere">
							<option value="1" <?= (isset($_POST['couvertsEnDiffere']) && $_POST['couvertsEnDiffere'] === '1') ? 'selected' : ''; ?>>NON</option>
							<option value="2" <?= (isset($_POST['couvertsEnDiffere']) && $_POST['couvertsEnDiffere'] === '2') ? 'selected' : ''; ?>>OUI</option>
						</select>
					</div>

					<!-- Determination de la pointe -->
					<div id="section-2">
						<h5 class="">Determination de la pointe</h5>
					</div>
					<div id="text-1" class="champ_outil">
						<label for="">NOMBRE DE COUVERTS SUR LE SERVICE LE PLUS FORT ?</label>
						<input id="nbCouverts" type="number" name="nbCouverts" value="<?= $_POST['nbCouverts'] ?? '950'; ?>" onchange="calculPointe()" maxlength="4" />
					</div>
					<div id="text-2" class="champ_outil">
						<label for="">DUREE DU SERVICE ?</label><input id="duree" type="number" name="duree" value="<?= $_POST['duree'] ?? '90'; ?>" onchange="calculPointe()" maxlength="4" />
					</div>
					<div id="select-6" class="champ_outil">
						<label for="select-6-label">ESTIMATION DU NOMBRE DE CONVIVES SUR L'HEURE DE POINTE ?</label><select id="nbconvives" name="nbconvives" onchange="calculPointe()">
							<option value="50" <?= (isset($_POST['nbconvives']) && $_POST['nbconvives'] === '50') ? 'selected' : ''; ?>>50%</option>
							<option value="55" <?= (isset($_POST['nbconvives']) && $_POST['nbconvives'] === '55') ? 'selected' : ''; ?>>55%</option>
							<option value="60" <?= (isset($_POST['nbconvives']) && $_POST['nbconvives'] === '60') ? 'selected' : ''; ?>>60%</option>
							<option value="65" <?= (isset($_POST['nbconvives']) && $_POST['nbconvives'] === '65') ? 'selected' : ''; ?>>65%</option>
							<option value="70" <?= (isset($_POST['nbconvives']) && $_POST['nbconvives'] === '70') ? 'selected' : ''; ?>>70%</option>
							<option value="75" <?= (isset($_POST['nbconvives']) && $_POST['nbconvives'] === '75') ? 'selected' : ''; ?>>75%</option>
							<option value="80" <?= (isset($_POST['nbconvives']) && $_POST['nbconvives'] === '80') ? 'selected' : ''; ?>>80%</option>
							<option value="85" <?= (isset($_POST['nbconvives']) && $_POST['nbconvives'] === '85') ? 'selected' : ''; ?>>85%</option>
							<option value="90" <?= (isset($_POST['nbconvives']) && $_POST['nbconvives'] === '90') ? 'selected' : ''; ?>>90%</option>
							<option value="95" <?= (isset($_POST['nbconvives']) && $_POST['nbconvives'] === '95') ? 'selected' : ''; ?>>95%</option>
							<option value="100" <?= (isset($_POST['nbconvives']) && $_POST['nbconvives'] === '100') ? 'selected' : ''; ?>>100%</option>
						</select>
					</div>
					<div class="champ_outil">
						<label for="calculation-1-field">NOMBRE DE COUVERTS SUR L'HEURE DE POINTE</label>
						<input name="nbCouvertsSurHeureDePointe" id="nbCouvertsSurHeureDePointe" value="<?= $_POST['nbCouvertsSurHeureDePointe'] ?? '665'; ?>" />
					</div>
					<!-- Mon type de machine -->
					<div id="section-3">
						<h5 class="">Mon type de machine</h5>
					</div>
					<div id="type_mesures" class="champ_outil">
						<label for="type_mesures-label">JE PRECONISE UNE MACHINE : A CASIERS / A CONVOYEUR ?</label><select id="type_mesures" name="type_mesures">
							<option value="1" <?= (isset($_POST['type_mesures']) && $_POST['type_mesures'] === '1') ? 'selected' : ''; ?>>MACHINE A AVANCEMENT AUTOMATIQUE DES CASIERS</option>
							<option value="2" <?= (isset($_POST['type_mesures']) && $_POST['type_mesures'] === '2') ? 'selected' : ''; ?>>MACHINE A AVANCEMENT AUTOMATIQUE A CONVOYEUR A DOIGTS</option>
						</select>
					</div>
					<div id="select-7" class="champ_outil">
						<label for="select-7-label">JE PRECONISE UNE POMPE A CHALEUR ?</label><select id="pompeAChaleur" name="pompeAChaleur">
							<option value="1" <?= (isset($_POST['pompeAChaleur']) && $_POST['pompeAChaleur'] === '1') ? 'selected' : ''; ?>>Non</option>
							<option value="2" <?= (isset($_POST['pompeAChaleur']) && $_POST['pompeAChaleur'] === '2') ? 'selected' : ''; ?>>Oui</option>
						</select>
					</div>

					<!-- Faire le choix -->
					<div>
						<button type="submit" name="submit" class="validation">
							Valider
						</button>
					</div>
			</form>
		</section>

		<section id="affichage" class="affichage">
			<div id="section-4">
				<h5 class="">
					Le choix entre le mieux ou le meilleur ?
				</h5>
			</div>
			<!-- table de choix -->
			<div class="champ_outil">
				<table class="choix">
					<tr class="entete_table">
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
						<td class="mesures debit_cellule">DEBIT NECESSAIRE DE LA MACHINE SELON DIN 10510 ET 10534</td>
						<td colspan="3">
							<span id="debit" class="unite_mesures"> <?= ($_POST['type_mesures'] == 2) ? calculdebit()->metres : calculdebit()->casiers ?> </span>
							<span id="casiers_metres"> <?= ($_POST['type_mesures'] == 1) ? "CASIERS/H." : "METRES/MIN." ?> </span>
						</td>
					</tr>
					<tr>
						<td class="mesures">REFERENCE DE LA MACHINE HOBART</td>
						<td class="profi">
							<?= referencesMachines()->profi[0]->type_machine ?>
						</td>
						<td></td>
						<td class="premax">
							<?= referencesMachines()->premax[0]->type_machine ?>
						</td>
					</tr>
					<tr>
						<td></td>
						<td></td>
						<td class="entete_table">VITESSE DIN</td>
						<td></td>
					</tr>
					<tr>
						<td class="mesures"> <?= ($_POST['type_mesures'] == 1) ? "CAPACITES EN CASIERS PAR HEURE SELON DIN 10510 ET 10534" : "CAPACITES EN METRES PAR MINUTES SELON DIN 10510 ET 10534" ?> </td>
						<td> <?= isset($_POST['submit']) ? referencesMachines()->profi[0]->vitesse2 : '0' ?> </td>
						<td></td>
						<td> <?= isset($_POST['submit']) ? referencesMachines()->premax[0]->vitesse2 : '0' ?> </td>
					</tr>
					<tr>
						<td class="mesures"> <?= ($_POST['type_mesures'] == 1) ? "LONGUEUR DE LA MACHINE ENTRE TABLES ?" : "LONGUEUR DE LA MACHINE" ?></td>
						<td> <?= isset($_POST['submit']) ? number_format(referencesMachines()->profi[0]->longueur_machine, 0, ',', ' ') : '0' ?> </td>
						<td class="unite_mesures">(en mm)</td>
						<td> <?= isset($_POST['submit']) ? number_format(referencesMachines()->premax[0]->longueur_machine, 0, ',', ' ') : '0' ?> </td>
					</tr>
				</table>
			</div>
			<!-- table de choix -->

			<div id="selectionMachine" class="champ_outil">
				<label for="selectionMachine-label"> JE SELECTIONNE LA MACHINE ?</label><select id="selectionMachine" name="selectionMachine" onchange="selectionMachine(this)">
					<?php if (isset($_POST['submit'])) { ?>
						<option value="1"> <?= choixProduit()->profi ?> </option>
						<option value="2"> <?= choixProduit()->premax ?> </option>
					<?php } ?>
				</select>
			</div>

			<!-- Le prix -->
			<div id="section-9">
				<div>
					<h5 class="">J'AI MON PRIX ?</h5>
				</div>
			</div>
			<div class="prix_produits champ_outil">
				<div id="prix_profi">
					<label for="calculation-10-field"> <?= number_format(dooneesProduit()->profi[0]->prix, 0, ',', ' ') ?> €</label>
				</div>
				<div id="prix_premax">
					<label for="calculation-10-field"> <?= number_format(dooneesProduit()->premax[0]->prix, 0, ',', ' ') ?> €</label>
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
				<div id="produit_profi">
					<h4><a href="../produit/<?= produitPost()->profi[0]->post_title ?>"><span id="machineChoisie"> <?= produitPost()->profi[0]->post_title ?> </span></a></h4>
				</div>
				<div id="produit_premax">
					<h4><a href="../produit/<?= produitPost()->premax[0]->post_title ?>"><span id="machineChoisie"> <?= produitPost()->premax[0]->post_title ?> </span></a></h4>
				</div>
			</div>
			<!-- Je choisis mon plan -->


			<div id="donnes_profi" class="champ_outil">
				<div>
					<h5 class="">DONNEES TECHNIQUES</h5>
				</div>
				<!-- DONNES TECHNIQUES -->
				<div>
					<table class="donnees_techniques">
						<tr class="titre_tableau">
							<td>LONGUEUR MACHINE AVEC TUNNEL DE SECHAGE</td>
							<td> <?= number_format(dooneesProduit()->profi[0]->longueur_machine_ts, 0, ',', ' ') ?> </td>
							<td>mm </td>
						</tr>
						<tr class="titre_tableau">
							<td>PERFORMANCES</td>
							<td></td>
							<td></td>
						</tr>
						<tr>
							<td>VITESSE 1</td>
							<td> <?= dooneesProduit()->profi[0]->vitesse_transport1 ?> </td>
							<td>Casiers par heure</td>
						</tr>
						<tr>
							<td>VITESSE 2</td>
							<td> <?= dooneesProduit()->profi[0]->vitesse_transport2 ?> </td>
							<td>Casiers par heure</td>
						</tr>
						<tr>
							<td>VITESSE 3</td>
							<td> <?= dooneesProduit()->profi[0]->vitesse_transport3 ?> </td>
							<td>Casiers par heure</td>
						</tr>
						<tr class="titre_tableau">
							<td>ELECTRICITE</td>
							<td></td>
							<td></td>
						</tr>
						<tr>
							<td>PUISSANCE INSTALLEE</td>
							<td> <?= dooneesProduit()->profi[0]->puissance_installe ?> </td>
							<td>kw</td>
						</tr>
						<tr>
							<td>PUISSANCE CONSOMMEE</td>
							<td> <?= dooneesProduit()->profi[0]->puissance_consommee ?> </td>
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
							<td> <?= dooneesProduit()->profi[0]->vitesse_debit1 ?> </td>
							<td>litres par heure</td>
						</tr>
						<tr>
							<td>VITESSE 2</td>
							<td> <?= dooneesProduit()->profi[0]->vitesse_debit2 ?> </td>
							<td>litres par heure</td>
						</tr>
						<tr>
							<td>VITESSE 3</td>
							<td> <?= dooneesProduit()->profi[0]->vitesse_debit3 ?> </td>
							<td>litres par heure</td>
						</tr>
						<tr>
							<td>REMPLISSAGE EAU CHAUDE ADOUCIE 5-7°TH</td>
							<td> <?= dooneesProduit()->profi[0]->remplissage_eau_chaude ?> </td>
							<td>litres</td>
						</tr>
						<tr class="titre_tableau">
							<td>EXTRACTION</td>
							<td></td>
							<td></td>
						</tr>
						<tr>
							<td>DEBIT REJETE</td>
							<td> <?= dooneesProduit()->profi[0]->debit_rejete ?> </td>
							<td>m3 par heure</td>
						</tr>
						<tr>
							<td>TEMPERATURE DE REJET</td>
							<td> <?= dooneesProduit()->profi[0]->temperature_rejet ?> </td>
							<td>°C</td>
						</tr>
						<tr>
							<td>HUMIDITE RELATIVE</td>
							<td> <?= dooneesProduit()->profi[0]->humidite_relative ?> </td>
							<td>%</td>
						</tr>
						<tr>
							<td>RATIO D'HUMIDITE</td>
							<td> <?= dooneesProduit()->profi[0]->ratio_humidite ?> </td>
							<td>litres par heure</td>
						</tr>
						<tr class="titre_tableau">
							<td>DEGAGEMENT CALORIFIQUE</td>
							<td></td>
							<td></td>
						</tr>
						<tr>
							<td>CHALEUR SENSIBLE (kW)</td>
							<td> <?= dooneesProduit()->profi[0]->chaleur_sensible ?> </td>
							<td>kw</td>
						</tr>
						<tr>
							<td>CHALEUR LATENTE (kW)</td>
							<td> <?= dooneesProduit()->profi[0]->chaleur_latente ?> </td>
							<td>kw</td>
						</tr>
						<tr>
							<td>VAISELLE (kW)</td>
							<td> <?= dooneesProduit()->profi[0]->vaisselle ?> </td>
							<td>kw</td>
						</tr>
					</table>
				</div>
				<!-- DONNES TECHNIQUES -->
			</div>

			<div id="donnes_premax" class="champ_outil">
				<div>
					<h5 class="">DONNEES TECHNIQUES</h5>
				</div>
				<!-- DONNES TECHNIQUES -->
				<div>
					<table class="donnees_techniques">
						<tr class="titre_tableau">
							<td>LONGUEUR MACHINE AVEC TUNNEL DE SECHAGE</td>
							<td> <?= number_format(dooneesProduit()->premax[0]->longueur_machine_ts, 0, ',', ' ') ?> </td>
							<td>mm </td>
						</tr>
						<tr class="titre_tableau">
							<td>PERFORMANCES</td>
							<td></td>
							<td></td>
						</tr>
						<tr>
							<td>VITESSE 1</td>
							<td> <?= dooneesProduit()->premax[0]->vitesse_transport1 ?> </td>
							<td>Casiers par heure</td>
						</tr>
						<tr>
							<td>VITESSE 2</td>
							<td> <?= dooneesProduit()->premax[0]->vitesse_transport2 ?> </td>
							<td>Casiers par heure</td>
						</tr>
						<tr>
							<td>VITESSE 3</td>
							<td> <?= dooneesProduit()->premax[0]->vitesse_transport3 ?> </td>
							<td>Casiers par heure</td>
						</tr>
						<tr class="titre_tableau">
							<td>ELECTRICITE</td>
							<td></td>
							<td></td>
						</tr>
						<tr>
							<td>PUISSANCE INSTALLEE</td>
							<td> <?= dooneesProduit()->premax[0]->puissance_installe ?> </td>
							<td>kw</td>
						</tr>
						<tr>
							<td>PUISSANCE CONSOMMEE</td>
							<td> <?= dooneesProduit()->premax[0]->puissance_consommee ?> </td>
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
							<td> <?= dooneesProduit()->premax[0]->vitesse_debit1 ?> </td>
							<td>litres par heure</td>
						</tr>
						<tr>
							<td>VITESSE 2</td>
							<td> <?= dooneesProduit()->premax[0]->vitesse_debit2 ?> </td>
							<td>litres par heure</td>
						</tr>
						<tr>
							<td>VITESSE 3</td>
							<td> <?= dooneesProduit()->premax[0]->vitesse_debit3 ?> </td>
							<td>litres par heure</td>
						</tr>
						<tr>
							<td>REMPLISSAGE EAU CHAUDE ADOUCIE 5-7°TH</td>
							<td> <?= dooneesProduit()->premax[0]->remplissage_eau_chaude ?> </td>
							<td>litres</td>
						</tr>
						<tr class="titre_tableau">
							<td>EXTRACTION</td>
							<td></td>
							<td></td>
						</tr>
						<tr>
							<td>DEBIT REJETE</td>
							<td> <?= dooneesProduit()->premax[0]->debit_rejete ?> </td>
							<td>m3 par heure</td>
						</tr>
						<tr>
							<td>TEMPERATURE DE REJET</td>
							<td> <?= dooneesProduit()->premax[0]->temperature_rejet ?> </td>
							<td>°C</td>
						</tr>
						<tr>
							<td>HUMIDITE RELATIVE</td>
							<td> <?= dooneesProduit()->premax[0]->humidite_relative ?> </td>
							<td>%</td>
						</tr>
						<tr>
							<td>RATIO D'HUMIDITE</td>
							<td> <?= dooneesProduit()->premax[0]->ratio_humidite ?> </td>
							<td>litres par heure</td>
						</tr>
						<tr class="titre_tableau">
							<td>DEGAGEMENT CALORIFIQUE</td>
							<td></td>
							<td></td>
						</tr>
						<tr>
							<td>CHALEUR SENSIBLE (kW)</td>
							<td> <?= dooneesProduit()->premax[0]->chaleur_sensible ?> </td>
							<td>kw</td>
						</tr>
						<tr>
							<td>CHALEUR LATENTE (kW)</td>
							<td> <?= dooneesProduit()->premax[0]->chaleur_latente ?> </td>
							<td>kw</td>
						</tr>
						<tr>
							<td>VAISELLE (kW)</td>
							<td> <?= dooneesProduit()->premax[0]->vaisselle ?> </td>
							<td>kw</td>
						</tr>
					</table>
				</div>
				<!-- DONNES TECHNIQUES -->
			</div>
		</section>

	</section>

</main><!-- #site-content -->

<!-- <?php get_template_part('template-parts/footer-menus-widgets'); ?> -->

<?php get_footer(); ?>