<?php



function add_xz_box (){
	//添加设置区域的函数a
	add_meta_box('xz_box_1', '百度地图坐标设置(点击选择点)', 'xz_box_1','post','advanced','default');
}
//在'add_meta_boxes'挂载 add_xz_box 函数
add_action('add_meta_boxes','add_xz_box');
function xz_box_1($post){
	
	
	//显示设置区域的回调函数echo"add_meta_box 测试";
  $xpos = get_post_meta( $post->ID, 'xpos', true );
    $ypos = get_post_meta( $post->ID, 'ypos', true );

?>
 <label for="pos"></label>
    
	  <div class="box">
	    <div class="boxl"><span>经度：</span> <input type="text" id="xpos" name="xpos" value="<?php echo esc_attr( $xpos ); ?>" placeholder="输入X轴坐标"></div>
       <div class="boxl"><span>纬度：</span> <input type="text" id="ypos" name="ypos" value="<?php echo esc_attr( $ypos ); ?>" placeholder="输入Y轴坐标"> </div>
	  <div class="boxl"><span>标注图标样式</span>
            <div class="box-item">
                <img src="<?php echo plugin_dir_url(__FILE__ )?>/assets/img/tubiao/t1.png"/>
                请选择样式
            </div>
            <ul class="picul">
			<input id="pictype" name="pictype" type="hidden" value="1"/>
			<?php for($i=2;$i<11;$i++){?>
                <li class="picitem" data-id="<?php echo $i;?>">
			<img src="<?php echo plugin_dir_url(__FILE__ )?>/assets/img/tubiao/t<?php echo $i?>.png"/>
                   
                </li>
			<?php }?>
            </ul>
           </div>   
        </div>
	<div id="ditu">
		<div id="dituedit"></div>
		</div>
		<script type="text/javascript" src="<?php echo plugin_dir_url(__FILE__ )?>/assets/js/jquery-1.10.2.min.js"></script>
	<script type="text/javascript" src="//api.map.baidu.com/api?v=2.0&ak=<?php echo get_option("appk");?>"></script>
		<script>
		    //进入页面 初始化 位置tab页的地图
			 initMap();
    function initMap() {
 
        $("#dituedit").empty();
        var map = new BMap.Map("dituedit");
		
		
        //设置一个 默认的位置。
        var point = new BMap.Point(116.404, 39.915);
        map.centerAndZoom(point,11);
        map.enableScrollWheelZoom(true);
		 var scaleCtrl = new BMap.ScaleControl();  // 添加比例尺控件
    map.addControl(scaleCtrl);
  map.enableScrollWheelZoom(true);     //开启鼠标滚轮缩放
	
	
        var geolocation = new BMap.Geolocation();
        geolocation.getCurrentPosition(function (r) {
            if (this.getStatus() == BMAP_STATUS_SUCCESS) {
                var mk = new BMap.Marker(r.point);
                map.addOverlay(mk);
                map.panTo(r.point);
            }
            else {
                alert('failed' + this.getStatus());
            }
        }, {enableHighAccuracy: true});
        map.addEventListener("click", function (e) {
 
            //获取当前点击 位置的经纬度，并显示在文本框中
            document.getElementById('xpos').value = e.point.lat;
            document.getElementById('ypos').value = e.point.lng;
            map.clearOverlays();
            var new_point = new BMap.Point(e.point.lng, e.point.lat);
            var new_mk = new BMap.Marker(new_point);
            map.addOverlay(new_mk);
            map.panTo(new_point);
 
 
       
        });
    }
	</script>
		 <style>
            *{
                margin: 0;
                padding: 0;
            }
            .box{
                width: 20%;float:left;
            }
			.boxl{margin-bottom:20px;}
            .box-item{
                height: 50px;
                line-height: 50px;
            }
			#ditu{float:left;width:70%;height:400px;margin-left:9%;}
			#dituedit{width:100%;height:100%;}
            .box-item img{
                width: 25px;
                vertical-align: middle;
            }
            ul{
                display: none;
                width: 100%;
                list-style: none;

            }
            li{
                height: 30px;
                line-height: 30px;
            }
            li:hover{
                background: #FFC0CB;
            }
            li img{
                width:25px;
                vertical-align: middle;
            }
            
        </style>
		
		
        <script>
            var ul = document.querySelector(".picul");

            var boxContent = document.querySelector(".box-item");
			var li=document.querySelector(".picitem");
　　　　　　　　//点击下拉框显示并阻止冒泡,防止触发document上写的隐藏下拉框函数
            boxContent.onclick = function(e) {
                var e = e || window.event;
                ul.style.display = "block";
                e.stopPropagation();
            };
		
		
		$(".picitem").click(function(){ 
  var txt = $(this).html(); 
  $(".box-item").html(txt); 
 $("#pictype").val($(this).attr("data-id"));
 
});
　　　　　　
　　　　　　　　//点击document隐藏下拉框  选择框显示但不做选择时点击页面选择框隐藏
            document.onclick = function() {
                ul.style.display = "none";
            }
        </script>
	  
	  
	  </div>
	   
<?php
}


