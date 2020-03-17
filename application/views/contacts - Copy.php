<DOCTYPE! html>
<html>
  <head>
    <title>PAKISTAN DB</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <!-- DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/css/jquery.dataTables.css">
     
    <!-- jQuery -->
    <script type="text/javascript" charset="utf8" src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.8.2.min.js"></script>
     
    <!-- DataTables -->
    <script type="text/javascript" charset="utf8" src="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/jquery.dataTables.min.js"></script>
    
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <style type="text/css">
      .dataTables_wrapper{
        width: 100%;
        margin-top:2px;
      }

    </style>
  </head>
  <?php
  $servername = "localhost";
  $username = "root";
  $password = "";
  $db="pkdb";

$conn = new mysqli($servername, $username, $password,$db);// Create connection

if ($conn->connect_error) { // Check connection
    die("Connection failed: " . $conn->connect_error);
}

  $query="SELECT * FROM contacts ORDER BY name";
  $result = $conn->query($sql);
  $data['arrayData']=$result;
  print_r($data);die;

  ?>
  <body>
    <div class="bg-success">
        <p class="text-white text-center headings" style="margin-bottom: 0px;">Contacts</p>

      <a href="javascript:void(0)"  class="btn btn-sm btn-danger mb-2" data-toggle="modal" data-target="#myModal">Add new contact</a>
    </div>
    

     <!-- Modal -->

  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-body">

      <h3 class="text-black" >Add Data</h3>
      <form  method="POST" action="<?php echo base_url()?>pkdb/insertContactsData">
        <div class="form-group">
          <label class="text-black" >Name:</label>
          <input type="text" class="form-control"  name="name" >
        </div>
        <div class="form-group">
          <label class="text-black" >Contact No:</label>
          <input type="text" class="form-control"  name="contact" >

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

        <table id="example" class="display" style="width:100%">
  <thead>
    <tr>
      <th>#</th>
      <th>First Name</th>
      <th>Contact</th>
    </tr>
  </thead>
    <tbody>
          <?php
          if(!empty($arrayData)){
          $i=1;
          foreach($arrayData as $row){
          ?> 

          <tr>
            <th scope="row"><?php echo $i;?></th>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['contact']; ?></td>
          </tr>
          <?php
          $i++;
          }
          }
          ?>
    </tbody>
</table>

  </body>
  <script>
  $(document).ready(function(){
  
    $('#example').DataTable({
      "iDisplayLength": 50
    });
  
  });
  </script>
</html>