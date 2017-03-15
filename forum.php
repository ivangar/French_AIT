
<script type="text/javascript">
    /*$.noConflict();*/
    $(document).ready(function () {

      //SETUP TOPIC VARIABLES DEFINED IN MAIN PROGRAM PAGE
      var topic1 = <?php if(isset($topicIds['0'])) {echo  " '$topicIds[0]' ";} else echo ''; ?>;
      var topic2 = <?php if(isset($topicIds['1'])) {echo  " '$topicIds[1]' ";} else echo ''; ?>;
      var topic3 = <?php if(isset($topicIds['2'])) {echo  " '$topicIds[2]' ";} else echo ''; ?>;
      var topic4 = <?php if(isset($topicIds['3'])) {echo  " '$topicIds[3]' ";} else echo ''; ?>;
      var topic5 = <?php if(isset($topicIds['4'])) {echo  " '$topicIds[4]' ";} else echo ''; ?>;
      var topic6 = <?php if(isset($topicIds['5'])) {echo  " '$topicIds[5]' ";} else echo ''; ?>;
      var topic7 = <?php if(isset($topicIds['6'])) {echo  " '$topicIds[6]' ";} else echo ''; ?>;
      var topic8 = <?php if(isset($topicIds['7'])) {echo  " '$topicIds[7]' ";} else echo ''; ?>;
      var topic9 = <?php if(isset($topicIds['8'])) {echo  " '$topicIds[8]' ";} else echo ''; ?>;
      var topic10 = <?php if(isset($topicIds['9'])) {echo  " '$topicIds[9]' ";} else echo ''; ?>;

       // Responds to click next previous section event
      $( "#prev_AFP_section, #next_post_test_section, .accred_reqs" ).click(function() {
          var target = ( $(this).attr( "class" ) === "accred_reqs" ) ? $(this).attr( "title" ) : $(this).attr( "alt" );
          window.parent.showTab(target);
      });

     //Make a general chain for toggle sections and switch the id of the clicked item.
      $( "#toggle_post_AIT_topic_04, #toggle_post_AIT_topic_05, #toggle_post_AIT_topic_06, #toggle_post_AIT_topic_07, #toggle_post_AIT_topic_08, #toggle_post_AIT_topic_09, #toggle_post_AIT_topic_10, #toggle_post_AIT_topic_11, #toggle_post_AIT_topic_12, #toggle_post_AIT_topic_13, #toggle_comments_AIT_topic_04, #toggle_comments_AIT_topic_05, #toggle_comments_AIT_topic_06, #toggle_comments_AIT_topic_07, #toggle_comments_AIT_topic_08, #toggle_comments_AIT_topic_09, #toggle_comments_AIT_topic_10, #toggle_comments_AIT_topic_11, #toggle_comments_AIT_topic_12, #toggle_comments_AIT_topic_13" ).click(function() {
         var clickedItem = $(this).attr( "id" );
         var toogleItem = '';
       
         switch (clickedItem)
         {
         case 'toggle_post_AIT_topic_04':
           toogleItem="#AIT_topic_04_form";
           break;
         case 'toggle_post_AIT_topic_05':
           toogleItem="#AIT_topic_05_form";
           break;
         case 'toggle_post_AIT_topic_06':
           toogleItem="#AIT_topic_06_form";
           break;
         case 'toggle_post_AIT_topic_07':
           toogleItem="#AIT_topic_07_form";
           break;
         case 'toggle_post_AIT_topic_08':
           toogleItem="#AIT_topic_08_form";
           break;
         case 'toggle_post_AIT_topic_09':
           toogleItem="#AIT_topic_09_form";
           break;
         case 'toggle_post_AIT_topic_10':
           toogleItem="#AIT_topic_10_form";
           break;
         case 'toggle_post_AIT_topic_11':
           toogleItem="#AIT_topic_11_form";
           break;    
         case 'toggle_post_AIT_topic_12':
           toogleItem="#AIT_topic_12_form";
           break;  
         case 'toggle_post_AIT_topic_13':
           toogleItem="#AIT_topic_13_form";
           break;                                    
         case 'toggle_comments_AIT_topic_04':
           toogleItem="#comments_AIT_topic_04";
           break;
         case 'toggle_comments_AIT_topic_05':
           toogleItem="#comments_AIT_topic_05";
           break;
         case 'toggle_comments_AIT_topic_06':
           toogleItem="#comments_AIT_topic_06";
           break;
         case 'toggle_comments_AIT_topic_07':
           toogleItem="#comments_AIT_topic_07";
           break;
         case 'toggle_comments_AIT_topic_08':
           toogleItem="#comments_AIT_topic_08";
           break;
         case 'toggle_comments_AIT_topic_09':
           toogleItem="#comments_AIT_topic_09";
           break; 
         case 'toggle_comments_AIT_topic_10':
           toogleItem="#comments_AIT_topic_10";
           break;  
         case 'toggle_comments_AIT_topic_11':
           toogleItem="#comments_AIT_topic_11";
           break;   
         case 'toggle_comments_AIT_topic_12':
           toogleItem="#comments_AIT_topic_12";
           break;   
         case 'toggle_comments_AIT_topic_13':
           toogleItem="#comments_AIT_topic_13";
           break;                                                  
         default:
           toogleItem="#AIT_topic_04_form, #AIT_topic_05_form, #AIT_topic_06_form, #comments_AIT_topic_04, #comments_AIT_topic_05, #comments_AIT_topic_06";
         }

          //Toggle the item
         $(toogleItem).toggle( "slow", function() {
         });

      });

      //Submit form listeners
     $( "#AIT_topic_04_form, #AIT_topic_05_form, #AIT_topic_06_form, #AIT_topic_07_form, #AIT_topic_08_form, #AIT_topic_09_form, #AIT_topic_10_form, #AIT_topic_11_form, #AIT_topic_12_form, #AIT_topic_13_form" ).submit(function( event ) {

          var submittedForm = $(this).attr( "id" );
          var comment = '';
          var topic = '';

          // customize Parsley errors class to append the errorwraper ul inside the container div specified
          $( '#' + submittedForm ).parsley( {
              errors: {
                  container: function (element) {
                      var $container = element.parent().find(".parsley-container");
                      if ($container.length === 0) {
                          $container = $("<div class='parsley-container forum'></div>").insertBefore(element);
                      }
                      return $container;
                  }
              }
          } );

          //since the form is submitted using jQuery event, bind the form with Parsley.
          var form_valid = $( '#' + submittedForm ).parsley( 'validate' );
          
          //prevent form submission if parsley returns false
          if ( !form_valid )
          {
              event.preventDefault();
          }
          
          else{

            //Swith the form that was submitted and set comment and topic id to be sent through Ajax
            switch (submittedForm)
            {
               case 'AIT_topic_04_form':
                 comment = $('textarea#comment_AIT_topic_04').val();
                 topic = topic1;
                 break;
                case 'AIT_topic_05_form':
                 comment = $('textarea#comment_AIT_topic_05').val();
                 topic = topic2;
                 break;
                case 'AIT_topic_06_form':
                 comment = $('textarea#comment_AIT_topic_06').val();
                 topic = topic3;
                 break;
                case 'AIT_topic_07_form':
                 comment = $('textarea#comment_AIT_topic_07').val();
                 topic = topic4;
                 break;
                case 'AIT_topic_08_form':
                 comment = $('textarea#comment_AIT_topic_08').val();
                 topic = topic5;
                 break;
                case 'AIT_topic_09_form':
                 comment = $('textarea#comment_AIT_topic_09').val();
                 topic = topic6;
                 break;   
                case 'AIT_topic_10_form':
                 comment = $('textarea#comment_AIT_topic_10').val();
                 topic = topic7;
                 break; 
                case 'AIT_topic_11_form':
                 comment = $('textarea#comment_AIT_topic_11').val();
                 topic = topic8;
                 break; 
                case 'AIT_topic_12_form':
                 comment = $('textarea#comment_AIT_topic_12').val();
                 topic = topic9;
                 break; 
                case 'AIT_topic_13_form':
                 comment = $('textarea#comment_AIT_topic_13').val();
                 topic = topic10;
                 break;                                                        
                default:
                 comment="";
                 topic="";
            }

          forum_submitted = { "topic":topic, "comment":comment, "submit_comment":1}; 
          target = "../lib/php/forum_topics.php";
          
          // make an ajax call to save answers in the database
          $.ajax({
              url: target,
              cache: false,
              type: "POST",
              dataType: "html",
              data: forum_submitted
            }) 

          .done(function( data ) {
          	  if (data === "posted"){
              		document.location.reload(true); //reload page in order to update access to post-test form
          	  }

          	  if (data === "failed"){
                    $( ".parsley-container" ).html( "<ul style='width:562px;font-weight:bold;'> <li>There was an error posting your comment. Try again. </li></ul>" );
                    $( ".parsley-container" ).show();
                    $("html, body").animate({
                          scrollTop: 0
                    }, 500);    
          	  }

          })
          .fail(function() {
                    $( ".parsley-container" ).html( "<ul style='width:562px;font-weight:bold;'> <li>There was an error posting your comment. Try again. </li></ul>" );
                    $( ".parsley-container" ).show();
                    $("html, body").animate({
                          scrollTop: 0
                    }, 500);    
          }); //ajax call
        
        }//end else
        
      	  event.preventDefault();

      }); //click function   


     /*--------------------------LOAD TOPIC 1-------------------------------------------------   */

     $("#AIT_topic_04").load("../lib/php/forum_topics.php?action=get_rows&topic_id=" + topic1);

      //This is called the first time the document loads
      $.get("../lib/php/forum_topics.php?action=row_count&topic_id=" + topic1, function(data) {
        $("#page_count_AIT_topic_04").val(Math.ceil(data / 10)); //Sets hidden input field with the number of pages (total rows/10)
        generateRows(1, topic1);
      });

      /*--------------------------LOAD TOPIC 2-------------------------------------------------   */

      $("#AIT_topic_05").load("../lib/php/forum_topics.php?action=get_rows&topic_id=" + topic2);

      //This is called the first time the document loads
      $.get("../lib/php/forum_topics.php?action=row_count&topic_id=" + topic2, function(data) {
        $("#page_count_AIT_topic_05").val(Math.ceil(data / 10)); //Sets hidden input field with the number of pages (total rows/10)
        generateRows(1, topic2);
      });

      /*--------------------------LOAD TOPIC 3-------------------------------------------------   */

      $("#AIT_topic_06").load("../lib/php/forum_topics.php?action=get_rows&topic_id=" + topic3);

      //This is called the first time the document loads
      $.get("../lib/php/forum_topics.php?action=row_count&topic_id=" + topic3, function(data) {
        $("#page_count_AIT_topic_06").val(Math.ceil(data / 10)); //Sets hidden input field with the number of pages (total rows/10)
        generateRows(1, topic3);
      });

      /*--------------------------LOAD TOPIC 4-------------------------------------------------   */

      $("#AIT_topic_07").load("../lib/php/forum_topics.php?action=get_rows&topic_id=" + topic4);

      //This is called the first time the document loads
      $.get("../lib/php/forum_topics.php?action=row_count&topic_id=" + topic4, function(data) {
        $("#page_count_AIT_topic_07").val(Math.ceil(data / 10)); //Sets hidden input field with the number of pages (total rows/10)
        generateRows(1, topic4);
      });

      /*--------------------------LOAD TOPIC 5-------------------------------------------------   */

      $("#AIT_topic_08").load("../lib/php/forum_topics.php?action=get_rows&topic_id=" + topic5);

      //This is called the first time the document loads
      $.get("../lib/php/forum_topics.php?action=row_count&topic_id=" + topic5, function(data) {
        $("#page_count_AIT_topic_08").val(Math.ceil(data / 10)); //Sets hidden input field with the number of pages (total rows/10)
        generateRows(1, topic5);
      });

      /*--------------------------LOAD TOPIC 6-------------------------------------------------   */

      $("#AIT_topic_09").load("../lib/php/forum_topics.php?action=get_rows&topic_id=" + topic6);

      //This is called the first time the document loads
      $.get("../lib/php/forum_topics.php?action=row_count&topic_id=" + topic6, function(data) {
        $("#page_count_AIT_topic_09").val(Math.ceil(data / 10)); //Sets hidden input field with the number of pages (total rows/10)
        generateRows(1, topic6);
      });

      /*--------------------------LOAD TOPIC 7-------------------------------------------------   */

      $("#AIT_topic_10").load("../lib/php/forum_topics.php?action=get_rows&topic_id=" + topic7);

      //This is called the first time the document loads
      $.get("../lib/php/forum_topics.php?action=row_count&topic_id=" + topic7, function(data) {
        $("#page_count_AIT_topic_10").val(Math.ceil(data / 10)); //Sets hidden input field with the number of pages (total rows/10)
        generateRows(1, topic7);
      });

      /*--------------------------LOAD TOPIC 8-------------------------------------------------   */

      $("#AIT_topic_11").load("../lib/php/forum_topics.php?action=get_rows&topic_id=" + topic8);

      //This is called the first time the document loads
      $.get("../lib/php/forum_topics.php?action=row_count&topic_id=" + topic8, function(data) {
        $("#page_count_AIT_topic_11").val(Math.ceil(data / 10)); //Sets hidden input field with the number of pages (total rows/10)
        generateRows(1, topic8);
      });

      /*--------------------------LOAD TOPIC 8-------------------------------------------------   */

      $("#AIT_topic_12").load("../lib/php/forum_topics.php?action=get_rows&topic_id=" + topic9);

      //This is called the first time the document loads
      $.get("../lib/php/forum_topics.php?action=row_count&topic_id=" + topic9, function(data) {
        $("#page_count_AIT_topic_12").val(Math.ceil(data / 10)); //Sets hidden input field with the number of pages (total rows/10)
        generateRows(1, topic9);
      });

      $("#AIT_topic_13").load("../lib/php/forum_topics.php?action=get_rows&topic_id=" + topic10);

      //This is called the first time the document loads
      $.get("../lib/php/forum_topics.php?action=row_count&topic_id=" + topic10, function(data) {
        $("#page_count_AIT_topic_13").val(Math.ceil(data / 10)); //Sets hidden input field with the number of pages (total rows/10)
        generateRows(1, topic10);
      });

  });//end document.ready

