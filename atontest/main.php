<?php
$db_host = '127.0.0.1'; 
$db_pass = '';
$db_user = 'root';
$db_name = 'card';

$mysqli = new mysqli($db_host,$db_user,$db_pass,$db_name);
$mysqli->set_charset("utf8mb4"); 

/*if ($mysqli->ping()){
  printf("Connection is ok");
} else {
  print("Connection is lost");
}*/

$sql = "SELECT * FROM product";
$result = $mysqli->query($sql);

$sort = '';
if(isset($_GET['sort'])){
  $sort = $_GET['sort'];
  if($sort == 'price_asc'){
    $SqlOrder = "SELECT * FROM product ORDER BY price ASC";
  } else if($sort == 'price_desc'){
    $SqlOrder = "SELECT * FROM product ORDER BY price DESC";
  }
  $result = $mysqli->query($SqlOrder);
}
?>

<html>
	<head>
		<meta charset="utf-8">
		<title>Main Page</title>
		<link href="../atontest/css/style.css" rel="stylesheet">
	</head>
  <div class="header">
    <h1> 
      ТАБЛИЦА ТОВАРОВ
    </h1>
  </div>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get" class="form" style="margin-left: 15%" >
    <select name="sort" id="field">
      <option value="price_asc" <?php if ($sort == 'price_asc') echo 'selected'; ?>>Сначала дешевые</option>
      <option value="price_desc" <?php if ($sort == 'price_desc') echo 'selected'; ?>>Сначала дорогие</option>
    </select>
    <button type="submit">Сортировать</button>
  </form>
  <div class="table-wrap">
    <table>
      <thead>
        <tr>
          <th>Название товара</th>
          <th>Цена</th>
        </tr>
      </thead>
      <?php
      while($row = $result->fetch_assoc())
      {
      ?>
      <tbody>
        <tr>
          <td> <?php echo $row['product_name']?> </td>
            <td> <?php echo $row['price']?> </td>
          </tr>
      </tbody>
      <?php    
        }
      ?>
  </table>
</div>

