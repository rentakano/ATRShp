<?php
session_start();
$error = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

  // フォームの送信時にエラーをチェックする
  if ($post['name'] === '') {
    $error['name'] = 'blank';
  }
  if ($post['email'] === '') {
    $error['email'] = 'blank';
  } else if (!filter_var($post['email'], FILTER_VALIDATE_EMAIL)) {
    $error['email'] = 'email';
  }
  if ($post['contact'] === '') {
    $error['contact'] = 'blank';
  }

  if (count($error) === 0) {
    // エラーがないので確認画面に移動
    $_SESSION['form'] = $post;
    header('Location: confirm.php');
    exit();
  }
} else {
  if (isset($_SESSION['form'])) {
    $post = $_SESSION['form'];
  }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="description" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="css/style.css" />
  <link rel="stylesheet" href="css/layout.css">
  <title>ATRS（公式）</title>
</head>
</head>

<header>
  <nav class="nav">
    <a href="https://www.instagram.com/atrsgroup/"><img class="logo" src="images/icon-instagram-square-silhouette.png" style="width:3%"></a>
    <a href="https://www.youtube.com/channel/UCxnZNW2yLII0CwsldXsyk9Q"><img class="logo" src="images/59883d93354828f3e5f22f900307b016.png" style="width:3%"></a>
  </nav>
</header>


<body>
  <!--ここから-->
  <div id="wrapper">
    <p class="btn-gnavi">
      <span></span>
      <span></span>
      <span></span>
    </p>
    <nav id="global-navi">
      <ul class="menu">
        <li><a href="index.html">TOP</a></li>
        <li><a href="Company info.php">MEMBERS</a></li>
        <li><a href="contact.html">PORTFOLIO</a></li>
        <li><a href="fee.html">CONTENTS</a></li>
        <li><a href="info.php">CONTACT</a></li>
      </ul>
    </nav>
  </div>
  <script src="js/jquery-3.3.1.min.js"></script>
  <script src="js/jquery.lettering.js"></script>
  <script src="js/jquery.textillate.js"></script>
  <script src="js/index.js"></script>

  <!--ここまで-->

  <div class="info">
    <h1>ATRS</h1>
  </div>

  <div class="contact">
    <h3>Contact</h3>
  </div>
  <div class="contact-sns">
    <p>各ソーシャルメディアのメッセージからも受付しています。</p>
  </div>

  <nav class="sns">
    <a href="https://www.instagram.com/atrsgroup/"><img class="logo" src="images/icon-instagram-square-silhouette.png" style="width:3%"></a>
    <a href="https://lin.ee/KeeYtKA"><img class="logo" src="images/LINE_APP.png" style="width:3%"></a>
  </nav>


  <!--

  <div class="input">
    <form method="post" action="example.cgi">

      <div class="box1">
      <input type="text" name="example4" size="40" value="性">
      <input type="text" name="example4" size="40"  value="名">
      </div>
      

      <div class="box2">
      <input type="text" name="example4" size="40" value="性（フリガナ）">
      <input type="text" name="example4" size="40" value="名（フリガナ）">
      </div>

      <div class="box3">
      <input type="text" name="example4" size="83.2" value="メールアドレス">
      </div>

      <div class="box4">
      <input type="text" name="example4" style="width:76%; padding:70px;" value="Message"  >
      </div>

      <p><input type="submit" value="CLICK HERE">
      
      </form>
  </div>

-->
  <div class="container">
    <form action="" method="POST" novalidate>
      <p>お問い合わせ</p>
      <div class="form-group">
        <div class="row">
          <div class="col-2">
            <label for="inputName">お名前</label>
          </div>
          <div class="col-2">
            <p class="require_item">必須</p>
          </div>
          <div class="col-md-8">
            <input type="text" name="name" id="inputName" class="form-control" value="<?php echo htmlspecialchars($post['name']); ?>" required autofocus>
            <?php if ($error['name'] === 'blank') : ?>
              <p class="error_msg">※お名前をご記入下さい</p>
            <?php endif; ?>
          </div>
        </div>
      </div>
      <div class="form-group">
        <div class="row">
          <div class="col-2">
            <label for="inputEmail">メールアドレス</label>
          </div>
          <div class="col-2">
            <p class="require_item">必須</p>
          </div>
          <div class="col-8">
            <input type="email" name="email" id="inputEmail" class="form-control" value="<?php echo htmlspecialchars($post['email']); ?>" required>
            <?php if ($error['email'] === 'blank') : ?>
              <p class="error_msg">※メールアドレスをご記入下さい</p>
            <?php endif; ?>
            <?php if ($error['email'] === 'email') : ?>
              <p class="error_msg">※メールアドレスを正しくご記入ください</p>
            <?php endif; ?>
          </div>
        </div>
      </div>
      <div class="form-group">
        <div class="row">
          <div class="col-2">
            <label for="inputContent">お問い合わせ内容</label>
          </div>
          <div class="col-2">
            <p class="require_item">必須</p>
          </div>
          <div class="col-8">
            <textarea name="contact" id="inputContent" rows="10" class="form-control" required><?php echo htmlspecialchars($post['contact']); ?></textarea>
            <?php if ($error['contact'] === 'blank') : ?>
              <p class="error_msg">※お問い合わせ内容をご記入下さい</p>
            <?php endif; ?>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-8 offset-4">
          <button type="submit">確認画面へ</button>
        </div>
      </div>
    </form>
  </div>

</body>