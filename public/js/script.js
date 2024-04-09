$('.owl-carousel').owlCarousel({
    loop: true,
    margin: 10,
    nav: false,
    dot: true,
    autoplay: true,
    autoplayTimeout: 15000,
    autoplayHoverPause: false,
    responsive: {
      0: {
        items: 1
      },
      600: {
        items: 1
      },
      1000: {
        items: 1
      }
    }
  })

  /* const navlinks = document.querySelector('navbar-nav')

  const navitems = navlinks.querySelector('nav-link')

  navlinks.addEventListener('click', handleClick)

  function handleClick (e) {
    if (e.target.matches('nav-link')) {
      navitems.forEach(navitems => navitems.classList.remove('active'))
      e.target.classList.add('active')
    }
  } */

  /* var navs = document.getElementById('navlinks')
  var navitem = document.getElementsByClassName('nav-item')
  for (var i = 0; i < navitem.length; i++) {
    navitem[i].addEventListener('click' , function () {
      var current = document.getElementsByClassName('active')
      current[0].className = current[0].className.replace = ('active', '')
      this.className += 'active'
    })
  } */

  /* const links = document.querySelectorAll('.nav-link')
  if (links.length > 0) {
    links.forEach((link) => {
      link.addEventListener('click', (e) => {
        links.forEach((link) => {
          link.classList.remove('active')
        })
        e.preventDefault()
        link.classList.add('active')
      })
    })
  } */

  // Get the current page's URL
  var currentPageUrl = window.location.href

  // Get all navigation links
  var navLinks = document.querySelectorAll('.nav-link')

  // Loop through each navigation link
  navLinks.forEach(function (navLink) {
    // Check if the href attribute matches the current page URL
    if (navLink.href === currentPageUrl) {
      // Add active class to the matching nav link
      navLink.classList.add('active')
    }
  })

