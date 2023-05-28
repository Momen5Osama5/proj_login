<?php
@include 'index.php';
$error = []; // إنشاء مصفوفة فارغة لتخزين الأخطاء (إذا حدثت)
function validat_input($input)
{
    $input = htmlspecialchars($input); // تحويل الحروف الخاصة إلى ترميز HTML entities لمنع حقن البرمجة النصية
    $input = trim($input); // إزالة الفراغات الزائدة من البداية والنهاية للنص
    $input = stripslashes($input); // إزالة الشرطات المائلة للنص لتجنب ترميز الشرطات المزدوجة
    return $input; // إرجاع البيانات المدخلة المعالجة
}
if (isset($_POST['submit'])) { // التحقق مما إذا تم تقديم النموذج عبر زر الإرسال (submit)
  $email = $_POST['email']; // استلام قيمة البريد الإلكتروني من النموذج
  $name = $_POST['name']; // استلام قيمة الاسم من النموذج
  $pass = md5($_POST['password']); // استلام قيمة كلمة المرور من النموذج وتشفيرها بواسطة MD5
  $conpass = md5($_POST['conpassword']); // استلام قيمة تأكيد كلمة المرور من النموذج وتشفيرها بواسطة MD5
  $role = $_POST['role']; // استلام قيمة الدور من النموذج
  
  if (empty($name)) {
    $errors["name_error"] = "*Please Enter your name"; // إضافة رسالة خطأ إلى مصفوفة الأخطاء إذا كانت قيمة الاسم فارغة
}

if (empty($email)) {
    $errors['email_error'] = "*email is required, please fill it"; // إضافة رسالة خطأ إلى مصفوفة الأخطاء إذا كانت قيمة البريد الإلكتروني فارغة
} else {
    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email_error'] = "*please enter valid email"; // إضافة رسالة خطأ إلى مصفوفة الأخطاء إذا كانت البريد الإلكتروني غير صالح
    } else {
        $email = validat_input($_POST['email']); // تنقية قيمة البريد الإلكتروني وتخزينها في المتغير $email
    }
}

if (empty($password)) {
    $errors['password_error'] = "*password is required, please fill it"; // إضافة رسالة خطأ إلى مصفوفة الأخطاء إذا كانت قيمة كلمة المرور فارغة
} else {
    if (strlen($password) > 12) {
        $errors['password_error'] = "*Please Enter More Than 12 Characters"; // إضافة رسالة خطأ إلى مصفوفة الأخطاء إذا كانت كلمة المرور أطول من 12 حرفًا
    }
}

if (empty($conpassword)) {
    $errors['conpassword'] = "*password confirmation is required, please fill it"; // إضافة رسالة خطأ إلى مصفوفة الأخطاء إذا كانت قيمة تأكيد كلمة المرور فارغة
} elseif (strcmp($conpassword, $password) != 0) {
    $errors['conpassword_error'] = "*passwords do not match"; // إضافة رسالة خطأ إلى مصفوفة الأخطاء إذا كانت كلمة المرور وتأكيد كلمة المرور غير متطابقين
    $errors['password_error'] = "*passwords do not match"; // إضافة رسالة خطأ أخرى إلى مصفوفة الأخطاء
}
  $select = "select * from user where email='$email'  && password='$pass'"; // إعداد استعلام SQL لاستعراض المستخدمين المطابقين للبريد الإلكتروني وكلمة المرور
  $result = mysqli_query($connt, $select); // تنفيذ الاستعلام واستلام النتائج من قاعدة البيانات

  if (mysqli_num_rows($result) > 0) { // فحص إذا ما كان هناك مستخدم بنفس البريد الإلكتروني وكلمة المرور في قاعدة البيانات
    $error[] = 'user already exist'; // إضافة رسالة الخطأ إلى مصفوفة الأخطاء
  } else {
    if ($pass != $conpass) { // التحقق مما إذا كانت كلمة المرور وتأكيد كلمة المرور غير متطابقين
      $error[] = 'password not matched'; // إضافة رسالة الخطأ إلى مصفوفة الأخطاء
    } else {
      $insert = "INSERT INTO user (name,email,password,role) VALUES ('$name','$email','$pass','$role')"; // إعداد استعلام SQL لإضافة مستخدم جديد إلى جدول المستخدمين
      mysqli_query($connt, $insert); // تنفيذ الاستعلام لإضافة المستخدم الجديد إلى قاعدة البيانات
      
      if ($insert) {
        echo "Add successful"; // إذا تمت العملية بنجاح، نعرض رسالة نجاح
      } else {
        echo "failed to add"; // إذا فشلت العملية، نعرض رسالة فشل
      }
      
      header('location:login.php'); // إعادة توجيه المستخدم إلى صفحة تسجيل الدخول
    }
  }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <style>
