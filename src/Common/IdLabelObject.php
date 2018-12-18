<?php
namespace Ecommerce\Common;

trait IdLabelObject
{
	/**
	 * @ObjectToArrayHydratorProperty
	 *
	 * @var string
	 */
	private $id;

	/**
	 * @ObjectToArrayHydratorProperty
	 *
	 * @var string
	 */
	private $label;

	/**
	 * @param string $id
	 * @param string $label
	 */
	public function __construct(string $id, string $label)
	{
		$this->id    = $id;
		$this->label = $label;
	}

	/**
	 * @param $id
	 * @return bool
	 */
	public function is($id)
	{
		return $this->id === $id;
	}

	/**
	 * @return string
	 */
	public function getId(): string
	{
		return $this->id;
	}

	/**
	 * @return string
	 */
	public function getLabel(): string
	{
		return $this->label;
	}
}