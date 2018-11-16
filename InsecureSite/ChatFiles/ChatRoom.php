<!DOCTYPE html>   
<html>
<head>
  <title>Class Chat Room</title>
  <link type="text/css" rel="stylesheet" href="theme.css" />
</head>
<body>
  <!-- SITE NAVIGATION -->
    <div class="navbar navbar-default" role="navigation">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <div class="navbar-collapse collapse">
            <ul id="site-nav" class="nav navbar-nav">
                <li><a href="InsecureSite.html">Course Homepage</a></li>
                <li><a href="">Class Forum</a></li> <!--Link Webpage Here-->
                <li><a href="">Buy Class Textbook</a></li> <!--Link Webpage Here-->
                <li class="active"><a href="./">Course Feedback</a></li> 
            </ul>
        </div>
    </div>
    <!-- END SITE NAVIGATION -->
    
   <!-------Start Chat Session-----------> 
   <?php
    session_start ();
    
    function loginForm() {
        echo'
        <div id="loginform">
            <form action="ChatRoom.php" method="post">
                <p>Please enter your name to continue:</p>
                <label for="name">Name: </label>
                <input type="text" name="name" id="name" />
                <input type="submit" name="enter" id="enter" value="Enter" />
            </form>
        </div>
        ';
    }
    ?>
    
if (isset ( $_POST ['enter'] )) {
    if ($_POST ['name'] != "") {
        $_SESSION ['name'] = stripslashes (( $_POST ['name']));
        $fp = fopen ("log.html", 'a');
        fwrite ($fp, "<div class='msgln'><i>User " . $_SESSION ['name'] . " has joined the chat session.</i><br></div>");
        fclose ($fp);
    } else {
        echo '<span class="error">Please type in a name</span>';
    }
}
 
  <?php
        if(!isset($_SESSION['name'])){
             loginForm();
        }
        else{
  ?>
  <div id = "wrapper">
     <div id = "menu">
       <p class="welcome">Welcome, <b><?php echo $_SESSION['name']; ?></b></p>
       <p class="Logout"><a id="exit" href="#">Exit Chat</a></p>
      <div style="clear:both"></div>
    </div>
    <div id = "chatbox">
      <?php
        if(file_exists("log.html") && filesize("log.html") > 0){
          $handle = fopen("log.html", "r");
          $contents = fread($handle, filesize("log.html"));
          fclose($handle);
     
          echo $contents;
        }
      ?>
   </div>
  
    <form name = "message" action = "">
     <input name="usermsg" type="text" id="usermsg" size="63" />
     <input name="submitmsg" type="submit"  id="submitmsg" value="Send" />
    </form>
    </div>
   
  
   <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3/jquery.min.js"></script>
   <script type="text/javascript">
     //jQuery Document
     $(document).ready(function(){
        //If user wants to end session
        $("#exit").click(function(){
            var exit = confirm("Are you sure you want to end the session?");
            if(exit==true){window.location = 'ChatRoom.php?logout=true';}     
        });
    });
    
    if (isset($_GET ['logout'])) {
        $fp = fopen ("log.html", 'a');
        fwrite ($fp, "<div class='msgln'><i>User " . $_SESSION ['name'] . " has left the chat session.</i><br></div>");
        fclose ($fp);
   
        session_destroy ();
        header ( "Location: ChatRoom.php" ); // Redirect the user
    }
    
       //If user submits the form
        $("#submitmsg").click(function(){
            var clientmsg = $("#usermsg").val();
            $.post("post.php", {text: clientmsg});             
            $("#usermsg").attr("value", "");
            loadLog;
            return false;
        });
 
        function loadLog(){    
            var oldscrollHeight = $("#chatbox").attr("scrollHeight") - 20; //Scroll height before the request
            $.ajax({
            url: "log.html",
            cache: false,
            success: function(html){       
            $("#chatbox").html(html); //Insert chat log into the #chatbox div  
           
            //Auto-scroll          
            var newscrollHeight = $("#chatbox").attr("scrollHeight") - 20; //Scroll height after the request
            if(newscrollHeight > oldscrollHeight){
                $("#chatbox").animate({ scrollTop: newscrollHeight }, 'normal'); //Autoscroll to bottom of div
            }              
        },
    });
}
<!-------Refresh Chat Log Page--------->
setInterval (loadLog, 5000);

    
    
    
    </script>
 
?>  
    <?php
        }
    ?>
  </body>
</html>
