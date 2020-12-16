<body>
  <div>Trang Chủ</div>
  <table border="1">
    <tr>
      <td>Id</td>
      <td>Name</td>
      <td>Age</td>
    </tr>
    <?php foreach ($list as $value) {?>
    <tr>
      <td><?php echo $value["id"];?></td>
      <td><?php echo $value["name"];?></td>
      <td><?php echo $value["age"];?></td>
    </tr>
    <?php } ?>
    <?php foreach ($Product as $value) {?>
    <tr>
      <td><?php echo $value["Pro_ID"];?></td>
      <td><?php echo $value["Pro_Name"];?></td>
      <td><?php echo $value["Pro_Price"];?></td>
    </tr>
    <?php } ?>
  </table>
  <a class="button" href="http://localhost:8888/codeigniter/webthuan/index.php/home/form_insert_product">Button</a>
</body>