add_action( 'save_post', 'save_meta_box' );
function save_meta_box($post_id){

  
    if ( ! isset( $_POST['xpos'] )||!isset($_POST['ypos']) ) {
        return;
    }
    $xpos = sanitize_text_field( $_POST['xpos'] );
	  $ypos = sanitize_text_field( $_POST['ypos'] );
	  $pictype = sanitize_text_field( $_POST['pictype'] );
    update_post_meta( $post_id,'xpos', $xpos );
	update_post_meta( $post_id,'ypos', $ypos );
	update_post_meta( $post_id,'pictype', $pictype );
}

function myshortcode_function($atts, $content = null ){ // $atts 代表了 shortcode 的各个参数，$content 为标签内的内容
//定义数据库全局变量
 global $wpdb;


  extract(shortcode_atts(// 使用 extract 函数解析标签内的参数
  array( 
"appk"=>get_option("appk")
  ), $atts));

  // 返回内容
$contents='<style type="text/css">
	body, html,#allmap {width: 100%;height: 100%;overflow: hidden;margin:0;font-family:"微软雅黑";}
	.myshortcode{height:400px;width:100%;}
	</style>
	<script type="text/javascript" src="//api.map.baidu.com/api?type=webgl&v=1.0&ak='.$appk.'"></script>



	<div id="allmap"></div>

<script type="text/javascript">
    // GL版命名空间为BMapGL
	var map = new BMapGL.Map("allmap");    // 创建Map实例
	map.centerAndZoom(new BMapGL.Point(116.404, 39.915), 11);  // 初始化地图,设置中心点坐标和地图级别
	
	map.enableScrollWheelZoom(true);     //开启鼠标滚轮缩放
	map.setMapType(BMAP_SATELLITE_MAP);      // 设置地图类型为地球模式
	 var scaleCtrl = new BMapGL.ScaleControl();  // 添加比例尺控件
    map.addControl(scaleCtrl);
	 var zoomCtrl = new BMapGL.ZoomControl();  // 添加缩放控件
    map.addControl(zoomCtrl);
	 var navi3DCtrl = new BMapGL.NavigationControl3D();  // 添加3D控件
    map.addControl(navi3DCtrl);
	';

$sql="select distinct(post_id) from ".$wpdb->prefix."postmeta  where (meta_key='xpos' or meta_key='ypos' )and meta_value>0";
$results=$wpdb->get_results($sql);
if(!empty($results)){
	foreach ($results as $key=>$item) {
		$id=$item->post_id;
		$title = get_post($id)->post_title;
		$xpos=get_post_meta($id, "xpos", true);
			$ypos=get_post_meta($id, "ypos", true);
			$pictype=plugin_dir_url(__FILE__ )."/assets/img/tubiao/t".get_post_meta($id, "pictype", true).'.png';
			$zhaiyao=get_the_excerpt($id);
	
$contents.='
// 创建点标记
	var point'.$key.' = new BMapGL.Point('.$ypos.', '.$xpos.');
map.centerAndZoom(point'.$key.', 15);

var myIcon'.$key.' = new BMapGL.Icon("'.$pictype.'", new BMapGL.Size(30, 44));
var marker'.$key.' = new BMapGL.Marker(point'.$key.',{
    icon: myIcon'.$key.'
});
map.addOverlay(marker'.$key.');
// 创建信息窗口
var opts'.$key.' = {
    width: 200,
    height: 50,
    title: "'.$title.'"
};
var infoWindow'.$key.' = new BMapGL.InfoWindow("'.$zhaiyao.'", opts'.$key.');
// 点标记添加点击事件
marker'.$key.'.addEventListener("click", function () {
    map.openInfoWindow(infoWindow'.$key.', point'.$key.'); // 开启信息窗口
})';	
		
		
		
		
	}
}

$contents.='</script>';
  return '<div class="myshortcode">' .$contents . ' </div>' ;

}

 

add_shortcode( "baidumap" , "myshortcode_function" ); 


?>