function generateRows(selected, topicId) {
  var pages = $("#page_count_" + topicId).val();  //number of pages in the hidden input field
  //selected is the field passed to this function (number of pages)
  
  if (pages <= 5) {
    //inserts all numbers after content
    $("#" + topicId).after("<div id='paginator_" + topicId + "'><ul class='pagor_group'><li class='pagor_" + topicId + " selected'>1</li><li class='pagor_" + topicId + "'>2</li><li  class='pagor_" + topicId + "'>3</li><li  class='pagor_" + topicId + "'>4</li><li  class='pagor_" + topicId + "'>5</li><div style='clear:both;'></div></ul></div>");
    //inserts rows based on the index of the number
    $(".pagor_" + topicId).click(function() {
      var index = $(".pagor_" + topicId).index(this);
      $("#" + topicId).load("../lib/php/forum_topics.php?action=get_rows&topic_id=" + topicId + "&start=" + index);
      $(".pagor_" + topicId).removeClass("selected");
      $(this).addClass("selected");
    });   
  } else {
    if (selected < 5) {  
      // Draw the first 5 then have ... link to last
      var pagers = "<div id='paginator_" + topicId + "'><ul class='pagor_group'>";
      for (i = 1; i <= 5; i++) {
        if (i == selected) {
          pagers += "<li class='pagor_" + topicId + " selected'>" + i + "</li>";
        } else {
          pagers += "<li class='pagor_" + topicId + "'>" + i + "</li>";
        }       
      }
      //last number should be 5 with ... before
      pagers += "<div style='float:left;padding-left:6px;padding-right:6px;'>...</div><li class='pagor_" + topicId + "'>" + Number(pages) + "</li><div style='clear:both;'></div></ul></div>";
      
      $("#paginator_" + topicId + "").remove();
      $("#" + topicId).after(pagers);
      $(".pagor_" + topicId).click(function(  ) {
        updatePage(this, topicId);
      });
    } else if (selected > (Number(pages) - 4)) {
      // Draw ... link to first then have the last 5
      var pagers = "<div id='paginator_" + topicId + "'><ul class='pagor_group'><li class='pagor_" + topicId + "'>1</li><div style='float:left;padding-left:6px;padding-right:6px;'>...</div>";
      for (i = (Number(pages) - 4); i <= Number(pages); i++) {
        if (i == selected) {
          pagers += "<li class='pagor_" + topicId + " selected'>" + i + "</li>";
        } else {
          pagers += "<li class='pagor_" + topicId + "'>" + i + "</li>";
        }       
      }     
      pagers += "<div style='clear:both;'></div></ul></div>";
      
      $("#paginator_" + topicId + "").remove();
      $("#" + topicId).after(pagers);
      $(".pagor_" + topicId).click(function( ) {
        updatePage(this, topicId);
      });   
    } else {
      // Draw the number 1 element, then draw ... 2 before and two after and ... link to last
      var pagers = "<div id='paginator_" + topicId + "'><ul class='pagor_group'><li class='pagor_" + topicId + "'>1</li><div style='float:left;padding-left:6px;padding-right:6px;'>...</div>";
      for (i = (Number(selected) - 2); i <= (Number(selected) + 2); i++) {
        if (i == selected) {
          pagers += "<li class='pagor_" + topicId + " selected'>" + i + "</li>";
        } else {
          pagers += "<li class='pagor_" + topicId + "'>" + i + "</li>";
        }
      }
      pagers += "<div style='float:left;padding-left:6px;padding-right:6px;'>...</div><li class='pagor_" + topicId + "'>" + pages + "</li><div style='clear:both;'></div></ul></div>";
      
      $("#paginator_" + topicId + "").remove();
      $("#" + topicId).after(pagers);
      $(".pagor_" + topicId).click(function( ) {
        updatePage(this, topicId);
      });     
    }
  }
}

