<?php 
//REQUIRE FIREPHP AND INITIALIZE OBJECT
require_once($_SERVER['DOCUMENT_ROOT'] . '/FirePHPCore/FirePHP.class.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/FirePHPCore/fb.php');
session_start();
ob_start(); // Turn on output buffering. From this point output is stored in an internal buffer 
require_once('../../inc/php/membersite_config.php');
require_once("../lib/php/program.php"); 

if(isset($_COOKIE['rememberme']) && !empty($_COOKIE['rememberme']) ){
	$fgmembersite->CheckCookie();
}

//If the user has not logged in, restrict access
if(!$fgmembersite->CheckLogin())
{
	$fgmembersite->RedirectToURL(SCRIPT_ROOT . "/AccessDeny/deny_access.html");
	exit;
}

//if user wants to logout
if(isset($_POST['logout_submitted']))
{
	$fgmembersite->LogOut();
}


//Create a Programs instances
$FrenchProgram = new Program();

//----------------DEFINE PERMANENT VARIABLES FOR THIS PROGRAM-----------------------//

$program_id_fr = 'AIT_01_FR';   //Program ID
$pretestId = 'AIT_Pre_01';  //program_section_id that belongs to the specific program pretest from program_sections table
$posttestId = 'AIT_Post_01';  //program_section_id that belongs to the specific program post test from program_sections table
$forum_id = 'AIT_Forum_01';  //program_section_id that belongs to the specific program forum from program_sections table
$evaluation_id = 'AIT_Eval_01';  //program evaluation
$evaluation_id_fr = 'AIT_Eval_01_FR';  //program evaluation
$certificate_id = 'M_Pro_01';	//Certificate id that belongs to a program
$certificate_id_fr = 'FMOQ_01_FR';	//Certificate id that belongs to a program
$topicIds = array("AIT_topic_04", "AIT_topic_05", "AIT_topic_06", "AIT_topic_07", "AIT_topic_08", "AIT_topic_09", "AIT_topic_10", "AIT_topic_11", "AIT_topic_12", "AIT_topic_13");  //Array of forum topic ids for this program
$sections = array("pretest", "postTest", "forum");  //These are required sections to obtain certificate
$no_sections = sizeof($sections);

//----------------DEFINE PERMANENT VARIABLES FOR THIS PROGRAM-----------------------//

$program_status = false;		//This will check the program_status field in the doctor profile
$program_completed = false;	  //This boolean value is used to allow to display the hidden certificate link if all 3 sections are complete
$sections_status = array();  //This array will hold the state of each program section whenever the page is loaded and reloaded
$no_sections_completed = 0;

$FrenchProgram->Set_Program($program_id_fr, $pretestId, $posttestId, $forum_id, $evaluation_id_fr, $certificate_id_fr);

//Check that a record having this program ID for this doctor ID exists in doctor_profiles table. 
//If not Insert a new record with the certificate id defined, program_status = 0, date of completion = NULL and time required Null
//NOTE: The doctor_profiles record will be updated once each program section is submitted

if(!$FrenchProgram->CheckProfileExists()){

	$FrenchProgram->CreateProfile(); //Create empty French profile
}

$program_status = $FrenchProgram->CheckProgramStatus();  //First check in the doctor profile to see if the program status is completed.
$FrenchProgram->GetSectionsStatus();	//Allways get the sections status regardles of program completion.
$sections_status = $FrenchProgram->sections_status;		//Allways set the section status array (will hold sections status every time user visits program)

if($program_status){
	$program_completed = true;
	$no_sections_completed = $no_sections;
}

//if program has not been completed in the profile check sections one by one everytime the program page is reloaded
if(!$program_status){

	//if all $no_sections sections are completed update profile with completed
	if($FrenchProgram->CheckSectionsCompleted()){
		$FrenchProgram->UpdateProfile($date_of_completion);  //call UpdateProfile to insert program_status = 1, date of completion = NOW()
		$program_completed = true;
		$no_sections_completed = $no_sections;
	}
}


