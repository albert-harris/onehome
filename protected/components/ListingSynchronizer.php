<?php
use Sunra\PhpSimple\HtmlDomParser;

/**
 * Sync properties from PropertyGuru
 *
 * @author Lam Huynh
 */
class ListingSynchronizer {
	
	static public function getHtml($url) {
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER,array(
			'Host: www.propertyguru.com.sg',
			'User-Agent: Mozilla/5.0 (Windows NT 6.1; WOW64; rv:34.0) Gecko/20100101 Firefox/34.0',
			'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
			'Accept-Language: en-US,en;q=0.5',
			'Cookie: PHPSESSID2=175vilcu40l9ti64pvt8tvj8n0; PGURU_VISITOR=14447406031157222634TEsTHKnbnkAE; SEARCH_PER_PAGE=10; __utma=165735807.184817377.1444740616.1444740616.1444740616.1; __utmb=165735807.2.10.1444740616; __utmc=165735807; __utmz=165735807.1444740616.1.1.utmcsr=(direct)|utmccn=(direct)|utmcmd=(none); __utmt=1; __utmt_guru=1; __gads=ID=97c501249f0a123f:T=1444740613:S=ALNI_Mbv_s8ZnL3FzDul5mnN9ORzflg8Ug; cX_S=ifpd9j3knno0vl3d; cX_P=idg0aetud9z28e6f; _em_vt=a3072f2eb3da24785084346f1ee9561cfe0e730d22-54980565561cfe0e; _em_v=2f29a63410c77945961b92352ffe561cfe0e730d35-82167601561cfe0e; D_SID=115.72.226.34:mr2J+2AL2HYs8/mi0kwFol/W7271s26gCgaodff3DKI; D_PID=3119DF0B-3C06-308A-88B4-6118E4B86D16; D_IID=D9F3E47F-1FA1-3F31-A910-897988544C23; D_UID=6F5AC42D-4A0A-3A53-81F2-4CD5D1DB9F87; D_HID=V4CdSUSpHXDcgvWsuJh+GRWi1HxfY+3zYz38S8qGAgQ',
			'Referer: http://www.propertyguru.com.sg/singapore-property-listing/property-for-sale/1?sort=date&order=asc',
			'Connection: keep-alive',
			'Cache-Control: max-age=0'
		));
		$content = curl_exec($ch);
		curl_close($ch);
		
