<?php
use Doctrine\Common\Collections\ArrayCollection;
/**
 * @Entity @Table(name="map_values")
 **/
class Value
{
    /**
	 * @Id @Column(type="integer") @GeneratedValue
	 * @var int
	 **/
    protected $id;
	/**
	 * @ManyToOne(targetEntity="Factor", inversedBy="values")
	 * @var Factor
	 **/
	protected $factor;
	/**
	 * @ManyToOne(targetEntity="Location", inversedBy="values")
	 * @var Location
	 **/
	protected $location;
	/**
	 * @ManyToOne(targetEntity="Status", inversedBy="values")
	 * @var Status
	 **/
	protected $status;
	/**
	 * @ManyToOne(targetEntity="ApiKey", inversedBy="values")
	 * @var ApiKey
	 **/
	protected $apikey;
	/**
	 * @Column(type="datetime")
	 * @var DateTime
	 **/
    protected $submitted;
	/**
	 * @Column(type="datetime")
	 * @var DateTime
	 **/
    protected $updated;
	/**
	 * @Column(type="text")
	 * @var string
	 **/
    protected $value;
	
	/**
	 * @Column(type="text")
	 * @var string
	 **/
    protected $source;
	/**
	 * @Column(type="date")
	 * @var DateTime
	 **/
    protected $sourceDate;
	
	public function __construct(Factor $factor, Location $location, Status $status, ApiKey $apikey, DateTime $submitted, DateTime $updated, $value, $source, DateTime $sourceDate)
	{
		$this->factor = $factor;
		$this->location = $location;
		$this->status = $status;
		$this->apikey = $apikey;
		$this->submitted = $submitted;
		$this->updated = $updated;
		$this->value = $value;
		$this->source = $source;
		$this->sourceDate = $sourceDate;
	}
	
	/* GETTERS */
	public function getId()
	{
		return $this->id;
	}

	public function getName()
	{
		return $this->factor->getName();
	}
	
	public function getSlug()
	{
		return $this->slug;
	}
	
	public function getLocation()
	{
		return $this->location;
	}
	
	public function getLocationCode()
	{
		return $this->location->getCode();
	}
	
	public function getValue()
	{
		return $this->value;
	}

	public function getFactor()
	{
		return $this->factor;
	}
	
	public function isFactorActive()
	{
		return $this->factor->isActive();
	}
	
	public function getStatus()
	{
		return $this->status;
	}
	
	public function getUnitHtml()
	{
		return $this->factor->getUnitHtml();
	}
	
	public function getDescription()
	{
		return $this->factor->getDescription();
	}
	
	public function getSubmitDate()
	{
		return $this->submitted;
	}
	
	public function getUpdateDate()
	{
		return $this->updated;
	}
	
	public function getSource()
	{
		return $this->source;
	}
	
	public function getSourceDate()
	{
		return $this->sourceDate;
	}
	
	public function getApiKey()
	{
		return $this->apikey;
	}

	/* SETTERS */
	public function setFactor($factor)
	{
		$this->factor = $factor;
	}
	
	public function setLocation($location)
	{
		$this->location = $location;
	}
	
	public function setStatus($status)
	{
		$this->status = $status;
	}
	
	public function setApiKey($apikey)
	{
		$this->apikey = $apikey;
	}
	
	public function setValue($value)
	{
		$this->value = $value;
	}
	
	public function setSource($source)
	{
		$this->source = $source;
	}
	
	public function setSourceDate($date)
	{
		$this->sourceDate = $date;
	}
	
	public function setUpdateDate($date)
	{
		$this->updated = $date;
	}
	
}
?>
