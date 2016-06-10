<?php
use Doctrine\Common\Collections\ArrayCollection;
/**
 * @Entity @Table(name="form_field_types")
 **/
class FormFieldType
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
    protected $tag;
	/**
	 * @OneToMany(targetEntity="FormField", mappedBy="type")
	 * @var FormField[]
	 **/
	protected $fields;
	
	public function __construct($tag)
	{
		$this->tag = $tag;
		$this->fields = new ArrayCollection();
	}

	/* GETTERS */	
	public function getId()
	{
		return $this->id;
	}
	public function getTag()
	{
		return $this->tag;
	}

	/* SETTERS */

}
?>
