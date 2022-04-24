<?php 

function getUrl() {
$url = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
if($_SERVER['SERVER_PORT'] != '80') {
    $url .= $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . $_SERVER['REQUEST_URI'];
} else {
    $url .= $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
}
$url = str_replace("http://127.0.0.1:8000","https://v.maware.cc",$url);
return $url;
}
function changeURLParam($url, $name, $value)
{
    $reg = "/([\?|&]" . $name . "=)[^&]*/i";
    $value = urlencode(trim($value));
    if (empty($value)) {
        return preg_replace($reg, '', $url);
    } else {
        if (preg_match($reg, $url)) {
            return preg_replace($reg, '${1}${2}' . $value, $url);
        } else {
            return $url . (strpos($url, '?') === false ? '?' : '&') . $name . '=' . $value;
        }
    }
}

if($_GET['id']!=''&&$_GET['type']!=''&&$_GET['url']==''){
    ini_set('user_agent','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/99.0.4844.82 Safari/537.36');
    $node_json = json_decode(file_get_contents("https://raw.githubusercontent.com/AnimeCDN/AnimeCDN/master/node/node.json"), true);
    $mix_json = json_decode(file_get_contents("https://raw.githubusercontent.com/AnimeCDN/AnimeCDN/master/index.json"), true);
    $json_url = $mix_json[$_GET['type']][((int)$_GET['id'])-1]["url"];
    $json = json_decode(file_get_contents($json_url), true);
    // header("content-type:application/json");
    // var_dump($json["tags"]);
}else if($_GET['id']==''&&$_GET['type']==''&&$_GET['url']!=''){
    ini_set('user_agent','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/99.0.4844.82 Safari/537.36');
    $node_json = json_decode(file_get_contents("https://raw.githubusercontent.com/AnimeCDN/AnimeCDN/master/node/node.json"), true);
    $json = json_decode(file_get_contents($_GET['url']), true);
}else{
    header("content-type:application/json");
    echo "参数错误！";
    exit(0);
}

if($_GET['clar']!=''&&$_GET['p']!=''){
    $initial_url = $json["parts"][$_GET['clar']][((int)$_GET['p'])-1]["url"];
    if($_GET['proxy']!=''){
        $initial_url = str_replace("raw.githubusercontent.com", $_GET['proxy'], $initial_url);
    }
    $initial_name = $json["name"]."-"."第".$_GET['p']."集-".$json["parts"][$_GET['clar']][((int)$_GET['p'])-1]["title"]."-".$_GET['clar'];
}else{
    $initial_url = $json["parts"][$json["clarity"][0]][0]["url"];
    if($_GET['proxy']!=''){
        $initial_url = str_replace("raw.githubusercontent.com", $_GET['proxy'], $initial_url);
    }
    $initial_name = $json["name"]."-"."第1集-".$json["parts"][$json["clarity"][0]][0]["title"]."-".$json["clarity"][0];
}

?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $json["name"]." - Maware"; ?></title>
<meta name="viewport" content="initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
<meta name="renderer" content="webkit" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<meta http-equiv="Cache-Control" content="no-transform" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<link rel="stylesheet" type="text/css" href="https://v.maware.cc/video.css" />
<script src="https://cdn.jsdelivr.net/npm/nplayer@latest/dist/index.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/hls.js@latest"></script>
</head>
<body class="fed-min-width">
    
<div class="fed-head-info fed-back-whits fed-min-width fed-box-shadow">
	<div class="fed-part-case">
		<div class="fed-navs-info">
			<ul class="fed-menu-info">
				<li class="fed-pull-left">
					<a class="fed-menu-title fed-show-kind fed-font-xvi fed-hide fed-show-md-block" href="https://maware.cc/"><h2>Maware</h2></a>
			    </li>
				<li class="fed-pull-left">
					<a class="fed-menu-title fed-show-kind fed-font-xvi fed-hide fed-show-md-block" href="https://maware.cc/">首页</a>
				</li>
								<li class="fed-pull-left">
					<a class="fed-menu-title fed-show-kind fed-font-xvi fed-hide fed-show-md-block" href="https://maware.cc/categories">分类</a>
				</li>
								<li class="fed-pull-left">
					<a class="fed-menu-title fed-show-kind fed-font-xvi fed-hide fed-show-lg-block" href="https://maware.cc/links">节点</a>
				</li>
								<li class="fed-pull-left">
					<a class="fed-menu-title fed-show-kind fed-font-xvi fed-hide fed-show-lg-block" href="https://github.com/AnimeCDN/AnimeCDN/issues/new?assignees=&labels=%E8%B5%84%E6%BA%90%E6%8F%90%E4%BA%A4&template=commit.yml">提交</a>
				</li>
								<li class="fed-pull-left">
					<a class="fed-menu-title fed-show-kind fed-font-xvi fed-hide fed-show-lg-block" href="https://github.com/AnimeCDN/AnimeCDN/issues/new?assignees=&labels=%E8%B5%84%E6%BA%90%E4%B8%BE%E6%8A%A5&template=report.yml">举报</a>
				</li>
								<li class="fed-pull-left">
					<a class="fed-menu-title fed-show-kind fed-font-xvi fed-hide fed-show-md-block" href="https://maware.cc/doc-Maware">文档</a>
				</li>
			</ul>
		</div>
	</div>
