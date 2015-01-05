<?php
namespace Valiknet\MusicBundle\Entity;

use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity()
 * @ORM\Table(name="`group`")
 * @ORM\HasLifecycleCallbacks
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
     * @Assert\NotBlank
     */
    protected $name;

    /**
     * @var text
     *
     * @ORM\Column(type="text")
     * @Assert\NotBlank
     */
    protected $history;

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
     * @var datetime
     *
     * @ORM\Column(type="datetime")
     * @Gedmo\Timestampable(on="create")
     */
    protected $createdAt;

    /**
     * @Assert\File(maxSize="6000000")
     */
    protected $poster;

    protected $temp;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    protected $pathToPoster;

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
     * @param  string $name
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
     * @param  string $history
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
     * @param  \DateTime $createdAt
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
     * @param  UploadedFile $poster = null
     * @return Group
     */
    public function setPoster(UploadedFile $poster = null)
    {
        $this->poster = $poster;
        // check if we have an old image path
        if (isset($this->pathToPoster)) {
            // store the old name to delete after the update
            $this->temp = $this->pathToPoster;
            $this->pathToPoster = null;
        } else {
            $this->pathToPoster = 'initial';
        }
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
     * @param  string $slug
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
     * @param  \Valiknet\MusicBundle\Entity\Country $country
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
     * @param  \Valiknet\MusicBundle\Entity\GroupUser $users
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
     * @param  \Valiknet\MusicBundle\Entity\Style $styles
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
     * @param  \Valiknet\MusicBundle\Entity\Clip $clips
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
     * @param  \Valiknet\MusicBundle\Entity\Release $releases
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
     * @param  \Valiknet\MusicBundle\Entity\Article $news
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

    /**
     * Set officialSite
     *
     * @param  string $officialSite
     * @return Group
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
     * @return Group
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
     * @return Group
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
     * @return Group
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
     * @return string
     */
    public function __toString()
    {
        return $this->name;
    }

    /**
     * @return null|string
     */
    public function getAbsolutePath()
    {
        return null === $this->pathToPoster
            ? null
            : $this->getUploadRootDir().'/'.$this->pathToPoster;
    }

    /**
     * @return null|string
     */
    public function getWebPath()
    {
        return null === $this->pathToPoster
            ? null
            : $this->getUploadDir().'/'.$this->pathToPoster;
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
        return 'uploads/groups';
    }

    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function preUpload()
    {
        if (null !== $this->getPoster()) {
            // do whatever you want to generate a unique name
            $filename = sha1(uniqid(mt_rand(), true));
            $this->pathToPoster = $filename.'.'.$this->getPoster()->guessExtension();
        }
    }

    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     */
    public function upload()
    {
        if (null === $this->getPoster()) {
            return;
        }

        // if there is an error when moving the file, an exception will
        // be automatically thrown by move(). This will properly prevent
        // the entity from being persisted to the database on error
        $this->getPoster()->move($this->getUploadRootDir(), $this->pathToPoster);

        // check if we have an old image
        if (isset($this->temp)) {
            // delete the old image
            unlink($this->getUploadRootDir().'/'.$this->temp);
            // clear the temp image path
            $this->temp = null;
        }
        $this->poster = null;
    }

    /**
     * Set pathToPoster
     *
     * @param  string $pathToPoster
     * @return Group
     */
    public function setPathToPoster($pathToPoster)
    {
        $this->pathToPoster = $pathToPoster;

        return $this;
    }

    /**
     * Get pathToPoster
     *
     * @return string
     */
    public function getPathToPoster()
    {
        return $this->pathToPoster;
    }

    /**
     * @ORM\PostRemove()
     */
    public function removeUpload()
    {
        $file = $this->getAbsolutePath();
        if ($file) {
            unlink($file);
        }
    }
}
