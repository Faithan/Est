
function showTablePendings() {

    var table1 = document.getElementById("table-container1");
    var table2 = document.getElementById("table-container2");
    var table3 = document.getElementById("table-container3");
    var table4 = document.getElementById("table-container4");
    var table5 = document.getElementById("table-container5");

    table1.style.display = "block";
    table2.style.display = "none";
    table3.style.display = "none";
    table4.style.display = "none";
    table5.style.display = "none";

    var pending_btn = document.getElementById("pending-btn");
    var confirmed_btn = document.getElementById("confirmed-btn");
    var checkedIn_btn = document.getElementById("checkedIn-btn");
    var checkedOut_btn = document.getElementById("checkedOut-btn");
    var rejected_btn = document.getElementById("rejected-btn");

    pending_btn.style.backgroundColor = 'white';
    pending_btn.style.color = '#002334';
    confirmed_btn.style.backgroundColor = '#002334';
    confirmed_btn.style.color = 'white';
    checkedIn_btn.style.backgroundColor = '#002334';
    checkedIn_btn.style.color = 'white';
    checkedOut_btn.style.backgroundColor = '#002334';
    checkedOut_btn.style.color = 'white';
    rejected_btn.style.backgroundColor = '#650000';
    rejected_btn.style.color = 'white';

}

function showTableConfirmed() {

    var table1 = document.getElementById("table-container1");
    var table2 = document.getElementById("table-container2");
    var table3 = document.getElementById("table-container3");
    var table4 = document.getElementById("table-container4");
    var table5 = document.getElementById("table-container5");


    table1.style.display = "none";
    table2.style.display = "block";
    table3.style.display = "none";
    table4.style.display = "none";
    table5.style.display = "none";

    var pending_btn = document.getElementById("pending-btn");
    var confirmed_btn = document.getElementById("confirmed-btn");
    var checkedIn_btn = document.getElementById("checkedIn-btn");
    var checkedOut_btn = document.getElementById("checkedOut-btn");
    var rejected_btn = document.getElementById("rejected-btn");

    pending_btn.style.backgroundColor = '#002334';
    pending_btn.style.color = 'white';
    confirmed_btn.style.backgroundColor = 'white';
    confirmed_btn.style.color = '#002334';
    checkedIn_btn.style.backgroundColor = '#002334';
    checkedIn_btn.style.color = 'white';
    checkedOut_btn.style.backgroundColor = '#002334';
    checkedOut_btn.style.color = 'white';
    rejected_btn.style.backgroundColor = '#650000';
    rejected_btn.style.color = 'white';

}


function showTableCheckedIn() {

    var table1 = document.getElementById("table-container1");
    var table2 = document.getElementById("table-container2");
    var table3 = document.getElementById("table-container3");
    var table4 = document.getElementById("table-container4");
    var table5 = document.getElementById("table-container5");

    table1.style.display = "none";
    table2.style.display = "none";
    table3.style.display = "block";
    table4.style.display = "none";
    table5.style.display = "none";

    var pending_btn = document.getElementById("pending-btn");
    var confirmed_btn = document.getElementById("confirmed-btn");
    var checkedIn_btn = document.getElementById("checkedIn-btn");
    var checkedOut_btn = document.getElementById("checkedOut-btn");
    var rejected_btn = document.getElementById("rejected-btn");

    pending_btn.style.backgroundColor = '#002334';
    pending_btn.style.color = 'white';
    confirmed_btn.style.backgroundColor = '#002334';
    confirmed_btn.style.color = 'white';
    checkedIn_btn.style.backgroundColor = 'white';
    checkedIn_btn.style.color = '#002334';
    checkedOut_btn.style.backgroundColor = '#002334';
    checkedOut_btn.style.color = 'white';
    rejected_btn.style.backgroundColor = '#650000';
    rejected_btn.style.color = 'white';


}


function showTableCheckedOut() {

    var table1 = document.getElementById("table-container1");
    var table2 = document.getElementById("table-container2");
    var table3 = document.getElementById("table-container3");
    var table4 = document.getElementById("table-container4");
    var table5 = document.getElementById("table-container5");

    table1.style.display = "none";
    table2.style.display = "none";
    table3.style.display = "none";
    table4.style.display = "block";
    table5.style.display = "none";
  

    var pending_btn = document.getElementById("pending-btn");
    var confirmed_btn = document.getElementById("confirmed-btn");
    var checkedIn_btn = document.getElementById("checkedIn-btn");
    var checkedOut_btn = document.getElementById("checkedOut-btn");
    var rejected_btn = document.getElementById("rejected-btn");

    pending_btn.style.backgroundColor = '#002334';
    pending_btn.style.color = 'white';
    confirmed_btn.style.backgroundColor = '#002334';
    confirmed_btn.style.color = 'white';
    checkedIn_btn.style.backgroundColor = '#002334';
    checkedIn_btn.style.color = 'white';
    checkedOut_btn.style.backgroundColor = 'white';
    checkedOut_btn.style.color = '#002334';
    rejected_btn.style.backgroundColor = '#650000';
    rejected_btn.style.color = 'white';
    
}

function showTableRejected() {

    var table1 = document.getElementById("table-container1");
    var table2 = document.getElementById("table-container2");
    var table3 = document.getElementById("table-container3");
    var table4 = document.getElementById("table-container4");
    var table5 = document.getElementById("table-container5");

    table1.style.display = "none";
    table2.style.display = "none";
    table3.style.display = "none";
    table4.style.display = "none";
    table5.style.display = "block";

    var pending_btn = document.getElementById("pending-btn");
    var confirmed_btn = document.getElementById("confirmed-btn");
    var checkedIn_btn = document.getElementById("checkedIn-btn");
    var checkedOut_btn = document.getElementById("checkedOut-btn");
    var rejected_btn = document.getElementById("rejected-btn");

    pending_btn.style.backgroundColor = '#002334';
    pending_btn.style.color = 'white';
    confirmed_btn.style.backgroundColor = '#002334';
    confirmed_btn.style.color = 'white';
    checkedIn_btn.style.backgroundColor = '#002334';
    checkedIn_btn.style.color = 'white';
    checkedOut_btn.style.backgroundColor =  '#002334';
    checkedOut_btn.style.color = 'white';
    rejected_btn.style.backgroundColor = 'white' ;
    rejected_btn.style.color = '#650000';
    
}



