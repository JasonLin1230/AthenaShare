<?php
/*
 * Author : JaosnLin
 * Date : 2018/6/24
 * Describe : Kownledge Model class. 
 *       
*/

namespace Kng\Model;

class KngModel extends Model {
	protected $fields = array ('kng_id', 
			'kng_owner_id', 'kng_name', 
			'kng_describe', 'kng_update_date', 
			'kng_like', 'kng_cate_id');
	protected $pk = 'kng_id';
}
?>
