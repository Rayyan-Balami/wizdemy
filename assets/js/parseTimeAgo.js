document.addEventListener('DOMContentLoaded', () => {
    const timeAgoSpan = document.querySelectorAll('.time-ago');


    timeAgoSpan.forEach((span) => {
        const time = new Date(span.getAttribute('data-datetime'));
        const now = new Date();
        const updateInterval = getUpdateInterval(time);

        const timeAgo = getTimeAgo(time);
        span.innerHTML = timeAgo;
        setInterval(() => {

            const timeAgo = getTimeAgo(time);
            span.innerHTML = timeAgo;
        }, updateInterval);
    });
});

function getTimeAgo(time) {
    const now = new Date();
    const secondsAgo = Math.floor((now - time) / 1000);
    if (secondsAgo < 60) return `${secondsAgo} seconds ago`;
    const minutesAgo = Math.floor(secondsAgo / 60);
    if (minutesAgo < 60) return `${minutesAgo} minutes ago`;
    const hoursAgo = Math.floor(minutesAgo / 60);
    if (hoursAgo < 24) return `${hoursAgo} hours ago`;
    const daysAgo = Math.floor(hoursAgo / 24);
    if (daysAgo < 7) return `${daysAgo} days ago`;
    const weeksAgo = Math.floor(daysAgo / 7);
    if (weeksAgo < 5) return `${weeksAgo} weeks ago`;
    const monthsAgo = Math.floor(weeksAgo / 4);
    if (monthsAgo < 12) return `${monthsAgo} months ago`;
    const yearsAgo = Math.floor(monthsAgo / 12);
    return `${yearsAgo} years ago`;

}

function getUpdateInterval(time) {
    const now = new Date();
    const secondsAgo = Math.floor((now - time) / 1000);
    if (secondsAgo < 60) return 1000; // update every second
    if (secondsAgo < 3600) return 60000; // update every minute
    if (secondsAgo < 86400) return 3600000; // update every hour
    clearInterval();
}