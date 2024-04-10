function multiply() {
    var input1 = parseFloat(document.getElementById("input1").value);
    var input2 = parseFloat(document.getElementById("input2").value);
    var result = input1 * input2;
  
    if (!isNaN(result)) {
      document.getElementById("result").value = result;
    } else {
      document.getElementById("result").value = "";
    }
  }


