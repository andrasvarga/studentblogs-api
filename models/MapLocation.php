<?php
use Doctrine\Common\Collections\ArrayCollection;
/**
 * @Entity @Table(name="map_locations")
 **/
class Location
{
    /**
	 * @Id @Column(type="integer") @GeneratedValue
	 * @var int
	 **/
    protected $id;
    /**
	 * @ManyToOne(targetEntity="Location", inversedBy="children")
	 * @var Location
	 **/
    protected $parentLocation;
	/**
	 * @Column(type="string")
	 * @var string
	 **/
    protected $name;
	/**
	 * @Column(type="string")
	 * @var string
	 **/
    protected $slug;
	/**
	 * @Column(type="string")
	 * @var string
	 **/
	protected $code;
	/**
	 * @OneToMany(targetEntity="Value", mappedBy="location")
	 * @var Value[]
	 **/
    protected $values;
	/**
	 * @OneToMany(targetEntity="Location", mappedBy="parentLocation")
	 * @var Location[]
	 **/
    protected $children;
	
	public function __construct($name, $slug, $code='', Location $parent=NULL)
	{
		$this->name = $name;
		$this->slug = $slug;
		$this->code = $code;
		$this->parentLocation = $parent;
		$this->values = new ArrayCollection();
		$this->children = new ArrayCollection();
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
	
	public function getSlug()
	{
		return $this->slug;
	}
	
	public function getCode()
	{
		return $this->code;
	}
	
	public function getValues()
	{
		return $this->values;
	}
	
	public function getValueIds()
	{
		$result = array();
		foreach ($this->values as $value)
		{
			$result[] = $value->getId();
		}
		return $result;
	}
	
	public function getParent()
	{
		return $this->parentLocation;
	}
	
	public function getParentId()
	{
		if (isset($this->parentLocation))
			return $this->parentLocation->getId();
		else
			return NULL;
	}

	/* SETTERS */
	public function setName($name)
	{
		$this->name = $name;
	}
	public function setSlug($slug)
	{
		$this->slug = $slug;
	}
	public function setCode($code)
	{
		$this->code = $code;
	}
	public function setParent($parent)
	{
		$this->parentLocation = $parent;
	}
	public function setParentById($parentId)
	{
		global $entityManager;
		$parent = $entityManager->find('Location', $parentId);
		$this->parentLocation = $parent;
	}
}
?>
