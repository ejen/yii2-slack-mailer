<?php

namespace ejen\slack\mailer;

use yii\mail\BaseMessage;

/**
 * Class SlackMessage
 * @package ejen\slack\mailer
 */
class SlackMessage extends BaseMessage
{
    private $_charset;

    private $_from;

    private $_to;

    private $_replyTo;

    private $_cc;

    private $_bcc;

    private $_subject;

    private $_textBody;

    private $_htmlBody;

    public $sendAsText = false;

    /**
     * @inheritdoc
     */
    public function getCharset()
    {
        return $this->_charset;
    }

    /**
     * @inheritdoc
     */
    public function setCharset($charset)
    {
        $this->_charset = $charset;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getFrom()
    {
        return $this->_from;
    }

    /**
     * @inheritdoc
     */
    public function setFrom($from)
    {
        $this->_from = $from;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getTo()
    {
        return $this->_to;
    }

    /**
     * @inheritdoc
     */
    public function setTo($to)
    {
        $this->_to = $to;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getReplyTo()
    {
        return $this->_replyTo;
    }

    /**
     * @inheritdoc
     */
    public function setReplyTo($replyTo)
    {
        $this->_replyTo = $replyTo;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getCc()
    {
        return $this->_cc;
    }

    /**
     * @inheritdoc
     */
    public function setCc($cc)
    {
        $this->_cc = $cc;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getBcc()
    {
        return $this->_bcc;
    }

    /**
     * @inheritdoc
     */
    public function setBcc($bcc)
    {
        $this->_bcc = $bcc;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getSubject()
    {
        return $this->_subject;
    }

    /**
     * @inheritdoc
     */
    public function setSubject($subject)
    {
        $this->_subject = $subject;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function setTextBody($text)
    {
        $this->_textBody = $text;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function setHtmlBody($html)
    {
        $this->_htmlBody = $html;
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
        if ($this->sendAsText) {
            return $this->_textBody;
        }

        return $this->_htmlBody;
    }
}