		return $content;
	}
	
	public function run() {
		$categories = array(
			'http://www.propertyguru.com.sg/singapore-property-listing/property-for-sale/',
			'http://www.propertyguru.com.sg/singapore-property-listing/property-for-rent/'
		);
		
		foreach ($categories as $link) {
			$listingLinks = $this->getListingLinks($link);
			foreach ($listingLinks as $listingLink) {
				$data = $this->getListingData($listingLink);
				if (!is_array($data)) continue;
				$this->syncListing($data);
			}
		}
	}
	
	/*
	 * get html content of url, parse and return the list of property url
	 * because the url has pager parameters. this method must have a mechanism to skip crawled pages
	 */
	static public function getListingLinks($url) {
		// adjust url for paging
		$k = 'crawl_pos_'.static::hash($url);
		$page = Yii::app()->setting->getItem($k) ?: 1;
		$order = '?sort=date&order=asc';
		$url .= $page . $order;
		
		$result = array();
		$dom = HtmlDomParser::str_get_html( static::getHtml($url) );
		foreach ($dom->find('ul.listing_list a.infotitle') as $element) {
			$result[] = 'http://www.propertyguru.com.sg'.$element->href;
		}
		
		// remove crawled listings
		$crawleds = CHtml::listData(RemoteListing::model()->findAll(), 'id', 'url');
		$result = array_diff($result, $crawleds);
		
		// save current page position
		Yii::app()->setting->setDbItem($k, $page+1);
		return $result;
	}
	
	/*
	 * get html content of url, parse and return data of listing (see mapping sheet)
	 */
	static public function getListingData($url) {
		// save crawled listing
		if ( !RemoteListing::model()->exists('url LIKE :s', array(
			':s' => $url
		)) ) {
			$r = new RemoteListing();
			$r->url = $url;
			$r->save();
		}

		$dom = HtmlDomParser::str_get_html( static::getHtml($url) );
//		$dom = HtmlDomParser::str_get_html( file_get_contents(Yii::getPathOfAlias('webroot').'/a.html') );
		
		$result = array();
		$result['comp_lis'] = static::parseCompanyLiscense($dom);
		if (!$result['comp_lis'])
			return null;	// url invalid or server blocked this request
		$result['user_id'] = static::parseAgentId($dom);
		$result['url'] = $url;
		$result['listing_type'] = static::parseListingType($dom);
		$result['display_address'] = static::parseAddress($dom);
		$result['of_bedroom'] = static::parseBedroom($dom);
		$result['of_bathrooms'] = static::parseBathroom($dom);
		$result['listing_description'] = static::parseDescription($dom);
		$result['date_listed'] = $result['re_listed_date'] = static::parseRelistedDate($dom);
		$result['status'] = STATUS_ACTIVE;
		$result['status_listing'] = STATUS_LISTING_ACTIVE;
		$result['created_date'] = date('Y-m-d H:i:s');
		$result['floor_area_unit'] = 'sqft';
		$result['photos'] = static::parsePhotos($dom);
		$result['location_id'] = static::parseLocation($dom);
		
		foreach ($dom->find('.detailtable tr') as $element) {
			$item = array();
			foreach($element->find('td') as $td) {
				$item[] = trim(html_entity_decode(strip_tags($td->plaintext)));
			}
			$label = isset($item[0]) ? $item[0] : null;
			$value = isset($item[1]) ? $item[1] : null;
			switch ($label) {
				case 'Property Name:':
					$result['property_name_or_address'] = $value;
					break;
				
				case 'Price:':
					$result['price'] = static::parsePrice($value);
					break;
				
				case 'Floor Area:':
					$matches = null;
					preg_match( '/(.*?)sqft/', $value, $matches);
					$value = isset($matches[1]) ? str_replace(',', '', trim($matches[1])) : null;
					$result['floor_area'] = $value;
					break;
				
				case 'Land Area:':
					$matches = null;
					preg_match( '/(.*?)sqft/', $value, $matches);
					$value = isset($matches[1]) ? str_replace(',', '', trim($matches[1])) : null;
					$result['land_area'] = $value;
					break;
				
				case 'Property Type:':
					$result['property_type_1'] = static::parsePropType($value);
					break;
				
				case 'Tenure:':
					$result['tenure'] = static::parseTenure($value);
					break;
					
				case 'Condition:':
					$result['furnished'] = static::parseFurnished($value);
					break;
					
			}
		}
		foreach ($dom->find('h3.infohead') as $element) {
			$label = trim($element->plaintext);
			$nextSibling = $element->next_sibling();
			switch ($label) {
				case 'Special Features:':
					$result['special_feature_json'] = static::parseSpecialFeature($nextSibling);
					break;
				case 'Features:':
					$result['fixtures_fittings_json'] = static::parseFeature($nextSibling);
					break;
				case 'Outdoor / Indoor Space:':
					$result['outdoor_indoor_space_json'] = static::parseOutdoor($nextSibling);
					break;
					
			}
		}
		return $result;
	}
	
	/*
	 * perform listing validation, create listing
	 */
	static public function syncListing($data) {
		// if listing is not from OneHome, skip it
		// if listing is not created by OneHome Agent, skip it
		if (strcasecmp($data['comp_lis'], 'L3010619I') != 0 ||
			!$data['user_id']) {
			return -1;
//			$data['user_id'] = 627;	// arthur zang
		}
		
		if (LhListing::model()->exists('property_name_or_address LIKE :s 
			AND display_address LIKE :a', array(
			':s' => $data['property_name_or_address'],
			':a' => $data['display_address'],
		))) return -2;

		// save listing
		$model = new LhListing('sync');
		$model->attributes = $data;
		$model->save();
		
		// save photo
		$notDef = false;
		foreach($data['photos'] as $url) {
			$ext = pathinfo($url, PATHINFO_EXTENSION);
			if (!in_array($ext, array('jpg', 'png', 'gif')))
				continue;
			
			$photo = new ProListingPhotos();
			$photo->display_order = 0;
			$photo->default = $notDef ? 0 : 1;
			$notDef = true;
			$photo->listing_id = $model->id;
			$photo->image = basename($url);
			$photo->created_date = date('Y-m-d H:i:s');
			$photo->save();
			
			// get image from remote server and save to disk
			$file = $photo->generateImagePath();
			if (!file_exists(dirname($file))) 
				mkdir(dirname($file));
			file_put_contents($file, static::getContent($url));
		}
		return 1;
	}
	
	/*
	 * parse display_address from simplehtmldom object
	 */
	static protected function parseAddress($dom) {
		$t = $dom->find('.info1 p');
		$p = end($t);
		if (!$p) return null;

		$matches = null;
		preg_match( '/(.*?)\,/', $p->plaintext, $matches);
		if (!isset($matches[1])) return null;
		return trim($matches[1]);
	}
	
	/*
	 * parse of_bedroom from simplehtmldom object
	 */
	static protected function parseBedroom($dom) {
		$b = $dom->find('.bedroom', 0);
		if (!$b) return null;
		return str_replace (array(' ', 'Beds'), '', $b->plaintext);
	}
	
	/*
	 * parse of_bathrooms from simplehtmldom object
	 */
	static protected function parseBathroom($dom) {
		$b = $dom->find('.bathroom', 0);
		if (!$b) return null;
		return str_replace (array(' ', 'Baths'), '', $b->plaintext);
	}
	
	/*
	 * parse price from text
	 */
	static protected function parsePrice($value) {
		$matches = null;
		preg_match( '/(\d+)/', str_replace(array('S$', ',', ' '), '', $value), $matches);
		if (!isset($matches[1])) return null;
		return $matches[1];
	}
	
	/*
	 * parse id from simplehtmldom object
	 */
	static protected function parseId($dom) {
		$a = $dom->find('a.shorlist', 0);
		if (!$a) return null;
		$matches = null;
		preg_match( '/addShortlist\((\d+)\)/', $a->href, $matches);
		if (!isset($matches[1])) return null;
		return $matches[1];
	}
	
	/*
	 * parse description from simplehtmldom object
	 */
	static protected function parseDescription($dom) {
		$a = $dom->find('#ldescription', 0);
		if (!$a) return null;
		return trim($a->innertext);
	}
	
	/*
	 * parse description from value
	 */
	static protected function parsePropType($value) {
		$data = CHtml::listData(ProPropertyType::model()->findAll(), 'id', 'name');
		return array_search(
			strtolower($value),
			array_map('strtolower', $data)
		);
	}
	
	/*
	 * parse tenure from value
	 */
	static protected function parseTenure($value) {
		$data = CHtml::listData(ProMasterTenure::model()->findAll(), 'id', 'name');
		$t = array_search(
			strtolower($value),
			array_map('strtolower', $data)
		);
		return $t ?: null;
	}
	
	/*
	 * parse re_listed_date from simplehtmldom object
	 */
	static protected function parseRelistedDate($dom) {
		$a = $dom->find('.info2 > p', 1);
		if (!$a) return null;
		$t = strtotime(trim(str_replace('Re-listed on ', '', $a->plaintext)));
		if (!$t) return null;
		return date('Y-m-d', $t);
	}
	
	/*
	 * parse agent cea then convert it to user id from simplehtmldom object
	 */
	static protected function parseAgentId($dom) {
		$a = $dom->find('.agent_info .bluethinlink', 0);
		if (!$a) return null;
		$cea = trim($a->plaintext);
		$u = Users::model()->findByAttributes(array(
			'role_id' => ROLE_AGENT,
			'agent_cea' => $cea,
			'status' => STATUS_ACTIVE
		));
		if (!$u) return null;
		return $u->id;
	}
	
	/*
	 * parse agent cea then convert it to user id from simplehtmldom object
	 */
	static protected function parseCompanyLiscense($dom) {
		$a = $dom->find('.agent_info .blueboldlink', 0);
		if (!$a) return null;
		return trim($a->plaintext);
	}
	
	/*
	 * parse agent cea then convert it to user id from simplehtmldom object
	 */
	static protected function parseListingType($dom) {
		$a = $dom->find('.summarytitle a', 0);
		if (!$a) return null;
		return strpos($a->plaintext, 'For Sale')!==false ? 
			Listing::FOR_SALE : Listing::FOR_RENT;
	}
	
	/*
	 * parse photos from simplehtmldom object
	 */
	static protected function parsePhotos($dom) {
		$matches = null;
		preg_match_all( "/addMediaItem.*?showfile': '(.*?)'/", $dom->innertext, $matches);
		return isset($matches[1]) ? $matches[1] : array();
	}
	
	/*
	 * return hash value of a string
	 */
	static private function hash($s) {
		return sprintf('%x', crc32($s));
	}
	
	/*
	 * parse furnished from simplehtmldom object
	 */
	static protected function parseFurnished($value) {
		$data = CHtml::listData(ProMasterFurnished::model()->findAll(), 'value', 'name');
		$t = array_search(
			strtolower($value),
			array_map('strtolower', $data)
		);
		return $t ?: null;
	}
	
	/*
	 * parse special feature from simplehtmldom object
	 */
	static protected function parseSpecialFeature($dom) {
		$result = array();
		$list = ProMasterSpecialFeatures::getDropdownList();
		foreach($dom->find('li') as $element) {
			$label = trim($element->plaintext);
			$value = array_search(
				strtolower($label),
				array_map('strtolower', $list)
			);
			
			if ($value)
				$result[] = $value;
		}
		return json_encode($result);
	}
	
	/*
	 * parse feature from simplehtmldom object
	 */
	static protected function parseFeature($dom) {
		$result = array();
		$list = ProMasterFixturesFittings::getDropdownList();
		foreach($dom->find('li') as $element) {
			$label = trim($element->plaintext);
			$value = array_search(
				strtolower($label),
				array_map('strtolower', $list)
			);
			
			if ($value)
				$result[] = $value;
		}
		return json_encode($result);
	}
	
	/*
	 * parse outdoor/indoor space from simplehtmldom object
	 */
	static protected function parseOutdoor($dom) {
		$result = array();
		$list = ProMasterOutdoorIndoorSpace::getDropdownList();
		foreach($dom->find('li') as $element) {
			$label = trim($element->plaintext);
			$value = array_search(
				strtolower($label),
				array_map('strtolower', $list)
			);
			
			if ($value)
				$result[] = $value;
		}
		return json_encode($result);
	}
	
	/*
	 * parse location_id from simplehtmldom object
	 */
	static protected function parseLocation($dom) {
		$a = $dom->find('.summarytitle a', 0);
		if (!$a) return null;
		$matches = null;
		preg_match( '/\(D(\d+)\)/', $a->plaintext, $matches);
		if (!isset($matches[1])) return null;
		$district = (int)$matches[1];
		$model = ProLocation::model()->findByAttributes(array(
			'district' => $district
		));
		if (!$model) return null;
		return $model->id;
	}
	
	static public function getContent($url) {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_POST, 0);
		curl_setopt($ch,CURLOPT_URL,$url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$result=curl_exec($ch);
		curl_close($ch);
		return $result;		
	}
}
