<!DOCTYPE html>
<html>
<head>
    <title>Logging out...</title>
    <script>
        // Set logging out flag
        sessionStorage.setItem('logging_out', 'true');
        // Clear the authentication token
        sessionStorage.removeItem('aisAuthToken');
        // Redirect to login page
        window.location.href = '/';
    </script>
</head>
<body>
    <p>Logging out...</p>
</body>
</html> 