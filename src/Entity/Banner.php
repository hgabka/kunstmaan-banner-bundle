<?php

namespace Hgabka\KunstmaanBannerBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Hgabka\KunstmaanExtensionBundle\Traits\TimestampableEntity;
use Kunstmaan\AdminBundle\Entity\AbstractEntity;
use Symfony\Component\Validator\Constraints as Assert;
use Kunstmaan\MediaBundle\Entity\Media;

/**
 * Email layout.
 *
 * @ORM\Table(name="hg_kuma_banner_banner")
 * @ORM\Entity(repositoryClass="Hgabka\KunstmaanBannerBundle\Repository\BannerRepository")
 */
class Banner extends AbstractEntity
{
    use TimestampableEntity;

    /**
     * @var string
	 * 
	 * @ORM\Column(name="name", type="string", length=255)
     * @Assert\NotBlank()
     */
    protected $name;
	
    /**
     * @var string
	 * 
     * @ORM\Column(name="place", type="string", length=255)
     * @Assert\NotBlank()
     */
    protected $place;

    /**
     * @var string
	 * 
	 * @ORM\Column(name="url", type="string", length=255, nullable=true)
     */
    protected $url;
	
    /**
     * @var Media
     *
     * @ORM\ManyToOne(targetEntity="Kunstmaan\MediaBundle\Entity\Media")
     * @ORM\JoinColumn(name="media_id", referencedColumnName="id", nullable=true)
     */
    protected $media;
	
    /**
     * @var Media
     *
     * @ORM\ManyToOne(targetEntity="Kunstmaan\MediaBundle\Entity\Media")
     * @ORM\JoinColumn(name="hover_media_id", referencedColumnName="id", nullable=true)
     */
    protected $hoverMedia;

    /**
     * @var string
	 * 
	 * @ORM\Column(name="html", type="text", nullable=true)
     */
    protected $html;
	
    /**
     * @var string
     *
     * @ORM\Column(name="locale", type="string", length=2, nullable=true)
     */
    protected $locale;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="start_time", type="datetime", nullable=true)
     */
    protected $start;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="end_time", type="datetime", nullable=true)
     */
    protected $end;

    /**
     * @var int
	 * 
	 * @ORM\Column(name="smallint", type="bigint", nullable=true)
     */
    protected $priority;

    /**
     * @var bool
	 * 
	 * @ORM\Column(name="new_window", type="boolean", nullable=true)
     */
    protected $newWindow = false;

    /**
     * @var string
	 * 
	 * @ORM\Column(name="image_alt", type="string", length=255, nullable=true)
     */
    protected $imageAlt;

    /**
     * @var string
	 * 
	 * @ORM\Column(name="image_title", type="string", length=255, nullable=true)
     */
    protected $imageTitle;

    /**
     * @return Media
     */
    public function getMedia()
    {
        return $this->media;
    }

    /**
     * @param Media $media
     *
     * @return Banner
     */
    public function setMedia($media)
    {
        $this->media = $media;

        return $this;
    }

    /**
     * @return Media
     */
    public function getHoverMedia()
    {
        return $this->hoverMedia;
    }

    /**
     * @param Media $media
     *
     * @return Banner
     */
    public function setHoverMedia($media)
    {
        $this->hoverMedia = $media;

        return $this;
    }

    /**
     * @return string
     */
    public function getLocale()
    {
        return $this->locale;
    }

    /**
     * @param string $locale
     *
     * @return Banner
     */
    public function setLocale($locale)
    {
        $this->locale = $locale;

        return $this;
    }
}
