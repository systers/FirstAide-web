<?php 
/*Created by Akanksha
  Desc: Implementation for coping with unwanted attention strategies of 'Safety tools'
*/
   if(!isset($_SESSION))
     session_start();
   if(!isset($_SESSION['email']))
   {  
      header("location: login.php"); 
   } 
   
?>
<!DOCTYPE html>
<html>
<head>
  <title>FirstAide</title>
  <link rel="stylesheet" type="text/css" href="css files/safety-tools.css"/>
</head>
<body>
<?php
     include('menu.php');
?>
<center>
<div class="window">
  <div>
    <h1 class="text">Coping With Unwanted Attention Strategies</h1>
    <hr class="line">
  </div>

  <table class="two-blocks-content">
    <tr>
      <td class="block">
          All PCVs will deal with some type of unwanted attention at some point in their service. This occurs across all cultures. The reaction someone has in response is highly personal and depends on the type of unwanted attention. Reactions may range from a slight feeling of discomfort to anger to fearing for one&#x27;s safety.  You do not have to &quot;be nice&quot; if you feel unsafe or even uncomfortable.  Peace Corps staff are here to help and have been trained on how to help PCVs cope. It&#x27;s important to report unwanted attention that is severe in nature so you can get the help and support you deserve. 
          <br><br>
          There&#x27;s a difference between unwanted attention and stalking. Stalking and cyber&#x2D;stalking are defined as repeated threatening behavior from a single person that causes a Volunteer to fear for his or her safety or suffer substantial emotional distress. Unwanted physical contact, such as grabbing or touching, is considered assault, not unwanted attention. 
      </td>
      <td class="block">
        <ul class="ul-safetytools">
          <li>
            <b>Walk purposefully.</b>Always walk with confidence and purpose.
          </li>
          <li>
            <b>Look assertive.</b> Hold your head high, shoulders back and present yourself as a professional demanding respect.
          </li>
          <li>
            <b>Nod (to acknowledge) and keep on walking.</b> Simply recognizing the person can help ward off unwanted attention. Many times an inappropriate comment is an effort to get attention.</li>
          <li>
            <b>Dress appropriately.</b> Keep in mind what is culturally appropriate.
          </li>
          <li>
            <b>Greetings.</b>Sometimes a polite &quot;Good Morning&quot; can thwart a potential unwanted comment, but at other times it can escalate the situation.  If this strategy does not work, try a different one.
          </li>
          <li>
            <b>Pretend that you heard something else.</b> &quot;I agree, it HAS been really great weather recently. Have a nice day, bye!&quot;
          </li>
          <li>
            <b>Humor.</b> Use humor to lighten the moment and solicit another response.  For example, if you are told that you would make a good lover, reply that your spouse is sure to agree!  Keep walking.  This may not work with a persistent individual, so please keep trying different strategies when needed.
          </li>
          <li>
            <b>Be polite but firm.</b> It is quite normal to stand your ground. &quot;I am offended by your comment; please do not address me in that manner.&quot;
          </li>
          <li>
            <b>Maintain your composure.</b> Try to remain calm even if you feel upset. The converse is also true; try not to show hostility as this may provoke a confrontation. It is best to remove yourself from a situation if you feel that you are losing control.
          </li>
          <li>
            <b>Never say &quot;next time.&quot; </b>Make no promises for another time, because you can be sure that the next time they see you, they will remind you of that promise.
          </li>
        </ul>
      </td>
    </tr>
  </table>
</div> <!--closing div of window-->
</center>
   <script type="text/javascript" src="javascripts/jquery-1.12.4.min.js"></script><!--must be loaded before use-->
   <script type="text/javascript" src="javascripts/dragscroll.js"></script>
</body>
</html>
