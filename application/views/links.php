<DOCTYPE! html>
<html>
  <head>
    <title>PAKISTAN DB</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    
  </head>
  <body>
    <div class="bg-success">
        <p class="text-white text-center headings" style="margin-bottom: 0px;">Links</p>
        <button type="button" class="btn btn-sm btn-danger mb-2" data-toggle="modal" data-target="#myModal">Add new Links</button>
    </div>

        <div class="info p-2 mt-5 mr-2" style="position:fixed;top:0;right:0; width:300px;color:white;z-index: 10;border-radius: 10px;">
        </div>
 <!-- Modal -->

  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-body">

            <?php
              $link_text=$description=$link=$id="";
            ?>

      <h3 class="text-black" >Add Data</h3>
      <form  method="POST" action="<?php echo base_url()?>pkdb/insertLinksData">
        <div class="form-group">
          <label class="text-black" >link text:</label>
          <input type="text" class="form-control" id="name" name="link_text" value="<?php echo $link_text;?>" >
        </div>
        <div class="form-group">
          <label class="text-black" >Discription:</label>
          <textarea class="form-control" rows="3" name="disc" spellcheck="true"><?php echo $description;?></textarea>
        </div>
        <div class="form-group">
          <label class="text-black" >Link:</label>
          <input type="text" class="form-control" id="link" name="link" value="<?php echo $link;?>">
        </div>
        
        <div class="form-group">
          <label class="text-black" >Featured:</label>
          <input type="checkbox" value="1" name="featured">
        </div>

        <!-- <button type="submit" class="btn btn-success">Submit USING URL</button>  -->
        <button type="submit" class="btn btn-success" id="submit">Submit</button>

        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </form>
        </div>
      </div>
    </div>
  </div>

  <!-- model -->
    <div class="container-fluid ">
      <div class="row">
          <?php
          $index="A";

          if(!empty($arrayData)){
          $i=0;
          foreach($arrayData as $row){
          ?>

            <?php
             if($index!=$row['link_text'][0]){
             }
            ?>

            <div class="col-2 border-bottom">        
              <a class="hoverAnchor" href="<?php echo $row['link'];?>" title="<?php echo $row['description']; ?>">
              	<?php echo $row['link_text']; ?>
              </a> 
              <!-- <img class="infoButton border" width="20px" height="20px" src="<?php echo base_url()?>/assets/info-solid.svg"> -->
              <p class="disc"><?php echo $row['description']; ?></p>
            </div>
          <?php
          $i++;
          }
          }
          ?>
      </div>
    </div>
  </body>
  <script>
  $(document).ready(function(){
  		$(".disc").hide();
      $(".hoverAnchor").hover(function(){
        var text=$(this).siblings("p").html();
        //alert(text);
        $(".info").css("background","black");
        $(".info").html(text);
      },
      function(){
        $(".info").empty();
        $(".info").css("background","transparent");
      });
  
  });
  </script>
</html>