document.addEventListener('DOMContentLoaded', () => {
  const timeAgoElements = document.querySelectorAll('.time-ago');

  timeAgoElements.forEach((span) => {
    const time = new Date(span.getAttribute('data-datetime'));
    const updateInterval = getUpdateInterval(time);

    const updateText = () => {
      const timeAgo = getTimeAgo(time);
      span.innerHTML = timeAgo;
    };

    updateText(); // Initial update

    setInterval(updateText, updateInterval);
  });
});

function getTimeAgo(time) {
  const now = new Date();
  const secondsAgo = Math.floor((now - time) / 1000);
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

function getUpdateInterval(time) {
  const now = new Date();
  const secondsAgo = Math.floor((now - time) / 1000);
  if (secondsAgo < 60) return 1000; // update every second
  if (secondsAgo < 3600) return 60000; // update every minute
  if (secondsAgo < 86400) return 3600000; // update every hour
  return 86400000; // update every day (default)
}

//after ajax success call this function to update timeAgo
function updateTimeAgo() {
  const timeAgoElements = document.querySelectorAll('.time-ago');
  timeAgoElements.forEach((span) => {
    const time = new Date(span.getAttribute('data-datetime'));
    const timeAgo = getTimeAgo(time);
    span.innerHTML = timeAgo;
  });
}
