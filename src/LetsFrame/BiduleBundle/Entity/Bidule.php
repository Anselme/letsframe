<?php

namespace LetsFrame\BiduleBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

use LetsFrame\GalleryBundle\Entity\Gallery;

/**
 * LetsFrame\BiduleBundle\Entity\Bidule
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="LetsFrame\BiduleBundle\Entity\BiduleRepository")
 */
class Bidule
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string $title
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var text $text
     *
     * @ORM\Column(name="text", type="text")
     */
    private $text;

    /**
     * @ORM\OneToOne(targetEntity="LetsFrame\GalleryBundle\Entity\Gallery", cascade={"persist"})
     */
    protected $gallery;

    function __construct()
    {
        $this->gallery = new Gallery();
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
     * Set title
     *
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set text
     *
     * @param text $text
     */
    public function setText($text)
    {
        $this->text = $text;
    }

    /**
     * Get text
     *
     * @return text
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Set gallery
     *
     * @param LetsFrame\GalleryBundle\Entity\Gallery $gallery
     */
    public function setGallery(\LetsFrame\GalleryBundle\Entity\Gallery $gallery)
    {
        $this->gallery = $gallery;
    }

    /**
     * Get gallery
     *
     * @return LetsFrame\GalleryBundle\Entity\Gallery
     */
    public function getGallery()
    {
        return $this->gallery;
    }
}
