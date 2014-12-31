<?php
namespace Valiknet\MusicBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="`group`")
 */
class Group
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
     * @var text
     *
     * @ORM\Column(type="text")
     */
    protected $history;

    /**
     * @var datetime
     *
     * @ORM\Column(type="datetime")
     * @Gedmo\Timestampable(on="create")
     */
    protected $createdAt;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    protected $poster;

    /**
     * @Gedmo\Slug(fields={"name"})
     * @ORM\Column(type="string", unique=true)
     */
    protected $slug;

    /**
     * @ORM\ManyToOne(targetEntity="Country", inversedBy="groups")
     */
    protected $country;

    /**
     * @ORM\OneToMany(targetEntity="GroupUser", mappedBy="group")
     */
    protected $users;

    /**
     * @ORM\ManyToMany(targetEntity="Style", inversedBy="groups")
     */
    protected $styles;

    /**
     * @ORM\OneToMany(targetEntity="Clip", mappedBy="group")
     */
    protected $clips;

    /**
     * @ORM\OneToMany(targetEntity="Release", mappedBy="group")
     */
    protected $releases;

    /**
     * @ORM\ManyToMany(targetEntity="Article", mappedBy="groups")
     */
    protected $news;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->users = new \Doctrine\Common\Collections\ArrayCollection();
        $this->styles = new \Doctrine\Common\Collections\ArrayCollection();
        $this->clips = new \Doctrine\Common\Collections\ArrayCollection();
        $this->releases = new \Doctrine\Common\Collections\ArrayCollection();
        $this->news = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @param string $name
     * @return Group
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
     * Set history
     *
     * @param string $history
     * @return Group
     */
    public function setHistory($history)
    {
        $this->history = $history;

        return $this;
    }

    /**
     * Get history
     *
     * @return string 
     */
    public function getHistory()
    {
        return $this->history;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Group
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set poster
     *
     * @param string $poster
     * @return Group
     */
    public function setPoster($poster)
    {
        $this->poster = $poster;

        return $this;
    }

    /**
     * Get poster
     *
     * @return string 
     */
    public function getPoster()
    {
        return $this->poster;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return Group
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
     * Set country
     *
     * @param \Valiknet\MusicBundle\Entity\Country $country
     * @return Group
     */
    public function setCountry(\Valiknet\MusicBundle\Entity\Country $country = null)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return \Valiknet\MusicBundle\Entity\Country 
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Add users
     *
     * @param \Valiknet\MusicBundle\Entity\GroupUser $users
     * @return Group
     */
    public function addUser(\Valiknet\MusicBundle\Entity\GroupUser $users)
    {
        $this->users[] = $users;

        return $this;
    }

    /**
     * Remove users
     *
     * @param \Valiknet\MusicBundle\Entity\GroupUser $users
     */
    public function removeUser(\Valiknet\MusicBundle\Entity\GroupUser $users)
    {
        $this->users->removeElement($users);
    }

    /**
     * Get users
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getUsers()
    {
        return $this->users;
    }

    /**
     * Add styles
     *
     * @param \Valiknet\MusicBundle\Entity\Style $styles
     * @return Group
     */
    public function addStyle(\Valiknet\MusicBundle\Entity\Style $styles)
    {
        $this->styles[] = $styles;

        return $this;
    }

    /**
     * Remove styles
     *
     * @param \Valiknet\MusicBundle\Entity\Style $styles
     */
    public function removeStyle(\Valiknet\MusicBundle\Entity\Style $styles)
    {
        $this->styles->removeElement($styles);
    }

    /**
     * Get styles
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getStyles()
    {
        return $this->styles;
    }

    /**
     * Add clips
     *
     * @param \Valiknet\MusicBundle\Entity\Clip $clips
     * @return Group
     */
    public function addClip(\Valiknet\MusicBundle\Entity\Clip $clips)
    {
        $this->clips[] = $clips;

        return $this;
    }

    /**
     * Remove clips
     *
     * @param \Valiknet\MusicBundle\Entity\Clip $clips
     */
    public function removeClip(\Valiknet\MusicBundle\Entity\Clip $clips)
    {
        $this->clips->removeElement($clips);
    }

    /**
     * Get clips
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getClips()
    {
        return $this->clips;
    }

    /**
     * Add releases
     *
     * @param \Valiknet\MusicBundle\Entity\Release $releases
     * @return Group
     */
    public function addRelease(\Valiknet\MusicBundle\Entity\Release $releases)
    {
        $this->releases[] = $releases;

        return $this;
    }

    /**
     * Remove releases
     *
     * @param \Valiknet\MusicBundle\Entity\Release $releases
     */
    public function removeRelease(\Valiknet\MusicBundle\Entity\Release $releases)
    {
        $this->releases->removeElement($releases);
    }

    /**
     * Get releases
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getReleases()
    {
        return $this->releases;
    }

    /**
     * Add news
     *
     * @param \Valiknet\MusicBundle\Entity\Article $news
     * @return Group
     */
    public function addNews(\Valiknet\MusicBundle\Entity\Article $news)
    {
        $this->news[] = $news;

        return $this;
    }

    /**
     * Remove news
     *
     * @param \Valiknet\MusicBundle\Entity\Article $news
     */
    public function removeNews(\Valiknet\MusicBundle\Entity\Article $news)
    {
        $this->news->removeElement($news);
    }

    /**
     * Get news
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getNews()
    {
        return $this->news;
    }
}
