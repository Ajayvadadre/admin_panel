<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Template</title>
</head>

<body>
    <?php echo view('inc/header') ?>
    <?php echo view($page??null, $data ?? []) ?>
    <?php echo view('inc/footer') ?>
</body>

</html>