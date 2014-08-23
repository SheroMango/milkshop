<?php
/**
 * 微信数据模型
 */
class WxModel extends Model
{
	public function valid()
    {
        $echoStr = $_GET["echostr"];

        //valid signature , option
        if($this->checkSignature()){
        	echo $echoStr;
        	exit;
        }
    }

    private function getTpl(){
    	$tpl = "<xml>
                <ToUserName><![CDATA[%s]]></ToUserName>
                <FromUserName><![CDATA[%s]]></FromUserName>
                <CreateTime>%s</CreateTime>
                <MsgType><![CDATA[%s]]></MsgType>";
        return $tpl;
    }

    /**
     * get keyword
     */
    public function getKey($postObj){
    	if($postObj->Content){
    		$keyword = $postObj->Content;
    	}elseif($postObj->MsgType == 'event'){
    		$keyword = $postObj->Event;
    	}else{
    		$keyword = 'defalut';
    	}
    	return $keyword;
    }
    public function responseMsg()
    {
		//get post data, May be due to the different environments
		$postStr = $GLOBALS["HTTP_RAW_POST_DATA"];

      	//extract post data
		if (!empty($postStr)){               
          	$postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
            $fromUsername = $postObj->FromUserName;
            $toUsername = $postObj->ToUserName;
            $keyword = $this->getKey($postObj);
            //$keyword = trim($postObj->Content);
            $time = time();
            if(!empty( $keyword ))
            {   
            	$replayType = D('Route')->where("keyword='".$keyword."'")->getField('obj_type');
            	$replayId = D('Route')->where("keyword='".$keyword."'")->getField('obj_id');
            	$tpl = $this->getTpl();
            	//如果replayType不为空 那就判断replayType是text还是txp
            	if(!empty($replayType)){
            		if($replayType == 'text'){
            			$contentStr = D('Text')->where("id='".$replayId."'")->getField('content');
            			$msgType = "text";
                    	$tpl .= "<Content><![CDATA[".$contentStr."]]></Content></xml>";
                    	$resultStr = sprintf($tpl, $fromUsername, $toUsername, $time, $msgType);
            		}elseif ($replayType == 'txp') {
            			$news = D('Txp')->where("id=".$replayId." OR fid=".$replayId)->select();
            			$count = count($news);
            			$tpl .= "<ArticleCount>".$count."</ArticleCount><Articles>";
            			foreach($news as $k=>$v){
            				$tpl .= "<item>";
            				$tpl .= "<Title><![CDATA[".$v['title']."]]></title>";
            				$tpl .= "<Description><[![CDATA[".$v['description']."]]></Description>";
            				$tpl .= "<PicUrl><![CDATA[".$v['pic']."]]></PicUrl>";
            				$tpl .= "<Url><![CDATA[".$v['url']."]]></Url>";
            				$tpl .= "</item>";
            			}
            			$tpl .= "</Articles></xml>";
            			$msgType = "news";
                    	$resultStr = sprintf($tpl, $fromUsername, $toUsername, $time, $msgType);
            		}elseif($replayType == 'event'){
            			if($postObj->Event == 'subscribe'){
            				$sub = D('Txp')->where('id='.$replayId)->find();
            				$msgType = "news";
            				$tpl .= "<ArticleCount>1</ArticleCount><Articles><item><Title><![CDATA[".$sub['description']
            				."]]></title><Description><![CDATA[".$sub['description']."]]></Description><PicUrl><![CDATA["
            				.$sub['pic']."]]></picUrl><Url><![CDATA[".$sub['url']."]]</Url></item></Articles></xml>";
            				 $resultStr = sprintf($tpl, $fromUsername, $toUsername, $time, $msgType);
            			}
            		}
                }
                echo $resultStr;
            }else {
    	       echo "nothing";
    	       exit;
            }
        }else{
            echo "nothing";
            exit;
        }
    }
		
	private function checkSignature()
	{
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];	
        		
		$token = D('Setting')->where("skey='token'")->getField('svalue');
		$tmpArr = array($token, $timestamp, $nonce);
		sort($tmpArr, SORT_STRING);
		$tmpStr = implode( $tmpArr );
		$tmpStr = sha1( $tmpStr );
		
		if( $tmpStr == $signature ){
			return true;
		}else{
			return false;
		}
	}
}