/*Created by Akanksha
  Desc: Popup js for ContactSARL
*/
function openSARL()
{
  var popup = document.getElementById('popup-SARL');
  var span = document.getElementById("close-SARL");
  
  //open popup on click of button
  popup.style.display = "block";

  // When the user clicks on <span> (x), close the popup
  span.onclick = function() {
    popup.style.display = "none";
  }

  // When the user clicks anywhere outside of the pupo, close it
  window.onclick = function(event) {
    if (event.target == popup) {
        popup.style.display = "none";
    }
  }

}