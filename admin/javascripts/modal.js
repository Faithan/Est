
// Get the modal element
var modal = document.getElementById("myModal");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// Get the modal message element
var modalMessage = document.getElementById("modal-message");

// Set the modal message
modalMessage.innerHTML = "<?php echo $modalMessage; ?>";

// Show the modal
modal.style.display = "block";

// Close the modal when the user clicks on the close button
span.onclick = function() {
  modal.style.display = "none";
};

// Close the modal when the user clicks anywhere outside of it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
};