function updatePage(elem, topicId) {
  // Retrieve the number stored and position elements based on that number
  var selected = $(elem).text();

  // First update 
  $("#" + topicId).load("../lib/php/forum_topics.php?action=get_rows&topic_id=" + topicId + "&start=" + (selected - 1));
  
  // Then update links
  generateRows(selected, topicId);
}
</script>
<table border="0" cellspacing="0">
<tr valign="top">
<td style="padding:0;width:620px;">
<div id="intro">
<h2 style="margin:0 0 15px 0;">Forum de discussion</h2>
<h3 style="line-height:25px;">Vous devez poster un commentaire sur au moins un sujet dans le forum de discussion de ce programme avant que l'agrément soit accordé et que votre certificat soit disponible. Pour voir vos certificats et un résumé des exigences d'agrément non satisfaites, <span class="accred_reqs" title="tab11">cliquez ici.</span>
</h3>
<hr/>
<?php if(isset($_SESSION['posted']) && $_SESSION['posted']) { echo "<h3 id='assessment'>Nous vous remercions de votre participation dans le forum de discussion de ce programme.</h3>"; unset($_SESSION['posted']); }?>
<div class="parsley-container" style="display:none;"> </div>
<div class="question forum" >
  <p>1) Quels sont les symptômes/effets les plus importants/incommodants signalés par vos patients atteints de rhinite allergique? Selon votre expérience, quels sont les moyens les plus efficaces pour maîtriser ces symptômes/effets? Quel symptôme/effet trouvez-vous le plus difficile à traiter adéquatement et pourquoi?</p>
