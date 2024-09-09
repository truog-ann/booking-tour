<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>

</body>
<script>
    fetch('http://127.0.0.1:8000/api/client/get-tour-detail/1')
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            // Work with JSON data here
            console.log(data.data.itineraries);
        })
        .catch(error => {
            console.error('There was a problem with the fetch operation:', error);
        });
</script>

</html>
