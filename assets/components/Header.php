<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>
    <?= $data['page_title'] ?>
  </title>
  <?php if (isset($data['stylesheets'])): ?>
    <?php foreach ($data['stylesheets'] as $stylesheet): ?>
      <link rel="stylesheet" href="<?= 'assets/css/' . $stylesheet . '.css' ?>" />
    <?php endforeach; ?>
  <?php endif; ?>
  <?php if (isset($data['scripts'])): ?>
    <?php foreach ($data['scripts'] as $script): ?>
      <script src="<?= 'assets/js/' . $script . '.js' ?>" defer></script>
    <?php endforeach; ?>
  <?php endif; ?>
</head>

<body>