</div>

<!-- THIS SECTION IS A TOGGLE -->
<div class="toggle" >
    <p id="toggle_post_AIT_topic_04" ><sub style="font-size:15px;">&#8618;</sub> Ajouter un commentaire</p> 
    <p id="toggle_comments_AIT_topic_04">&nbsp;&nbsp;<sub style="font-size:15px;">&#8618;</sub> Voir les commentaires </p>
</div>
<!-- THIS SECTION IS A TOGGLE -->

<!-- THIS SECTION IS A FORM -->
<form class="jotform-form" action="" method="POST" data-ajax="false" name="AIT_topic_04_form" id="AIT_topic_04_form" accept-charset="utf-8" style="display:none;">
  <div class="program_evaluation" style="width:600px;">
    <ul class="form-section">
      <li class="form-line" style="margin:0;padding:0;">
          <textarea class="form-textarea" name="comment" parsley-required="true" parsley-error-message="Veuillez entrer un commentaire (500 caractères maximum)" parsley-maxlength="500" id="comment_AIT_topic_04" rows="5" style="width: 600px;max-width: 600px;margin:0;padding:0;"></textarea>
          <div class="form-textarea-limit-indicator"><span class="comment_AIT_topic_04" >500 caractères maximum</span>
              </div>
      </li>
      <li id="AIT_topic_04_actions">
          <div style="padding:10px 0 15px 0;" class="form-buttons-wrapper">
            <button id="submit_AIT_topic_04_form" type="submit" class="form-submit-button-cool_grey_rounded" >Poster</button>
            <button id="reset_AIT_topic_04_form" type="reset" class="form-submit-button-cool_grey_rounded">Effacer</button>
          </div>
      </li>
    </ul>
  </div>
