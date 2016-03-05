<?php

ini_set('xdebug.var_display_max_depth', 3);
ini_set('xdebug.var_display_max_children', 256);
ini_set('xdebug.var_display_max_data', 1024);

$loader = require('vendor/autoload.php');
$query = isset($_REQUEST['query']) ? urldecode($_REQUEST['query']) : "";

?>

<!doctype html>
<html class="no-js" lang="">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Search Engine Results Collector - Results</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"
          integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7"
          crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css"
          integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r"
          crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"
            integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS"
            crossorigin="anonymous"></script>

</head>
<body>
<div class="jumbotron">
    <div class="container">
        <div class="row">
            <div class="input-group">
                <input type="text" id="query" name="query" class="form-control" placeholder="Search for..."
                       value="<?= $query ?>">
                  <span class="input-group-btn">
                    <button id="submit-query" class="btn btn-default" type="submit">Search!</button>
                  </span>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <?php
    if (empty($query)) {
        ?>
        Empty query
        <?php
    } else {
        $csr = new \CSR\CSR($query);
        $csr->query();
        $results = $csr->getResults();
        ?>
        <table class="table table-hover table-responsive">
            <thead>
            <tr>
                <th colspan="3"></th>
                <th colspan="2">Position on Engine</th>
            </tr>
            <tr>
                <th>#</th>
                <th>Avg Position</th>
                <th>Title</th>
                <th>Google</th>
                <th>Yahoo</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $idx = 1;
            foreach ($results as $entry) {
                $url = $entry->getUrl();
                $avg_pos = $entry->getPosition();
                $title = $entry->getTitle();
                $engines = implode(" ", $entry->getEngines());
                $positions = $entry->getPositions();
                $engine_yahoo_position = isset($positions["Yahoo"]) ? $positions["Yahoo"] : "?";
                $engine_google_position = isset($positions["Google"]) ? $positions["Google"] : "?";
                echo "<tr><td>$idx</td><td>$avg_pos</td><td><a href='$url'>$title</a></td><td>$engine_google_position</td><td>$engine_yahoo_position</td></tr>";
                $idx++;
            }
            ?>
            </tbody>
        </table>
        <?php
    }
    ?>
</div>
<script type="application/javascript">
    $('button#submit-query').click(function () {
        window.location.href = '/search.php?query=' + encodeURIComponent($("#query").val());
    })
</script>

</html>
