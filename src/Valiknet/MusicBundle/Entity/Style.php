<?php
namespace Valiknet\MusicBundle\Entity;

use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\MaxDepth;

/**
 * @ORM\Entity(repositoryClass="Valiknet\MusicBundle\Entity\StyleRepository")
 * @ORM\Table(name="`style`")
 * @ORM\HasLifecycleCallbacks()
 */
class Style
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
     * @var string
     *
     * @ORM\Column(type="string")
     */
    protected $name;

    /**
     * @var string
     *
     * @Gedmo\Slug(fields={"name"})
     * @ORM\Column(type="string")
     */
    protected $slug;

    /**
     * @MaxDepth(2)
     * @ORM\OneToMany(targetEntity="Style", mappedBy="parent")
     */
    protected $children;

    /**
     * @MaxDepth(1)
     * @ORM\ManyToOne(targetEntity="Style", inversedBy="children")
     * @ORM\JoinColumn(nullable=true)
     */
    protected $parent;

    /**
     * @MaxDepth(1)
     * @ORM\ManyToMany(targetEntity="Group", mappedBy="styles")
     */
    protected $groups;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->children = new \Doctrine\Common\Collections\ArrayCollection();
        $this->groups = new \Doctrine\Common\Collections\ArrayCollection();
    }

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
     * Set name
     *
     * @param  string $name
     * @return Style
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set slug
     *
     * @param  string $slug
     * @return Style
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Add children
     *
     * @param  \Valiknet\MusicBundle\Entity\Style $children
     * @return Style
     */
    public function addChild(\Valiknet\MusicBundle\Entity\Style $children)
    {
        $this->children[] = $children;

        return $this;
    }

    /**
     * Remove children
     *
     * @param \Valiknet\MusicBundle\Entity\Style $children
     */
    public function removeChild(\Valiknet\MusicBundle\Entity\Style $children)
    {
        $this->children->removeElement($children);
    }

    /**
     * Get children
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * Set parent
     *
     * @param  \Valiknet\MusicBundle\Entity\Style $parent
     * @return Style
     */
    public function setParent(\Valiknet\MusicBundle\Entity\Style $parent = null)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get parent
     *
     * @return \Valiknet\MusicBundle\Entity\Style
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Add groups
     *
     * @param  \Valiknet\MusicBundle\Entity\Group $groups
     * @return Style
     */
    public function addGroup(\Valiknet\MusicBundle\Entity\Group $groups)
    {
        $this->groups[] = $groups;

        return $this;
    }

    /**
     * Remove groups
     *
     * @param \Valiknet\MusicBundle\Entity\Group $groups
     */
    public function removeGroup(\Valiknet\MusicBundle\Entity\Group $groups)
    {
        $this->groups->removeElement($groups);
    }

    /**
     * Get groups
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getGroups()
    {
        return $this->groups;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        if (!$this->parent) {
            return "-".$this->name;
        } elseif (!$this->parent->parent) {
            return "--".$this->name;
        } else {
            return "---".$this->name;
        }
    }

    /**
     * @ORM\PrePersist()
     */
    public function hasParent()
    {
        if ($this->parent && $this->parent->getParent() && $this->parent->getParent()->getParent()) {
            $this->parent = $this->parent->getParent();
        }
    }
}
