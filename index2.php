<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Practice Baranagay Website</title>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

        <style>
            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }
           body {
            font-family: Montserrat;
            background-color: #ecebfd;
            overflow-y: auto;
            padding: 0;
            margin: 0;
            }
           header {
            /* background-color: #69698f; */
            height: 80px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 4px 10px rgba(#8a8a9e,0.6); 
            background: linear-gradient(135deg, #69698f, #986cf4);
            box-shadow: 0 5px 10px grey;
            border-bottom: 1px solid #8a8a9e;
            padding-left: 10px;
           }

           main {
            display: flex;
            justify-content: space-between;           
           }

           .left-middle-section {
            display: flex;
            align-items: center;
            gap: 16px;
           }

           .picture-area {
            width: 70px;
            height: 70px;
            border-radius: 50%;
           }

           .tsora-logo {
            width: 100%;
            height: 100%;
            overflow: hidden;
            object-fit: cover;
            border-radius: 50%;
           }

           .middle-section {
            line-height: 1.3;
            font-size: 8.6px;
            font-weight: 600;
            color: white;
           }

           .right-section {
            display: flex;
            justify-content: space-between;
            gap: 30px;
            margin-right: 30px;
            font-weight: bold;
            color: white;
            text-shadow: 0 2px 5px rgb(221, 220, 220);
            transition: background-color 0.2s ease;
           }

           .right-section a {
            text-decoration: none;
            color:white ;
           }

           .right-section div:hover {
           background-color: rgba(0,0,0,0.08);  
           }

           .main-left {
            display: flex;
            flex-direction: column;
            margin-top: 20px;
            margin-left: 20px;
           }

           .doc-element-area {
            margin-top: 30px;
            margin-bottom: 20px ;
           }

           .main-title {
            font-weight: bold;
            font-size: 31.5px;
            margin-left: 20px;
           }

           .short-description {
            font-size: 13.3px;
            color: #69698f;
            font-weight: bold;
            margin-bottom: 20px;
            margin-top: 10px;
            margin-left: 20px;
           }

           .request-button {
            background: linear-gradient(135deg, #69698f, #986cf4);
            padding: 12px 2px;
            width: 500px;
            margin-left: 10px;
            border: none;
            border-radius: 4px;
            box-shadow: 0 5px 10px grey;
            color: white;
            text-shadow: 0 2px 5px rgb(44, 41, 41);
            font-weight: bold;
            font-size:  24.8px;
            cursor: pointer;
            transition: transform 0.25 ease;
           }

           .request-button:hover{
            transform: scale(1.05);
           }

           .how-section {
            color: #505094;
            font-weight: bold;       
            margin-top: 20px;
            margin-left: 10px;
            display: flex;
            flex-direction: row;
            align-items: center;
            gap: 10px;
           }

           .how-section button {
            background-color: #505094;
            text-shadow: 0 2px 5px rgb(44, 41, 41);
            box-shadow: 0 5px 10px grey;
            color: white;
            font-weight: bold;
            border: none;
            border-radius: 25%;
            padding: 5px 10px;
            cursor: pointer;
            transition: transform 0.25s ease;
           }

           .how-section button:hover{
            transform: scale(1.05);
           }

           .bg-brgy-area{
            width: 500px;
            height: 500px;
            margin-top: 20px;
           }

           .bg-brgy-area img{
            width: 100%;
            height: 100%;
           }

        </style>

    </head>

    <body>
        <header>
            <div class="left-middle-section">
                <div class="picture-area">
                    <img class="tsora-logo" src="img/tandangsora1-logo.jpg">
                </div>

                <div class="middle-section">
                <div>REPUBLIC OF THE PHILIPPINES</div>
                <div>NATIONAL CAPITAL REGION</div>
                <div>QUEZON CITY</div>
                <span style="color: #d6d0ff; font-size: 10.7px; font-weight: bold;">
                    <div>BARANGAY TANDANG SORA</div>
                </span>
                </div>
            
            </div>

            <div class="right-section">
                <div><a href="signup.php">SIGN UP</a></div>
                <div><a href="login.php">LOG IN</a></div>
            </div>

        </header>

        <main>
            <div class="main-left">

                <div class="doc-element-area">
                    <img src="img/documents-logo.svg">
                </div>

                <div class="main-title">
                    <div>WELCOME TO THE OFFICIAL</div>
                    <span style="color: #505094;"><div>DOCUMENT FILE REQUEST SYSTEM</div></span>
                    <div>OF BARANGAY TANDANG SORA</div>
                </div>
                <div class="short-description">
                    <div>Simplifying barangay document requests
                     through a digital</div>
                    <div>platform
                     that lets you apply, track, and receive updates</div>
                    <div> online—no need
                     for long lines.</div>
                </div>
                <a href="login.php"><button class="request-button">REQUEST A DOCUMENT -></button></a>
                <div class="how-section">
                    <button class="qmark-part">?</button>
                    <div class="how-part">HOW IT WORKS</div>
                </div>
            </div>

            <div class="main-right">
                <div class="bg-brgy-area">
                    <img src="img/barangay-bg.svg">
                </div>
            </div>

        </main>

    </body>
</html>