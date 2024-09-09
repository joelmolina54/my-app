document.addEventListener('DOMContentLoaded', () => {
    const loginButton = document.getElementById('loginButton');
    const flipContainer = document.querySelector('.flip-container');
  
    loginButton.addEventListener('click', () => {
      flipContainer.classList.toggle('flipped');
    });
  });