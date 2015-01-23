<?php 

	class Hash{
		public static function get($func, $data, $key){
			$hash = hash_init($func, HASH_HMAC, $key);
			hash_update($hash, $data);
			return hash_final($hash);
		}

	}