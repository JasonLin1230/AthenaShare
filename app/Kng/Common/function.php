<?php

        /*
         * Author : JasonLin
         * Describe : 获取所有分类名称
         */
        function get_cate () {
            $data = M('cate') -> field('cate_id as id,cate_name as name') -> select ();
            return $data;
        }


        /*
         * Author : JasonLin
         * Describe : 获取所有分类名称
         */
        function new_message_count () {
            $usr_id = $_SESSION ['usr_id'];
            $new_msg_count = M ('Msg') -> where ("msg_rcver_id=$usr_id and msg_read=0") -> 
                count ();
            return  $new_msg_count;
        }


        /*
         * Author : JasonLin
         * Describe : 检查是否登录
         */
        function check_login () {
            //session_start ();       //JasonLin 2016/5/6 系统默认开启，如果不希望系统自动启动session的话，可以设置'SESSION_AUTO_START' =>false
            $usr_id = $_SESSION ['usr_id'];
            if (isset ($usr_id)) {
                return $usr_id;
            } else {
                return -1;
            }
        }



	/*
	 * Author : JasonLin
	 * Describe : 系统邮件发送函数
     * @param string $to    接收邮件者邮箱
     * @param string $name  接收邮件者名称
     * @param string $subject 邮件主题 
     * @param string $body    邮件内容
     * @param string $attachment 附件列表
     * @return boolean 
     */
    function ezsys_send_mail($to, $name, $subject = '', $body = '', $attachment = null){
        $config = C('THINK_EMAIL');
        vendor('phpmailer.class#phpmailer'); //从phpmailer目录导class.phpmailer.php类文件
        $mail             = new PHPMailer(); //PHPMailer对象
        $mail->SMTPSecure = 'tls';
        $mail->CharSet    = 'UTF-8'; //设定邮件编码，默认ISO-8859-1，如果发中文此项必须设置，否则乱码
        $mail->IsSMTP();  // 设定使用SMTP服务
        $mail->SMTPDebug  = 0;                     // 关闭SMTP调试功能
                                                   // 1 = errors and messages
                                                   // 2 = messages only
        $mail->SMTPAuth   = true;                  // 启用 SMTP 验证功能
        $mail->SMTPSecure = 'ssl';                 // 使用安全协议
        $mail->Host       = $config['SMTP_HOST'];  // SMTP 服务器
        $mail->Port       = $config['SMTP_PORT'];  // SMTP服务器的端口号
        $mail->Username   = $config['SMTP_USER'];  // SMTP服务器用户名
        $mail->Password   = $config['SMTP_PASS'];  // SMTP服务器密码
        $mail->SetFrom($config['FROM_EMAIL'], $config['FROM_NAME']);
        $replyEmail       = $config['REPLY_EMAIL']?$config['REPLY_EMAIL']:$config['FROM_EMAIL'];
        $replyName        = $config['REPLY_NAME']?$config['REPLY_NAME']:$config['FROM_NAME'];
        $mail->AddReplyTo($replyEmail, $replyName);
        $mail->Subject    = $subject;
        $mail->MsgHTML($body);
        $mail->AddAddress($to, $name);
        if(is_array($attachment)){ // 添加附件
            foreach ($attachment as $file){
                is_file($file) && $mail->AddAttachment($file);
            }
        }
        return $mail->Send() ? true : false;
    }


    /*
     * Author : JasonLin
     * Describe : 生成验证码
     */
    function GetRandStr($len) 
    { 
        $chars = array( 
            "a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k",  
            "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v",  
            "w", "x", "y", "z", "A", "B", "C", "D", "E", "F", "G",  
            "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R",  
            "S", "T", "U", "V", "W", "X", "Y", "Z", "0", "1", "2",  
            "3", "4", "5", "6", "7", "8", "9" 
        ); 
        $charsLen = count($chars) - 1; 
        shuffle($chars);   
        $output = ""; 
        for ($i=0; $i<$len; $i++) 
        { 
            $output .= $chars[mt_rand(0, $charsLen)]; 
        }  
        return $output;  
    } 


    /*
     * Author : JasonLin
     * Describe : 生成随机数字数组
     */
    function GetRandNum($len) 
    { 
        $chars = array( 
            "0", "1", "2", "3", "4", "5", "6", "7", "8", "9" 
        ); 
        $charsLen = count($chars) - 1; 
        shuffle($chars);   
        $output = ""; 
        for ($i=0; $i<$len; $i++) 
        { 
            $output .= $chars[mt_rand(0, $charsLen)]; 
        }  
        return $output;  
    } 
?>