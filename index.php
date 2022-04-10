<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>NPlayer 测试</title>
    <script src="https://cdn.jsdelivr.net/npm/nplayer@latest/dist/index.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/hls.js@latest"></script>
</head>
<body>
    <div id="nplayer"></div>
    <script>
    const hls = new Hls()
    const player = new NPlayer.Player()
    hls.attachMedia(player.video)

    hls.on(Hls.Events.MEDIA_ATTACHED, function () {
        hls.loadSource('<?php echo $_GET['url'] ?>')
    })
    
    // player.mount('#nplayer')
    player.mount(document.body)
</script>
</body>
</html>