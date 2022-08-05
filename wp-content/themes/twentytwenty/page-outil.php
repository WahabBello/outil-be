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

<!-- Differents Function pour les calculs  -->
<?php

function round_up($value, $places = 0)
{
	if ($places < 0) {
		$places = 0;
	}
	$mult = pow(10, $places);
	return ceil($value * $mult) / $mult;
}

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

function references_machines()
{
	global $wpdb;
	// $mesures =  $_POST['type_mesures'];
	$machines = new stdClass;
	$valeur_debit =  calculdebit();

	$machines->profiCasiers = $wpdb->get_results("SELECT * FROM " . $wpdb->prefix . "reference_machine WHERE valeur_mesure<='$valeur_debit->casiers' AND gamme='PROFI' AND type_mesure='CASIERS' ORDER BY valeur_mesure DESC LIMIT 1");
	$machines->premaxCasiers = $wpdb->get_results("SELECT * FROM " . $wpdb->prefix . "reference_machine WHERE valeur_mesure<='$valeur_debit->casiers' AND gamme='PREMAX' AND type_mesure='CASIERS' ORDER BY valeur_mesure DESC LIMIT 1");

	$machines->profiMetres = $wpdb->get_results("SELECT * FROM " . $wpdb->prefix . "reference_machine WHERE valeur_mesure<='$valeur_debit->metres' AND gamme='PROFI' AND type_mesure='METRES' ORDER BY valeur_mesure DESC LIMIT 1");
	$machines->premaxMetres = $wpdb->get_results("SELECT * FROM " . $wpdb->prefix . "reference_machine WHERE valeur_mesure<='$valeur_debit->metres' AND gamme='PREMAX' AND type_mesure='METRES' ORDER BY valeur_mesure DESC LIMIT 1");

	return $machines;
}
// call the function

