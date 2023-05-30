<?php
// ���������� �������� ���������� ���������,
// ���� index.php ������ ���� � ��������� UTF-8 ��� BOM.
header('Content-Type: text/html; charset=UTF-8');

// � ��������������� ������� $_SERVER PHP ��������� �������� ��������� ������� HTTP
// � ������ �������� � �������� � �������, �������� ����� �������� ������� $_SERVER['REQUEST_METHOD'].
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
  
  $messages = array();

  if (!empty($_COOKIE['save'])) {
    setcookie('save', '', 100000);
    // ���� ���� �������� save, �� ������� ��������� ������������.
    $messages[] = '�������, ���������� ���������.';
  }

  // ���������� ������� ������ � ������.
  $errors = array();
  $errors['name'] = !empty($_COOKIE['name_error']);
  $errors['email'] = !empty($_COOKIE['email_error']);
  $errors['year'] = !empty($_COOKIE['year_error']);
  $errors['radio-1'] = !empty($_COOKIE['pol_error']);
  $errors['radio-2'] = !empty($_COOKIE['limb_error']);
  $errors['super'] = !empty($_COOKIE['super_error']);
  $errors['bio'] = !empty($_COOKIE['bio_error']);
  $errors['check-1'] = !empty($_COOKIE['check_error']);

  // ������ ��������� �� �������.
  if ($errors['name']) {
    setcookie('name_error', '', 100000);
    $messages[] = '<div class="pas error">��������� ��� ��� � ���� �������� ������ (only English)</div>';
  }
  if ($errors['email']) {
    setcookie('email_error', '', 100000);
    $messages[] = '<div class="pas error">��������� ����� ��� � ���� �������� ������</div>';
  }
  if ($errors['year']) {
    setcookie('year_error', '', 100000);
    $messages[] = '<div class="pas error">�������� ���.</div>';
  }
  if ($errors['radio-1']) {
    setcookie('pol_error', '', 100000);
    $messages[] = '<div class="pas error">�������� ���.</div>';
  }
  if ($errors['radio-2']) {
    setcookie('limb_error', '', 100000);
    $messages[] = '<div class="pas error">������� ���-�� �����������.</div>';
  }
  if ($errors['super']) {
    setcookie('super_error', '', 100000);
    $messages[] = '<div class="pas error">�������� ����������������(���� �� ����).</div>';
  }
  if ($errors['bio']) {
    setcookie('bio_error', '', 100000);
    $messages[] = '<div class="pas error">��������� ��������� ��� � �� �������� ������ (only English)</div>';
  }
  if ($errors['check-1']) {
    setcookie('check_error', '', 100000);
    $messages[] = '<div class="pas error">�� ������ ���� �������� ���� ���� ������.</div>';
  }
  
  // ���������� ���������� �������� ����� � ������, ���� ����.
  $values = array();
  $values['name'] = empty($_COOKIE['name_value']) ? '' : $_COOKIE['name_value'];
  $values['email'] = empty($_COOKIE['email_value']) ? '' : $_COOKIE['email_value'];
  $values['year'] = empty($_COOKIE['year_value']) ? 0 : $_COOKIE['year_value'];
  $values['radio-1'] = empty($_COOKIE['pol_value']) ? '' : $_COOKIE['pol_value'];
  $values['radio-2'] = empty($_COOKIE['limb_value']) ? '' : $_COOKIE['limb_value'];
  $values['inv'] = empty($_COOKIE['inv_v']) ? 0 : $_COOKIE['inv_v'];
  $values['walk'] = empty($_COOKIE['walk_v']) ? 0 : $_COOKIE['walk_v'];
  $values['fly'] = empty($_COOKIE['fly_v']) ? 0 : $_COOKIE['fly_v'];
  $values['bio'] = empty($_COOKIE['bio_value']) ? '' : $_COOKIE['bio_value'];
  $values['check-1'] = empty($_COOKIE['check_value']) ? 0 : $_COOKIE['check_value'];

  // �������� ���������� ����� form.php.
  // � ��� ����� �������� ���������� $messages, $errors � $values ��� ������ 
  // ���������, ����� � ����� ������������ ������� � ���������� ������.
  include('form.php');
}
else {
  //���������� ���������
  $bioregex = "/^\s*\w+[\w\s\.,-]*$/";
  $nameregex = "/^\w+[\w\s-]*$/";
  $mailregex = "/^[\w\.-]+@([\w-]+\.)+[\w-]{2,4}$/";
	
  // ��������� ������.
  $errors = FALSE;
  if ((empty($_POST['name'])) || (!preg_match($nameregex,$_POST['name']))) {
    setcookie('name_error', '1', time() + 24 * 60 * 60);
    setcookie('name_value', '', 100000);
    $errors = TRUE;
  }
  else {
    // ��������� ����� ��������� � ����� �������� �� ���.
    setcookie('name_value', $_POST['name'], time() + 12 * 30 * 24 * 60 * 60);
    setcookie('name_error', '', 100000);
  }
  
  if ((empty($_POST['email'])) || (!preg_match($mailregex,$_POST['email']))) {
    setcookie('email_error', '1', time() + 24 * 60 * 60);
    setcookie('email_value', '', 100000);
    $errors = TRUE;
  }
  else {
    setcookie('email_value', $_POST['email'], time() + 12 * 30 * 24 * 60 * 60);
    setcookie('email_error', '', 100000);
  }
  
  if ($_POST['year']=='���') {
    setcookie('year_error', '1', time() + 24 * 60 * 60);
    setcookie('year_value', '', 100000);
    $errors = TRUE;
  }
  else {
    setcookie('year_value', intval($_POST['year']), time() + 12 * 30 * 24 * 60 * 60);
    setcookie('year_error', '', 100000);
  }
  
  if (!isset($_POST['radio-1'])) {
    setcookie('pol_error', '1', time() + 24 * 60 * 60);
    setcookie('pol_value', '', 100000);
    $errors = TRUE;
  }
  else {
    setcookie('pol_value', $_POST['radio-1'], time() + 12 * 30 * 24 * 60 * 60);
    setcookie('pol_error','',100000);
  }
  
  if (!isset($_POST['radio-2'])) {
    setcookie('limb_error', '1', time() + 24 * 60 * 60);
    setcookie('limb_value', '', 100000);
    $errors = TRUE;
  }
  else {
    setcookie('limb_value', $_POST['radio-2'], time() + 12 * 30 * 24 * 60 * 60);
    setcookie('limb_error','',100000);
 }
  
  if (!isset($_POST['super'])) {
    setcookie('super_error', '1', time() + 24 * 60 * 60);
    setcookie('inv_v', '', 100000);
    setcookie('walk_v', '', 100000);
    setcookie('fly_v', '', 100000);
    $errors = TRUE;
  }
  else {
    $powrs=$_POST['super'];
    $apw=array(
      "inv_v"=>0,
      "walk_v"=>0,
      "fly_v"=>0,
    );
  foreach($powrs as $pwer){
    if($pwer=='inv'){setcookie('inv_v', 1, time() + 12 * 30 * 24 * 60 * 60); $apw['inv_v']=1;} 
    if($pwer=='walk'){setcookie('walk_v', 1, time() + 12*30 * 24 * 60 * 60);$apw['walk_v']=1;} 
    if($pwer=='fly'){setcookie('fly_v', 1, time() + 12*30 * 24 * 60 * 60);$apw['fly_v']=1;} 
    }
  foreach($apw as $c=>$val){
    if($val==0){
      setcookie($c,'',100000);
    }
  }
}
  
  if ((empty($_POST['bio'])) || (!preg_match($bioregex,$_POST['bio']))) {
    setcookie('bio_error', '1', time() + 24 * 60 * 60);
    setcookie('bio_value', '', 100000);
    $errors = TRUE;
  }
  else {
    setcookie('bio_value', $_POST['bio'], time() + 12 * 30 * 24 * 60 * 60);
    setcookie('bio_error', '', 100000);
  }
  
  if(!isset($_POST['check-1'])){
    setcookie('check_error','1',time()+  24 * 60 * 60);
    setcookie('check_value', '', 100000);
    $errors=TRUE;
  }
  else{
    setcookie('check_value', TRUE,time()+ 12 * 30 * 24 * 60 * 60);
    setcookie('check_error','',100000);
  }

  if ($errors) {
    // ��� ������� ������ ������������� �������� � ��������� ������ �������.
    header('Location: index.php');
    exit();
  }
  else {
    // ������� Cookies � ���������� ������.
    setcookie('name_error', '', 100000);
    setcookie('email_error', '', 100000);
    setcookie('year_error', '', 100000);
    setcookie('pol_error', '', 100000);
    setcookie('limb_error', '', 100000);
    setcookie('super_error', '', 100000);
    setcookie('bio_error', '', 100000);
    setcookie('check_error', '', 100000);
  }
  
  $name = $_POST['name'];
  $email = $_POST['email'];
  $birth_year = $_POST['year'];
  $pol = $_POST['radio-1'];
  $limbs = intval($_POST['radio-2']);
  $superpowers = $_POST['super'];
  $bio= $_POST['bio'];

  // ���������� � ��.
$user = 'u52943';
$pass = '2352838';
  $db = new PDO('mysql:host=localhost;dbname=u52943', $user, $pass, array(PDO::ATTR_PERSISTENT => true));
   try {
    $stmt = $db->prepare("INSERT INTO form SET name=:name, email=:email, year=:byear, pol=:pol, limbs=:limbs, bio=:bio");
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':byear', $birth_year);
    $stmt->bindParam(':pol', $pol);
    $stmt->bindParam(':limbs', $limbs);
    $stmt->bindParam(':bio', $bio);
    if($stmt->execute()==false){
    print_r($stmt->errorCode());
    print_r($stmt->errorInfo());
    exit();
    }
    $id = $db->lastInsertId();
    $sppe= $db->prepare("INSERT INTO super SET name=:name, per_id=:person");
    $sppe->bindParam(':person', $id);
    foreach($superpowers as $inserting){
  	$sppe->bindParam(':name', $inserting);
  	if($sppe->execute()==false){
	    print_r($sppe->errorCode());
	    print_r($sppe->errorInfo());
	    exit();
  	}
    }
  }
  catch(PDOException $e){
    print('Error : ' . $e->getMessage());
    exit();
  }

  // ��������� ���� � ��������� ��������� ����������.
  setcookie('save', '1');

  // ������ ���������������.
  header('Location: index.php');
}