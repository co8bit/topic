<?php 
require_once(CONF_PATH."MyConfigINI.php");

class SyncAction extends Action {
	
	   protected function _initialize()
	   {
	   		if ( !(($this->_param("userName") == "syndontStarve") && ($this->_param("userPassword") == "sc2")) )
	   				redirect(U('Topic/index'));
	   }
	   
	   /**
	    * 序列化一维数组，给数组添加自定义的中断标记并转换成字符串。
	    * @param	array $data;需要转换的一维原始数据
	    * 					string $tag;中断标记
	    * @return		string;转换完成后的字符串
	    * @note		开头没有中断标记，
	    * 					最后一个元素末尾都有中断标记
	    */
	   protected function transformWithSlef($data,$tag)
	   {
		   	$re = "";
		   	for ($i = 0; $i < count($data); $i++)
		   	{
		   		$re .= $data[$i].$tag;
		   	}
		   	return $re;
	   }
	   
	   /**
	    * 序列化二维数组，给数组添加自定义的中断标记并转换成字符串。
	    * @param	array $data;需要转换的二维原始数据
	    * 					string $tag;中断标记
	    * @return		string;转换完成后的字符串
	    * @note		开头没有中断标记，
	    * 					最后一个元素末尾都有中断标记
	    */
	   protected function transform2WithSlef($data,$tag)
	   {
	   		$re = "";
	   		for ($i = 0; $i < count($data); $i++)
		   	{
		   		$re .= $this->transformWithSlef($data[$i],$tag);
		   	}
		   	return $re;
	   }
	   
	   /**
	    * 和游戏服务器同步帖子
	    */
		public function sync()
		{
			$MAX_NUM		=		2;//每次发送$MAX_NUM个帖子数据
			
			if ($this->_param("ch") == "t")//发送下一批
			{
				$topics       = D( 'Topic' )->getSyncTopic($MAX_NUM);
				
				$output = null;
				for ($i = 0; $i < count($topics); $i++)
				{
					$output[$i][0] = $topics[$i]["tid"];
					$output[$i][1] = $topics[$i]["create_time"];
					$output[$i][2] = $topics[$i]["cid"];
					$output[$i][3] = $topics[$i]["coordinate"];
					$output[$i][4] = $topics[$i]["subject"];
				}
				$outputString = "";
				$outputString = $this->transform2WithSlef($output,_SPECAL_BREAK_FLAG);
// 				dump($output);
				echo $outputString;
			}
			else if ($this->_param("ch") == "r")//重置所有帖子的发送状态
			{
				$data["isPush"] = false;
				D("Topic")->where("status=1")->save($data);
			}
			else if ($this->_param("ch") == "d")//发送删除的帖子的tid
			{
				$output = null;
				$output = D("Deletelist")->getSyncDelTopic($MAX_NUM);
// 				dump($output);
				
				$outputString = "";
				for ($i = 0; $i < count($output); $i++)
				{
					$outputString .= $output[$i]["tid"] . _SPECAL_BREAK_FLAG;
				}
				echo $outputString;
			}
// 			$this->display("Public/login");
		}
}
?>