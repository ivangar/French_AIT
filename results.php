<?php require_once("../lib/php/program_results.php"); 

if(isset($_POST) && (!empty($_POST))){

	//Create a test results instance
	$results = new TestEvaluation();

	$data = $_POST; //contains number of questions and program section id
	$results->Set_Program($data);
	$results->Set_Tests($data);

 	//call method to get final assessment
	if($results->Get_Final_Evaluation()){
		$results->Get_Assessment();
	} 

	//Get pretest answers
  $results->Get_Pretest_Answers();

  $results->Get_Postest_Answers();


	// close database connection 
	mysqli_close($results->con);

}
?>
<script type="text/javascript">
    /*$.noConflict();*/
    $(document).ready(function () {

      $( ".accred_reqs" ).click(function() {
          var target = $(this).attr( "title" );
          window.parent.showTab(target);
      });

    });//end document.ready
</script>
<div id="intro">
<h2 style="margin:0 0 15px 0;">Immunothérapie allergénique : <br>Une mise à jour pour les médecins de soins primaires</h2><h2 style="margin:0 0 15px 0;">Post-test:</h2>
<h3 style="line-height:25px;">Merci d’avoir complété le post-test de ce programme. Pour voir vos certificats et un résumé des exigences d'agrément non satisfaites, <span class="accred_reqs" title="tab11">cliquez ici.</span>
</h3>
<hr/>
</div>
<div id="assessment"><?php echo $results->assessment; ?>
</div>
<div class="question"><p>1. Dans les cas de rhinite allergique de classe I, quelle est la première mesure de prise en charge recommandée dans les lignes directrices canadiennes? </p>
</div>
<div class="choices">
<span class="valid_answer">a) Éviction de l'allergène/irritant </span></br>
b) Antihistaminique oral non sédatif</br>
c) Corticostéroïde intranasal </br>
d) Antagoniste des récepteurs des leucotriènes</br>
e) Aucune de ces réponses</br>
</div>
<div class="results">
Votre réponse du pré-test est: <?php echo $results->pretest_answers[0]; ?></br>Votre réponse du post-test est : <?php echo $results->postest_answers[0]; ?>
</div>
<div class="question">
<p>2. La vaste majorité des réactions générales à l'immunothérapie allergénique sous-cutanée surviennent : </p>
</div>
<div class="choices">
a) dans les 5 minutes suivant l'injection</br>
b) dans les 15 minutes suivant l'injection</br>
<span class="valid_answer">c) dans les 30 minutes suivant l'injection</span></br>
d) de 30 à 45 minutes après l'injection </br>
e) plus de 45 minutes après l'injection</br>
</div>
<div class="results">
Votre réponse du pré-test est: <?php echo $results->pretest_answers[1]; ?></br>Votre réponse du post-test est : <?php echo $results->postest_answers[1]; ?>
</div>      

<div class="question">
<p>3. Il a été démontré que l'effet clinique d'un comprimé d'immunothérapie sublinguale à base de pollen de graminées se maintient : </p>
</div>
<div class="choices">
a) pendant un maximum de 3 mois</br>
b) pendant un maximum de 12 mois </br>
<span class="valid_answer">c) 2 ans </span></br>
d) 5 ans </br>
</div>
<div class="results">
Votre réponse du pré-test est: <?php echo $results->pretest_answers[2]; ?></br>Votre réponse du post-test est : <?php echo $results->postest_answers[2]; ?>
</div>  

<div class="question">
<p>4. Le premier comprimé d'immunothérapie sublinguale doit être : </p>
</div>
<div class="choices">
a) pris par le patient à la maison</br>
b) in the office/clinic with no need for an observation period.</br>
c) administré au cabinet/à la clinique, suivi d'une période d'observation d'au moins 10 minutes </br>
<span class="valid_answer">d) administré au cabinet/à la clinique, suivi d'une période d'observation d'au moins 30 minutes </span> </br>
e) administré uniquement dans une clinique spécialisée dans les allergies</br>
</div>
<div class="results">
Votre réponse du pré-test est: <?php echo $results->pretest_answers[3]; ?></br>Votre réponse du post-test est : <?php echo $results->postest_answers[3]; ?>
</div>  

<div class="question">
<p>5. Comparativement à l'immunothérapie allergénique sous-cutanée, l'immunothérapie allergénique par comprimé sublingual : </p>
</div>
<div class="choices">
a) s'est révélée aussi efficace dans les études contrôlées, avec un risque égal d'anaphylaxie</br>
b) s'est révélée aussi efficace dans les études contrôlées, avec un risque plus élevé d'anaphylaxie </br>
<span class="valid_answer">c) s'est révélée aussi efficace dans les études contrôlées, avec un risque plus faible d'anaphylaxie</span></br>
d) s'est révélée plus efficace dans les études contrôlées, avec un risque égal d'anaphylaxie </br>
e) s'est révélée plus efficace dans les études contrôlées, avec un risque plus faible d'anaphylaxie</br>
f) s'est révélée moins efficace dans les études contrôlées, avec un risque plus élevé d'anaphylaxie</br>
</div>
<div class="results">
Votre réponse du pré-test est: <?php echo $results->pretest_answers[4]; ?></br>Votre réponse du post-test est : <?php echo $results->postest_answers[4]; ?>
</div>  

<div class="question">
<p>6. Les raisons de diriger un patient atteint de rhinite allergique vers un spécialiste comprennent :</p>
</div>
<div class="choices">
a) symptômes ne répondant pas adéquatement au traitement médical </br>
b) volonté de déterminer les allergènes déclencheurs afin de pouvoir les éviter  </br>
c) effets secondaires intolérables du traitement médical ou refus du patient de prendre un tel traitement</br>
d) évaluation de la pertinence de recourir à l'immunothérapie chez un patient </br>
<span class="valid_answer">e) toutes ces réponses</span></br>
f) b et d seulement</br>
g) aucune de ces réponses
</div>
<div class="results">
Votre réponse du pré-test est: <?php echo $results->pretest_answers[5]; ?></br>Votre réponse du post-test est : <?php echo $results->postest_answers[5]; ?>
</div>  