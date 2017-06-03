<?php
/*Created by Akanksha
  Desc: Implementation for safety plan basics of 'Safety tools'
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
    <h1 class="text">Safety Plan Basics</h1>
    <hr class="line">
  </div>

  <div class="dragscroll"><!--dragscroll enables horizontal drag scrolling-->
  <table class="greaterthan5-blocks-content">
    <tr>
      <td class="block">
         Safety Plans are personalized, practical steps that can help you manage your security following an incident. Each safety plan is unique, and therefore, should be tailored to the circumstances of a particular incident and the needs.  Not all incidents require a safety plan.  However, you have a right to request help from a staff member to create a tailored safety plan.   
      </td>
      <td class="block">
          <ul>
            <h4>Main reasons for a Safety Plan:</h4>
              <li>Exploring on-going risks and concerns associated with the incident </li>
              <li>Assessing strategies on how to respond when a perceived threat is present </li>
              <li>Maintaining your safety and well-being </li>
          </ul>
      </td>
      <td class="block">
        <ul class="ul-safetytools">
            <h4>Purpose of a Safety Plan:</h4>
            <li> To assist you in identifying strategies for mitigating on-going risks</li>
            <li> To outline possible responses and resources in instances of potential future harm</li>
            <li> To strengthen the partnership between you and staff in promoting your on-going safety and security and well-being</li>
            <li> To empower you to reclaim a sense of safety and security by addressing safety and security needs and concerns</li>
        </ul>
      </td>
      <td class="block">
        <ul>
          <h4>Safety Plans cannot:</h4>
            <li> Guarantee your future safety. </li>
            <li> Take the place of working with a mental health specialist to identify ways to cope with emotions and stressful situations which may arise in the aftermath of an incident.  If you would like such assistance, counseling can be arranged through the PCMO. 
        </ul>
      </td>
      <td class="block">
        <ul class="ul-safetytools">
            <h4>Tips for creating a Safety Plan</h4>
            <li> If you choose to work with staff, be honest with sharing any concerns </li>
            <li> Identify strategies that can be taken to reduce any on-going safety and security concerns </li>
            <li> Identify strategies or actions post may take to support you in these efforts</li>
            <li> If you want post staff perspective and help, simply ask </li>
            <li> If you are feeling overwhelmed with fear or anxiety, have a conversation with the PCMO or a counselor to talk it out </li>
            <li> Safety planning is an on-going process.  New concerns may arise that require adjusting it.  Modify your safety plan to accommodate any changes. </li>
        </ul>
      </td>
    </tr>
  </table>
  </div><!--closing div for dragscroll-->
</div><!--closing div for window-->
</center>
  <script type="text/javascript" src="javascripts/jquery-1.12.4.min.js"></script>
  <script type="text/javascript" src="javascripts/dragscroll.js"></script>
</body>
</html>