</div>

<div class="fed-main-info fed-min-width">
<div class="fed-part-case">
<div class="fed-play-info fed-part-rows fed-back-whits fed-marg-top">
	<div class="fed-play-player fed-rage-head fed-part-rows fed-back-black" style="padding-top:56.25%">
		<style type="text/css">@media(max-width:47.9375rem){.fed-play-player{padding-top:56.25%!important}}</style>
			<div id="fed-play-iframe" class="fed-play-iframe fed-part-full"></div>
	</div>
	<div class="fed-play-title fed-part-rows">
				<ul class="fed-play-boxs fed-padding fed-part-rows fed-col-xs12 fed-col-md6">
			<li class="fed-padding fed-col-xs5">
				<span class="fed-play-text fed-visible fed-font-xvi fed-part-eone"><?php echo $initial_name; ?></span>
			</li>
		</ul>
	</div>
</div>
<div class="fed-tabs-info  fed-rage-foot fed-part-rows fed-part-layout fed-back-whits fed-play-data" data-name="<?php echo $json["name"]; ?>">
	<ul class="fed-list-head fed-part-rows fed-padding">
				<li class="fed-tabs-btns fed-part-curs fed-font-xvi fed-mart-v" href="javascript:;">剧情简介</li>
	</ul>
	<div class="fed-tabs-boxs">
		<div class="fed-tabs-item fed-drop-info fed-visible">
		    <div class="fed-tabs-item fed-hidden fed-show" style="display: block;">
						<div class="fed-col-xs12 fed-col-sm8 fed-col-md9">
				<dl class="fed-deta-info fed-margin fed-part-rows fed-part-over">
	<dt class="fed-deta-images fed-list-info fed-col-xs3">
		<a class="fed-list-pics fed-lazy fed-part-2by3" target="_blank" href="<?php echo $json["blog"]; ?>" data-original="<?php echo $json["pic"]; ?>" style="background-image: url(&quot;<?php echo $json["pic"]; ?>&quot;); display: block;">
			<span class="fed-list-play fed-hide-xs"></span>
						<span class=" "></span>
						<span class="fed-list-score fed-font-xii fed-back-green"><?php echo $json["update-statement"]; ?></span>
		</a>
	</dt>
	<dd class="fed-deta-content fed-col-xs7 fed-col-sm8 fed-col-md10 ">
		<h1 class="fed-part-eone fed-font-xvi"><a target="_blank" href="<?php echo $json["blog"]; ?>"><?php echo $json["name"]; ?></a></h1>
		<ul class="fed-part-rows">
			<li class="fed-col-xs6 fed-col-md3 fed-part-eone"><span class="fed-text-muted">标签：</span>
			
			<?php
			foreach ($json["tags"] as $t){
			    echo "<a href=\"https://maware.cc/tags/".urlencode($t)."/\" target=\"_blank\">".$t."</a>&nbsp;";
			}
			?>
			
			</li>
			<li class="fed-col-xs12 fed-hide fed-show-md-block">
				<div class="fed-part-esan">
					<span class="fed-text-muted">简介：</span><?php echo $json["introduction"]; ?></div>
			</li>
		</ul>
	</dd>
	<dd class="fed-deta-button fed-col-xs7 fed-col-sm8 fed-part-rows">
				<a class="fed-deta-play fed-rims-info fed-btns-info fed-btns-green fed-col-xs4" target="_blank" href="<?php echo $json["blog"]; ?>">查看详情</a>
			</dd>
</dl>

			</div>
						<p class="fed-padding fed-part-both fed-text-muted"><?php echo $json["introduction"]; ?></p>
		</div>
		</div>
				<div class="fed-tabs-item fed-hidden">
						<div class="fed-col-xs12 fed-col-sm8 fed-col-md9">
				<dl class="fed-deta-info fed-margin fed-part-rows fed-part-over">
	<dt class="fed-deta-images fed-list-info fed-col-xs3">
		<a class="fed-list-pics fed-lazy fed-part-2by3" target="_blank" href="<?php echo $json["blog"]; ?>" data-original="<?php echo $json["pic"]; ?>" style="background-image: url(<?php echo $json["pic"]; ?>);">
			<span class="fed-list-play fed-hide-xs"></span>
						<span class=" "></span>
						<span class="fed-list-score fed-font-xii fed-back-green"><?php echo $json["update-statement"]; ?></span>
		</a>
	</dt>
	<dd class="fed-deta-content fed-col-xs7 fed-col-sm8 fed-col-md10 ">
		<h1 class="fed-part-eone fed-font-xvi"><a target="_blank" href="<?php echo $json["blog"]; ?>"><?php echo $json["name"]; ?></a></h1>
		<ul class="fed-part-rows">
			<li class="fed-col-xs6 fed-col-md3 fed-part-eone"><span class="fed-text-muted">标签：</span>
			
			<?php
			foreach ($json["tags"] as $t){
			    echo "<a href=\"https://maware.cc/tags/".urlencode($t)."/\" target=\"_blank\">".$t."</a>&nbsp;";
			}
			?>
			
			</li>
		</ul>
	</dd>
	<dd class="fed-deta-button fed-col-xs7 fed-col-sm8 fed-part-rows">
				<a class="fed-deta-play fed-rims-info fed-btns-info fed-btns-green fed-col-xs4" target="_blank" href="<?php echo $json["blog"]; ?>">查看详情</a>
			</dd>
            </dl>
			</div>
			<p class="fed-padding fed-part-both fed-text-muted"><?php echo $json["introduction"]; ?></p>
	    </div>
	</div>
