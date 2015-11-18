<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class EmailHelper {

    public static function sendMail($data) {
//        self::_setTestEmail($data, 'quocbao1087@gmail.com');
        $message = new YiiMailMessage($data['subject']);
        $message->setBody($data['message'], 'text/html');
        if (is_array($data['to'])) {
            foreach ($data['to'] as $t) {
                $message->addTo($t);
            }
        }
        else
            $message->addTo($data['to']);

        if (isset($data['cc']))
            $message->setCc($data['cc']);

        $message->from = $data['from'];
        $message->setFrom(array($data['from'] => Yii::app()->setting->getItem('title_all_mail')));
		// test email using local mail server
		if ($_SERVER['HTTP_HOST'] == 'localhost') {
			Yii::app()->mail->transportType = 'smtp';
			Yii::app()->mail->transportOptions = array(
				'host' => 'localhost',
				'username' => null,
				'password' => null
			);
		}
        return Yii::app()->mail->send($message);
    }

    /*     * *
     * $emailTemplateId: Email template id in database
     * $param: supported param in template with array key=>value. Key is param {key} in template
     */

    public static function bindEmailContent($emailTemplateId, $param, $to, $cc = null,$from = null) {
        $modelEmailTemplate = EmailTemplates::model()->findByPk($emailTemplateId);
        if (!empty($modelEmailTemplate)) {
            $message = $modelEmailTemplate->email_body;
            $subject = $modelEmailTemplate->email_subject;
            if (!empty($param)) {
                foreach ($param as $key => $value) {
                    $message = str_replace($key, $value, $message);
                    $subject = str_replace($key, $value, $subject);
                }
            }

            // Send a email to patient     
            $data = array(
                'subject' => $subject,
                'message' => $message,
                'to' => $to,
                'cc' => $cc,
                'from' => empty($from)?Yii::app()->params['autoEmail']:$from,
            );
            self::sendMail($data);
        }
    }

}

?>
