<?php
$config_dir = preg_replace('/\/public/', '/config', $_SERVER['DOCUMENT_ROOT']);
require_once $config_dir . '/config.inc.php';

$year = isset($_GET['year']) ? intval($_GET['year']) : date('Y');
$month = isset($_GET['month']) ? intval($_GET['month']) : date('n');
$calendar = new Calendar($year, $month);
?><!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
<?php if ($calendar->today > 0): ?>
  <meta http-equiv="refresh" content="3600; url=/">
<?php endif; ?>
  <title>Calendar</title>
  <link rel="icon" href="/favicon.ico" sizes="16x16 32x32 48x48 64x64" type="image/vnd.microsoft.icon">
  <link rel="stylesheet" href="/css/calendar.css">
</head>
<body>
  <div id="calendar">

    <div id="title">
      <button class="previous" onclick="window.location.href='/?year=<?php echo $calendar->previous['year']; ?>&month=<?php echo $calendar->previous['month']; ?>';">&laquo;</button>
      <button class="next" onclick="window.location.href='/?year=<?php echo $calendar->next['year']; ?>&month=<?php echo $calendar->next['month']; ?>';">&raquo;</button>
      <h1><?php echo $calendar->title; ?></h1>
      <br>
    </div>

    <div class="label">Su</div>
    <div class="label">M</div>
    <div class="label">Tu</div>
    <div class="label">W</div>
    <div class="label">Th</div>
    <div class="label">F</div>
    <div class="label">Sa</div>

<?php foreach ($calendar->days as $day): ?>
<?php if (is_null($day)): ?>
    <div class="day empty"></div>
<?php else: ?>
    <div class="day <?php echo Custody::classname($calendar->offset++);?><?php echo $day == $calendar->today ? ' today' : ''; ?>"><p><?php echo $day; ?></p></div>
<?php endif; ?>
<?php endforeach; ?>

  </div>
</body>
</html>

