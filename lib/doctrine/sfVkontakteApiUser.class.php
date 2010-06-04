<?
/**
 * sfVkontakteApiUser doctrine listener  .
 *
 * @package	sfVkontaktePlugin
 * @subpackage doctrine
 * @author	 Alexey Tyagunov <atyaga@gmail.com>
 */

class sfVkontakteApiUser extends Doctrine_Template {

	/**
	 * @return
	 */
	public function setTableDefinition() {
		// get columns from app.yml
		$columns = sfConfig::get('app_vkontakte_profile_fields');

		foreach ($columns as $fieldName => $options) {
			$this->hasColumn($fieldName, $options['type']);
		}
		$this->hasColumn('settings', 'integer');
		$this->hasColumn('fetched_at', 'datetime');
	}
	public function setUp() {
		$userModelTable = sfConfig::get('app_vkontakte_user_model');
		$this->hasMany($userModelTable . ' as Friends', array(
			'local' => 'user_from',
			'foreign' => 'user_to',
			'refClass' => 'FriendReference',
			'equal'  => true
		));
		//$this->
		//$this->_options['table'];
	}
}

//class FriendReference extends Doctrine_Record {
//    public function setTableDefinition() {
//        $this->hasColumn('user_from', 'integer', null, array('primary'=>true));
//        $this->hasColumn('user_to', 'integer', null, array('primary'=>true));
//    }
//}