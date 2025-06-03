 // here i will start header-responsive
 let nav = document.querySelector("nav"); 
let btn = document.querySelector(".bars"); 
let icon = document.querySelector(".bars i"); 

btn.addEventListener("click", function () {

    if(icon.classList.contains("fa-bars"))
    {
        icon.classList.replace("fa-bars","fa-xmark");
        nav.style.opacity="1";
        nav.style.visibility="visible";
        nav.style.top="100px";
    }else{
        icon.classList.replace("fa-xmark","fa-bars");
        nav.style.opacity="0";
        nav.style.visibility="hidden";
        nav.style.top="0px";
    }
  })
  // here i will End header-responsive


  document.addEventListener("DOMContentLoaded", function () {
    const videoBtn = document.getElementById("PlayVideo");
    const videoModal = document.getElementById("videoModal");
    const closeBtn = document.querySelector(".video-modal .close");
    const youtubeVideo = document.getElementById("youtubeVideo");
  
    videoBtn.onclick = () => {
      videoModal.style.display = "flex";
      youtubeVideo.play();
    };
  
    closeBtn.onclick = () => {
      videoModal.style.display = "none";
      youtubeVideo.pause();
      youtubeVideo.currentTime = 0;
    };
  
    window.onclick = (e) => {
      if (e.target == videoModal) {
        videoModal.style.display = "none";
        youtubeVideo.pause();
        youtubeVideo.currentTime = 0;
      }
    };
  
    ScrollReveal().reveal('.hero-left', {
      duration: 1000,
      origin: 'left',
      distance: '50px',
      easing: 'ease-in-out',
      reset: true
    });
  
    ScrollReveal().reveal('.hero-right', {
      duration: 1000,
      origin: 'right',
      distance: '50px',
      easing: 'ease-in-out',
      delay: 200,
      reset: true
    });
    ScrollReveal().reveal('.about-left', {
      duration: 1000,
      origin: 'left',
      distance: '50px',
      easing: 'ease-in-out',
      reset: true
    });
  
    ScrollReveal().reveal('.about-right', {
      duration: 1000,
      origin: 'right',
      distance: '50px',
      easing: 'ease-in-out',
      delay: 200,
      reset: true
    });
  
        // ScrollReveal for featured-scholarships section
        ScrollReveal().reveal('.featured-scholarships .section-header', {
          duration: 1000,
          origin: 'top',
          distance: '40px',
          easing: 'ease-in-out',
          reset: true
        });
    
        ScrollReveal().reveal('.featured-scholarships .card', {
          duration: 1000,
          origin: 'bottom',
          distance: '50px',
          easing: 'ease-in-out',
          interval: 200,
          reset: true
        });
    
        ScrollReveal().reveal('.featured-scholarships .btn-FS', {
          duration: 1000,
          origin: 'bottom',
          distance: '40px',
          delay: 600,
          easing: 'ease-in-out',
          reset: true
        });
    
        ScrollReveal().reveal('.faq-item', {
          duration: 800,
          origin: 'bottom',
          distance: '30px',
          interval: 200,
          easing: 'ease-in-out',
          reset: true
        });


        // ScrollReveal animations
        ScrollReveal().reveal('.testnomial-header', {
          origin: 'top',
          distance: '50px',
          duration: 1000,
          delay: 600,
          easing: 'ease-in-out',
        });

        ScrollReveal().reveal('.testnomial', {
          origin: 'bottom',
          distance: '50px',
          duration: 1000,
          delay: 200,
          easing: 'ease-in-out',
          reset: false, // true if you want it to reveal again on re-scroll
        });
      
        ScrollReveal().reveal('.swiper-slide', {
          origin: 'bottom',
          distance: '30px',
          duration: 800,
          interval: 200, // reveal slides one by one
        });
   
        
  });
  document.addEventListener("DOMContentLoaded", function () {
    const faqQuestions = document.querySelectorAll(".faq-question");
  
    faqQuestions.forEach(question => {
      question.addEventListener("click", () => {
        const answer = question.nextElementSibling;
        answer.style.display = answer.style.display === "block" ? "none" : "block";
      });
    });
  });


  function filterScholarships() {
    const level = document.getElementById('levelFilter').value.toLowerCase();
    const country = document.getElementById('countryFilter').value.toLowerCase();
    const search = document.getElementById('searchInput').value.toLowerCase();
    const errorMessage = document.getElementById("h1");
  
    const cards = document.querySelectorAll('.scholarship-card');
    let matchFound = false;
  
    cards.forEach(card => {
      const cardLevel = card.getAttribute('data-level');
      const cardCountry = card.getAttribute('data-country');
      const cardText = card.textContent.toLowerCase();
  
      const matchLevel = !level || cardLevel === level;
      const matchCountry = !country || cardCountry === country;
      const matchSearch = !search || cardText.includes(search);
  
      if (matchLevel && matchCountry && matchSearch) {
        card.style.display = "block";
        matchFound = true;
      } else {
        card.style.display = "none";
      }
    });
  
    if (matchFound) {
      errorMessage.style.display = "none";
    } else {
      errorMessage.style.display = "block";
    }
  }


      
      

  
  
  


  