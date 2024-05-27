function enableEdit(event) {
    event.preventDefault();

    var fieldNames = ['first_name', 'middle_name', 'last_name', 'address', 'phone_number', 'email', 'room_type', 'bed_type', 'bed_quantity', 'number_of_person', 'amenities', 'rate_per_hour', 'date_of_arrival', 'time_of_arrival', 'time_out', 'special_request'];

    for (var i = 0; i < fieldNames.length; i++) {
        var field = document.querySelector('input[name="' + fieldNames[i] + '"]');
        field.removeAttribute('readonly');
    }
}