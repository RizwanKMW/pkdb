<!DOCTYPE html>
<html lang="en-US">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Tutorials</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link href="<?php echo base_url()?>assets/rainbowSyntaxHiglighter/rainbow.css" rel="stylesheet" type="text/css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url()?>assets/tinymce/js/tinymce/tinymce.min.js" referrerpolicy="origin"></script>
     <!-- <script src="https://cdn.tiny.cloud/1/mbyj2ijlmg1tb8qutuctbqigx1p8fcd57vmsg9jmqxj5gdcd/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script> -->
  </head>
    <style>
    .navigation{
    background-color: #e0f1f5;
    }
    .nav-link{
    color:black;
    padding-top: 0;
    padding-bottom: 0;
    }
    .nav-link:hover{
    background-color: black;
    border-radius: 3px;
    color:white;
    }
    .buttons_are a{
      margin-top: 5px;
      margin-left: 10px;
    }
    .form-group,label{
      margin-bottom: 5px;
    }
    .card-header {
      padding: .05rem 1.25rem;
    }
    </style>
  </head>
  <body>
<!-- ############################# Modals #########################-->
    <!-- ############################# add_code_modal #########################-->
      <div class="modal fade" id="add_code_modal" role="dialog">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-body">

        <h6 class="text-black" >Add code</h6>
        <form  method="POST" id="add_code" action="<?php echo base_url()?>pkdb/add_code">
          <div class="form-group">
            <input type="text" class="form-control form-control-sm"  name="title" placeholder="title" spellcheck="true" required="true">
          </div>              
          <div class="form-group">
           <textarea id="code" rows="20" name="code" spellcheck="true"></textarea>
          <script>
            tinymce.init({
            height : "380",
            selector: '#code',  
            plugins: "anchor,lists,image,link,hr,table,codesample",
             toolbar: 'removeformat codesample| bold hr| alignleft aligncenter alignright|link| numlist bullist forecolor backcolor h1 h5  fontsizeselect table ', 
             setup: function(ed) {
              ed.on('keydown', function(event) {
                  if (event.keyCode == 9) { // tab pressed
                    if (event.shiftKey) {
                      ed.execCommand('Outdent');
                    }
                    else {
                      ed.execCommand('Indent');
                    }

                    event.preventDefault();
                    return false;
                  }
              });
              }
            });
          </script>
          </div>
          <div class="form-group">
                <label for="sel1">Category:</label>
                  <?php
                    if(!empty($categories_data)){
                    ?>
                    <span class="category_name"><?php echo $categories_data['title']?></span><input type="radio" name="category" checked="true" value="<?php echo $categories_data['id'];?>">
                <?php
                  }
                ?>
              </div>
           <div class="form-group">
            <label for="sel1">Tags:</label>
            
            <input type="text" class="tag_in" maxlength="32"/>
            <span class="tag_list">
              <!-- <span class="tag">xyz</span> will be produced using javascript assets/3b-tag.js -->
            </span>
            <div class="suggesstion-box"></div> <!-- show suggested tags-->
          </div>
          <button type="submit" class="btn btn-success" id="submit">Submit</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </form>
          </div>
        </div>
      </div>
    </div>


    <!-- ############################# edit_code_modal #########################-->
      <div class="modal fade" id="edit_code_modal" role="dialog">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-body">

            <h6 class="text-black" >Update code</h6>
            <form  method="POST" id="update_code" action="<?php echo base_url()?>pkdb/update_code">
              <div class="form-group">
                <input type="text" class="form-control form-control-sm"  name="title" placeholder="title" id="title">
              </div>              
              <div class="form-group">
               <textarea id="code_u" rows="20" name="code"></textarea>
              <script>
                tinymce.init({
                height : "380",
                selector: '#code_u',  
                plugins: "anchor,lists,image,link,hr,table,codesample",
                 toolbar: 'removeformat codesample| bold hr| alignleft aligncenter alignright alignjustify |link image| numlist bullist forecolor backcolor h1 h5  fontsizeselect table ', 
                 setup: function(ed) {
                  ed.on('keydown', function(event) {
                      if (event.keyCode == 9) { // tab pressed
                        if (event.shiftKey) {
                          ed.execCommand('Outdent');
                        }
                        else {
                          ed.execCommand('Indent');
                        }

                        event.preventDefault();
                        return false;
                      }
                  });
                  }
                });
              </script>
              </div>
              <div class="form-group">
                <label for="sel1">Category:</label>
                  <?php
                    if(!empty($categories_data)){
                    ?>
                    <span class="category_name"><?php echo $categories_data['title']?></span><input type="radio" name="category" checked="true" value="<?php echo $categories_data['id'];?>">
                <?php
                  }
                ?>
              </div>

              <div class="form-group">
                <label for="sel1">Tags:</label>
                
                <input type="text" class="tag_in" maxlength="32"/>
                <span class="tag_list">
                  <!-- <span class="tag">xyz</span> will be produced using javascript assets/3b-tag.js -->
                </span>
                <div class="suggesstion-box"></div> <!-- show suggested tags-->
              </div>


              <!-- <button type="submit" class="btn btn-success">Submit USING URL</button>  -->
              <input type="hidden" name="id_is" id="id_is">
              <input type="hidden" name="category" value="<?php echo $categories_data['id']; ?>">
              <button type="submit" class="btn btn-success" id="submit">Update</button>

              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </form>
          </div>
        </div>
      </div>
    </div>


    <div class="bg-success">
      <a class="" href="index.php" style="cursor: help; text-decoration: none;">
        <p class="text-white text-center headings" style="margin-bottom: 0px;">PK</p>
      </a>
    </div>


    <!-- nav bar -->
    <nav class="navbar navbar-expand-lg navigation">
      <a class="navbar-brand" href="<?php echo base_url()?>"><img src="<?php echo base_url()?>assets/images/logo.png" width="50px" height="50px" /></a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navb">
      <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navb">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link" href="javascript:void(0)" data-toggle="modal" data-target="#add_code_modal">Add code</a>
          </li>

          <li class="nav-item">
            <a class="nav-link disabled" href="javascript:void(0)">admin</a>
          </li>
        </ul>
        <form class="form-inline my-2 my-lg-0">
          <input class="form-control mr-s" type="text" placeholder="Search">
          <button class="btn btn-info my-2 my-sm-0" type="button">Search</button>
        </form>
      </div>
    </nav>
    <!-- nav bar   -->
    <div class="container-fluid ">
          <!-- ################################### code ###################################-->
          <style type="text/css">
            .edit_button{
              cursor: pointer;
            }
          </style>
          <div class="row mt-2">
            <div class="col-sm-12">
              <div id="accordion">
                <?php
                 if(!empty($code_data)){
                  foreach($code_data as $row){
                ?>
               <div class="card">
                  <div class="card-header">
                    <a class="card-link" style="display: block;display: block;float: left;width: 80%;" data-toggle="collapse" href="#id_<?php echo $row['id']?>">
                      <?php echo $row['title']?>
                    </a>
                    <span style="float:right;" class="badge badge-light edit_button" data-toggle="modal" data-target="#edit_code_modal" data-id="<?php echo $row['id'];?>" >&#9998;</span>
                  </div>
                  <div id="id_<?php echo $row['id']?>" class="collapse" data-parent="#accordion">
                    <div class="card-body">
                      <?php echo $row['code']?>
                    </div>
                  </div>
                </div>
                <?php
                    }
                  }
                ?>
              </div>

            </div>
          </div>
      </div>    
  <script>
    var base_url = '<?php echo base_url() ?>';
    $(document).ready(function(){
      //#############add new code ##############//
     $('#add_code').on('submit', function(event){
      event.preventDefault();
       var form_data = $(this).serialize();
       form_data=form_data+"&tags="+tag.list;
       $.ajax({
        url:base_url+"pkdb/add_code",
        method:"POST",
        data:form_data,
        success:function(data){
         alert("added success");
         $('#add_code_modal').modal('hide');
         window.location.reload();
        }
       });
     });
     //############# Add new code ##############//

     //############# when edit button clicked##############//
    $(".edit_button").click(function(){
      var id=$(this).attr("data-id");
      $.ajax({
      url: base_url+'pkdb/edit_code/'+id,
      type: 'POST',
      error: function() {alert("error");},
      success: function(data){
        res = JSON.parse(data);
        console.log(res);
        $("#id_is").val(res[0].id);
        $("#post_id").val(res[0].id);
        $("#title").val(res[0].title);
        tinyMCE.activeEditor.setContent(res[0].code);
        var category=res[0].category;

        $("input[type=radio][value="+category+"]").attr("checked",true);

        //now tags
        var tags='';
        $.each(res[1] , function(index, val) { 
          tags+="<span class='tag'>"+val+"</span>";
        });
        $('.tag_list').prepend(tags);
        }
      }); //ajax
    });//click
     //#############update code ##############//
     $('#update_code').on('submit', function(event){
      event.preventDefault();
       var form_data = $(this).serialize();
       form_data=form_data+"&tags="+tag.list;
       console.log(form_data);
       $.ajax({
        url:base_url+"pkdb/update_code",
        method:"POST",
        data:form_data,
        success:function(data){
         alert("added success");
         $('#edit_code_modal').modal('hide');
         window.location.reload();
        }
       });
     });


          
         
    });
  </script>  
  <script src="<?php echo base_url()?>assets/tags_mange/3b-tag.js"></script>
  </body>
</html>