// echo "<pre>";
// print_r(calculdebit());
// print_r(references_machines());
// echo "<pre>";
?>
<!-- <pre> <?= var_dump(references_machines()) ?> </pre> -->

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
						<label for="select-1-label">QUEL EST LE TYPE D'ETABLISSEMENT ?</label><select id="select-1" name="typeDetablissement" data-placeholder="" onchange="affichageElement(this.value)">
							<option value=""></option>
							<option  <?= (isset($_POST['typeDetablissement']) && $_POST['typeDetablissement'] === 'HOPITAL-PATIENT') ? 'selected' : ''; ?> id="HOPITAL-PATIENT" value="HOPITAL-PATIENT"> HOPITAL PATIENT </option>
							<option  <?= (isset($_POST['typeDetablissement']) && $_POST['typeDetablissement'] === 'HOPITAL-SELF') ? 'selected' : ''; ?> id="HOPITAL-SELF" value="HOPITAL-SELF"> HOPITAL SELF </option>
							<option  <?= (isset($_POST['typeDetablissement']) && $_POST['typeDetablissement'] === 'COLLEGE') ? 'selected' : ''; ?> id="COLLEGE" value="COLLEGE">COLLEGE</option>
							<option  <?= (isset($_POST['typeDetablissement']) && $_POST['typeDetablissement'] === 'LYCEE') ? 'selected' : ''; ?> id="LYCEE" value="LYCEE">LYCEE</option>
							<option  <?= (isset($_POST['typeDetablissement']) && $_POST['typeDetablissement'] === 'UNIVERSITE') ? 'selected' : ''; ?> id="UNIVERSITE" value="UNIVERSITE"> UNIVERSITE </option>
							<option  <?= (isset($_POST['typeDetablissement']) && $_POST['typeDetablissement'] === 'ENTREPRISE') ? 'selected' : ''; ?> id="ENTREPRISE" value="ENTREPRISE"> ENTREPRISE </option>
						</select>
					</div>
					<div id="select-2" class="champ_outil">
						<label for="select-2-label">QUEL EST LE PLATEAU TYPE</label><select id="plateauType" name="plateauType" data-placeholder="">
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
							?</label><select id="plateauxEnDiffere" name="plateauxEnDiffere" data-placeholder="">
							<option value="1" <?= (isset($_POST['plateauxEnDiffere']) && $_POST['plateauxEnDiffere'] === '1') ? 'selected' : ''; ?>>NON</option>
							<option value="2" <?= (isset($_POST['plateauxEnDiffere']) && $_POST['plateauxEnDiffere'] === '2') ? 'selected' : ''; ?>>OUI</option>
						</select>
					</div>
					<div id="select-11" class="champ_outil">
						<label for="select-11-label">JE LAVE LES VERRES EN DIFFERE OU SUR UNE MACHINE SPECIFIQUE
							?</label><select id="verresEnDiffere" name="verresEnDiffere" data-placeholder="">
							<option value="1" <?= (isset($_POST['verresEnDiffere']) && $_POST['verresEnDiffere'] === '1') ? 'selected' : ''; ?>>NON</option>
							<option value="2" <?= (isset($_POST['verresEnDiffere']) && $_POST['verresEnDiffere'] === '2') ? 'selected' : ''; ?>>OUI</option>
						</select>
					</div>
					<div id="select-12" class="champ_outil">
						<label for="select-12-label">JE LAVE LES COUVERTS EN DIFFERE OU SUR UNE MACHINE SPECIFIQUE
							?</label><select id="couvertsEnDiffere" name="couvertsEnDiffere" data-placeholder="">
							<option value="1" <?= (isset($_POST['couvertsEnDiffere']) && $_POST['couvertsEnDiffere'] === '1') ? 'selected' : ''; ?>>NON</option>
							<option value="2" <?= (isset($_POST['couvertsEnDiffere']) && $_POST['couvertsEnDiffere'] === '2') ? 'selected' : ''; ?>>OUI</option>
						</select>
					</div>
					<!-- Type d'établissement -->

					<!-- Determination de la pointe -->
					<div id="section-2">
						<h5 class="">Determination de la pointe</h5>
					</div>
					<div id="text-1" class="champ_outil">
						<label for="">NOMBRE DE COUVERTS SUR LE SERVICE LE PLUS FORT ?</label>
						<input id="nbCouverts" type="number" name="nbCouverts" 
						value="<?= $_POST['nbCouverts'] ?? '950'; ?>" 
						onchange="calculPointe()" maxlength="4" />
					</div>
					<div id="text-2" class="champ_outil">
						<label for="">DUREE DU SERVICE ?</label><input id="duree" type="number" name="duree" 
						value="<?= $_POST['duree'] ?? '90'; ?>" onchange="calculPointe()" maxlength="4" />
					</div>
					<div id="select-6" class="champ_outil">
						<label for="select-6-label">ESTIMATION DU NOMBRE DE CONVIVES SUR L'HEURE DE POINTE ?</label><select id="nbconvives" name="nbconvives" data-placeholder="" onchange="calculPointe()">
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
					<!-- Determination de la pointe -->
					<!-- Mon type de machine -->
					<div id="section-3">
						<h5 class="">Mon type de machine</h5>
					</div>
					<div id="type_mesures" class="champ_outil">
						<label for="type_mesures-label">JE PRECONISE UNE MACHINE : A CASIERS / A CONVOYEUR ?</label><select id="type_mesures" name="type_mesures" data-placeholder="">
							<option value="1" <?= (isset($_POST['type_mesures']) && $_POST['type_mesures'] === '1') ? 'selected' : ''; ?>>MACHINE A AVANCEMENT AUTOMATIQUE DES CASIERS</option>
							<option value="2" <?= (isset($_POST['type_mesures']) && $_POST['type_mesures'] === '2') ? 'selected' : ''; ?>>MACHINE A AVANCEMENT AUTOMATIQUE A CONVOYEUR A DOIGTS</option>
						</select>
					</div>
					<div id="select-7" class="champ_outil">
						<label for="select-7-label">JE PRECONISE UNE POMPE A CHALEUR ?</label><select id="pompeAChaleur" name="pompeAChaleur" data-placeholder="">
							<option value="1" <?= (isset($_POST['pompeAChaleur']) && $_POST['pompeAChaleur'] === '1') ? 'selected' : ''; ?>>Non</option>
							<option value="2" <?= (isset($_POST['pompeAChaleur']) && $_POST['pompeAChaleur'] === '2') ? 'selected' : ''; ?>>Oui</option>
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
		</section>

		<section id="affichage" class="affichage">
			<!-- Faire le choix -->
			<div id="section-4">
				<h5 class="">
					Le choix entre le mieux ou le meilleur ?
				</h5>
			</div>
			<!-- <pre> <?= var_dump($_GET) ?> </pre>
			<pre> <?= var_dump($_POST) ?> </pre> -->
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
							<?= ($_POST['type_mesures'] == 2) ? references_machines()->profiMetres[0]->type_machine : references_machines()->profiCasiers[0]->type_machine ?>
						</td>
						<td></td>
						<td class="premax">
							<?= ($_POST['type_mesures'] == 2) ? references_machines()->premaxMetres[0]->type_machine : references_machines()->premaxCasiers[0]->type_machine ?>
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
						<td> <?= ($_POST['type_mesures'] == 2) ? references_machines()->profiMetres[0]->vitesse2 : references_machines()->profiCasiers[0]->vitesse2 ?> </td>
						<td></td>
						<td> <?= ($_POST['type_mesures'] == 2) ? references_machines()->premaxMetres[0]->vitesse2 : references_machines()->premaxCasiers[0]->vitesse2 ?> </td>
					</tr>
					<tr>
						<td class="mesures"> <?= ($_POST['type_mesures'] == 1) ? "LONGUEUR DE LA MACHINE ENTRE TABLES ?" : "LONGUEUR DE LA MACHINE" ?></td>
						<td> <?= ($_POST['type_mesures'] == 2) ? references_machines()->profiMetres[0]->longueur_machine : references_machines()->profiCasiers[0]->longueur_machine ?> </td>
						<td class="unite_mesures">(en mm)</td>
						<td> <?= ($_POST['type_mesures'] == 2) ? references_machines()->premaxMetres[0]->longueur_machine : references_machines()->premaxCasiers[0]->longueur_machine ?> </td>
					</tr>
				</table>
			</div>

			<!-- table de choix -->
			<div id="selectionMachine" class="champ_outil">
				<label for="selectionMachine-label"> JE SELECTIONNE LA MACHINE ?</label><select id="selectionMachine" name="selectionMachine" onchange="selectionMachine(this.value)">
				<?php
					$profiMetres = references_machines()->profiMetres[0]->type_machine;
					$premaxMetres = references_machines()->premaxMetres[0]->type_machine;
					$profiCasiers = references_machines()->profiCasiers[0]->type_machine;
					$premaxCasiers = references_machines()->premaxCasiers[0]->type_machine;
					if ($_POST['type_mesures'] == 2) {
				?>
					<option value="<?= $profiMetres ?>"> <?= $profiMetres ?> </option>
					<option value="<?= $premaxMetres ?>"> <?= $premaxMetres ?> </option>
				<?php
					} else {
				?>
					<option value="<?= $profiCasiers ?>"> <?= $profiCasiers ?> </option>
					<option value="<?= $premaxCasiers ?>"> <?= $premaxCasiers ?> </option>								
				<?php
					}
				?>
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
					<label for="calculation-10-field">198 948 $</label>
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
					<h4><a href="http://localhost/wordpress/produit/"><span id="machineChoisie"> <?= ($_POST['type_mesures'] == 2) ? $profiMetres : $profiCasiers ?> </span></a></h4>
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

	</section>

</main><!-- #site-content -->

<!-- <?php get_template_part('template-parts/footer-menus-widgets'); ?> -->

<?php get_footer(); ?>