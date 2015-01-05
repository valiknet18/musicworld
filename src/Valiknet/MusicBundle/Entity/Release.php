<?php
namespace Valiknet\MusicBundle\Entity;

use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity()
 * @ORM\Table(name="`release`")
 * @ORM\HasLifecycleCallbacks()
 */
class Release
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
     * @var integer
     *
     * @ORM\Column(type="integer")
     */
    protected $type;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    protected $name;

    /**
     * @Assert\File(maxSize="6000000")
     */
    protected $poster;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    protected $pathToPoster;

    /**
     * @var text
     *
     * @ORM\Column(type="text")
     */
    protected $text;

    /**
     * @var datetime
     *
     * @ORM\Column(type="datetime")
     */
    protected $releasedAt;

    /**
     * @var string
     *
     * @Gedmo\Slug(fields={"name"})
     * @ORM\Column(type="string")
     */
    protected $slug;

    /**
     * @ORM\ManyToOne(targetEntity="Group", inversedBy="releases")
     */
    protected $group;

    /**
     * @ORM\OneToMany(targetEntity="Track", mappedBy="release", cascade={"all"})
     */
    protected $tracks;

    protected $temp;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->tracks = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set type
     *
     * @param  integer $type
     * @return Release
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return integer
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set name
     *
     * @param  string  $name
     * @return Release
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
     * Set poster
     *
     * @param  UploadedFile $poster = null
     * @return Release
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
     * Set text
     *
     * @param  string  $text
     * @return Release
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * Get text
     *
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Set releasedAt
     *
     * @param  \DateTime $releasedAt
     * @return Release
     */
    public function setReleasedAt($releasedAt)
    {
        $this->releasedAt = $releasedAt;

        return $this;
    }

    /**
     * Get releasedAt
     *
     * @return \DateTime
     */
    public function getReleasedAt()
    {
        return $this->releasedAt;
    }

    /**
     * Set slug
     *
     * @param  string  $slug
     * @return Release
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
     * Set group
     *
     * @param  \Valiknet\MusicBundle\Entity\Group $group
     * @return Release
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
     * Get tracks
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTracks()
    {
        return $this->tracks;
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
        return 'uploads/releases';
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

    /**
     * Add tracks
     *
     * @param  \Valiknet\MusicBundle\Entity\Track $track
     * @return Release
     */
    public function addTrack(\Valiknet\MusicBundle\Entity\Track $track)
    {
        $this->tracks[] = $track;
    }

    /**
     * Remove tracks
     *
     * @param  \Valiknet\MusicBundle\Entity\Track $tracks
     * @return boolean
     */
    public function removeTrack(\Valiknet\MusicBundle\Entity\Track $tracks)
    {
        $this->tracks->removeElement($tracks);

        return true;
    }
}
