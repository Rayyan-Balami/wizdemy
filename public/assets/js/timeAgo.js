// Function to calculate time ago
function getTimeAgo(time, serverTime) {
  const secondsAgo = Math.floor((serverTime - time) / 1000);
  if (secondsAgo < 60) return `Just now`;
  const minutesAgo = Math.floor(secondsAgo / 60);
  if (minutesAgo < 60) return `${minutesAgo} minute${minutesAgo === 1 ? '' : 's'} ago`;
  const hoursAgo = Math.floor(minutesAgo / 60);
  if (hoursAgo < 24) return `${hoursAgo} hour${hoursAgo === 1 ? '' : 's'} ago`;
  const daysAgo = Math.floor(hoursAgo / 24);
  if (daysAgo < 7) return `${daysAgo} day${daysAgo === 1 ? '' : 's'} ago`;
  const weeksAgo = Math.floor(daysAgo / 7);
  if (weeksAgo < 4) return `${weeksAgo} week${weeksAgo === 1 ? '' : 's'} ago`;
  const monthsAgo = Math.floor(weeksAgo / 4);
  if (monthsAgo < 12) return `${monthsAgo} month${monthsAgo === 1 ? '' : 's'} ago`;
  const yearsAgo = Math.floor(monthsAgo / 12);
  return `${yearsAgo} year${yearsAgo === 1 ? '' : 's'} ago`;
}

// Function to update time ago for elements with class 'time-ago'
async function updateTimeAgo() {
  const timeAgoElements = document.querySelectorAll('.time-ago');

  // Get server time if hosted on server then use this
  // add echo in body attribute in layout file
  // data-datetime = "<?= echo date('Y-m-d H:i:s'); ?>"
  // const serverTime = new Date(document.body.getAttribute('data-datetime'));

  // Get server time if hosted on Localhost then use this
  const serverTime = new Date();

  // Update time ago for each element
  timeAgoElements.forEach((span) => {
    const time = new Date(span.getAttribute('data-datetime'));
    const timeAgo = getTimeAgo(time, serverTime);
    span.innerHTML = timeAgo;
  });
}


// Event listener to update time ago on DOMContentLoaded
document.addEventListener('DOMContentLoaded', () => {
  updateTimeAgo(); // Initial update

  // Update time every minute
  setInterval(updateTimeAgo, 60000);
});