</form>
<!-- THIS SECTION IS A FORM -->

<!-- THIS SECTION IS A PAGINATION -->
<div class="pagination" id="comments_AIT_topic_04" style="display:none;">
    <div id="AIT_topic_04"></div>
  <input type="hidden" name="page_count_AIT_topic_04" id="page_count_AIT_topic_04" />
</div>
<!-- THIS SECTION IS A PAGINATION -->

<div class="question forum">
<p>2) Quelle a été l'expérience globale de vos patients atteints de rhinite allergique qui ont reçu une immunothérapie sous-cutanée? Recommandez-vous systématiquement ce traitement? Pourquoi ou pourquoi pas? </p>
</div>

<!-- THIS SECTION IS A TOGGLE -->
<div class="toggle" ><p id="toggle_post_AIT_topic_05" ><sub style="font-size:15px;">&#8618;</sub> Ajouter un commentaire</p> <p id="toggle_comments_AIT_topic_05">&nbsp;&nbsp;<sub style="font-size:15px;">&#8618;</sub> Voir les commentaires </p></div>
<!-- THIS SECTION IS A TOGGLE -->

<!-- THIS SECTION IS A FORM -->
<form class="jotform-form" action="" method="POST" data-ajax="false" name="AIT_topic_05_form" id="AIT_topic_05_form" accept-charset="utf-8" style="display:none;">
  <div class="program_evaluation" style="width:600px;">
    <ul class="form-section">
      <li class="form-line" style="margin:0;padding:0;">
          <textarea class="form-textarea" name="comment" parsley-required="true" parsley-error-message="Veuillez entrer un commentaire (500 caractères maximum)" parsley-maxlength="500" id="comment_AIT_topic_05" rows="5" style="width: 600px;max-width: 600px;margin:0;padding:0;"></textarea>
          <div class="form-textarea-limit-indicator"><span class="comment_AIT_topic_05" >500 caractères maximum</span>
              </div>
      </li>
      <li id="AIT_topic_05_actions">
          <div style="padding:10px 0 15px 0;" class="form-buttons-wrapper">
            <button id="submit_AIT_topic_05_form" type="submit" class="form-submit-button-cool_grey_rounded" >Poster</button>
            <button id="reset_AIT_topic_05_form" type="reset" class="form-submit-button-cool_grey_rounded">Effacer</button>
          </div>
      </li>
    </ul>
  </div>
</form>
<!-- THIS SECTION IS A FORM -->

<!-- THIS SECTION IS A PAGINATION -->
<div class="pagination" id="comments_AIT_topic_05" style="display:none;">
    <div id="AIT_topic_05"></div>
  <input type="hidden" name="page_count_AIT_topic_05" id="page_count_AIT_topic_05" />
</div>
<!-- THIS SECTION IS A PAGINATION -->

<div class="question forum">
<p>3) Où situez-vous la place de l’immunothérapie sublinguale dans l’arsenal thérapeutique du traitement de la rhinite allergique? Quels avantages et inconvénients percevez-vous?</p>
</div>

<!-- THIS SECTION IS A TOGGLE -->
<div class="toggle" ><p id="toggle_post_AIT_topic_06" ><sub style="font-size:15px;">&#8618;</sub> Ajouter un commentaire</p> <p id="toggle_comments_AIT_topic_06"> &nbsp;&nbsp;<sub style="font-size:15px;">&#8618;</sub> Voir les commentaires </p></div>
<!-- THIS SECTION IS A TOGGLE -->

<!-- THIS SECTION IS A FORM -->
<form class="jotform-form" action="" method="POST" data-ajax="false" name="AIT_topic_06_form" id="AIT_topic_06_form" accept-charset="utf-8" style="display:none;">
  <div class="program_evaluation" style="width:600px;">
    <ul class="form-section">
      <li class="form-line" style="margin:0;padding:0;">
          <textarea class="form-textarea" name="comment" parsley-required="true" parsley-error-message="Veuillez entrer un commentaire (500 caractères maximum)" parsley-maxlength="500" id="comment_AIT_topic_06" rows="5" style="width: 600px;max-width: 600px;margin:0;padding:0;"></textarea>
          <div class="form-textarea-limit-indicator"><span class="comment_AIT_topic_06" >500 caractères maximum</span>
              </div>
      </li>
      <li id="AIT_topic_06_actions">
          <div style="padding:10px 0 15px 0;" class="form-buttons-wrapper">
            <button id="submit_AIT_topic_06_form" type="submit" class="form-submit-button-cool_grey_rounded" >Poster</button>
            <button id="reset_AIT_topic_06_form" type="reset" class="form-submit-button-cool_grey_rounded">Effacer</button>
          </div>
      </li>
    </ul>
  </div>
</form>
<!-- THIS SECTION IS A FORM -->

<!-- THIS SECTION IS A PAGINATION -->
<div class="pagination" id="comments_AIT_topic_06" style="display:none;">
    <div id="AIT_topic_06"></div>
  <input type="hidden" name="page_count_AIT_topic_06" id="page_count_AIT_topic_06" />
</div>
<!-- THIS SECTION IS A PAGINATION -->

