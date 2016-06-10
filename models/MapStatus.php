<?php
use Doctrine\Common\Collections\ArrayCollection;
/**
 * @Entity @Table(name="map_statuses")
 **/
class Status
{
    /**
	 * @Id @Column(type="integer") @GeneratedValue
	 * @var int
	 **/
    protected $id;
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
	 * @OneToMany(targetEntity="Value", mappedBy="status")
	 * @var Value[]
	 **/
	protected $values;
		
	public function __construct($name,$slug)
	{
		$this->name = $name;
		$this->slug = $slug;
		$this->values = new ArrayCollection();
	}
	
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

	public function setName($name)
	{
		$this->name = $name;
	}
	
	public function setSlug($slug)
	{
		$this->slug = $slug;
	}
}
?>
