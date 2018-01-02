<?php
function menusById($id = 0){
    $servername = "localhost";
    $username = "human";
    $password = "aftereffects@1";
    $dbname = "test";
    $conn = new mysqli($servername, $username, $password, $dbname);
    $sql = "SELECT menus.*, menu_count.count FROM menus LEFT JOIN menu_count ON menus.id = menu_count.menu_id WHERE menus.menu_id = {$id}";
    $result = $conn->query($sql) or die("Connection failed: " . $conn->connect_error);// or die($conn->connect_error());
    $rows = array();
    while($row = $result->fetch_assoc()) $rows[] = $row;
    return $rows;
}

function drawMenusRecursive($id = 0){
    echo "<ul>";
    foreach (menusById($id) as $menu){
        echo "<li>";
        echo "<a href=\"" . $menu["link"] ."\">";
            echo $menu["name"] . ($menu["count"]>0 ? "(".$menu['count'].")" : "");
          echo "</a>";
          drawMenusRecursive($menu["id"]);
        echo "</li>";
    }
    echo "</ul>";
}
?>
<!DOCTYPE html>
<html>
<head>
<style>
ul {
    list-style-type: none;
  margin: 0;
  padding: 0;
  overflow: hidden;
    background-color: #333;
}

li {
    float: left;
}

li a {
  display: inline-block;
  color: #fff;
    text-align: center;
  padding: 14px 16px;
    text-decoration: none;
}

li a:hover {
    background-color: #111;
}
</style>
</head>
<body>
<?php drawMenusRecursive(); ?>
</body>
</html>