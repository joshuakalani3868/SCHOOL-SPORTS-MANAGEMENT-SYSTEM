document.addEventListener('DOMContentLoaded', function () {
    const navToggle = document.querySelector('.nav-toggle');
    const navItems = document.querySelector('.nav-items');
  
    // Function to toggle the 'active' class smoothly
    function toggleMenu() {
      navItems.classList.toggle('active');
    }
  
    // Event listener to toggle the menu
    navToggle.addEventListener('click', function () {
      toggleMenu();
    });
  
    // Close the menu when clicking outside of it
    document.addEventListener('click', function (event) {
      if (!event.target.closest('.header')) {
        if (navItems.classList.contains('active')) {
          toggleMenu();
        }
      }
    });
  });
  