<!DOCTYPE html>
<html lang="en-US">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Bootstrap 4 Cheat Sheet</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  </head>
  <style type="text/css">
  </style>
  <body>

  

<!--Slap all hidden-root-code stuff on to this for modals and things-->
                                                                                                                                                                                                                                                                                                                                                             <!-- Modal -->

<div class="container">
  <div class="jumbotron mt-2">
    <h1 class="text-center text-danger">Bootstrap 4 cheetSheet</h1>      
    <p class="text-center text-success">index+preview+code.</p>
  </div>

<?php
  foreach($arrayData as $data){
    echo "<div class='workingArea'>";
      $idIs="codeIs".$data['id'];
      echo "<h4 class='bg-success text-white p-2 mt-1 rounded ButtoncodeShow'>".$data['title']."</h4>";
      echo $data['code'];
      echo "<pre id='$idIs' class='codeIs'>".htmlentities( $data['code'] )."</pre>";
    echo '</div>';
  }

?>
</div>
  <script>
    $(document).ready(function(){
      //$(".codeIs").hide();
      // $(".ButtoncodeShow").click(function(){
      //   var classX=$(this).siblings().eq(1).attr("id");
      //   $("#"+classX).toggle();
      // });
    });
  </script>
  </body>
</html>