<div class="question forum">
<p>4) Quelle est la prise en charge de l’anaphylaxie dans la pratique de médecine familiale?</p>
</div>

<!-- THIS SECTION IS A TOGGLE -->
<div class="toggle" ><p id="toggle_post_AIT_topic_07" ><sub style="font-size:15px;">&#8618;</sub> Ajouter un commentaire</p> <p id="toggle_comments_AIT_topic_07"> &nbsp;&nbsp;<sub style="font-size:15px;">&#8618;</sub> Voir les commentaires </p></div>
<!-- THIS SECTION IS A TOGGLE -->

<!-- THIS SECTION IS A FORM -->
<form class="jotform-form" action="" method="POST" data-ajax="false" name="AIT_topic_07_form" id="AIT_topic_07_form" accept-charset="utf-8" style="display:none;">
  <div class="program_evaluation" style="width:600px;">
    <ul class="form-section">
      <li class="form-line" style="margin:0;padding:0;">
          <textarea class="form-textarea" name="comment" parsley-required="true" parsley-error-message="Veuillez entrer un commentaire (500 caractères maximum)" parsley-maxlength="500" id="comment_AIT_topic_07" rows="5" style="width: 600px;max-width: 600px;margin:0;padding:0;"></textarea>
          <div class="form-textarea-limit-indicator"><span class="comment_AIT_topic_07" >500 caractères maximum</span>
              </div>
      </li>
      <li id="AIT_topic_07_actions">
          <div style="padding:10px 0 15px 0;" class="form-buttons-wrapper">
            <button id="submit_AIT_topic_07_form" type="submit" class="form-submit-button-cool_grey_rounded" >Poster</button>
            <button id="reset_AIT_topic_07_form" type="reset" class="form-submit-button-cool_grey_rounded">Effacer</button>
          </div>
      </li>
    </ul>
  </div>
</form>
<!-- THIS SECTION IS A FORM -->

<!-- THIS SECTION IS A PAGINATION -->
<div class="pagination" id="comments_AIT_topic_07" style="display:none;">
    <div id="AIT_topic_07"></div>
  <input type="hidden" name="page_count_AIT_topic_07" id="page_count_AIT_topic_07" />
</div>
<!-- THIS SECTION IS A PAGINATION -->

<div class="question forum">
<p>5) Après une réaction à l’immunothérapie, doit-on poursuivre le traitement?</p>
</div>

<!-- THIS SECTION IS A TOGGLE -->
<div class="toggle" ><p id="toggle_post_AIT_topic_08" ><sub style="font-size:15px;">&#8618;</sub> Ajouter un commentaire</p> <p id="toggle_comments_AIT_topic_08"> &nbsp;&nbsp;<sub style="font-size:15px;">&#8618;</sub> Voir les commentaires </p></div>
<!-- THIS SECTION IS A TOGGLE -->

<!-- THIS SECTION IS A FORM -->
<form class="jotform-form" action="" method="POST" data-ajax="false" name="AIT_topic_08_form" id="AIT_topic_08_form" accept-charset="utf-8" style="display:none;">
  <div class="program_evaluation" style="width:600px;">
    <ul class="form-section">
      <li class="form-line" style="margin:0;padding:0;">
          <textarea class="form-textarea" name="comment" parsley-required="true" parsley-error-message="Veuillez entrer un commentaire (500 caractères maximum)" parsley-maxlength="500" id="comment_AIT_topic_08" rows="5" style="width: 600px;max-width: 600px;margin:0;padding:0;"></textarea>
          <div class="form-textarea-limit-indicator"><span class="comment_AIT_topic_08" >500 caractères maximum</span>
              </div>
      </li>
      <li id="AIT_topic_08_actions">
          <div style="padding:10px 0 15px 0;" class="form-buttons-wrapper">
            <button id="submit_AIT_topic_08_form" type="submit" class="form-submit-button-cool_grey_rounded" >Poster</button>
            <button id="reset_AIT_topic_08_form" type="reset" class="form-submit-button-cool_grey_rounded">Effacer</button>
          </div>
      </li>
    </ul>
  </div>
</form>
<!-- THIS SECTION IS A FORM -->

<!-- THIS SECTION IS A PAGINATION -->
<div class="pagination" id="comments_AIT_topic_08" style="display:none;">
    <div id="AIT_topic_08"></div>
  <input type="hidden" name="page_count_AIT_topic_08" id="page_count_AIT_topic_08" />
</div>
<!-- THIS SECTION IS A PAGINATION -->

<div class="question forum">
<p>6) Comment doit-on prendre en charge le patient du cas n&deg; 2 s’il souhaite cesser l’ITSC?</p>
</div>

<!-- THIS SECTION IS A TOGGLE -->
<div class="toggle" ><p id="toggle_post_AIT_topic_09" ><sub style="font-size:15px;">&#8618;</sub> Ajouter un commentaire</p> <p id="toggle_comments_AIT_topic_09"> &nbsp;&nbsp;<sub style="font-size:15px;">&#8618;</sub> Voir les commentaires </p></div>
<!-- THIS SECTION IS A TOGGLE -->

