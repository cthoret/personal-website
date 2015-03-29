<?php

namespace Clemac\PortfolioBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Post
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Post
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
     * @ORM\Column(name="content", type="text")
     */
    private $content;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=255)
     */
    private $image;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="creat", type="datetime")
     */
    private $creat;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data_update", type="datetime")
     */
    private $dataUpdate;


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
     * @return Post
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
     * Set content
     *
     * @param string $content
     * @return Post
     */
    public function setContent($content)
    {
        $this->content = $content;
    
        return $this;
    }

    /**
     * Get content
     *
     * @return string 
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set string
     *
     * @param string $image
     * @return achievement
     */
    public function setImage($image)
    {
        $this->image = $image;
    
        return $this;
    }

    /**
     * Get file
     *
     * @return string 
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set creat
     *
     * @param \DateTime $creat
     * @return Post
     */
    public function setCreat($creat)
    {
        $this->creat = $creat;
    
        return $this;
    }

    /**
     * Get creat
     *
     * @return \DateTime 
     */
    public function getCreat()
    {
        return $this->creat;
    }

    /**
     * Set dataUpdate
     *
     * @param \DateTime $dataUpdate
     * @return Post
     */
    public function setDataUpdate($dataUpdate)
    {
        $this->dataUpdate = $dataUpdate;
    
        return $this;
    }

    /**
     * Get dataUpdate
     *
     * @return \DateTime 
     */
    public function getDataUpdate()
    {
        return $this->dataUpdate;
    }
}
