<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <title><?= $title; ?></title>

  <?= Asset::css(array('bootstrap.min.css', 'bootstrap-theme.min.css', 'main.css')); ?>
  <?= Asset::js('sortable.js'); ?>
</head>
<body role="document">
  <!-- Fixed navbar -->
  <nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <?= Html::anchor('/', 'Parking Tracker', array('class' => 'navbar-brand')); ?>
      </div>
      <div id="navbar" class="navbar-collapse collapse">
        <ul class="nav navbar-nav">
          <li class="active"><?= Html::anchor('/', 'Home'); ?></li>
          <li><a href="#about">About</a></li>
          <li><a href="#contact">Contact</a></li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Dropdown <span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
              <li><a href="#">Action</a></li>
              <li><a href="#">Another action</a></li>
              <li><a href="#">Something else here</a></li>
              <li class="divider"></li>
              <li class="dropdown-header">Nav header</li>
              <li><a href="#">Separated link</a></li>
              <li><a href="#">One more separated link</a></li>
            </ul>
          </li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
          <p class="navbar-text">User Stuff</p>
        </ul>
      </div><!--/.nav-collapse -->
    </div>
  </nav>


  <div class="container" role="main">
    <div class="page-header">
      <h1><?= $title; ?></h1>
    </div>

    <div id="content">
      <?= $content; ?>
    </div>
  </div> <!-- /container -->

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
  <?= Asset::js('bootstrap.min.js'); ?>

</body>
</html>