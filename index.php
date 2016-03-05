<!doctype html>
<html class="no-js" lang="">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Search Engine Results Collector</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"
          integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css"
          integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"
            integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS"
            crossorigin="anonymous"></script>

    <link rel="stylesheet" href="/resources/css/main.css">

</head>
<body>
<div class="jumbotron vertical-center">
    <div class="container">
        <div class="row">
            <div class="input-group">
                <input type="text" id="query" name="query" class="form-control" placeholder="Search for...">
                  <span class="input-group-btn">
                    <button id="submit-query" class="btn btn-default" type="submit">Search!</button>
                  </span>
            </div>
        </div>
    </div>
</div>
<script type="application/javascript">
    $('button#submit-query').click(function () {
        window.location.href = '/search.php?query=' + encodeURIComponent($("#query").val());
    })
</script>
</body>
</html>