// Get all elements with the class name 'dropdown'
const navLists = document.querySelectorAll('.dropdown');

// Loop through each navigation list element to set the width
navLists.forEach((navList) => {
  // Get the bounding box width of the navigation list content for each element
  const navListContentWidth = navList.getBoundingClientRect().width;

  // Get the corresponding dropdown content element for each navigation list
  const dropdownContent = navList.querySelector('.dropdown-content');

  // Apply the content width to the dropdown content element
  dropdownContent.style.width = `${navListContentWidth}px`;

  // Show dropdown content below the dropdown element on hover
  navList.addEventListener('mouseover', () => {
    const navListRect = navList.getBoundingClientRect();
    dropdownContent.style.position = 'absolute';
    dropdownContent.style.top = `${navListRect.bottom}px`; // Position the content below the dropdown
    dropdownContent.style.left = `${navListRect.left}px`;
    dropdownContent.style.display = 'block';
  });

  // Hide dropdown content when not hovering
  navList.addEventListener('mouseout', () => {
    dropdownContent.style.display = 'none';
  });
});