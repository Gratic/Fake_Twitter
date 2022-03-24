<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>Legit</title>
  <link rel="stylesheet" type="text/css" href="lib/bootstrap-5.1.3-dist/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="style/legit.css">

</head>
<script src="lib/jquery.js"></script>
<script type="text/javascript">

var x = '';
var y = '';
var fakeCursor= '';

$(document).ready(function() {
  
  fakeCursor=$('#fake-cursor');
    $("#donate").click(function(){
      alert("you donated!");
    })
    $("#like").click(function(){
      alert("you liked!");
    })

    $(document).mousemove(function(e){
    // get mouse coordinates
    x = e.pageX;
    y = e.pageY;
     
    
        // calculate iFrame coordinates
        var offTop = y;
        var offLeft = x+75;
         
        // set iFrame coordinates   
        $(fakeCursor).offset({ top: offTop, left: offLeft });
    });
  });
</script>
<body>
  <nav class="navbar navbar-dark bg-dark navbar-expand-lg">
    <a class="navbar-brand " href=""> Stream.co</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
      aria-controls="navbarNav" aria-expanded="" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" href="#"></a>
        </li>

      </ul>
    </div>
  </nav>
  <section id="title">

    <div class="container">
      <div class="row">
        <div class="zone col-lg-6">
          <h1 class=" catch-phrase"><b> Your Favorite Gamers.</b></h1>
          <img id="fake-cursor" src="ressources/img/cursor.png"> 
          
          <button id="donate" class="download-btn btn btn-dark" type="button">Donate</button>
          <button id="like" class="download-btn btn btn-outline-light" type="button"><i class="fab fa-google-play"></i>
            Like</button>
        </div>
        <div class="col-lg-6">
        
          
          <img src="ressources/img/d90.jpg" class="gamer-pic" alt="gamer">
        </div>
      </div>
    </div>
    </div>
  </section>
  <script src="lib/bootstrap-5.1.3-dist/js/bootstrap.min.js"></script>
 

</body>


</html>