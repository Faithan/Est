function changeColor(input) {
    if (input.value !== '') {
      input.classList.add('has-value');
    } else {
      input.classList.remove('has-value');
    }
  }
