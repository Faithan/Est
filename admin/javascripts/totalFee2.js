// Function to calculate total fee and deduct from reservation fee
function calculateTotalFee() {
    // Get the input values
    const extraBed = parseInt(document.querySelector('input[name="extra_bed"]').value);
    const extraPerson = parseInt(document.querySelector('input[name="extra_person"]').value);
    const price = parseInt(document.querySelector('input[name="rate_per_hour"]').value);
    const reservationFee = parseInt(document.querySelector('input[name="reservation_fee"]').value);

    // Calculate the additional charges
    const extraBedCharge = extraBed * 600;
    const extraPersonCharge = extraPerson * 600;

    // Calculate the total fee
    const totalFee = price + extraBedCharge + extraPersonCharge;

    // Deduct the total fee from the reservation fee
    const remainingFee = totalFee - reservationFee ;

    // Set the value of the "Total Fee" input field
    document.querySelector('input[name="total_fee"]').value = remainingFee;
}

// Call calculateTotalFee once when the page loads to calculate and deduct the total fee
calculateTotalFee();

// Listen for input and change events on Extra Bed, Extra Person, Price, and Reservation Fee fields
document.querySelectorAll('input[name="extra_bed"], input[name="extra_person"], input[name="rate_per_hour"], input[name="reservation_fee"]').forEach(input => {
    input.addEventListener('input', calculateTotalFee);
    input.addEventListener('change', calculateTotalFee);
});