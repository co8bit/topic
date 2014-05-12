<?php
class DeletelistModel  extends Model
{
	/**
	 * 同步帖子时取出被删除帖子的tid
	 * @param	int $pageSize，一次取出的大小
	 * @return	$re[i]["tid"] 第i个topic的数据tid
	 */
	public function getSyncDelTopic($pageSize = 50)
	{
		$result  = $this->limit($pageSize)->select();
		
		$this->where("fordel=''")->limit($pageSize)->delete();
		return $result;
	}
}
?>
