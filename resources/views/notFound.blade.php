<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Page Not Found</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            height: 100vh;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #ffffff;
        }
        .container {
            text-align: center;
            padding: 20px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 20px;
            backdrop-filter: blur(10px);
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
        }
        h1 {
            font-size: 8rem;
            margin: 0;
            animation: pulse 2s infinite;
        }
        p {
            font-size: 1.5rem;
            margin: 20px 0;
        }
        .btn {
            display: inline-block;
            padding: 12px 24px;
            background-color: #ffffff;
            color: #764ba2;
            text-decoration: none;
            border-radius: 30px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        .btn:hover {
            background-color: #764ba2;
            color: #ffffff;
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }
        .astronaut {
            width: 200px;
            height: 200px;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 512 512'%3E%3Cpath fill='%23ffffff' d='M256 48C141.1 48 48 141.1 48 256s93.1 208 208 208 208-93.1 208-208S370.9 48 256 48zm-72 320h144c8.8 0 16 7.2 16 16s-7.2 16-16 16H184c-8.8 0-16-7.2-16-16s7.2-16 16-16zm-16-80h176c8.8 0 16 7.2 16 16s-7.2 16-16 16H168c-8.8 0-16-7.2-16-16s7.2-16 16-16zm16-80h144c8.8 0 16 7.2 16 16s-7.2 16-16 16H184c-8.8 0-16-7.2-16-16s7.2-16 16-16zm-16-80h176c8.8 0 16 7.2 16 16s-7.2 16-16 16H168c-8.8 0-16-7.2-16-16s7.2-16 16-16z'/%3E%3C/svg%3E");
            background-size: contain;
            background-repeat: no-repeat;
            margin: 0 auto 20px;
            animation: float 6s ease-in-out infinite;
        }
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
            100% { transform: translateY(0px); }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="astronaut"></div>
        <h1>404</h1>
        <p>Oops! Looks like you're lost.</p>
        <a href="{{ url('/') }}" class="btn">Return to Home Page</a>
        </div>
</body>
</html>