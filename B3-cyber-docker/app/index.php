<?php

require_once('./functions.php');

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
}

echo "Bienvenue ".$_SESSION['user']['email']." !";

$link = connectDB();

if(isset($_GET['id'])) {
    $sql = 'SELECT * FROM tasks WHERE id = ' . $_GET['id'];
} else {
    $sql = 'SELECT * FROM tasks';
}

?>
<style>
  * {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
  }

  body {
    font-family: Arial, sans-serif;
    background-color: #f2f2f2;
  }

  .container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
  }

  h1 {
    font-size: 36px;
    margin-bottom: 20px;
  }

  table {
    width: 100%;
    border-collapse: collapse;
    background-color: #fff;
    box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.1);
    margin-bottom: 40px;
  }

  thead {
    background-color: #f2f2f2;
  }

  th,
  td {
    padding: 10px;
    text-align: left;
    border: 1px solid #ddd;
  }

  th {
    font-weight: bold;
    text-transform: uppercase;
  }

  tr:hover {
    background-color: #f2f2f2;
  }

  button {
    display: inline-block;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    background-color: #4CAF50;
    color: #fff;
    font-size: 16px;
    font-weight: bold;
    cursor: pointer;
    transition: background-color 0.3s ease;
  }

  button:hover {
    background-color: #3e8e41;
  }

  a {
    color: #666;
    text-decoration: none;
    transition: color 0.3s ease;
  }

  a:hover {
    color: #000;
  }

</style>
<table>
    <thead>
        <tr>
            <th>Id</th>
            <th>Label</th>
            <th>Description</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($link->query($sql) as $row) { ?>
            <tr>
                <td>
                    <?php echo $row['id']; ?>
                </td>
                <td>
                    <?php echo $row['label']; ?>
                </td>
                <td>
                    <?php echo $row['description']; ?>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>
