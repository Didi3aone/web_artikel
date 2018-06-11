<?php
// Encryption Function
	function inacbg_encrypt($data, $key) {

	/// make binary representasion of $key
	 $key = hex2bin($key);
	 /// check key length, must be 256 bit or 32 bytes
	 if (mb_strlen($key, "8bit") !== 32) {
	 throw new Exception("Needs a 256-bit key!");
	 }
	 /// create initialization vector
	 $iv_size = openssl_cipher_iv_length("aes-256-cbc");
	 $iv = openssl_random_pseudo_bytes($iv_size); // dengan catatan dibawah
	 /// encrypt
	 $encrypted = openssl_encrypt($data,
	 "aes-256-cbc",
	 $key,
	 OPENSSL_RAW_DATA,
	 $iv );
	 /// create signature, against padding oracle attacks
	 $signature = mb_substr(hash_hmac("sha256",
	 $encrypted,
	 $key,
	 true),0,10,"8bit");
	 /// combine all, encode, and format
	 $encoded = chunk_split(base64_encode($signature.$iv.$encrypted));
	 return $encoded;
 }

 // Decryption Function
 function inacbg_decrypt($str, $strkey){
	 /// make binary representation of $key
	 $key = hex2bin($strkey);
	 /// check key length, must be 256 bit or 32 bytes
	 if (mb_strlen($key, "8bit") !== 32) {
		 throw new Exception("Needs a 256-bit key!");
	}
/// calculate iv size
	 $iv_size = openssl_cipher_iv_length("aes-256-cbc");
	 /// breakdown parts
	 $decoded = base64_decode($str);
	 $signature = mb_substr($decoded,0,10,"8bit");
	 $iv = mb_substr($decoded,10,$iv_size,"8bit");
	 $encrypted = mb_substr($decoded,$iv_size+10,NULL,"8bit");
	 /// check signature, against padding oracle attack
	 $calc_signature = mb_substr(hash_hmac("sha256",
	 $encrypted,
	 $key,
	 true),0,10,"8bit");
	 if(!inacbg_compare($signature,$calc_signature)) {
	 return "SIGNATURE_NOT_MATCH"; 
	 }
	 $decrypted = openssl_decrypt($encrypted,
	 "aes-256-cbc",
	 $key,
	 OPENSSL_RAW_DATA,
	 $iv);
	 return $decrypted;
	}

	/// Compare Function
 function inacbg_compare($a, $b) {

 	/// compare individually to prevent timing attacks

	 /// compare length
	 if (strlen($a) !== strlen($b)) return false;

	 /// compare individual
	 $result = 0;
	 for($i = 0; $i < strlen($a); $i ++) {
	 $result |= ord($a[$i]) ^ ord($b[$i]);
	 }

	 return $result == 0;
	 }
 ?>
 <?php 
  //    // contoh encryption key, bukan aktual
		// $key = "5cb7e8e7d0f6d15a9c986f4accc5022893938092039";
		// // json query
		// $json_request = <<<EOT
		// {
		//  "metadata": {
		//  "method": "claim_print"
		//  },
		//  "data": {
		//  "nomor_sep": "16120507422"
		//  }
		// }
		// EOT;

		// $ws_query["metadata"]["method"] = "claim_print";
		// $ws_query["data"]["nomor_sep"] = "16120507422";
		// $json_request = json_encode($ws_query);
		// // data yang akan dikirimkan dengan method POST adalah encrypted:
		// $payload = inacbg_encrypt($json_request,$key);
		// // tentukan Content-Type pada http header
		// $header = array("Content-Type: application/x-www-form-urlencoded");
		// // url server aplikasi E-Klaim,
		// // silakan disesuaikan instalasi masing-masing
		// $url = "http://192.168.56.101/E-Klaim/ws.php";
		// $ch = curl_init();
		// curl_setopt($ch, CURLOPT_URL, $url);
		// curl_setopt($ch, CURLOPT_HEADER, 0);
		// curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		// curl_setopt($ch, CURLOPT_HTTPHEADER,$header);
		// curl_setopt($ch, CURLOPT_POST, 1);
		// curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);

 ?>