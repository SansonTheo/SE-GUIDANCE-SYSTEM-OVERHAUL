
<!DOCTYPE html>
<html>
    <head>
        <title>Document</title>
        <link rel="stylesheet" type="text/css" href="css/main.css">
        <link rel="stylesheet" type="text/css" href="css/login.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    </head>
    <body style="background-color: rgb(224, 224, 224); padding-top:60px; min-width:800px;">
        <div class="toggle-bar">
            <div class="btn-toggle-nav p-0"  onclick="toggleNav()"><img src="imgs/icon-menu.png" style="height:80%; width:80%;"></div>
        </div>
        <div class="title-bar">
            <div class="seal-container"><img src="imgs/wmsu-seal.png"></div>
            <div>WMSU Guidance</div>
        </div>
        <form method="post" action="login.php" class="center-container" style="padding-top:100px;">
            <div class="form-label" style="height:100px;">
                Login
            </div>
            <div class="subgroup-container biographics">
                <div class="subgroup-label-container">
                    <p class="subgroup-label">Login</p>
                </div>
                <div class="question-container">
                    <p>Username</p>
                    <input type="text" placeholder="Username" id="username" name="username">
                </div>
                <div class="question-container">
                    <p>Password</p>
                    <input type="password" placeholder="Password" id="password" name="password">
                </div>
                <div class="buttons" style="display:flex; align-items:center; justify-content:center;">
                    <button class="action-button" id="addSiblingToTable" style="width:80px; height:30px;">
                        <div class="action-button-label">
                            Login
                        </div>
                    </button>
                </div>
            </div>
        </form>
        <div class="page-footer" style="width:100%; margin-left:0px; margin-top:223px;">
            <div class="footer-container">
                <div class="footer-seal-container">
                    <div class="footer-seal">
                        <div class="footer-img-container">
                            <img src="imgs/wmsu-seal.png">
                        </div>
                        <div class="footer-wmsu-container">
                            <p>Western Mindanao</p>
                            <p>State University</p>
                        </div>
                    </div>
                    <div class="footer-location-info" style="font-size:17px;">
                        <p style="font-size:15px;">Guidance and Counseling</p>
                        <p>Normal Road, Baliwasan</p>
                        <p>7000, Zamboanga City</p>
                        <p>Philippines</p>
                    </div>
                </div>
                <div class="footer-buttons-container">
                    <a href="#">Home</a>
                    <a href="#">Student Profiling</a>
                    <a href="#">Guidance Counseling</a>
                </div>
                <div class="footer-buttons-container">
                    <a href="#">About</a>
                    <a href="#">Mission & Vision</a>
                    <a href="#">Support</a>
                    <a href="#">Contact Us:</a>
                    <p class="footer-contact-info">(062) 991 - 6446</p>
                    <p class="footer-contact-info">gcc@wmsu.edu.ph</p>
                </div>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
        <script src="js/main.js"></script>
    </body>
</html>