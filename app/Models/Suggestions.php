<?php

namespace Ddb\Models;

/**
 * Suggestions
 * 
 * @package Ddb\Models
 * @autogenerated by Phalcon Developer Utils
 * @date 2018-05-29, 15:20:21
 * 
 * @method static static findFirstByMemberId($member_id)
 * @method static static[] findByMemberId($member_id)
 * @method static int countByMemberId($member_id)
 * @method static static findFirstByContent($content)
 * @method static static[] findByContent($content)
 * @method static int countByContent($content)
 * @method static static findFirstByType($type)
 * @method static static[] findByType($type)
 * @method static int countByType($type)
 * @method static static findFirstByUserId($user_id)
 * @method static static[] findByUserId($user_id)
 * @method static int countByUserId($user_id)
 * @method static static findFirstByRefuseReason($refuse_reason)
 * @method static static[] findByRefuseReason($refuse_reason)
 * @method static int countByRefuseReason($refuse_reason)
 * @method static static findFirstByReply($reply)
 * @method static static[] findByReply($reply)
 * @method static int countByReply($reply)
 * @method static static findFirstByAuditTime($audit_time)
 * @method static static[] findByAuditTime($audit_time)
 * @method static int countByAuditTime($audit_time)
 * @method static static findFirstByCreatedAt($created_at)
 * @method static static[] findByCreatedAt($created_at)
 * @method static int countByCreatedAt($created_at)
 * @method static static findFirstByUpdatedAt($updated_at)
 * @method static static[] findByUpdatedAt($updated_at)
 * @method static int countByUpdatedAt($updated_at)
 */
class Suggestions extends BaseModel
{

    /**
     *
     * @var integer
     */
    protected $id;

    /**
     *
     * @var integer
     */
    protected $member_id;

    /**
     *
     * @var string
     */
    protected $content;

    /**
     *
     * @var string
     */
    protected $type;

    /**
     *
     * @var integer
     */
    protected $user_id;

    /**
     *
     * @var string
     */
    protected $refuse_reason;

    /**
     *
     * @var string
     */
    protected $reply;

    /**
     *
     * @var integer
     */
    protected $status;

    /**
     *
     * @var string
     */
    protected $audit_time;

    /**
     *
     * @var string
     */
    protected $created_at;

    /**
     *
     * @var string
     */
    protected $updated_at;

    /**
     * Method to set the value of field id
     *
     * @param integer $id
     * @return static
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Method to set the value of field member_id
     *
     * @param integer $member_id
     * @return static
     */
    public function setMemberId($member_id)
    {
        $this->member_id = $member_id;

        return $this;
    }

    /**
     * Method to set the value of field content
     *
     * @param string $content
     * @return static
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Method to set the value of field type
     *
     * @param string $type
     * @return static
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Method to set the value of field user_id
     *
     * @param integer $user_id
     * @return static
     */
    public function setUserId($user_id)
    {
        $this->user_id = $user_id;

        return $this;
    }

    /**
     * Method to set the value of field refuse_reason
     *
     * @param string $refuse_reason
     * @return static
     */
    public function setRefuseReason($refuse_reason)
    {
        $this->refuse_reason = $refuse_reason;

        return $this;
    }

    /**
     * Method to set the value of field reply
     *
     * @param string $reply
     * @return static
     */
    public function setReply($reply)
    {
        $this->reply = $reply;

        return $this;
    }

    /**
     * Method to set the value of field status
     *
     * @param integer $status
     * @return static
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Method to set the value of field audit_time
     *
     * @param string $audit_time
     * @return static
     */
    public function setAuditTime($audit_time)
    {
        $this->audit_time = $audit_time;

        return $this;
    }

    /**
     * Method to set the value of field created_at
     *
     * @param string $created_at
     * @return static
     */
    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;

        return $this;
    }

    /**
     * Method to set the value of field updated_at
     *
     * @param string $updated_at
     * @return static
     */
    public function setUpdatedAt($updated_at)
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    /**
     * Returns the value of field id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Returns the value of field member_id
     *
     * @return integer
     */
    public function getMemberId()
    {
        return $this->member_id;
    }

    /**
     * Returns the value of field content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Returns the value of field type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Returns the value of field user_id
     *
     * @return integer
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * Returns the value of field refuse_reason
     *
     * @return string
     */
    public function getRefuseReason()
    {
        return $this->refuse_reason;
    }

    /**
     * Returns the value of field reply
     *
     * @return string
     */
    public function getReply()
    {
        return $this->reply;
    }

    /**
     * Returns the value of field status
     *
     * @return integer
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Returns the value of field audit_time
     *
     * @return string
     */
    public function getAuditTime()
    {
        return $this->audit_time;
    }

    /**
     * Returns the value of field created_at
     *
     * @return string
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * Returns the value of field updated_at
     *
     * @return string
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'suggestions';
    }

}
