<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>403 - Unauthorized Access</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:'Poppins',sans-serif;
        }

        body{
            background: linear-gradient(135deg, #0d6efd, #6610f2);
            min-height:100vh;
            display:flex;
            align-items:center;
            justify-content:center;
            overflow:hidden;
            position:relative;
        }

        .error-container{
            background:#fff;
            width:90%;
            max-width:600px;
            border-radius:25px;
            padding:60px 40px;
            text-align:center;
            box-shadow:0 15px 40px rgba(0,0,0,0.2);
            position:relative;
            z-index:2;
            animation:fadeIn 0.8s ease;
        }

        .error-code{
            font-size:120px;
            font-weight:700;
            color:#dc3545;
            line-height:1;
            margin-bottom:20px;
        }

        .error-title{
            font-size:32px;
            font-weight:600;
            color:#222;
            margin-bottom:15px;
        }

        .error-text{
            font-size:16px;
            color:#666;
            margin-bottom:35px;
            line-height:1.8;
        }

        .btn-home{
            background:#0d6efd;
            color:#fff;
            border:none;
            padding:14px 35px;
            border-radius:50px;
            text-decoration:none;
            font-size:16px;
            font-weight:500;
            transition:0.3s ease;
            display:inline-block;
        }

        .btn-home:hover{
            background:#084298;
            transform:translateY(-3px);
            color:#fff;
        }

        /* Floating circles */

        .circle{
            position:absolute;
            border-radius:50%;
            background:rgba(255,255,255,0.1);
            animation:float 6s infinite ease-in-out;
        }

        .circle1{
            width:180px;
            height:180px;
            top:10%;
            left:10%;
        }

        .circle2{
            width:120px;
            height:120px;
            bottom:15%;
            right:12%;
            animation-delay:2s;
        }

        .circle3{
            width:80px;
            height:80px;
            top:60%;
            left:20%;
            animation-delay:4s;
        }

        @keyframes float{
            0%{
                transform:translateY(0px);
            }
            50%{
                transform:translateY(-20px);
            }
            100%{
                transform:translateY(0px);
            }
        }

        @keyframes fadeIn{
            from{
                opacity:0;
                transform:translateY(30px);
            }
            to{
                opacity:1;
                transform:translateY(0);
            }
        }

        @media(max-width:768px){

            .error-code{
                font-size:90px;
            }

            .error-title{
                font-size:26px;
            }

            .error-container{
                padding:45px 25px;
            }
        }

    </style>

</head>
<body>

    <!-- Background Shapes -->
    <div class="circle circle1"></div>
    <div class="circle circle2"></div>
    <div class="circle circle3"></div>

    <!-- Error Box -->
    <div class="error-container">

        <div class="error-code">
            403
        </div>

        <h1 class="error-title">
            Unauthorized Access
        </h1>

        <p class="error-text">
            Sorry, you do not have permission to access this page.
            Please contact the administrator if you believe this is a mistake.
        </p>

        <a href="{{ url('/') }}" class="btn-home">
            Back To Home
        </a>

    </div>

</body>
</html>