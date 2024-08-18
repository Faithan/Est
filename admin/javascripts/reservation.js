function showTable(tableIndex, buttonIndex) {
    // Array of table and button IDs
    const tables = ["table-container1", "table-container2", "table-container3", "table-container4", "table-container5", "table-container6"];
    const buttons = ["pending-btn", "confirmed-btn", "checkedIn-btn", "extended-btn", "checkedOut-btn", "rejected-btn"];
    const colors = { active: 'white', inactive: '#002334', rejectedActive: '#650000', rejectedInactive: 'white' };

    // Set table display
    tables.forEach((table, index) => {
        document.getElementById(table).style.display = index === tableIndex ? "block" : "none";
    });

    // Set button styles
    buttons.forEach((button, index) => {
        const btnElement = document.getElementById(button);
        if (index === buttonIndex) {
            btnElement.style.backgroundColor = button === "rejected-btn" ? colors.rejectedInactive : colors.active;
            btnElement.style.color = button === "rejected-btn" ? colors.rejectedActive : colors.inactive;
        } else {
            btnElement.style.backgroundColor = colors.inactive;
            btnElement.style.color = colors.active;
        }
    });

    // Store active table in localStorage
    localStorage.setItem('activeTable', tables[tableIndex]);
}

window.onload = function() {
    const activeTableMap = {
        "table-container1": 0,
        "table-container2": 1,
        "table-container3": 2,
        "table-container4": 4,
        "table-container5": 5,
        "table-container6": 3
    };
    
    const activeTable = localStorage.getItem('activeTable');
    if (activeTable && activeTableMap.hasOwnProperty(activeTable)) {
        showTable(activeTableMap[activeTable], activeTableMap[activeTable]);
    }
};

// Attach functions to buttons
document.getElementById("pending-btn").onclick = () => showTable(0, 0);
document.getElementById("confirmed-btn").onclick = () => showTable(1, 1);
document.getElementById("checkedIn-btn").onclick = () => showTable(2, 2);
document.getElementById("extended-btn").onclick = () => showTable(3, 3);
document.getElementById("checkedOut-btn").onclick = () => showTable(4, 4);
document.getElementById("rejected-btn").onclick = () => showTable(5, 5);
