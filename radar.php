<?php
/*Created by Akanksha
  Desc: RADAR of 'Safety Tools'
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
  <link rel="stylesheet" href="css files/sweetalert.css">
</head>
<body>
<?php
     include('menu.php');
?>
<center>
<div class="window">
  <div>
    <h1 class="text">RADAR</h1>
    <hr class="line">
  </div>
  <!--Horizontally scrollable content-->
  <div class="dragscroll">
  <table class="greaterthan5-blocks-content"><!--more than 5 blocks i.e, <td>'s here-->
    <tr>
      <td class="block">
        <p>
          How does a pilot know when there is another plane in the flight path? How do weather forecasters know when there is a major thunderstorm approaching? They use RADAR.
          <br>
          RADAR provides a warning to help recognize potential dangers and when to protect ourselves.
          RADAR is a series of steps to help you manage the risks you face.  
        </p>
      </td>
      <td class="block">
        <h4>Step 1: Recognize the danger</h4>
        <p>
          Be aware of what is going on around you – be on the lookout for suspicious people and for situations that could pose a danger. 
          <br><br>
          Be aware of how others perceive you – are your actions or dress inadvertently attracting unwanted attention?  Are you wearing jewelry, using a camera, working on a laptop, or flashing money that might grab the attention of a criminal?
          <br><br>
          Being able to recognize dangers lets us begin to figure out ways to reduce the risks. This is where it’s important to trust your instincts. If you have a bad feeling about something it’s a warning sign. Don’t dismiss it – listen to what that voice in the back of your head is saying or that uneasy feeling in your stomach is telling you.  For example, when you walk in to a crowded bus terminal, you recognize that there is a risk of being pickpocketed.
        </p> 
      </td>
       <td class="block">
         <h4>Step 2: Assess your options</h4>
         <p>
            Now that you have recognized a potentially dangerous situation, what can you do in order to reduce the risk you face? In most situations, you will have choices to make. Identify as many options as you can.  For example, you can mitigate the risk of going out at night by traveling in a group, by using a trusted taxi or even by choosing to return home at an earlier hour.
         </p>
      </td>
      <td class="block">
        <h4>Step 3: Decide what’s best for you</h4>
        <p>
          After figuring out what options you have, run the different scenarios in your head – say ‘What if’ – and decide which option is the best. You could try to defuse the situation by remaining calm and use good communication skills to keep the situation from escalating.  Maybe try an escape option where you run towards safety, not just away from danger.  As a last resort, try a verbal, psychological, or physical defense tactic.
          <br><br>
          Sometimes your best option might be a bit unconventional. If it’s the best option to keep you safe, then it’s a good option.
        </p>
      </td>
      <td class="block">
        <h4>Step 4: Act when the time is right</h4>
        <p>
          After you decide on your best course of action, decide when to act. Sometimes you’ll need to act right away. Other times you can wait until the danger gets closer – but don’t wait until it gets too close! 
          <br><br>
          Draw your own imaginary line – set your own personal tripwire. Once the danger crosses that line – whatever you decided for yourself – that’s when you act.
         </p>
      </td>
      <td class="block">
        <h4>Step 5: Reassess as the situation changes</h4>
        <p>
          And because no situation is static, you must constantly reassess your options as the conditions and circumstances change. If you encounter new risks or if you run out of options, start the cycle again.  
        </p>
      </td>
    </tr>
  </table>
  </div><!--closing div of dragscroll-->
</div> <!--closing div of window-->
</center>
  <script src="javascripts/sweetalert.min.js"></script>
  <script src="javascripts/sweetalert.js"></script>
  <!--swal uses sweetalert scripts, Used to display alert-->
  <script type="text/javascript">
    swal(
      {title: "Drag to move!", 
       text: "You can move right or left to scroll through content", 
       imageUrl: "images/drag_hand.png" });
  </script>
  <script type="text/javascript" src="javascripts/jquery-1.12.4.min.js"></script><!--must be loaded first-->
  <script type="text/javascript" src="javascripts/dragscroll.js"></script>
</body>
</html>