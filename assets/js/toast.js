document.addEventListener('DOMContentLoaded', function() {
    var toasts = document.querySelectorAll('.toast');
    toasts.forEach(function(toast) {
        var duration = toast.getAttribute('data-duration');
        toast.style.transition = 'opacity 0.5s';
        toast.style.opacity = '1';
        setTimeout(function() {
            toast.style.opacity = '0';
            setTimeout(function() {
                toast.style.display = 'none';
            }, 500); // wait for 0.5s to hide after opacity is 0
        }, duration);
    });
});