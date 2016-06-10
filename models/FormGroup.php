<?php
use Doctrine\Common\Collections\ArrayCollection;
/**
 * @Entity @Table(name="form_groups")
 **/
class FormGroup
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
	 * @Column(type="integer")
	 * @var int
	 **/
	protected $groupOrder;
	/**
	 * @ManyToMany(targetEntity="FormPost", mappedBy="groups")
	 * @var FormPost[]
	 **/
    protected $forms;
	/**
	 * @OneToMany(targetEntity="FormField", mappedBy="group")
	 * @var FormField[]
	 **/
	protected $fields;
	
	public function __construct($title, $name, $description, $order=0)
	{
		$this->title = $title;
		$this->name = $name;
		$this->description = $description;
		$this->groupOrder = $order;
		$this->forms = new ArrayCollection();
	}

	/* GETTERS */	
	public function getId()
	{
		return $this->id;
	}
	
	public function getGroupFields()
	{
		$temp = array();
		
		foreach ($this->fields as $field)
		{
			array_push($temp, $field->getField());
		}
		
		return $temp;
	}
	
	public function getGroup()
	{
		return array(
			"id"	=> $this->id,
			"title"	=> $this->title,
			"name"	=> $this->name,
			"description" => $this->description,
			"order"	=> $this->groupOrder,
			"fields"=> $this->getGroupFields()
		);
	}
	

	/* SETTERS */
	public function setName($name)
	{
		$this->name = $name;
	}
	
	public function addToForm(FormPost $form)
	{
		$this->forms->add($form);
	}

}
?>