//This will display program progress status
if($no_sections_completed !== $no_sections){
    	foreach($sections_status as $section => $status)
    	{
    		if((strcmp($section,'evaluation') == 0) || (strcmp($section,'forum') == 0)) break;

    		elseif($status)
        	$no_sections_completed++;
    	}
}


if( !isset($_SESSION['arrow_box'])){ $_SESSION['arrow_box'] = true; }

// close connection 
mysqli_close($FrenchProgram->con);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<META HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE">
<META HTTP-EQUIV="PRAGMA" CONTENT="NO-CACHE">
<title>dxLink - Allergen Immunotherapy</title> 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js" type="text/javascript"></script>
<script src="<?= SCRIPT_ROOT ?>/SpryAssets/SpryMenuBar.js" type="text/javascript"></script>
<link href="<?= SCRIPT_ROOT ?>/css/styles.css" rel="stylesheet" type="text/css" />
<link href="<?= SCRIPT_ROOT ?>/SpryAssets/SpryMenuBarHorizontal.css" rel="stylesheet" type="text/css" />
<link type="text/css" rel="stylesheet" href="<?= SCRIPT_ROOT ?>/css/form-submit-button.css"/>
<link type="text/css" rel="stylesheet" href="<?= SCRIPT_ROOT ?>/css/tabStyles.css"/>
<link type="text/css" rel="stylesheet" href="<?= SCRIPT_ROOT ?>/css/Pretest/form.css"/>
<link type="text/css" rel="stylesheet" href="<?= SCRIPT_ROOT ?>/css/Pretest/nova.css" />
<link type="text/css" rel="stylesheet" href="../css/program_styles.css" />
<script type="text/javascript" src="<?= SCRIPT_ROOT ?>/js/parsley.js"></script>
<script type="text/javascript" src="<?= SCRIPT_ROOT ?>/browser/bowser.min.js"></script>
<script type="text/javascript" src="<?= SCRIPT_ROOT ?>/js/hashchange.js"></script>
<script type="text/javascript" src="<?= SCRIPT_ROOT ?>/js/tabScript.js"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
<script type="text/javascript" src="js/program.js"></script>
<script src="<?= SCRIPT_ROOT ?>/js/jquery.blockUI.js"></script>
<script type="text/javascript">
	var showTip = <?php if($_SESSION['arrow_box']) {echo "true"; $_SESSION['arrow_box'] = false;} else echo "false";?>;	
</script>

<style>
.ui-tooltip {
background: #f6f6f6;
border: 2px solid #969696;

}
.ui-tooltip {
border-radius: 10px;
box-shadow: 0 0 7px black;
font-family:Arial,Helvetica,sans-serif;
font-size:16px;
font-style: italic;
padding: 10px 20px;
}

.slides_qty{
font-family:Arial,Helvetica,sans-serif;
font-size:12px;
line-height: 10px;
}

#v-nav > ul > li{
	font-size: 1em;
}
</style>
</head>
<body class="gradient">
<div class="arrow_box" style="display:none;"> 
	<p>Utilisez les flèches pour<br/>naviguer dans le programme</p>
</div> 
<table class="content" border="0" cellspacing="0">
  <tr valign="bottom">
    <td width="250" height="90" align="left" bgcolor="#FFFFFF" style="padding:0 0 10px 20px;" ><a href="<?= SCRIPT_ROOT ?>/fr/index.php"><img src="/images/dxLinkAP.jpg" width="147" height="42" align="left" alt="dxlink"/></a>
	</td>
	<td bgcolor="#FFFFFF" style="padding:0 0 5px 0;" align="right">
		<div style="display: inline-block;"><?php $fgmembersite->printLogout(); ?></div>
	</td>
  </tr>
</table>
<table class="content" border="0" cellspacing="0">
  <tr valign="bottom">
	  <td style="padding:0 0 5px 0;"><img src="/images/bannerPA.jpg" align="left" alt="Accredited Programs" width="1000px;"/>
	  </td>
  </tr>
