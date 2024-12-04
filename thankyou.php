<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank You Page</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #ffffff;
            font-family: Arial, sans-serif;
        }
        .container-custom {
            background-color: #F0F4FF;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 900px;
            width: 100%;
            height: auto;
            margin-top: 20px;
            text-align: center;
            display: flex;
            flex-direction: column;
            justify-content: center;
            overflow: hidden;
        }
        .back-arrow-container {
            position: absolute;
            top: 20px;
            left: 20px;
        }
        .back-arrow {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            background-color: #ffffff;
            color: #333;
            border-radius: 50%;
            text-decoration: none;
            box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.2);
            font-size: 1.25rem;
            transition: color 0.2s, background-color 0.2s;
        }
        .back-arrow:hover {
            color: #ffffff;
            background-color: #007bff;
        }
        h1 {
            color: #333;
            font-size: 1.75rem;
            margin-bottom: 20px;
            text-align: left;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: flex-start;
            white-space: nowrap;
        }
        h1 img {
            width: 40px;
            height: 40px;
            margin-left: 10px;
        }
        p {
            color: #555;
            font-size: 1rem;
            line-height: 1.6;
            text-align: justify;
            word-wrap: break-word;
        }
        @media (max-width: 768px) {
            .container-custom {
                padding: 20px;
            }
            h1 {
                font-size: 1.5rem;
            }
            p {
                font-size: 0.9rem;
            }
        }
        
        @media (max-width: 460px) {
            h1 {
                font-size: 1.2rem;
                flex-wrap: wrap;
            }
            h1 img {
                width: 30px;
                height: 30px;
            }
            p {
                font-size: 0.85rem;
            }
            .container-custom {
                padding: 15px;
            }
            
        }

        @media (max-width: 400px) {
            h1 {
                font-size: 1rem;
                flex-wrap: wrap;
            }
            h1 img {
                width: 20px;
                height: 20px;
            }
            p {
                font-size: 0.70rem;
            }
            .container-custom {
                padding: 15px;
            }
        }
    </style>
</head>
<body>

<div class="back-arrow-container">
    <a href="index.php" class="back-arrow">←</a>
</div>

<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="container-custom text-center p-4">
        <h1>
            Thank You for Your Application! <img src="logo.png" alt="Logo">
        </h1>
        <p>
            We appreciate your interest in our scholarship program. <b>Your application has been successfully submitted, and our team is currently reviewing all submissions.</b>
        </p>
        <p>
            We understand how important this opportunity is for you, and we are committed to giving each application the attention it deserves.
        </p>
        <p>
            Thank you once again for taking this important step toward your academic future. See you, future scholar!
        </p>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
