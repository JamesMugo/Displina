  <?php
  Require 'server.php';

  /*if (isset($_POST['login'])) {
    $creater = createUser($username,$email,$phone,$age,$org,$pass);
  }*/

  $username =$_GET['username'];
  $email = $_GET['email'];
  $phone = $_GET['phone'];
  //$age = $_GET['age'];
  //$organization = $_GET['organization'];
  $pass = $_GET['password'];

  function createUser($username,$email,$phone,$pass){
    $db = Database::getInstance();

  try{
    $stmt = $db->prepare("INSERT INTO users (username, email, phone, password) VALUES (:username,:email,:phone,:pass)");
    $stmt->bindParam(':username,:email,:phone,:pass', $username,$email,$phone,$pass);
    $stmt->execute();

    if($stmt->rowCount() > 0)

         {

            return true;

         }

         

      } catch (PDOException $e) {

         echo $e->getMessage();

         return NULL;

      }
    }

    $inst = createUser($username,$email,$phone,$pass);
    echo $inst;
    ?>