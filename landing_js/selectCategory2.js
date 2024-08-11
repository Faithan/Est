
    function scrollToDiv2() {
        var selectedRoomType = document.getElementById("roomTypeSelect").value;
        var roomSections = document.getElementsByClassName("title-head");

        for (var i = 0; i < roomSections.length; i++) {
            var roomSectionTitle = roomSections[i].textContent.trim();
            if (roomSectionTitle === selectedRoomType) {
                roomSections[i].scrollIntoView({ behavior: 'smooth', block: 'start' });
                break;
            }
        }
    }
