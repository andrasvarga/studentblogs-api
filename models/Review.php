<?php
use Doctrine\Common\Collections\ArrayCollection;
/**
 * @Entity @Table(name="reviews")
 **/
class Review
{
    /**
	 * @Id @Column(type="integer") @GeneratedValue
	 * @var int
	 **/
    protected $id;
	/**
	 * @Column(type="datetime")
	 * @var DateTime
	 **/
    protected $submitDate;
	/**
	 * @Column(type="boolean")
	 * @var bool
	 **/
    protected $approved;
	/**
	 * @ManyToOne(targetEntity="FormPost", inversedBy="reviews")
	 * @var FormPost
	 **/
	protected $form;
	/**
	 * @Column(type="integer")
	 * @var int
	 **/
	protected $version;
	/**
	 * @Column(type="integer")
	 * @var int
	 **/
	protected $userId;
	/**
	 * @OneToMany(targetEntity="ReviewResponse", mappedBy="review")
	 * @var Value[]
	 **/
    protected $responses;
	
	public function __construct($user_id, FormPost $form, DateTime $date, $version, $approved=FALSE)
	{
		$this->userId = $user_id;
		$this->form = $form;
		$this->submitDate = $date;
		$this->version = $version;
		$this->approved = $approved;
		$this->responses = new ArrayCollection();
	}

	/* GETTERS */	
	public function getId()
	{
		return $this->id;
	}
	
	/* SETTERS */
	public function addResponse(ReviewResponse $response){
		$this->responses->add($response);
	}
	public function setApproved()
	{
		$this->approved = TRUE;
	}
	public function setNotApproved()
	{
		$this->approved = FALSE;
	}
	
	/* RENDER */
	public function getResponses()
	{
		$temp = array();
		
		foreach ($this->responses as $response)
		{
			array_push($temp, $response->getResponse());
		}
		
		return $temp;
	}
	
	public function getReview()
	{
		return array(
			"date"		=> $this->submitDate,
			"approved"	=> $this->approved,
			"formId"	=> $this->form->getId(),
			"userId"	=> $this->userId,
			"version"	=> $this->version,
			"responses" => $this->getResponses()
		);
	}
}
?>
