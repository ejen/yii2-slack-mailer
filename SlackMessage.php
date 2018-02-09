<?php

namespace ejen\slack\mailer;

use yii\mail\BaseMessage;

/**
 * Class SlackMessage
 * @package ejen\slack\mailer
 */
class SlackMessage extends BaseMessage
{
    /**
     * @inheritdoc
     */
    public function getCharset()
    {
        return $this->charset;
    }

    /**
     * @inheritdoc
     */
    public function setCharset($charset)
    {
        $this->charset = $charset;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getFrom()
    {
        return $this->from;
    }

    /**
     * @inheritdoc
     */
    public function setFrom($from)
    {
        $this->from = $from;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getTo()
    {
        return $this->to;
    }

    /**
     * @inheritdoc
     */
    public function setTo($to)
    {
        $this->to = $to;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getReplyTo()
    {
        return $this->replyTo;
    }

    /**
     * @inheritdoc
     */
    public function setReplyTo($replyTo)
    {
        $this->replyTo = $replyTo;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getCc()
    {
        return $this->cc;
    }

    /**
     * @inheritdoc
     */
    public function setCc($cc)
    {
        $this->cc = $cc;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getBcc()
    {
        return $this->bcc;
    }

    /**
     * @inheritdoc
     */
    public function setBcc($bcc)
    {
        $this->bcc = $bcc;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * @inheritdoc
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function setTextBody($text)
    {
        $this->textBody = $text;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function setHtmlBody($html)
    {
        $this->htmlBody = $html;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function attach($fileName, array $options = [])
    {
    }

    /**
     * @inheritdoc
     */
    public function attachContent($content, array $options = [])
    {
    }

    /**
     * @inheritdoc
     */
    public function embed($fileName, array $options = [])
    {
    }

    /**
     * @inheritdoc
     */
    public function embedContent($content, array $options = [])
    {
    }

    /**
     * @inheritdoc
     */
    public function toString()
    {
        return parent::toString();
    }
}
