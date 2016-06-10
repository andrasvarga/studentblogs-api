<?php
use Doctrine\Common\Collections\ArrayCollection;
/**
 * @Entity @Table(name="form_posts")
 **/
class FormPost
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
    protected $title;
	/**
	 * @Column(type="string")
	 * @var string
	 **/
    protected $name;
	/**
	 * @Column(type="string")
	 * @var string
	 **/
    protected $description;
	/**
	 * @ManyToMany(targetEntity="FormGroup", inversedBy="forms")
	 * @JoinTable(name="form_posts_groups")
	 * @var FormGroup[]
	 **/
    protected $groups;
	/**
	 * @OneToMany(targetEntity="Review", mappedBy="form")
	 * @var Review[]
	 **/
	protected $reviews;
	
	public function __construct($title, $name, $description)
	{
		$this->title = $title;
		$this->name = $name;
		$this->description = $description;
		$this->groups = new ArrayCollection();
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
	
	public function getTitle()
	{
		return $this->title;
	}
	
	public function getGroups()
	{
		return $this->groups;
	}
	
	public function getDescription()
	{
		return $this->description;
	}

	/* SETTERS */
	public function setName($name)
	{
		$this->name = $name;
	}
	
	public function addGroup(FormGroup $group)
	{
		$this->groups->add($group);
	}

}
?>