<!-- THIS SECTION IS A FORM -->
<form class="jotform-form" action="" method="POST" data-ajax="false" name="AIT_topic_09_form" id="AIT_topic_09_form" accept-charset="utf-8" style="display:none;">
  <div class="program_evaluation" style="width:600px;">
    <ul class="form-section">
      <li class="form-line" style="margin:0;padding:0;">
          <textarea class="form-textarea" name="comment" parsley-required="true" parsley-error-message="Veuillez entrer un commentaire (500 caractères maximum)" parsley-maxlength="500" id="comment_AIT_topic_09" rows="5" style="width: 600px;max-width: 600px;margin:0;padding:0;"></textarea>
          <div class="form-textarea-limit-indicator"><span class="comment_AIT_topic_09" >500 caractères maximum</span>
              </div>
      </li>
      <li id="AIT_topic_09_actions">
          <div style="padding:10px 0 15px 0;" class="form-buttons-wrapper">
            <button id="submit_AIT_topic_09_form" type="submit" class="form-submit-button-cool_grey_rounded" >Poster</button>
            <button id="reset_AIT_topic_09_form" type="reset" class="form-submit-button-cool_grey_rounded">Effacer</button>
          </div>
      </li>
    </ul>
  </div>
</form>
<!-- THIS SECTION IS A FORM -->

<!-- THIS SECTION IS A PAGINATION -->
<div class="pagination" id="comments_AIT_topic_09" style="display:none;">
    <div id="AIT_topic_09"></div>
  <input type="hidden" name="page_count_AIT_topic_09" id="page_count_AIT_topic_09" />
</div>
<!-- THIS SECTION IS A PAGINATION -->

<div class="question forum">
<p>7) Comment doit-on prendre en charge le patient du cas n&deg; 2 s’il souhaite poursuivre l’ITSC?</p>
</div>

<!-- THIS SECTION IS A TOGGLE -->
<div class="toggle" ><p id="toggle_post_AIT_topic_10" ><sub style="font-size:15px;">&#8618;</sub> Ajouter un commentaire</p> <p id="toggle_comments_AIT_topic_10"> &nbsp;&nbsp;<sub style="font-size:15px;">&#8618;</sub> Voir les commentaires </p></div>
<!-- THIS SECTION IS A TOGGLE -->

<!-- THIS SECTION IS A FORM -->
<form class="jotform-form" action="" method="POST" data-ajax="false" name="AIT_topic_10_form" id="AIT_topic_10_form" accept-charset="utf-8" style="display:none;">
  <div class="program_evaluation" style="width:600px;">
    <ul class="form-section">
      <li class="form-line" style="margin:0;padding:0;">
          <textarea class="form-textarea" name="comment" parsley-required="true" parsley-error-message="Veuillez entrer un commentaire (500 caractères maximum)" parsley-maxlength="500" id="comment_AIT_topic_10" rows="5" style="width: 600px;max-width: 600px;margin:0;padding:0;"></textarea>
          <div class="form-textarea-limit-indicator"><span class="comment_AIT_topic_10" >500 caractères maximum</span>
              </div>
      </li>
      <li id="AIT_topic_10_actions">
          <div style="padding:10px 0 15px 0;" class="form-buttons-wrapper">
            <button id="submit_AIT_topic_10_form" type="submit" class="form-submit-button-cool_grey_rounded" >Poster</button>
            <button id="reset_AIT_topic_10_form" type="reset" class="form-submit-button-cool_grey_rounded">Effacer</button>
          </div>
      </li>
    </ul>
  </div>
</form>
<!-- THIS SECTION IS A FORM -->

<!-- THIS SECTION IS A PAGINATION -->
<div class="pagination" id="comments_AIT_topic_10" style="display:none;">
    <div id="AIT_topic_10"></div>
  <input type="hidden" name="page_count_AIT_topic_10" id="page_count_AIT_topic_10" />
</div>
<!-- THIS SECTION IS A PAGINATION -->

<div class="question forum">
<p>8) Si un patient se présente à votre cabinet avec des symptômes graves, quelles sont certaines options thérapeutiques?</p>
</div>

<!-- THIS SECTION IS A TOGGLE -->
<div class="toggle" ><p id="toggle_post_AIT_topic_11" ><sub style="font-size:15px;">&#8618;</sub> Ajouter un commentaire</p> <p id="toggle_comments_AIT_topic_11"> &nbsp;&nbsp;<sub style="font-size:15px;">&#8618;</sub> Voir les commentaires </p></div>
<!-- THIS SECTION IS A TOGGLE -->

<!-- THIS SECTION IS A FORM -->
<form class="jotform-form" action="" method="POST" data-ajax="false" name="AIT_topic_11_form" id="AIT_topic_11_form" accept-charset="utf-8" style="display:none;">
  <div class="program_evaluation" style="width:600px;">
    <ul class="form-section">
      <li class="form-line" style="margin:0;padding:0;">
          <textarea class="form-textarea" name="comment" parsley-required="true" parsley-error-message="Veuillez entrer un commentaire (500 caractères maximum)" parsley-maxlength="500" id="comment_AIT_topic_11" rows="5" style="width: 600px;max-width: 600px;margin:0;padding:0;"></textarea>
          <div class="form-textarea-limit-indicator"><span class="comment_AIT_topic_11" >500 caractères maximum</span>
              </div>
      </li>
      <li id="AIT_topic_11_actions">
          <div style="padding:11px 0 15px 0;" class="form-buttons-wrapper">
            <button id="submit_AIT_topic_11_form" type="submit" class="form-submit-button-cool_grey_rounded" >Poster</button>
            <button id="reset_AIT_topic_11_form" type="reset" class="form-submit-button-cool_grey_rounded">Effacer</button>
          </div>
      </li>
    </ul>
  </div>
