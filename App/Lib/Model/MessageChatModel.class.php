<?php

class MessageChatModel extends  Model {

	protected $tableName = 'message_chat';
	public function getMessageChat($id, $username){
		$chat_lists['data'] = $this->where(array('ms_id'=>$id))->order('create_time DESC')->selectPage( 10 );
		if ( !empty( $this->page ) ) {
			$chat_lists['page'] = $this->page;
		}
		if (!empty($chat_lists)) {
			foreach ($chat_lists['data'] as $key => $chat) {
				$chat_lists['data'][$key]['username'] = $username;
			}
			return  $chat_lists;
		}
	}

}

?>