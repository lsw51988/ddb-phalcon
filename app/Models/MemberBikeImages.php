<?php

namespace Ddb\Models;

/**
 * MemberBikeImages
 * 
 * @package Ddb\Models
 * @autogenerated by Phalcon Developer Utils
 * @date 2018-04-25, 13:10:52
 * 
 * @method static static findFirstByMemberBikeId($member_bike_id)
 * @method static static[] findByMemberBikeId($member_bike_id)
 * @method static int countByMemberBikeId($member_bike_id)
 * @method static static findFirstByPath($path)
 * @method static static[] findByPath($path)
 * @method static int countByPath($path)
 * @method static static findFirstByCreatedAt($created_at)
 * @method static static[] findByCreatedAt($created_at)
 * @method static int countByCreatedAt($created_at)
 * @method static static findFirstByUpdatedAt($updated_at)
 * @method static static[] findByUpdatedAt($updated_at)
 * @method static int countByUpdatedAt($updated_at)
 */
class MemberBikeImages extends BaseModel
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
    protected $member_bike_id;

    /**
     *
     * @var string
     */
    protected $path;

    /**
     *
     * @var integer
     */
    protected $create_by;

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
     * Method to set the value of field member_bike_id
     *
     * @param integer $member_bike_id
     * @return static
     */
    public function setMemberBikeId($member_bike_id)
    {
        $this->member_bike_id = $member_bike_id;

        return $this;
    }

    /**
     * Method to set the value of field path
     *
     * @param string $path
     * @return static
     */
    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }

    /**
     * Method to set the value of field create_by
     *
     * @param integer $create_by
     * @return static
     */
    public function setCreateBy($create_by)
    {
        $this->create_by = $create_by;

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
     * Returns the value of field member_bike_id
     *
     * @return integer
     */
    public function getMemberBikeId()
    {
        return $this->member_bike_id;
    }

    /**
     * Returns the value of field path
     *
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Returns the value of field create_by
     *
     * @return integer
     */
    public function getCreateBy()
    {
        return $this->create_by;
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
        return 'member_bike_images';
    }

}