</form>
<!-- THIS SECTION IS A FORM -->

<!-- THIS SECTION IS A PAGINATION -->
<div class="pagination" id="comments_AIT_topic_11" style="display:none;">
    <div id="AIT_topic_11"></div>
  <input type="hidden" name="page_count_AIT_topic_11" id="page_count_AIT_topic_11" />
</div>
<!-- THIS SECTION IS A PAGINATION -->

<div class="question forum">
<p>9) Quels autres tests peuvent être envisagés?</p>
</div>

<!-- THIS SECTION IS A TOGGLE -->
<div class="toggle" ><p id="toggle_post_AIT_topic_12" ><sub style="font-size:15px;">&#8618;</sub> Ajouter un commentaire</p> <p id="toggle_comments_AIT_topic_12"> &nbsp;&nbsp;<sub style="font-size:15px;">&#8618;</sub> Voir les commentaires </p></div>
<!-- THIS SECTION IS A TOGGLE -->

<!-- THIS SECTION IS A FORM -->
<form class="jotform-form" action="" method="POST" data-ajax="false" name="AIT_topic_12_form" id="AIT_topic_12_form" accept-charset="utf-8" style="display:none;">
  <div class="program_evaluation" style="width:600px;">
    <ul class="form-section">
      <li class="form-line" style="margin:0;padding:0;">
          <textarea class="form-textarea" name="comment" parsley-required="true" parsley-error-message="Veuillez entrer un commentaire (500 caractères maximum)" parsley-maxlength="500" id="comment_AIT_topic_12" rows="5" style="width: 600px;max-width: 600px;margin:0;padding:0;"></textarea>
          <div class="form-textarea-limit-indicator"><span class="comment_AIT_topic_12" >500 caractères maximum</span>
              </div>
      </li>
      <li id="AIT_topic_12_actions">
          <div style="padding:12px 0 15px 0;" class="form-buttons-wrapper">
            <button id="submit_AIT_topic_12_form" type="submit" class="form-submit-button-cool_grey_rounded" >Poster</button>
            <button id="reset_AIT_topic_12_form" type="reset" class="form-submit-button-cool_grey_rounded">Effacer</button>
          </div>
      </li>
    </ul>
  </div>
</form>
<!-- THIS SECTION IS A FORM -->

<!-- THIS SECTION IS A PAGINATION -->
<div class="pagination" id="comments_AIT_topic_12" style="display:none;">
    <div id="AIT_topic_12"></div>
  <input type="hidden" name="page_count_AIT_topic_12" id="page_count_AIT_topic_12" />
</div>
<!-- THIS SECTION IS A PAGINATION -->

<div class="question forum">
<p>10) À quel moment orienteriez-vous le patient du cas n&deg; 3?</p>
</div>

<!-- THIS SECTION IS A TOGGLE -->
<div class="toggle" ><p id="toggle_post_AIT_topic_13" ><sub style="font-size:15px;">&#8618;</sub> Ajouter un commentaire</p> <p id="toggle_comments_AIT_topic_13"> &nbsp;&nbsp;<sub style="font-size:15px;">&#8618;</sub> Voir les commentaires </p></div>
<!-- THIS SECTION IS A TOGGLE -->

<!-- THIS SECTION IS A FORM -->
<form class="jotform-form" action="" method="POST" data-ajax="false" name="AIT_topic_13_form" id="AIT_topic_13_form" accept-charset="utf-8" style="display:none;">
  <div class="program_evaluation" style="width:600px;">
    <ul class="form-section">
      <li class="form-line" style="margin:0;padding:0;">
          <textarea class="form-textarea" name="comment" parsley-required="true" parsley-error-message="Veuillez entrer un commentaire (500 caractères maximum)" parsley-maxlength="500" id="comment_AIT_topic_13" rows="5" style="width: 600px;max-width: 600px;margin:0;padding:0;"></textarea>
          <div class="form-textarea-limit-indicator"><span class="comment_AIT_topic_13" >500 caractères maximum</span>
              </div>
      </li>
      <li id="AIT_topic_13_actions">
          <div style="padding:12px 0 15px 0;" class="form-buttons-wrapper">
            <button id="submit_AIT_topic_13_form" type="submit" class="form-submit-button-cool_grey_rounded" >Poster</button>
            <button id="reset_AIT_topic_13_form" type="reset" class="form-submit-button-cool_grey_rounded">Effacer</button>
          </div>
      </li>
    </ul>
  </div>
</form>
<!-- THIS SECTION IS A FORM -->

<!-- THIS SECTION IS A PAGINATION -->
<div class="pagination" id="comments_AIT_topic_13" style="display:none;">
    <div id="AIT_topic_13"></div>
  <input type="hidden" name="page_count_AIT_topic_13" id="page_count_AIT_topic_13" />
</div>
<!-- THIS SECTION IS A PAGINATION -->

</td>
     <td style="padding:0 10px 0 30px;">
        <img style="cursor: pointer;" src="../images/prev.jpg" width="28" height="28"  alt="tab7" id="prev_AFP_section"/>
     </td>
     <td style="padding: 0;">
        <img style="cursor: pointer;" src="../images/next.jpg" width="28" height="28" alt="tab9" id="next_post_test_section"/>
    </td>
  </tr>
</table>
