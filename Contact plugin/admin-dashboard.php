<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/6f17665668.js" crossorigin="anonymous"></script>

    <title>Admin Dashboard</title>
</head>
<body>
<table class="table">

  <thead>
    <tr>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col">Subject</th>
      <th scope="col">Message</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>

  <tbody>
    <?php
        $connection = mysqli_connect('localhost','root','');
        mysqli_select_db($connection,"contact-plugin-wp");
        $query = "SELECT * FROM contact order by id desc";
        $result = mysqli_query($connection, $query);
            while ($row = $result->fetch_assoc()) {
                echo '<tr>
                        <td>'. $row["Name"] . '</td>
                        <td>' . $row["Email"] . '</td>
                        <td>' . $row["Subject"] . '</td>
                        <td>' . $row["Message"] . '</td>
                        <td class="d-flex justify-content-end>

                          <form  action="#" method="post">
                            <button type="submit" class="btn btn-warning" name="response" onclick = "show_response()" ;> Reply <i class="fas fa-reply"></i> </button>
                          </form>&nbsp;

                          <form action="#" method="post">
                            <input type="text" value="'.$row["id"].'" name="id" hidden>
                            <button type="submit" class="btn btn-danger" name="delete" > Delete <i class="far fa-trash-alt"></i></button>
                          </form>

                        </td>
                     </tr>';
            }   

        if(isset($_POST['delete'])){
          $id=$_POST['id'];
          $queryD="DELETE FROM contact WHERE id=$id";
          mysqli_query($connection, $queryD);

        }
        
        
    ?>

  </tbody>

</table>


<!----------------------------------------------------------------->
<!-- Response  -->
<!----------------------------------------------------------------->

<div id="response" style="display: none;">
  <div class="card" style="width: 35rem; height: 15rem;">
    <div class = "d-flex justify-content-between">
      <h2 class="card-title">Response </h2> 
      <button type="button" class="close" onclick ="hide_response()">
        <span aria-hidden="true">&times;</span>
      </button> 
    </div>
                          
    <div class="card-body d-flex justify-content-center align-items-center">
      <form action="#" method="POST" class="text-center align-items-center">

        <p class="send_msg"> Write your response </p>

        <textarea type= "text" name ="Response" class="textarea" placeholder = "Enter your response"></textarea>
        <button type="button" name="send" class="btn btn-danger" onclick="send()">
          Send
        </button> 

      </form>
    </div>
  </div>
</div>

<?php

if (isset ($_POST ['send'])){

  $Response = sanitize_text_field($_POST['Response']);
      
  $to = '';
  $subject = 'Test form reply';
  $comment = ''.$name.' - '.$email.' - '.$subject.' - '.$message;
      
  // echo "<pre>"; print_r($_POST); echo "</pre>";
  wp_mail($to, $subject, $comment);
}

?>



<!----------------------------------------------------------------->
<!-- Delete message -->
<!----------------------------------------------------------------->

<div id="delete" style="display: none;">
  <div class="card" style="width: 35rem; height: 15rem;">
    <div class = "d-flex justify-content-around">
      <h2 class="card-title">Delete your message</h2> 
      <button type="button" class="close" onclick ="hide_delete()">
        <span aria-hidden="true">&times;</span>
      </button> 
    </div>
                          
    <div class="card-body d-flex justify-content-center align-items-center">
      <form action="#" method="POST" class="text-center align-items-center">

        <p class="delete_msg"> Are you sure that you wanna delete this message !!? </p>

          <button type="button" id="delete-btn" class="btn btn-danger" onclick="Delete()">
            Delete
          </button> 
      </form>
    </div>
  </div>
</div>


<script type="text/javascript">

  //response popup
  function show_response() {
    document.getElementById("response").style.display = "block";
  }

  function hide_response() {
    document.getElementById("response").style.display = "none";
  }

  function send() {
    
  }

  //delete popup
  function show_delete() {
    document.getElementById("delete").style.display = "block";
  }

  function hide_delete() {
    document.getElementById("delete").style.display = "none";
  }
  
  function Delete() {

  }
</script>

<style>
  @import url('https://fonts.googleapis.com/css2?family=Oswald:wght@500&display=swap');

  .card {
    margin: 0 auto;
    background-color: lightcyan;
  }

  p {
    font-family: 'Oswald', sans-serif;
    font-size: 20px;
  }

  .textarea {
    width: 100%;
  }



</style>

</body>
</html>
