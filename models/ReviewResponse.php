<?php
use Doctrine\Common\Collections\ArrayCollection;
/**
 * @Entity @Table(name="review_responses")
 **/
class ReviewResponse
{
    /**
	 * @Id @Column(type="integer") @GeneratedValue
	 * @var int
	 **/
    protected $id;
	/**
	 * @ManyToOne(targetEntity="Review", inversedBy="responses")
	 * @var Location
	 **/
    protected $review;
    /**
	 * @ManyToOne(targetEntity="FormField", inversedBy="responses")
	 * @var FormField
	 **/
    protected $field;
	/**
	 * @Column(type="string")
	 * @var string
	 **/
    protected $value;
	
	public function __construct(Review $review, FormField $field, $value)
	{
		$this->review = $review;
		$this->field = $field;
		$this->value = $value;
	}

	/* GETTERS */	
	public function getId()
	{
		return $this->id;
	}
	
	public function getResponse()
	{
		return array(
			"id"	=> $this->id,
			"field"	=> $this->field->getField(),
			"value"	=> $this->value
		);
	}

	/* SETTERS */
	public function setValue($value)
	{
		$this->value = $value;
	}
	
}
?>
