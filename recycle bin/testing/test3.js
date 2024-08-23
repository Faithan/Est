// Get the modal element
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var openModalBtn = document.getElementById("openModalBtn");

// Get the close button inside the modal
var closeButton = modal.getElementsByClassName("close")[0];

// Function to open the modal
function openModal() {
  modal.style.display = "block";
}

// Function to close the modal
function closeModal() {
  modal.style.display = "none";
}

// Event listener for opening the modal
openModalBtn.addEventListener("click", openModal);

// Event listener for closing the modal
closeButton.addEventListener("click", closeModal);

// Event listener for clicking outside the modal
window.addEventListener("click", function(event) {
  if (event.target == modal) {
    closeModal();
  }
});