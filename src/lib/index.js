const plans = document.getElementById('showPlans');
const navPlans = document.getElementById('plansLink');

plans.addEventListener('click' , () => {
    window.scrollTo({
        top: document.body.scrollHeight,
        behavior: 'smooth'
      });
});

navPlans.addEventListener('click' , () => {
    window.scrollTo({
        top: document.body.scrollHeight,
        behavior: 'smooth'
      });
});

function reveal() {
    var reveals = document.querySelectorAll(".notActive");
    for (var i = 0; i < reveals.length; i++) {
      var windowHeight = window.innerHeight;
      var elementTop = reveals[i].getBoundingClientRect().top;
      var elementVisible = 145;
      if (elementTop < windowHeight - elementVisible) {
        reveals[i].classList.add("active");
      } else {
        reveals[i].classList.remove("active");
      }
    }
  }

window.addEventListener('scroll',reveal);