</table>
<!-- NAV BAR TABLE -->
<table class="content" border="0" cellspacing="0">
  <tr align="center" valign="top">
    <td height="30" style="padding:0;background:#3B0CAF;">
		<ul id="MenuBar1" class="MenuBarHorizontal">
	      <li><a href="<?= SCRIPT_ROOT ?>/fr/index.php" class="accredited">Accueil</a></li>
	      <li><a href="" class="MenuBarItemSubmenu accredited">Programmes</a>
	        <ul>
          		<li><a href="<?= SCRIPT_ROOT ?>/fr/accredited_programs.php" class="accredited">Programmes agréés</a></li>
          		<li><a href="<?= SCRIPT_ROOT ?>/fr/virtual_clinic.php" class="accredited">Clinique virtuelle</a></li>
          		<li> <a href="<?= SCRIPT_ROOT ?>/fr/congress_reports.php" class="accredited">Rapports de congrès</a></li>
          		<li><a href="<?= SCRIPT_ROOT ?>/fr/clinical_update.php" class="accredited">Mise à jour clinique</a></li>
	        </ul>
	      </li>
	      <li><a href="<?= SCRIPT_ROOT ?>/fr/account.php" class="accredited">Mon profil</a></li>
	      <li><a href="<?= SCRIPT_ROOT ?>/fr/contactez-nous.php" class="accredited">Contactez-nous</a></li>
	  	  <li><a href="http://www.cjdiagnosis.com/?ac=diagnosis" target="_blank" class="accredited">CJ Diagnosis</a></li>
	  	  <li><a href="http://www.cjcme.com//?ac=cme" target="_blank" class="accredited">CJ CME</a></li>
	  	  <li class="last"><a href="http://www.stacommunications.com/" target="_blank" class="accredited">STA HealthCare Communications</a></li>
	    </ul>
	</td>
  </tr>
  </table>
  <!-- NAV BAR ENDS HERE -->
   <!-- INNER 3-COLUMN STYLE TABLE  -->
  <table class="three-columns" border="0" cellspacing="0">
	<tr>   
  	 <td style="padding: 0 0 0 920px;">
  		<div id="counter"><span id="ARslide_no"></span><span id="SCITslide_no"></span><span id="SLITslide_no"></span><span id="AFPslide_no"></span><span class='count' title="page"></span>
  		</div>
	 </td>  	
  	</tr>
  <tr valign="top">
	  <!-- LEFT VERTICAL TABBED SECTION -->
		  <td style="padding: 10px 0 0 0;">
	          <section id="wrapper" class="wrapper">
	              <div id="v-nav">
	              	<!--  THIS LIST WAS USED FOR WHEN THE PROGRAM WAS ACCREDITED
	              		SEE MODIFIED LIST BELOW!!
					  <ul>
	                      <li tab="tab1" class="first current" >Introduction</li>
	                      <li tab="tab2" > Soutien commercial </li>
	                      <li tab="tab3" >Pré-test</li>
	                      <li tab="tab4" >Description de la rhinite allergique<br/><span class="slides_qty">(8 diapositives)</span></li>
	                      <li tab="tab5" >Immunothérapie sous-cutanée<br/><span class="slides_qty">(10 diapositives)</span></li>
						  <li tab="tab6" >Comprimé d’immunothérapie sublingual<br/><span class="slides_qty">(30 diapositives)</span></li>
						  <li tab="tab7" >Approche dans la pratique de médecine familiale<br/><span class="slides_qty">(11 diapositives)</span></li>
						  <li tab="tab8" >Forum de discussion</li>
						  <li tab="tab9" >Post-test</li>
	                      <li tab="tab10" >Questionnaire d'évaluation</li>
	                      <li tab="tab11" class="last">Agrément</li>

					  </ul>
					  <div class="tab-content" >
	                  	<?php //require_once('introduction.html'); ?>  
	                  </div>
	                  <div class="tab-content" >
	                  	<?php //require_once('soutien_commercial.html'); ?>  
	                  </div>
	                  <div class="tab-content" >
	                  		<?php //require_once('pretest.html'); ?>  
	                  </div>
	                  <div class="tab-content" id="AR_section">
	                  		<?php //require_once('AR/AIT_AR_slide_1.html'); ?>
	                  </div>
	                  <div class="tab-content" id="SCIT_section">
	                        <?php //require_once('SCIT/AIT_SCIT_slide_1.html'); ?> 
	                  </div>
	                  <div class="tab-content" id="SLIT_section">
	                        <?php //require_once('SLIT/AIT_SLIT_slide_1.html'); ?>     
	                  </div>
	                  <div class="tab-content" id="AFP_section">
	                  	<?php //require_once('AFP/AIT_AFP_slide_1.html'); ?>           
	                  </div>
	                  <div class="tab-content">
	                      <?php //require_once('forum.php'); ?>           
	                  </div>
	                  <div class="tab-content" id="post_test_section" >
	                  	<?php //require_once('postest.html'); ?> 
	                  </div>
	                  <div class="tab-content" >
	                  	<?php //require_once('evaluation.html'); ?> 
	                  </div>
	                  <div class="tab-content" >
	                  	<?php //require_once('accreditation.html'); ?> 
	                  </div>
					  END OF ORIGINAL ACCREDITED LIST-->
					  <ul>
	                      <li tab="tab1" class="first current" >Introduction</li>
	                      <li tab="tab2" > Soutien commercial </li>
	                      <li tab="tab3" >Description de la rhinite allergique<br/><span class="slides_qty">(8 diapositives)</span></li>
	                      <li tab="tab4" >Immunothérapie sous-cutanée<br/><span class="slides_qty">(10 diapositives)</span></li>
						  <li tab="tab5" >Comprimé d’immunothérapie sublingual<br/><span class="slides_qty">(30 diapositives)</span></li>
						  <li tab="tab6" >Approche dans la pratique de médecine familiale<br/><span class="slides_qty">(11 diapositives)</span></li>
	                      <li tab="tab7" >Questionnaire d'évaluation</li>
					  </ul>
	                  <div class="tab-content" >
	                  	<?php require_once('introduction.html'); ?>  
	                  </div>
	                  <div class="tab-content" >
	                  	<?php require_once('soutien_commercial.html'); ?>  
	                  </div>
	                  <div class="tab-content" id="AR_section">
	                  		<?php require_once('AR/AIT_AR_slide_1.html'); ?>
	                  </div>
	                  <div class="tab-content" id="SCIT_section">
	                        <?php require_once('SCIT/AIT_SCIT_slide_1.html'); ?> 
	                  </div>
	                  <div class="tab-content" id="SLIT_section">
	                        <?php require_once('SLIT/AIT_SLIT_slide_1.html'); ?>     
	                  </div>
	                  <div class="tab-content" id="AFP_section">
	                  	<?php require_once('AFP/AIT_AFP_slide_1.html'); ?>           
	                  </div>

	                  <div class="tab-content" >
	                  	<?php require_once('evaluation.html'); ?> 
	                  </div>

	              </div>
	          </section>
  	</td>
  </tr>
</table>
  <!-- END INNER 3-COLUMN TABLE  -->
  <table class="content" border="0" cellspacing="0">
  <tr>
    <td  height="35" colspan="3" valign="top" bgcolor="#FFFFFF" align="center">
   </td>
  </tr>
 </table>
  <!-- FOOTER TABLE -->
  <table class="content" border="0" cellspacing="0">
  <tr>
    <td style="padding:20px 50px 0 20px;display:inline-block;" height="65" valign="bottom" bgcolor="#FFFFFF" align="center">
		<? $fgmembersite->printCopyright(); ?>   
    </td>
    <td style="padding:0 0 10px 400px;display:inline-block;" valign="bottom" bgcolor="#FFFFFF" align="center">  
    	<? $fgmembersite->printTermsConditions(); ?>
   </td>
  </tr>
</table>
<script type="text/javascript">
var MenuBar1 = new Spry.Widget.MenuBar("MenuBar1");
</script>
</body>
</html>
<?php ob_flush(); //This function will send the contents of the output buffer ?>