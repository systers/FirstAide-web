<?php
/*Created by Akanksha
  Desc: Implementation of Safety plan worksheet of 'Safety Tools'
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
  <!--scripts for this file must be kept at top-->
  <script type="text/javascript" src="javascripts/jquery-1.12.4.min.js"></script>
  <script type="text/javascript" src="javascripts/dragscroll.js"></script>
  <script type="text/javascript">
    jQuery(document).ready(function() {
      //toggle for cocerns and actions tab
      jQuery(".content").hide();
      jQuery(".heading").click(function(){
      jQuery(this).next(".content").slideToggle(500);
    });
  });
 </script>
</head>
<body>
<?php
     include('menu.php');
?>
<center>
<div class="window">
  <div>
    <h1 class="text">Safety Plan Worksheet</h1>
    <hr class="line">
  </div>
 
  <div class="dragscroll"><!--dragscroll enables horizontal drag scrolling-->
  <table class="greaterthan5-blocks-content">
    <tr>
      <td class="block">
        Your safety and security is always a primary concern for Peace Corps. If you have been the victim of a crime, staff want to support you in being and feeling safe before you go back to site or return to service.  Contact your SSM if you would like additional support going through the following questions.  
      </td>
      <td class="block">
        <h4>Physical Safety</h4>
          <div class="wrap"><!--wrap used to expand content when heading clicked-->
            <p class="heading">Concerns</p>
              <div class="content">
                Have you anticipated where and in which ways you might come into contact with the perpetrator and perpetrator’s friends/family?
                <br>
                If you were to come into contact with the perpetrator and perpetrator’s family/friends, what specific things could you do that might help you feel safe in that situation?
                <br>
                Have you thought about making a plan in case of emergencies of who you could call, where you could go, and how you could get there? How can Peace Corps assist you in developing this plan?
              </div>
            <p class="heading">Actions</p>
              <div class="content">
                <ul>
                  <li> Know where to go for help</li>
                  <li> Have a way to alert neighbors/counterparts if there’s a problem</li>
                  <li> Help develop a phone list of people to call in an emergency</li>
                  <li> Ensure you have readily accessible emergency contact numbers for local authorities and PC </li>
                  <li> If requested, establish contacts between PC and counterpart, neighbors, local police and community leaders so they know how to contact PC </li>
                  <li> Have your important documents ready in case of an emergency </li>
                </ul>
              </div>
          </div>
      </td>
      <td class="block">
        <h4>Home</h4>
          <div class="wrap">
            <p class="heading">Concerns</p>
              <div class="content">
                Do you suspect the perpetrator or the perpetrator’s family/friends know where you live? If so, do you believe the perpetrator may have access to your housing? 
                <br><br>
                Do you feel safe inside your home? What can Peace Corps do to help you feel safe inside your home (e.g., working locks on door/windows, etc.)? 
                <br><br>
                If you live with a host family or on a family compound, does anyone know about the incident? If not, would they be supportive if they were to learn of the incident?
                <br><br>
                If the perpetrator or the perpetrator’s family/friends were to show up at your home are there people you can turn to for assistance?
                <br><br>
                In the unlikely event of a non-medical emergency, are there local friends, community members, or other Volunteers nearby who you can stay with or contact for assistance? If not, can Peace Corps help you identify individuals and establish those contacts? 
                <br><br>
                How could you contact these individuals?
                <br><br>
                Can you think of other resources or things you can do to feel safer where you live? What can Peace Corps do to assist you with this?
              </div>
            <p class="heading">Actions</p>
              <div class="content">
                <ul>
                  <li> Know where to go for help</li>
                  <li> Ask staff to conduct a safety inspection of your home, if necessary</li>
                  <li> Ensure needed security upgrades are completed</li>
                  <li> Help develop a phone list of people to call in an emergency</li>
                  <li> Ensure that you have readily accessible emergency contact numbers for local authorities and PC</li>
                  <li> Have a way to alert neighbors/counterparts if there’s a problem</li>
                  <li> Take steps to enhance privacy (use locks, keep curtains closed, etc)</li>
                </ul>
              </div>
          </div>
      </td>
       <td class="block">
        <h4>Safety and Technology</h4>
          <div class="wrap">
            <p class="heading">Concerns</p>
              <div class="content">
                Does the perpetrator know your cell phone number? Your email address? Have you thought about what you would do if the perpetrator or perpetrator’s friends/family attempts to contact you or posts things about you online?  What can Peace Corps do to help you?
                <br><br>
                Does the perpetrator know any of your passwords? If so, have you considered changing your passwords?
                <br><br>
                Do you have any social media accounts (e.g., Facebook, Google, Twitter, Linked In, blogs)? Are you “friends” with the perpetrator or perpetrator’s friends/family? If so, do you know how to block the perpetrator or perpetrator’s family or friends?
                <br><br>
                Are you concerned that the perpetrator or perpetrator’s family/friends will contact you on the Internet?  If they do, have you thought about what you will do?
              </div>
            <p class="heading">Actions</p>
              <div class="content">
                <ul>
                 <li>  Change your SIM card or cellphone</li>
                 <li> Ensure you have readily accessible emergency contact numbers for local authorities and PC</li>
                 <li> Change user names and/or passwords for mail and other social media</li>
                 <li> Try to avoid using location services or posting information that may divulge your location</li>
                 <li> Notify Peace Corps as soon as possible of safety and security concerns or if the offender attempts to contact you.</li>
                 <li> Program your phone with important emergency numbers</li>
                 <li> Keep phone charged and have enough minutes in case of an emergency.</li>
                </ul>
              </div>
          </div>
      </td>
      <td class="block">
        <h4>Workplace</h4>
          <div class="wrap">
            <p class="heading">Concerns</p>
              <div class="content">
                Does the perpetrator or perpetrator’s family/friends know where you work? 
                <br><br>
                Does anyone else at work know about the incident?
                <br><br>
                If your counterpart/supervisor learns about the incident, do you think it would make you more or less safe?
                <br><br>
                If you work with the perpetrator, are there steps you can take to avoid interacting with the perpetrator?
                <br><br>
                If the perpetrator shows up at your work are there people you can turn to for support?
                <br><br>
                Is there anything that the Peace Corps can do to help you feel safe at work?
              </div>
            <p class="heading">Actions</p>
              <div class="content">
                <ul>
                <li> Make sure PC has established contact with your counterpart so they know how to contact PC</li>
                <li> Identify an emergency point of contact in the workplace</li>
                <li> Immediately notify PC if the offender comes to your work</li>
                <li> If working in isolated areas seek accompaniment by a coworker or community member if possible</li>
                <li> Avoid staying late or alone in the office or workplace</li>
                </ul>
              </div>
          </div>
      </td>
       <td class="block">
        <h4>Community</h4>
          <div class="wrap">
            <p class="heading">Concerns</p>
              <div class="content">
               Do you anticipate that you will see the perpetrator when you are out in public? If yes, where?
               <br><br>
               Do you see the perpetrator’s family/friends when you are out in public? If yes, where?
               <br><br>
               If needed, is there someone you trust who can accompany you to the places you need to go?
               <br><br>
               If you were approached by the perpetrator or perpetrator’s friends/family in a public place, do you know where you could go to be safe?
               <br><br>
               Do you have any concerns about rumors related to the incident that are mentioned by community members or other Volunteers? How might you respond to these? How might these rumors impact you? How can Peace Corps assist you in dealing with rumors?
               <br><br>
               Are there specific things you or Peace Corps can do that might help you feel safer in your community?
              </div>
            <p class="heading">Actions</p>
              <div class="content">
                <ul>
                  <li>  Establish regular check-in plan with PCMO and other PC staff</li>
                  <li> Find out what support services are available to you, including Volunteer Support Network and PCVLs</li>
                  <li> Trust your instincts; don’t worry about appearing to over-react (over-reacting is okay)</li>
                  <li> Be aware of unhealthy coping mechanisms such as self-medicating, isolating oneself, hurting oneself, etc. and seek help from PC</li>
                  <li> Ask Peace Corps for help before stress becomes overwhelming.</li>
                </ul>
              </div>
          </div>
      </td>
      <td class="block">
        <h4>Transportation</h4>
          <div class="wrap">
            <p class="heading">Concerns</p>
              <div class="content">
               Do you have any safety concerns with any modes of transportation related to the incident? 
               <br><br>
               Does the perpetrator know your transportation routes? If yes, can you change the routes you take to work, home, shopping?
               <br><br>
               Does the perpetrator or the perpetrator’s friends/family use the same transportation you do? If so, are there other ways you could get where you need to go? Is their opportunity for carpooling with someone else?
               <br><br>
               Are there specific things you can think of doing or that Peace Corps might do that might help you feel safer in transport?
              </div>
            <p class="heading">Actions</p>
              <div class="content">
                <ul>
                 <li>  Assist with identifying a safe taxi/moto-taxi or bus services</li>
                 <li> Ensure that the Volunteer has readily accessible emergency contact numbers for local authorities and PC</li>
                 <li> Notify Peace Corps as soon as possible of safety and security concerns</li>
                 <li> Trust your instincts; don’t worry about appearing to over-react </li>
                 <li> Modify daily routines, change times and routes to frequent locations if possible</li>
                 <li> Keep personal belongings secure at all times</li>
                </ul>
              </div>
          </div>
      </td>
    </tr>
  </table>
  </div><!--closing div for dragscroll-->
</div><!--closing div for window-->
</center>
</body>
</html>