/*Created by Akanksha
  Desc: Popup js for contact now of PCSaves, OfficeOfVictimAdvocacy, 
  OfficeOfInspectorGeneral and OfficeOfCivilRightsAndDiversity
*/
function openPopup()
{
  var popup = document.getElementById('popup-cnt');
  var span = document.getElementById("close-cnt");

  //open popup on click of button
  popup.style.display = "block";

  // When the user clicks on <span> (x), close the modal
  span.onclick = function() {
    popup.style.display = "none";
  }

  // When the user clicks anywhere outside of the modal, close it
  window.onclick = function(event) {
    if (event.target == popup) {
        popup.style.display = "none";
    }
  }

}