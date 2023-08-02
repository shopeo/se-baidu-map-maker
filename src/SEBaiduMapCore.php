<?php

namespace Shopeo\SeBaiduMapPoint;

class SEBaiduMapCore {

	public function __construct() {
		if ( defined( 'SE_Baidu_Map_Core_Loaded' ) ) {
			return;
		}
		define( 'SE_Baidu_Map_Core_Loaded', true );
		add_action( 'admin_menu', array( $this, 'add_page' ) );
	}

	public function add_page() {
		$hookname = add_menu_page(
				__( 'Baidu Map Point', 'se-baidu-map-point' ),
				__( 'Baidu Map Point', 'se-baidu-map-point' ),
				'manage_options',
				'se-baidu-map-point',
				array( $this, 'html' ),
				'data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCA1NzYgNTEyIj48IS0tISBGb250IEF3ZXNvbWUgUHJvIDYuNC4wIGJ5IEBmb250YXdlc29tZSAtIGh0dHBzOi8vZm9udGF3ZXNvbWUuY29tIExpY2Vuc2UgLSBodHRwczovL2ZvbnRhd2Vzb21lLmNvbS9saWNlbnNlIChDb21tZXJjaWFsIExpY2Vuc2UpIENvcHlyaWdodCAyMDIzIEZvbnRpY29ucywgSW5jLiAtLT48cGF0aCBkPSJNMzg0IDQ3Ni4xTDE5MiA0MjEuMlYzNS45TDM4NCA5MC44VjQ3Ni4xem0zMi0xLjJWODguNEw1NDMuMSAzNy41YzE1LjgtNi4zIDMyLjkgNS4zIDMyLjkgMjIuM1YzOTQuNmMwIDkuOC02IDE4LjYtMTUuMSAyMi4zTDQxNiA0NzQuOHpNMTUuMSA5NS4xTDE2MCAzNy4yVjQyMy42TDMyLjkgNDc0LjVDMTcuMSA0ODAuOCAwIDQ2OS4yIDAgNDUyLjJWMTE3LjRjMC05LjggNi0xOC42IDE1LjEtMjIuM3oiLz48L3N2Zz4=',
				80
		);
		//add_action( 'load-' . $hookname, $this );
	}
	

	public function html() {
		
	
			
	if($_POST)
		{
			

 
  update_option("appid", $_POST['appid']);
  update_option("appk", $_POST['appk']);
 
 echo '<script>alert("设置成功！");</script>';
			
			
			
		}
		
		
		
		
		
		$appid=get_option('appid');
		$appk=get_option('appk');
	
		?>
		<div class="wrap">
		<form name="baduapiset" method="post" enctype="multipart/form-data">
		<h1>地图开发人员配置</h1>
		<div class="l1"><label>APPID</label>:<input type="text" name="appid" value="<?php echo $appid;?>"/></div>
		<div class="l1"><label>APPK</label>：<input type="text" name="appk" value="<?php echo $appk;?>"/><div>
		<div class="l1"><input type="submit" name="theme_set" value="保存设置"/>
		
		
		</form>
		</div>
		<?php
	}

	public function submit() {
	

	
	}
}
