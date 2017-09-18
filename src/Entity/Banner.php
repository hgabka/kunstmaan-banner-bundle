<?php

namespace Hgabka\KunstmaanBannerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Hgabka\KunstmaanBannerBundle\Helper\BannerHandler;
use Hgabka\KunstmaanExtensionBundle\Traits\TimestampableEntity;
use Kunstmaan\AdminBundle\Entity\AbstractEntity;
use Kunstmaan\MediaBundle\Entity\Media;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Banner.
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
     * @ORM\JoinColumn(name="media_id", referencedColumnName="id", nullable=true, onDelete="SET NULL")
     */
    protected $media;

    /**
     * @var Media
     *
     * @ORM\ManyToOne(targetEntity="Kunstmaan\MediaBundle\Entity\Media")
     * @ORM\JoinColumn(name="hover_media_id", referencedColumnName="id", nullable=true, onDelete="SET NULL")
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
     * @ORM\Column(name="priority", type="smallint", nullable=true)
     * @Assert\Range(min=0, minMessage="A prioritás minimum értéke 0", max=10, maxMessage="A prioritás maximum értéke 10")
     */
    protected $priority = 0;

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

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return Banner
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getPlace()
    {
        return $this->place;
    }

    /**
     * @param string $place
     *
     * @return Banner
     */
    public function setPlace($place)
    {
        $this->place = $place;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param string $url
     *
     * @return Banner
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getHtml()
    {
        return $this->html;
    }

    /**
     * @param string $html
     *
     * @return Banner
     */
    public function setHtml($html)
    {
        $this->html = $html;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getStart()
    {
        return $this->start;
    }

    /**
     * @param \DateTime $start
     *
     * @return Banner
     */
    public function setStart($start)
    {
        $this->start = $start;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getEnd()
    {
        return $this->end;
    }

    /**
     * @param \DateTime $end
     *
     * @return Banner
     */
    public function setEnd($end)
    {
        $this->end = $end;

        return $this;
    }

    /**
     * @return int
     */
    public function getPriority(): int
    {
        return $this->priority;
    }

    /**
     * @param int $priority
     *
     * @return Banner
     */
    public function setPriority($priority)
    {
        $this->priority = $priority;

        return $this;
    }

    /**
     * @return bool
     */
    public function isNewWindow(): bool
    {
        return $this->newWindow;
    }

    /**
     * @param bool $newWindow
     *
     * @return Banner
     */
    public function setNewWindow($newWindow)
    {
        $this->newWindow = $newWindow;

        return $this;
    }

    /**
     * @return string
     */
    public function getImageAlt()
    {
        return $this->imageAlt;
    }

    /**
     * @param string $imageAlt
     *
     * @return Banner
     */
    public function setImageAlt($imageAlt)
    {
        $this->imageAlt = $imageAlt;

        return $this;
    }

    /**
     * @return string
     */
    public function getImageTitle()
    {
        return $this->imageTitle;
    }

    /**
     * @param string $imageTitle
     *
     * @return Banner
     */
    public function setImageTitle($imageTitle)
    {
        $this->imageTitle = $imageTitle;

        return $this;
    }

    public function getType()
    {
        return empty($this->html) ? BannerHandler::TYPE_IMAGE : BannerHandler::TYPE_HTML;
    }

    public function setType($type)
    {
        if (BannerHandler::TYPE_HTML === $type) {
            $this->media = null;
            $this->hoverMedia = null;
            $this->imageAlt = null;
            $this->imageTitle = null;
        } else {
            $this->html = null;
        }
    }

    public function isImage()
    {
        return BannerHandler::TYPE_IMAGE === $this->getType();
    }
}
