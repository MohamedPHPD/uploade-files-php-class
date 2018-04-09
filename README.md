# how to use insert-data-class
step : 1
make form you need
example 
  <form action="" method="post">
  <input type="text" name="name">
  <br>
  <input type="password" name="pass">
  <br>
  <input type="text" name="permissions">
  <br>
  <input type="submit" name="add" value="add">
  </from>

step : 2
  //make array firest ofset shoud be called tbn and value = table name
  //and another ofsets is table_fiald => $valus
 if ($_POST['add']){
  $query = array(
      'tbn'   => 'admins' , // table name dont change 'tbn'
      'admin_name*'  => $_POST['name'] ,// 
      'admin_pass*'   => $_POST['pass'] ,
      'permissions' => 'all'
  );
  
  custome errors is optional
  make array with 
  key       = fiald name
  and value = error message
  
  like this
  $errors = array(
      'admin_name' => 'يجب ادخال اسم المستخدم',
      'admin_pass' => 'يجب ادخال كلمة المرور '
  );
  
  $ins = new  insert($query,$connect,$errors) ;
  if ($ins == 'done')
  {
      echo 'تم ادخال البيانات ' ;
  }
  else if ($ins == 'error q   ')
  {
      echo 'خطاء م قد حدث' ;
  }
}
