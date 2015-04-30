<?php
include_once('simple_html_dom.php');
$shop=new Shop();
print_r($shop->getInfomation());

class Shop{
	public function getInfomation(){
		$html = file_get_html('http://www.quwan.com/category_2013-85-sc770501-catogry_type_2013.html?fm=mainnav');
		foreach($html->find('div.brick') as $temp) {
			$item['link']=$temp->find('a', 0)->href;
			$item['img']=$temp->find('img', 0)->src;
			$item['name']=$temp->find('dl dd a', 0)->plaintext;
			$item['price']=$temp->find('dl dd span', 0)->plaintext;
			
			$more_img = file_get_html($item['link']);
			foreach($more_img->find('div[class="box details"]') as $inner) {
				$imgs=$more_img->find('p img');
				foreach($imgs as $img) {
					$more[]=$img->src;
				}
			}
			$item['more']=$more;
			
			$items[]=$item;
			$more=null;
			//break;
		}
		return $items;
	}
}
?>