<!DOCTYPE html>
<html>
<head>
<style>
    body, html {
        height: 100%;
        margin: 0;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .frame-container {
        position: relative;
        width: 100%;
        height: 100%;
        overflow: auto;
    }
    .frame-container iframe {
        border: 0;
        position: absolute;
        top: 0; left: 0;
        width: 100%; height: 100%;
    }
</style>
</head>
<body>
    <div class="frame-container">
        <iframe src="http://norman-love.com/lunar/lunar_iframe.php"></iframe>
    </div>
</body>
</html>