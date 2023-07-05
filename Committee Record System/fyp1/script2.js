const form = document.querySelector('#login-form');
const emailInput = document.querySelector('#Email_U');
const passwordInput = document.querySelector('#Password_U');

form.addEventListener('submit', (event) => {
  event.preventDefault();
  if (!emailInput.value) {
    showError('Please enter your email.');
  } else if (!isValidEmail(emailInput.value)) {
    showError('Please enter a valid email address.');
  } else if (!passwordInput.value) {
    showError('Please enter your password.');
  } else {
    form.submit();
  }
});

function showError(message) {
  const errorElement = document.createElement('div');
  errorElement.classList.add('error');
  errorElement.textContent = message;
  form.prepend(errorElement);
  setTimeout(() => {
    errorElement.remove();
  }, 3000);
}

function isValidEmail(email) {
  const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  return regex.test(email);
}
