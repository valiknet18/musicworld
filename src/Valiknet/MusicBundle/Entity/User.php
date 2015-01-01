<?php
namespace Valiknet\MusicBundle\Entity;

use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="user")
 */
class User
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
     * @ORM\Column(type="string")
     */
    protected $lastname;

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
     */
    protected $birthedAt;

    /**
     * @var string
     *
     * @Gedmo\Slug(fields={"name","lastname"})
     * @ORM\Column(type="string")
     */
    protected $slug;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    protected $photo;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    protected $officialSite;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    protected $officialVkPage;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    protected $officialFacebookPage;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    protected $officialTwitterPage;

    /**
     * @ORM\ManyToOne(targetEntity="Country", inversedBy="users")
     */
    protected $country;

    /**
     * @ORM\ManyToMany(targetEntity="Article", mappedBy="users")
     */
    protected $news;

    /**
     * @ORM\OneToMany(targetEntity="GroupUser", mappedBy="user")
     */
    protected $groups;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->news = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return User
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
     * Set lastname
     *
     * @param  string $lastname
     * @return User
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get lastname
     *
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set history
     *
     * @param  string $history
     * @return User
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
     * Set birthedAt
     *
     * @param  \DateTime $birthedAt
     * @return User
     */
    public function setBirthedAt($birthedAt)
    {
        $this->birthedAt = $birthedAt;

        return $this;
    }

    /**
     * Get birthedAt
     *
     * @return \DateTime
     */
    public function getBirthedAt()
    {
        return $this->birthedAt;
    }

    /**
     * Set slug
     *
     * @param  string $slug
     * @return User
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
     * Set photo
     *
     * @param  string $photo
     * @return User
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     * Get photo
     *
     * @return string
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * Set country
     *
     * @param  \Valiknet\MusicBundle\Entity\Country $country
     * @return User
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
     * Add news
     *
     * @param  \Valiknet\MusicBundle\Entity\Article $news
     * @return User
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

    /**
     * Add groups
     *
     * @param  \Valiknet\MusicBundle\Entity\GroupUser $groups
     * @return User
     */
    public function addGroup(\Valiknet\MusicBundle\Entity\GroupUser $groups)
    {
        $this->groups[] = $groups;

        return $this;
    }

    /**
     * Remove groups
     *
     * @param \Valiknet\MusicBundle\Entity\GroupUser $groups
     */
    public function removeGroup(\Valiknet\MusicBundle\Entity\GroupUser $groups)
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
     * Set officialSite
     *
     * @param  string $officialSite
     * @return User
     */
    public function setOfficialSite($officialSite)
    {
        $this->officialSite = $officialSite;

        return $this;
    }

    /**
     * Get officialSite
     *
     * @return string
     */
    public function getOfficialSite()
    {
        return $this->officialSite;
    }

    /**
     * Set officialVkPage
     *
     * @param  string $officialVkPage
     * @return User
     */
    public function setOfficialVkPage($officialVkPage)
    {
        $this->officialVkPage = $officialVkPage;

        return $this;
    }

    /**
     * Get officialVkPage
     *
     * @return string
     */
    public function getOfficialVkPage()
    {
        return $this->officialVkPage;
    }

    /**
     * Set officialFacebookPage
     *
     * @param  string $officialFacebookPage
     * @return User
     */
    public function setOfficialFacebookPage($officialFacebookPage)
    {
        $this->officialFacebookPage = $officialFacebookPage;

        return $this;
    }

    /**
     * Get officialFacebookPage
     *
     * @return string
     */
    public function getOfficialFacebookPage()
    {
        return $this->officialFacebookPage;
    }

    /**
     * Set officialTwitterPage
     *
     * @param  string $officialTwitterPage
     * @return User
     */
    public function setOfficialTwitterPage($officialTwitterPage)
    {
        $this->officialTwitterPage = $officialTwitterPage;

        return $this;
    }

    /**
     * Get officialTwitterPage
     *
     * @return string
     */
    public function getOfficialTwitterPage()
    {
        return $this->officialTwitterPage;
    }
}