body, div, dl, dt, dd, ul, ol, li, h1, h2, h3, h4, h5, h6, 
pre, form, fieldset, input, textarea, p, blockquote, th, td 
{ 
  padding:0;
  margin:0;
}
 
 fieldset,img  {border: 0}

ol,ul, li {list-style: none}

:focus { outline: none}
body,input,textarea,
select {
  font-family: 'Open Sans', sans-serif;
  font-size: 16px;
  color: #4c4c4c;
}

p {
  font-size: 12px;
  width: 150px;
  display: inline-block;
   margin-left: 18px;
}

h1 {
  font-size: 32px;
  font-weight: 300;
  color: #4c4c4c;
  text-align: center;
  padding-top: 10px;
  margin-bottom: 10px;
}

html{
  background-color: #ffffff;
}

.testbox {
  margin: 20px auto;
  width: 343px; 
  height: 464px; 
  -webkit-border-radius: 8px/7px; 
  -moz-border-radius: 8px/7px; 
  border-radius: 8px/7px; 
  background-color: #ebebeb; 
  -webkit-box-shadow: 1px 2px 5px rgba(0,0,0,.31); 
  -moz-box-shadow: 1px 2px 5px rgba(0,0,0,.31); 
  box-shadow: 1px 2px 5px rgba(0,0,0,.31); 
  border: solid 1px #cbc9c9;
}

input[type=radio] {
  visibility: hidden;
}

form{
  margin: 0 30px;
}

label.radio {
	cursor: pointer;
  text-indent: 35px;
  overflow: visible;
  display: inline-block;
  position: relative;
  margin-bottom: 15px;
}

label.radio:before {
  background: #3a57af;
  content:'';
  position: absolute;
  top:2px;
  left: 0;
  width: 20px;
  height: 20px;
  border-radius: 100%;
}

label.radio:after {
	opacity: 0;
	content: '';
	position: absolute;
	width: 0.5em;
	height: 0.25em;
	background: transparent;
	top: 7.5px;
	left: 4.5px;
	border: 3px solid #ffffff;
	border-top: none;
	border-right: none;

	-webkit-transform: rotate(-45deg);
	-moz-transform: rotate(-45deg);
	-o-transform: rotate(-45deg);
	-ms-transform: rotate(-45deg);
	transform: rotate(-45deg);
}

input[type=radio]:checked + label:after {
	opacity: 1;
}

hr{
  color: #a9a9a9;
  opacity: 0.3;
}

input[type=text],input[type=password]{
  width: 200px; 
  height: 39px; 
  -webkit-border-radius: 0px 4px 4px 0px/5px 5px 4px 4px; 
  -moz-border-radius: 0px 4px 4px 0px/0px 0px 4px 4px; 
  border-radius: 0px 4px 4px 0px/5px 5px 4px 4px; 
  background-color: #fff; 
  -webkit-box-shadow: 1px 2px 5px rgba(0,0,0,.09); 
  -moz-box-shadow: 1px 2px 5px rgba(0,0,0,.09); 
  box-shadow: 1px 2px 5px rgba(0,0,0,.09); 
  border: solid 1px #cbc9c9;
  margin-left: -5px;
  margin-top: 13px; 
  padding-left: 10px;
}
#conpasword{
  width: 200px; 
  height: 39px; 
  -webkit-border-radius: 0px 4px 4px 0px/5px 5px 4px 4px; 
  -moz-border-radius: 0px 4px 4px 0px/0px 0px 4px 4px; 
  border-radius: 0px 4px 4px 0px/5px 5px 4px 4px; 
  background-color: #fff; 
  -webkit-box-shadow: 1px 2px 5px rgba(0,0,0,.09); 
  -moz-box-shadow: 1px 2px 5px rgba(0,0,0,.09); 
  box-shadow: 1px 2px 5px rgba(0,0,0,.09); 
  border: solid 1px #cbc9c9;
  margin-left: -5px;
  margin-top: 13px; 
  padding-left: 10px;
  

}

