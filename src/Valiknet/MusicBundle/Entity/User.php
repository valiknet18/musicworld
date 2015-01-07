<?php
namespace Valiknet\MusicBundle\Entity;

use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity()
 * @ORM\Table(name="user")
 * @ORM\HasLifecycleCallbacks
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
     * @Assert\NotBlank
     */
    protected $name;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     * @Assert\NotBlank
     */
    protected $lastname;

    /**
     * @var text
     *
     * @ORM\Column(type="text")
     * @Assert\NotBlank
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
     * @Assert\File(maxSize="6000000")
     */
    protected $photo;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    protected $pathToPhoto;

    protected $tmp;

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
    public function setPhoto(UploadedFile $photo = null)
    {
        $this->photo = $photo;
        // check if we have an old image path
        if (isset($this->pathToPhoto)) {
            // store the old name to delete after the update
            $this->temp = $this->pathToPhoto;
            $this->pathToPhoto = null;
        } else {
            $this->pathToPhoto = 'initial';
        }
    }

    /**
     * @return null|string
     */
    public function getAbsolutePath()
    {
        return null === $this->pathToPhoto
            ? null
            : $this->getUploadRootDir().'/'.$this->pathToPhoto;
    }

    /**
     * @return null|string
     */
    public function getWebPath()
    {
        return null === $this->pathToPhoto
            ? null
            : $this->getUploadDir().'/'.$this->pathToPhoto;
    }

    /**
     * @return string
     */
    protected function getUploadRootDir()
    {
        // the absolute directory path where uploaded
        // documents should be saved
        return __DIR__.'/../../../../web/'.$this->getUploadDir();
    }

    /**
     * @return string
     */
    protected function getUploadDir()
    {
        // get rid of the __DIR__ so it doesn't screw up
        // when displaying uploaded doc/image in the view.
        return 'uploads/users';
    }

    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function preUpload()
    {
        if (null !== $this->getPhoto()) {
            // do whatever you want to generate a unique name
            $filename = sha1(uniqid(mt_rand(), true));
            $this->pathToPhoto = $filename.'.'.$this->getPhoto()->guessExtension();
        }
    }

    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     */
    public function upload()
    {
        if (null === $this->getPhoto()) {
            return;
        }

        // if there is an error when moving the file, an exception will
        // be automatically thrown by move(). This will properly prevent
        // the entity from being persisted to the database on error
        $this->getPhoto()->move($this->getUploadRootDir(), $this->pathToPhoto);

        // check if we have an old image
        if (isset($this->temp)) {
            // delete the old image
            unlink($this->getUploadRootDir().'/'.$this->temp);
            // clear the temp image path
            $this->temp = null;
        }
        $this->photo = null;
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

    /**
     * Set pathToPhoto
     *
     * @param  string $pathToPhoto
     * @return User
     */
    public function setPathToPhoto($pathToPhoto)
    {
        $this->pathToPhoto = $pathToPhoto;

        return $this;
    }

    /**
     * Get pathToPhoto
     *
     * @return string
     */
    public function getPathToPhoto()
    {
        return $this->pathToPhoto;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->name." ".$this->lastname;
    }
}
