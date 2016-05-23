<?php

namespace App\Models\API;

class Items
{

	protected $url = 'https://api.steampowered.com/IEconItems_730/GetSchema/v2/';
	private $items, $data;

    public function __construct(){
    	if(!env('CS_API_KEY')){
    		throw new Exception("No CS API KEY provided!", 1);
    	}
    	$this->url = $this->url.'?'.http_build_query(['key' => env('CS_API_KEY'), 'language' => 'en']);

    	$this->items = collect($this->_request()->items);
    	$this->data = collect($this->_request());

    }

    public function all(){
    	return $this->items;
    }

    private function _request() {

			$curl = curl_init();
			$options = array
				(
					CURLOPT_RETURNTRANSFER => TRUE,
					CURLOPT_HEADER         => FALSE,
					CURLOPT_FOLLOWLOCATION => FALSE,
					CURLOPT_ENCODING       => '',
					CURLOPT_USERAGENT      => 'Client',
					CURLOPT_AUTOREFERER    => FALSE,
					CURLOPT_SSL_VERIFYHOST => FALSE,
					CURLOPT_SSL_VERIFYPEER => FALSE,
					CURLOPT_NOBODY         => FALSE,
					CURLOPT_CONNECTTIMEOUT => 10,
					CURLOPT_TIMEOUT        => 20,
					CURLOPT_SSLCERTPASSWD  => '',                                                             
					CURLOPT_SSLVERSION     => 1,        
					CURLOPT_URL            => $this->url
				);

			curl_setopt_array($curl, $options); 
			
			$curl_result = curl_exec($curl);

			if($curl_result){
				$data = json_decode($curl_result);
				curl_close($curl);
				return $data->result;
			}
			$error = curl_error($curl);
			curl_close($curl);
			return $error;
	}

}
