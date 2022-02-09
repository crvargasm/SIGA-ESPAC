<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
    <script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
</head>

<body>
    <a href="javascript:;" class="fancybox">Open</a>
    <div id="test" style="display:none;width:300px;">
        <p>
            prueba
        </p>
        <input type="text" class="datepicker" />
    </div>

</body>
<script>
    $(".datepicker").datepicker();

    $(".fancybox").fancybox({
        openEffect: 'none',
        closeEffect: 'none'
    });
</script>

</html>