</div>
<div class="fed-tabs-info  fed-rage-foot fed-part-rows fed-part-layout fed-back-whits fed-play-data" data-name="<?php echo $json["name"]; ?>">

    <?php
    foreach ($json["clarity"] as $clar){
        echo "<div class=\"fed-play-item fed-drop-item fed-visible\"><ul class=\"fed-drop-head fed-padding fed-part-rows\"><li class=\"fed-padding fed-col-xs4 fed-part-eone fed-font-xvi\">清晰度-".$clar."</li></ul></div><ul class=\"fed-part-rows\">";
		foreach ($json["parts"][$clar] as $part){
		    $now_url = changeURLParam(getUrl(),"clar",$clar);
		    $now_url = changeURLParam($now_url,"p",(string)$part["part"]);
		    echo "<li class=\"fed-padding fed-col-xs3 fed-col-md2 fed-col-lg1\"><a class=\"fed-btns-info fed-rims-info fed-part-eone fed-btns-green\" href=\"".$now_url."\">第".(string)$part["part"]."集</a>";
		}
		echo "</ul>";
	}
    ?>

 <!--   <div class="fed-play-item fed-drop-item fed-visible">-->
	<!--	<ul class="fed-drop-head fed-padding fed-part-rows">-->
	<!--		<li class="fed-padding fed-col-xs4 fed-part-eone fed-font-xvi">播放集数</li>-->
	<!--	</ul>-->
	<!--</div>-->
 <!--   <ul class="fed-part-rows">-->
	<!--	<li class="fed-padding fed-col-xs3 fed-col-md2 fed-col-lg1">-->
	<!--		<a class="fed-btns-info fed-rims-info fed-part-eone fed-btns-green" href="{[播放地址]}">第01集</a>-->
	<!--	</li>-->
	<!--</ul>-->
</div>
<div class="fed-tabs-info  fed-rage-foot fed-part-rows fed-part-layout fed-back-whits fed-play-data" data-name="节点列表">
    <div class="fed-play-item fed-drop-item fed-visible">
		<ul class="fed-drop-head fed-padding fed-part-rows">
			<li class="fed-padding fed-col-xs4 fed-part-eone fed-font-xvi">节点列表</li>
		</ul>
	</div>
	<ul class="fed-part-rows">
	<li class="fed-padding fed-col-xs3 fed-col-md2 fed-col-lg1"><a class="fed-btns-info fed-rims-info fed-part-eone fed-btns-green" href="<?php echo changeURLParam(getUrl(),"proxy",""); ?>">不使用节点</a></li>
    <?php
    foreach ($node_json as $node){
        $now_node_url = changeURLParam(getUrl(),"proxy",$node["domain"]);
        echo "<li class=\"fed-padding fed-col-xs3 fed-col-md2 fed-col-lg1\"><a class=\"fed-btns-info fed-rims-info fed-part-eone fed-btns-green\" href=\"".$now_node_url."\">".$node['name']."</a></li>";
	}
    ?>
    </ul>
</div>
</div>
</div>

<div class="fed-foot-info fed-part-layout fed-back-whits">
	<div class="fed-part-case">
		<p class="fed-text-center fed-text-black"></p>
		<p class="fed-text-center fed-text-black fed-hide"></p>
			 <div class="masked">
    <h4><p class="fed-text-center fed-text-black">&nbsp;&nbsp;&nbsp;免责说明：本站所有视频均来自互联网收集而来，版权归原创者所有，如果侵犯了你的权益，请通过留言版给我们留言，我们会及时删除侵权内容，谢谢合作。</p>
		        <p class="fed-text-center fed-text-black">&nbsp;&nbsp;&nbsp;本站由 AnimeCDN 提供服务。</p>
		<p class="fed-text-center fed-text-black">&copy;&nbsp;2022&nbsp;<a class="fed-font-xiv" href="" target="_blank">Maware</a></p>
   </h4>
</div>
</div>
</div>
<script>
    const hls = new Hls()
    const player = new NPlayer.Player()
    hls.attachMedia(player.video)

    hls.on(Hls.Events.MEDIA_ATTACHED, function () {
        hls.loadSource('<?php echo $initial_url; ?>')
    })
    player.mount('#fed-play-iframe')
</script>
</body>
</html>
