// Function to debounce the input
function debounce(func, wait) {
    let timeout;
    return function executedFunction(...args) {
        const later = () => {
            clearTimeout(timeout);
            func(...args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
}

// Function to calculate additional payment based on extended time and price per hour
function calculateAdditionalPayment() {
    // Get the input values
    const extendedTime = parseInt(document.querySelector('input[name="extended_time"]').value);
    const extendedPrice = parseInt(document.querySelector('input[name="extended_price"]').value);

    // Calculate the additional payment
    const additionalPayment = extendedTime * extendedPrice;

    // Set the value of the "Additional Payment" input field
    document.querySelector('input[name="additional_payment"]').value = additionalPayment;
}

// Function to update check-out time based on extended time
function updateCheckOutTime() {
    // Get the input values
    const extendedTime = parseInt(document.querySelector('input[name="extended_time"]').value);
    const timeOutInput = document.querySelector('input[name="time_out"]');

    // Get the current time out value
    let currentTimeOut = timeOutInput.value;

    // Calculate the new check-out time
    let timeOutHours = parseInt(currentTimeOut.split(":")[0]);
    let timeOutMinutes = parseInt(currentTimeOut.split(":")[1]);
    let newTimeOutHours = timeOutHours + extendedTime;
    
    // Adjust hours and minutes
    if (newTimeOutHours >= 24) {
        newTimeOutHours -= 24;
    }

    // Format new check-out time
    let newTimeOutFormatted = (newTimeOutHours < 10 ? "0" : "") + newTimeOutHours + ":" + (timeOutMinutes < 10 ? "0" : "") + timeOutMinutes;

    // Update the check-out time input field
    timeOutInput.value = newTimeOutFormatted;
}

// Debounce the functions for calculating additional payment and updating check-out time
const debouncedCalculateAdditionalPayment = debounce(calculateAdditionalPayment, 300);
const debouncedUpdateCheckOutTime = debounce(updateCheckOutTime, 300);

// Listen for input events on Extended Time field with debounce
document.querySelector('input[name="extended_time"]').addEventListener('input', () => {
    debouncedCalculateAdditionalPayment();
    debouncedUpdateCheckOutTime();
});

// Listen for input events on Extended Price field with debounce
document.querySelector('input[name="extended_price"]').addEventListener('input', () => {
    debouncedCalculateAdditionalPayment();
});