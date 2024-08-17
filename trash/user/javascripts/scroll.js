// for searching for category

function scrollToCategory(category) {
    if (category) {
      var element = document.getElementById(category);
      element.scrollIntoView({behavior: "smooth"});
    }
  }