<?php
use Doctrine\Common\Collections\ArrayCollection;
/**
 * @Entity @Table(name="map_factors")
 **/
class Factor
{
    /**
	 * @Id @Column(type="integer") @GeneratedValue
	 * @var int
	 **/
    protected $id;
	/**
	 * @ManyToOne(targetEntity="Unit", inversedBy="factors")
	 * @var Unit
	 **/
	protected $unit;
    /**
	 * @Column(type="string")
	 * @var string
	 **/
    protected $name;
	/**
	 * @Column(type="text")
	 * @var string
	 **/
    protected $description;
	/**
	 * @Column(type="integer")
	 * @var int
	 **/
    protected $priority;
	/**
	 * @Column(type="boolean")
	 * @var bool
	 **/
    protected $active;
	/**
	 * @Column(type="boolean")
	 * @var bool
	 **/
    protected $invert;
	/**
	 * @OneToMany(targetEntity="Value", mappedBy="factor")
	 * @var Value[]
	 **/
	protected $values;
	
	public function __construct($name, Unit $unit=NULL, $description, $priority=100, $active=false, $invert=false)
    {
		$this->name = $name;
		$this->unit = $unit;
		$this->description = $description;
		$this->priority = $priority;
		$this->active = $active;
		$this->invert = $invert;
        $this->values = new ArrayCollection();
    }
	
	/* GETTERS */
	public function getId()
	{
		return $this->id;
	}

	public function getName()
	{
		return $this->name;
	}
	
	public function getDescription()
	{
		return $this->description;
	}
	
	public function getPriority()
	{
		return $this->priority;
	}
	
	public function getUnitSlug()
	{
		if ($this->unit) return $this->unit->getSlug();
	}
	
	public function getUnitHtml()
	{
		if ($this->unit) return $this->unit->getName();
	}
	
	public function getUnit(){
		if ($this->unit) return $this->unit;
	}
	
	public function isActive()
	{
		return $this->active;
	}
	
	public function isInvert()
	{
		return $this->invert;
	}
	
	/* SETTERS */
	public function setName($name)
	{
		$this->name = $name;
	}
	
	public function setDescription($text)
	{
		$this->description = $text;
	}
	
	public function setPriority($int)
	{
		$this->priority = $int;
	}
	
	public function setUnit(Unit $unit)
	{
		 $this->unit = $unit;
	}
	
	public function setActive($active)
	{
		$this->active = $active;
	}
	
	public function setInvert($invert)
	{
		$this->invert = $invert;
	}
}
?>