input[type=password]{
  margin-bottom: 8px;
}
#icon {
  display: inline-block;
  width: 30px;
  background-color: #CDC673;
  padding: 8px 0px 8px 15px;
  margin-left: 15px;
  -webkit-border-radius: 4px 0px 0px 4px; 
  -moz-border-radius: 4px 0px 0px 4px; 
  border-radius: 4px 0px 0px 4px;
  color: white;
  -webkit-box-shadow: 1px 2px 5px rgba(0,0,0,.09);
  -moz-box-shadow: 1px 2px 5px rgba(0,0,0,.09); 
  box-shadow: 1px 2px 5px rgba(0,0,0,.09); 
  border: solid 0px #cbc9c9;
}

.gender {
  margin-left: 30px;
  margin-bottom: px;
}

.accounttype{
  margin-left: 8px;
  margin-top: 20px;
}

button {
  font-size: 14px;
  font-weight: 600;
  color: white;
  float: right;
  text-decoration: none;
  width: 80px; height:27px; 
  -webkit-border-radius: 5px; 
  -moz-border-radius: 5px; 
  border-radius: 5px; 
  background-color: #CDC673; 
  -webkit-box-shadow: 0 3px rgba(58,87,175,.75); 
  -moz-box-shadow: 0 3px rgba(58,87,175,.75); 
  box-shadow: 0 3px rgba(58,87,175,.75);

   

  position: relative;
}


a.button:hover {
  top: 3px;
  background-color:#2e458b;
  -webkit-box-shadow: none; 
  -moz-box-shadow: none; 
  box-shadow: none;
  
}

.footer{color:#0a0a0a;  font-size: 12px; }
.testbox form .error-msg{
  margin:10px 0;
  display: block;
  background:crimson;
  color: #fff;
  border-radius:5px;
  font-size:20px;
}
  </style>
</head>

<body>
  <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600' rel='stylesheet' type='text/css'>
  <link href="//netdna.bootstrapcdn.com/font-awesome/3.1.1/css/font-awesome.css" rel="stylesheet">

  <div class="testbox">
    <h1>Registration</h1>

    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
      <hr>
      <hr>

      <?php
      if (isset($error)) {
        foreach ($error as $error) {
          echo '<span class="error-msg">'  . $error .   '</span>';
        }
      }

      ?>
      <label id="icon" for="name"><i class="icon-envelope "></i></label>
      <input type="text" name="email" id="name" placeholder="Email" required />
      <label id="icon" for="name"><i class="icon-user"></i></label>
      <input type="text" name="name" id="name" placeholder="Name" required />
      <label id="icon" for="name"><i class="icon-shield"></i></label>
      <input type="password" name="password" id="name" placeholder="Password" required />
      <label id="icon" for="name"><i class="icon-shield"></i></label>
      <input type="password" name="conpassword" id="conpasword" placeholder="Confirm Password" />
      <select name="role">
        <option value="1"> admin </option>
        <option value="2"> user </option>


      </select>
      <div>
        <button type="submit" name="submit">Sign up</button>
      </div>
      <br />
      <br />

    </form>

    <div class="card-footer">
      <div class="">
        <p class="footer" class="float-sm-right text-center m-0">Have an Account? <a href="login.php" class="card-link">log in</a></p>
      </div>
    </div>
</body>

</html>