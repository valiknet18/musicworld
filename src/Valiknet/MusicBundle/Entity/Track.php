<?php
namespace Valiknet\MusicBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="track")
 */
class Track
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
     * @ORM\Column(type="string", length=5)
     */
    protected $timeline;

    /**
     * @ORM\ManyToOne(targetEntity="Release", inversedBy="tracks")
     */
    protected $release;

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
     * @return Track
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
     * Set timeline
     *
     * @param  string $timeline
     * @return Track
     */
    public function setTimeline($timeline)
    {
        $this->timeline = $timeline;

        return $this;
    }

    /**
     * Get timeline
     *
     * @return string
     */
    public function getTimeline()
    {
        return $this->timeline;
    }

    /**
     * Set release
     *
     * @param  \Valiknet\MusicBundle\Entity\Release $release
     * @return Track
     */
    public function setRelease(\Valiknet\MusicBundle\Entity\Release $release = null)
    {
        $this->release = $release;

        return $this;
    }

    /**
     * Get release
     *
     * @return \Valiknet\MusicBundle\Entity\Release
     */
    public function getRelease()
    {
        return $this->release;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->name;
    }
}
