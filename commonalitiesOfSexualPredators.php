<?php
/*Created by Akanksha
  Desc: Implementation of Commonalities of sexual predators of 'Safety tools' 
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
  <link rel="shortcut icon" href="favicon.png" > 
  <link rel="stylesheet" type="text/css" href="css files/safety-tools.css"/>
</head>
<body>
<?php
     include('menu.php');
?>
<center>
<div class="window">
  <div>
    <h1 class="text">Commonalities Of Sexual Predators</h1>
    <hr class="line">
  </div>

  <div class="dragscroll"><!--for horizontal drag scrolling-->
  <table class="threeorfour-blocks-content">
    <tr>
      <td class="block">
        <p>
           While cultural misunderstandings can contribute to increased risk, most sexual assaults are not the result of cross-cultural misinterpretations. They are the result of deliberate planning by the sexual predator. Ultimately, sexual assault is a crime of motive and opportunity. While you can never completely protect yourself from sexual assault, there are some things you can do to help reduce your risk of being assaulted. 
        </p>
      </td>
      <td class="block">
        <ul class="ul-safetytools">
          <h4 style="margin-left: -25px; margin-top: 0px">Characteristics of assaults:</h4>
          <li>
            Sexual predators often <b>plan sexual assaults.</b>
            <ul> 
              <li>
                Sexual assault is not an accident.  Sexual predators know what they want to do, even if they have not already identified a specific target.  Most of them have a plan in mind for how they will select and control someone, or they will seek out an area where a potential victim might be isolated and unable to get help. When we say planned to some extent it may not mean days or weeks in advance but also planned in the particular 
                moment.                                                    
              </li>  
            </ul> 
          </li>
          <li>
            Sexual predators often <b>watch for vulnerabilities and opportunities.</b>
            <ul>
               <li>
                Sexual predators look for cues to indicate they can dominate and control a potential victim. They look for signs indicating that someone would be unlikely or unable to resist.  For instance, people who are unaware of their surroundings, alone or lost; someone who is intoxicated or in some way incapacitated. 
               </li>
            </ul>
          </li>
          <li>
            Sexual predators often <b>test the boundaries of potential victims.</b>
            <ul>
               <li>
                  Testing boundaries may involve inappropriate comments, unwanted touching or invading personal space. It is a way of measuring the amount of resistance a potential victim might offer. A person who offers little or no resistance to these advances might be seen as a suitable target.
               </li>
            </ul>
          </li>      
        </ul>
      </td>
      <td class="block">
        <h4>Both in Peace Corps and worldwide, the majority of sexual assault have these similarities:</h4>
        <ul>
          <li>Predators <b>know the victim</b></li>
          <li>Occur when the <b>victim is isolated.</b></li>
          <li>Occur <b>at night.</b></li>
        </ul>
      </td>
      <td class="block">
        <h4>Tactics used by sexual predators</h4>
        <ul class="ul-safetytools">
          <li>
            <b>Attempt to isolate their potential victim.</b> They may target someone who is already alone. For example, walking alone, or they may try to get their target alone by offering a ride in their car.
          </li>
          <li>
            <b>Persuasion and confidence.</b>This is the &quot;Smooth Talker&quot; who puts you at ease.  They make you feel comfortable and relaxed so you are not aware of their true intent.  They may try to persuade you to do something you feel uncomfortable about.  They might promise that they won&#x27;t try anything with you or reassure you by saying &quot;You can trust me.&quot;
          </li>
            <b>Pressure and guilt.</b>Sexual predators may try to coerce you by pressuring you to go farther in a relationship than you are ready or willing to go.  They may try to make you feel guilty if you do not give in to their advances. They might say &quot;You are offending me culturally&quot; or something similar to make Volunteers feel guilty.
          <li>
            <b>Threats and intimidation.</b> Sometimes the sexual predator threatens to physically harm the Volunteer or someone they care about.  They might also threaten to blackmail the Volunteer unless they comply.
          </li>
          <li>
            <b>Force and violence.</b>Force and Violence involves a direct physical attack to overpower a Volunteer.  It is what we frequently see on TV and in movies &#x2D;like when the assailant jumps out of the bushes with a knife and attacks an unsuspecting jogger.
          </li>
          <li>
            <b>Drugs, including alcohol</b>
            Description to be provided.
          </li>
        </ul>
      </td>
    </tr>
  </table>
  </div><!--closing div of dragscroll-->
</div><!--closing div of window-->
</center>
  <script type="text/javascript" src="javascripts/jquery-1.12.4.min.js"></script><!--must be loaded first always-->
  <script type="text/javascript" src="javascripts/dragscroll.js"></script>
</body>
</html>
