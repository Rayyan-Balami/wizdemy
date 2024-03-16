let auth;

// Use AJAX to fetch authentication status
$.ajax({
    url: '/api/authStatus',
    method: 'POST',
    dataType: 'json',
    success: function(response) {
        auth = response.data.auth;
    },
    error: function(xhr, status, error) {
        console.error(xhr.responseText);
    }
});