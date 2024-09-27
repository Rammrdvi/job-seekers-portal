<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Job Portal</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 0;
        }
        header {
            background-color: #2c3e50;
            color: #fff;
            padding: 20px 0;
            text-align: center;
        }
        header h1 {
            margin: 0;
            font-size: 2.5em;
            font-weight: 700;
        }
        .hero {
            background: #3498db;
            color: #fff;
            padding: 80px 0;
            text-align: center;
            background-image: url('https://static.weblinkindia.net/images/job-portal-banner.jpg'); /* Optional: Add a background image */
            background-size: cover;
            background-position: center;
        }
        .hero h1 {
            margin: 0;
            font-size: 4em;
            font-weight: 700;
        }
        .hero p {
            font-size: 1.5em;
            margin: 10px 0;
        }
        .hero a {
            display: inline-block;
            background-color: #fff;
            color: #3498db;
            padding: 15px 30px;
            text-decoration: none;
            font-weight: bold;
            border-radius: 5px;
            margin-top: 20px;
        }
        .hero a:hover {
            background-color: #eaf0f1;
        }
        .links {
            text-align: center;
            margin: 40px 0;
        }
        .links a {
            display: inline-block;
            margin: 0 15px;
            padding: 10px 20px;
            background-color: #3498db;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
        }
        .links a:hover {
            background-color: #2980b9;
        }
        .container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
        }
        section {
            margin: 40px 0;
        }
        h2 {
            font-size: 2em;
            margin-bottom: 20px;
            font-weight: 700;
        }
        ul {
            list-style-type: disc;
            margin-left: 20px;
        }
        footer {
            background-color: #2c3e50;
            color: #fff;
            padding: 20px 0;
            text-align: center;
            font-size: 0.9em;
        }
    </style>
</head>
<body>
    <header>
        <div class="container">
            <h1>Job Portal</h1>
        </div>
    </header>

    <section class="hero">
        <div class="container">
            <h1>Welcome to the Job Portal</h1>
            <p>Your gateway to exceptional job opportunities.</p>
        </div>
    </section>

    <section class="links">
        <div class="container">
            <a href="{{ route('login') }}">Login</a>
            <a href="{{ route('register') }}">Register</a>
        </div>
    </section>

    <section class="container">
        <h2>Why Choose Us?</h2>
        <p>Our job portal offers a range of features designed to connect job seekers with their ideal opportunities and help employers find top talent:</p>
        <ul>
            <li>Extensive job listings across various sectors.</li>
            <li>Advanced search and filter options tailored to your preferences.</li>
            <li>Simplified application process with real-time status tracking.</li>
            <li>Employers can post job openings, manage applications, and connect with qualified candidates.</li>
        </ul>
    </section>

    <footer>
        <div class="container">
            <p>&copy; 2024 Job Portal. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>
