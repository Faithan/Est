function subtract() {
    var result = parseFloat(document.getElementById("result").value);
    var input3 = parseFloat(document.getElementById("input3").value);
    var input4 = parseFloat(document.getElementById("input4").value);

    var totalpayment = input3 + input4;

    var change = result - totalpayment;
  
    var change = (change) * -1;

    if (!isNaN(change)) {
      document.getElementById("change").value = change;
    } else {
      document.getElementById("change").value = "";
    }
  }