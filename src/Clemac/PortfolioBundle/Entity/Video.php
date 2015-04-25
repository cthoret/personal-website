<?php

namespace Clemac\PortfolioBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Video
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Clemac\PortfolioBundle\Entity\VideoRepository")
 */
class Video
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="imgae", type="string", length=255, nullable=true)
     */
    private $imgae;

    /**
     * @var string
     *
     * @ORM\Column(name="iframe", type="text")
     */
    private $iframe;


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
     * @return Video
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
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
     * Set description
     *
     * @param string $description
     * @return Video
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set string
     *
     * @param string $imgae
     * @return achievement
     */
    public function setImage($imgae)
    {
        $this->imgae = $imgae;

        return $this;
    }

    /**
     * Get file
     *
     * @return string
     */
    public function getImage()
    {
        return $this->imgae;
    }

    /**
     * Get file
     *
     * @return string
     */
    public function getWebPathImage()
    {
        return 'upload/' . $this->imgae;
    }

    /**
     * Set iframe
     *
     * @param string $iframe
     * @return Video
     */
    public function setIframe($iframe)
    {
        $this->iframe = $iframe;

        return $this;
    }

    /**
     * Get ifram
     *
     * @return string
     */
    public function getIframe()
    {
        return $this->iframe;
    }
}
