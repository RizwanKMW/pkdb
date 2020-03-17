<!DOCTYPE html>
<html lang="en-US">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>PHP Cheat Sheet</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link href="<?php echo base_url()?>assets/rainbowSyntaxHiglighter/rainbow.css" rel="stylesheet" type="text/css">
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
    <h1 class="text-center text-danger">PHP cheetSheet</h1>      
    <p class="text-center text-success">index+preview+code.</p>
    <a href="javascript:void(0)"  class="btn btn-sm btn-danger mb-2" data-toggle="modal" data-target="#myModal">Add PHP Code</a>
  </div>

<!-- Modal to add date-->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-body">

      <h3 class="text-black" >Add Data</h3>
      <form  method="POST" action="<?php echo base_url()?>pkdb/insertPHP">
        <div class="form-group">
          <input type="text" class="form-control form-control-sm"  name="title" placeholder="title">
        </div>              
        <div class="form-group">
          <textarea class="form-control form-control-sm mt-1 mb-1" name="code" rows="10" placeholder="code"></textarea>
        </div>
        <div class="form-group">
          <textarea class="form-control form-control-sm mt-1 mb-1" name="description" rows="3" placeholder="description"></textarea>
        </div>
        <div class="form-group">
          <label for="sel1">Category:</label>
         <input type="text" class="form-control form-control-sm"  name="category" placeholder="category">
        </div>


        <!-- <button type="submit" class="btn btn-success">Submit USING URL</button>  -->
        <button type="submit" class="btn btn-success" id="submit">Submit</button>

        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </form>
        </div>
      </div>
    </div>
  </div>

<!-- Modal EDIT DATA-->
  <div class="modal fade" id="editData" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-body">

      <h3 class="text-black" >Update Data</h3>
      <form  method="POST" action="<?php echo base_url()?>pkdb/updatePHP">
        <div class="form-group">
          <input type="text" class="form-control form-control-sm"  name="title" id="titleU" placeholder="title">
        </div>              
        <div class="form-group">
          <textarea class="form-control form-control-sm mt-1 mb-1" name="code" rows="10" id="codeU" placeholder="code"></textarea>
        </div>
        <div class="form-group">
          <textarea class="form-control form-control-sm mt-1 mb-1" name="description" rows="3" id="descriptionU" placeholder="description"></textarea>
        </div>
        <div class="form-group">
          <label for="sel1">Category:</label>
         <input type="text" class="form-control form-control-sm"  name="category" id="categoryU" placeholder="category">
        </div>
        <input type="hidden" class="form-control form-control-sm"  name="id" id="id">

        <!-- <button type="submit" class="btn btn-success">Submit USING URL</button>  -->
        <button type="submit" class="btn btn-success" id="submit">Submit</button>

        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </form>
        </div>
      </div>
    </div>
  </div>
  <style type="text/css">
    .indexLinks{
      width:15%;
      display: inline-block;
      margin:3px 5px;
      background-color: white;
      overflow: hidden;
      white-space: nowrap;
      text-overflow: ellipsis;
      color:black;
      border-radius: 5px;
      padding:0 4px;
    }
    .codeIs{
      margin-bottom: 1px;
      border-bottom: 3px dotted green;
    }
  </style>
  <div class="indexRef">
     <?php
      foreach($arrayData as $data){
        $idIs=$data['id'];
        ?>
          <a href="#index<?php echo $idIs;?>" class="indexLinks"><?php echo $data['title'];?></a>
        <?php
          }
        ?>
  </div>
  <div class="workingArea">
    <?php
      foreach($arrayData as $data){
        $idIs=$data['id'];
        ?>
          <div class="contentDiv<?php echo $idIs;?>">
            <h4 class="bg-info text-white p-2 mt-1 rounded ButtoncodeShow" id="index<?php echo $idIs;?>">
              <?php echo $data['title']; ?>
              <div class="buttons" style="float: right;margin-bottom: 2px;">
                <button type="button" class="justify-content-end text-center btn btn-sm btn-danger">Show Des</button>
                <button class="justify-content-end text-center btn btn-sm btn-danger edit" data-toggle="modal" data-target="#editData" data-id="<?php echo $idIs;?>">EDIT</button>
                <a href='deletePHP/<?php echo $idIs;?>' class="justify-content-end text-center btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this item?');">Delete</a>
                </div>
            </h4>
              <pre><?php echo htmlentities( $data['code'] ); ?></pre>
              <?php if($data['description']!=""){?>
                <pre class="description"><?php echo $data['description']; ?> </pre>
              <?php }?>
          </div>
        <?php
      }

    ?>
  </div>
</div>
  <script>
    $(document).ready(function(){
      $(".edit").click(function(){
            var id=$(this).attr("data-id");
            $.ajax({
            url: 'editPHP/'+id,
            type: 'POST',
            data: {id: id},
            error: function() {alert("error");},
            success: function(data){
              res = JSON.parse(data);
              $("#id").val(res.id);
              $("#titleU").val(res.title);
              $("#codeU").val(res.code);
              $("#descriptionU").val(res.description);
              $("#categoryU").val(res.category);
              }
          }); //ajax

          });//click
    });
  </script>
<!--   <script src="<?php echo base_url()?>assets/rainbowSyntaxHiglighter/rainbow.js"></script>
  <script src="<?php echo base_url()?>assets/rainbowSyntaxHiglighter/generic.js"></script>
  <script src="<?php echo base_url()?>assets/rainbowSyntaxHiglighter/php.js"></script> -->
  </body>
</html>
