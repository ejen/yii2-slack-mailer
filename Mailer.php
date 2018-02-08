<?php

namespace ejen\yii2_slack_mailer;

use yii\mail\BaseMailer;
use Yii;

/**
 * Class Mailer
 * @package ejen\yii2_slack_mailer
 */
class Mailer extends BaseMailer
{
    public $transport;

    public $messageClass = Message::class;

    /**
     * @param null|string $view
     * @param array $params
     * @return \yii\mail\MessageInterface
     */
    public function compose($view = null, array $params = [])
    {
        $message = $this->createMessage();

        if (is_array($view)) {
            if (isset($view['html'])) {
                $html = $this->render($view['html'], $params, $this->htmlLayout);
            }
            if (isset($view['text'])) {
                $text = $this->render($view['text'], $params, $this->textLayout);
            }
        } else {
            $html = $this->render($view, $params, $this->htmlLayout);
        }

        if (isset($html)) {
            $message->setHtmlBody($html);
        }
        if (isset($text)) {
            $message->setTextBody($text);
        } elseif (isset($html)) {
            if (preg_match('~<body[^>]*>(.*?)</body>~is', $html, $match)) {
                $html = $match[1];
            }
            // remove style and script
            $html = preg_replace('~<((style|script))[^>]*>(.*?)</\1>~is', '', $html);
            // strip all HTML tags and decoded HTML entities
            $text = html_entity_decode(strip_tags($html), ENT_QUOTES | ENT_HTML5, Yii::$app ? Yii::$app->charset : 'UTF-8');
            // improve whitespace
            $text = preg_replace("~^[ \t]+~m", '', trim($text));
            $text = preg_replace('~\R\R+~mu', "\n\n", $text);
            $message->setTextBody($text);
        }

        return $message;
    }

    /**
     * @param \yii\mail\MessageInterface $message
     * @return bool
     */
    protected function sendMessage($message)
    {
        $result = Yii::$app->slack->send('Вам письмо!', ':thumbs_up:', [
            [
                'text' => $message->textBody,
                'pretext' => $message->from,
            ],
        ]);

        return $result ? true : false;
    }

    /**
     * @param \yii\mail\MessageInterface $message
     * @return bool
     */
    public function send($message)
    {
        if (!$this->beforeSend($message)) {
            return false;
        }

        $address = $message->getTo();
        if (is_array($address)) {
            $address = implode(', ', array_keys($address));
        }
        Yii::info('Sending email "' . $message->getSubject() . '" to "' . $address . '"', __METHOD__);

        $isSuccessful = $this->sendMessage($message);

        $this->afterSend($message, $isSuccessful);

        return $isSuccessful;
    }
}
