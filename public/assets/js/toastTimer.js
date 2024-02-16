// Get all toast messages
const toastCollection = document.querySelectorAll('.toast-notification li');

// initial delay for showing
let delay = 0;

// show loop
toastCollection.forEach((toast, index) => {
  setTimeout(() => {
    toast.style.display = 'flex'; // change the display property hidden to flex
  }, delay);

  delay += 1150; // Increment delay for the next toast
});

// initial delay for removing
delay = 7000;

// remove loop
toastCollection.forEach((toast) => {
  setTimeout(() => {
    removeToast(toast); // function to remove the toast
  }, delay);

  delay += 1150; // Increment delay for the next toast message
});

// Function to remove toast after animation ends
function removeToast(toast) {
  toast.classList.add('toast-off'); // Add toast-off class
  toast.addEventListener('animationend', () => {
    toast.remove(); // Remove the toast from the DOM after animation ends
  });
}