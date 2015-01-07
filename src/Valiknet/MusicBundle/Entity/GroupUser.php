<?php
namespace Valiknet\MusicBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="group_user")
 */
class GroupUser
{
    /**
     * @var integer
     *
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Id
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="Group", inversedBy="users")
     */
    protected $group;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="groups")
     */
    protected $user;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    protected $role;

    /**
     * @var datetime
     *
     * @ORM\Column(type="datetime")
     */
    protected $joinedAt;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set role
     *
     * @param  string    $role
     * @return GroupUser
     */
    public function setRole($role)
    {
        $this->role = $role;

        return $this;
    }

    /**
     * Get role
     *
     * @return string
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Set joinedAt
     *
     * @param  \DateTime $joinedAt
     * @return GroupUser
     */
    public function setJoinedAt($joinedAt)
    {
        $this->joinedAt = $joinedAt;

        return $this;
    }

    /**
     * Get joinedAt
     *
     * @return \DateTime
     */
    public function getJoinedAt()
    {
        return $this->joinedAt;
    }

    /**
     * Set group
     *
     * @param  \Valiknet\MusicBundle\Entity\Group $group
     * @return GroupUser
     */
    public function setGroup(\Valiknet\MusicBundle\Entity\Group $group = null)
    {
        $this->group = $group;

        return $this;
    }

    /**
     * Get group
     *
     * @return \Valiknet\MusicBundle\Entity\Group
     */
    public function getGroup()
    {
        return $this->group;
    }

    /**
     * Set user
     *
     * @param  \Valiknet\MusicBundle\Entity\User $user
     * @return GroupUser
     */
    public function setUser(\Valiknet\MusicBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Valiknet\MusicBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }
}
