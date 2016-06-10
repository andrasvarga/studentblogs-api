<?php
use Doctrine\Common\Collections\ArrayCollection;
/**
 * @Entity @Table(name="apikeys")
 **/
class ApiKey
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
    protected $apikey;
	/**
	 * @Column(type="string")
	 * @var string
	 **/
    protected $owner;
	/**
	 * @Column(type="boolean")
	 * @var bool
	 **/
    protected $active;
	/**
	 * @OneToMany(targetEntity="Value", mappedBy="key")
	 * @var Value[]
	 **/
	protected $values;
	
	public function __construct($owner='anonymous',$status=false)
	{
		$this->apikey = md5(microtime().rand());
		$this->owner = $owner;
		$this->active = $status;
		$this->values = new ArrayCollection();
	}
	
	
	
	
	public function getId()
	{
		return $this->id;
	}

	public function getKey()
	{
		return $this->apiKey;
	}
	
	public function getOwner()
	{
		return $this->owner;
	}
	
	public function isActive()
	{
		return (bool)$this->active;
	}

	public function setName($name)
	{
		$this->name = $name;
	}
	
	public function setSlug($slug)
	{
		$this->slug = $slug;
	}
	
	public function setActive($status=true)
	{
		$this->active = $status;
	}
}
?>
