<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8">
        <title>Online bookstore</title>
        <link rel="stylesheet" href="styles/style.css">
        <link rel="stylesheet" href="styles/font-awesome.min.css">
        <link rel="icon" href="images/book.ico">
    </head>

    <body>
        <header>
            <nav> 
                <div class="links-container">
                    <a href="#" class="selected">BESTSELLERS</a>
                    <a href="#">JOURNALISM</a>
                    <a href="#">LITERATURE</a>
                    <a href="#">TEXTBOOKS</a>
                </div>
            </nav>
        </header>

    <main>
        <div class="headings-container">
            <h1>Online book store</h1>
            <h3>Reading is for everyone</h3>
        </div>

        <div id="registration-container">
            <i class="fa fa-user user-icon" ></i>
            <a href="#">Registration</a>
            <a href="#">Log in</a>
        </div>

        <div id="caption">
            <h5>Enjoy our vast collection of books, magazines, textbooks and much more!</h5>
        </div>

        <div id="slider-container">  
        </div>

        <div id="thumbnails-container">
        </div>

        <div id="bottom-button">
            <input type="submit" value="Add new image" id="add-button">
        </div>
    </main>

    <footer>
        <div id="footer-icons">
            <i class="fa fa-facebook-official fa-2x facebook-icon"></i>
            <i class="fa fa-twitter-square fa-2x twitter-icon"></i>
        </div>

        <p>All rights reserved <br/> Ana Pandža</p>

        <div id="footer-link">	
            <a href="#">About</a>
            <a href="#">Contact</a>
        </div>
    </footer>

    <script type="text/html" id="slider-template">
        <i class="fa fa-angle-left fa-4x arrow-icon-left"></i>
        <div id="slider-description">
            <h3>{{title}}</h3>
            <p>{{text}}</p><br/>
            <input type="submit" value="Edit" class="button" id= "edit"><br/>
            <input type="submit" value="Add new image" class="button" id="add-new">
       </div>
        <div id="slider-image" data-id="{{id}}">
            <img src="{{imageUrl}}" alt="{{title}}"><br/>
            <div id="stars"> 
                <i class="fa fa-star-o fa-2x"></i>
                <i class="fa fa-star-o fa-2x"></i>
                <i class="fa fa-star-o fa-2x"></i>
                <i class="fa fa-star-o fa-2x"></i>
                <i class="fa fa-star-o fa-2x"></i>
            </div> 
        </div>
       <i class="fa fa-angle-right fa-4x arrow-icon-right"></i>
    </script>

    <script type="text/html" id="thumbnail-template">
        <div class="thumbnail" data-id="{{id}}">
            <i class="fa fa-times delete-button"></i>
            <img src="{{imageUrl}}" alt="{{title}}">
            <h5>{{title}}</h5>
            <form>
                <input type="submit" value="Read more" class="more-button">
            </form>
        </div>
    </script>

    <script src="scripts/jquery-3.1.1.min.js"></script>
    <script src="scripts/mustache.min.js"></script>
    <script src="scripts/slider.js"></script>
    <script src="scripts/thumbnail.js"></script>
    </body>
</html>