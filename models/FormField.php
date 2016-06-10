<?php
use Doctrine\Common\Collections\ArrayCollection;
/**
 * @Entity @Table(name="form_fields")
 **/
class FormField
{
    /**
	 * @Id @Column(type="integer") @GeneratedValue
	 * @var int
	 **/
    protected $id;
    /**
	 * @ManyToOne(targetEntity="FormFieldType", inversedBy="fields")
	 * @var FormFieldType
	 **/
    protected $type;
	/**
	 * @ManyToOne(targetEntity="FormGroup", inversedBy="fields")
	 * @var FormGroup
	 **/
    protected $group;
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
    protected $placeholder;
	/**
	 * @Column(type="string")
	 * @var string
	 **/
	protected $instructions;
	/**
	 * @Column(type="integer")
	 * @var int
	 **/
	protected $version;
	/**
	 * @Column(type="integer")
	 * @var int
	 **/
	protected $fieldOrder;
	/**
	 * @Column(type="boolean")
	 * @var bool
	 **/
	protected $required;
	/**
	 * @OneToMany(targetEntity="ReviewResponse", mappedBy="field")
	 * @var FormResponse[]
	 **/
    protected $responses;
	
	public function __construct(FormFieldType $type, FormGroup $group, $title, $name, $placeholder="", $instructions="", $version, $order=0, $required=FALSE)
	{
		$this->type = $type;
		$this->group = $group;
		$this->title = $title;
		$this->name = $name;
		$this->placeholder = $placeholder;
		$this->instructions = $instructions;
		$this->version = $version;
		$this->fieldOrder = $order;
		$this->required = $required;
		$this->responses = new ArrayCollection();
	}

	/* GETTERS */	
	public function getId()
	{
		return $this->id;
	}
	
	public function getField()
	{
		return array(
			"id"	=> $this->id,
			"title"	=> $this->title,
			"name"	=> $this->name,
			"type"	=> $this->type->getTag(),
			"placeholder" => $this->placeholder,
			"instructions" => $this->instructions,
			"order"	=> $this->fieldOrder,
			"required" => $this->required
		);
	}

	/* SETTERS */
	public function setTitle($title)
	{
		$this->name = $title;
	}
	
}
?>
