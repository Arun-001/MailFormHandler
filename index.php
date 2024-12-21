<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Form</title>
    <link rel="stylesheet" href="styles.css"> <!-- Link to the new CSS file -->
</head>

<body>

    <div class="form-container">
        <h2>Contact Us</h2>
        <form action="process.php" method="POST">
            <label for="name">Name (required)</label>
            <input type="text" name="name" id="name" required>

            <label for="email">Email (required)</label>
            <input type="email" name="email" id="email" required>

            <label for="message">Message (required)</label>
            <textarea name="message" id="message" rows="5" required></textarea>

            <input type="submit" value="Submit">
        </form>
    </div>

</body>

</html>