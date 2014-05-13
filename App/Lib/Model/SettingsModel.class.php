<?php
class SettingsModel  extends  Model{
	protected $tableName = 'settings';


	public  function   getSettings(){
		$result = $this->select();
		foreach ($result as $key => $value) {
			$result[$key]['value'] = unserialize($value['value']);
		}
		$result = array_merge($result[0]['value'], $result[1]['value']);
		F('settings', $result);
		return $result;
	}
}
?>