function extendedPayment() {
    var input1 = parseFloat(document.getElementById("input1").value);
    var input2 = parseFloat(document.getElementById("input2").value);
    var input3 = parseFloat(document.getElementById("input3").value);

    var balance = input1 * input2;

    var change = balance - input3;
  
    var change = (change) * -1;

    if (!isNaN(change)) {
      document.getElementById("input4").value = change;
    } else {
      document.getElementById("input4").value = "";
    }
  }