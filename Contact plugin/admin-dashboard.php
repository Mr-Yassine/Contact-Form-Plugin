<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
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
                        <td>'. $row["Name"] . 
                        '</td><td>' . $row["Email"] . 
                        '</td><td>' . $row["Subject"] . 
                        '</td><td>' . $row["Message"] . 
                        '<td class="d-flex justify-content-end>
                          <form id="response" action="" method="post">
                            <button type="submit" class="btn btn-warning" name="response" onclick = "show_response()" ;>Response</button>
                          </form>&nbsp;

                          <form action="" method="post">
                            <button type="submit" class="btn btn-danger" name="submit" onclick = "show_delete()" ;>Delete</button>
                          </form>
                        </td>
                     </tr>';
            }   
    ?>

  </tbody>

</table>


<!----------------------------------------------------------------->
<!-- Response  -->
<!----------------------------------------------------------------->

<div id="response">
  <div class="card" style="width: 35rem; height: 15rem;">
    <div class = "d-flex justify-content-between">
      <h2 class="card-title">Response </h2> 
      <button type="button" class="close" onclick ="hide_response()">
        <span aria-hidden="true">&times;</span>
      </button> 
    </div>
                          
    <div class="card-body d-flex justify-content-center align-items-center">
      <form action="#" method="POST" class="text-center align-items-center">

        <p class="send_msg">  </p>

          <button type="button" id="delete-btn" class="btn btn-danger" onclick="send()">
            Send
          </button> 
      </form>
    </div>
  </div>
</div>



<!----------------------------------------------------------------->
<!-- Delete message -->
<!----------------------------------------------------------------->

<div id="delete">
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

</body>
</html>
