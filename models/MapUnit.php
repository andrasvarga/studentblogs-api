<?php
use Doctrine\Common\Collections\ArrayCollection;
/**
 * @Entity @Table(name="map_units")
 **/
class Unit
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
	 * @OneToMany(targetEntity="Factor", mappedBy="unit")
	 * @var Factor[]
	 **/
	protected $factors;
	
	public function __construct($name,$slug)
    {
		$this->name = $name;
		$this->slug = $slug;
        $this->factors = new ArrayCollection();
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
