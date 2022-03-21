<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title><?= basename(dirname(__FILE__, 1)); ?></title>
    <style>
        * {
            margin: 0;
            padding: 0;
        }
        a {
            font-size: 20px;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="list-group">
        <?php
        $folders = glob('*[!index.php]*');
        natsort($folders);
        foreach($folders as $folder) {
            $name = basename($folder);
            $ext = pathinfo($name, PATHINFO_EXTENSION);
            if (is_dir($folder)) {
                $index = '';
                $files = glob(__DIR__ . '/' . $name . '/*');
                foreach ($files as $file) {
                    if (strpos(basename($file), 'index') !== false) $index = basename($file);
                }
                print '<a class="list-group-item list-group-item-action text-center" href="' . str_replace('index.php', '', ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']) . $name . '/' . $index . '">' . str_replace('.' . $ext, '', $name) . '</a><br>';
            } else {
                print '<a class="list-group-item list-group-item-action text-center" href="' . str_replace('index.php', '', ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']) . $name . '">' . str_replace('.' . $ext, '', $name) . '</a><br>';
            }
        }
        ?>
    </div>
</div>
</body>
</html>