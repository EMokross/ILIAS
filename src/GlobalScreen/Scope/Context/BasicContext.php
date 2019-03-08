<?php namespace ILIAS\GlobalScreen\Scope\Context;

use ILIAS\Data\ReferenceId;
use ILIAS\GlobalScreen\Scope\Context\AdditionalData\Collection;

/**
 * Class BasicContext
 *
 * @author Fabian Schmid <fs@studer-raimann.ch>
 */
class BasicContext implements ContextInterface {

	/**
	 * @var ReferenceId
	 */
	protected $reference_id;
	/**
	 * @var Collection
	 */
	protected $additional_data;
	/**
	 * @var string
	 */
	protected $context_identifier = '';


	/**
	 * BasicContext constructor.
	 *
	 * @param string $context_identifier
	 */
	public function __construct(string $context_identifier) {
		$this->context_identifier = $context_identifier;
		$this->additional_data = new Collection();
		$this->reference_id = new ReferenceId(0);
	}


	/**
	 * @inheritDoc
	 */
	public function hasReferenceId(): bool {
		return $this->reference_id instanceof ReferenceId && $this->reference_id->toInt() > 0;
	}


	/**
	 * @inheritDoc
	 */
	public function getReferenceId(): ReferenceId {
		return $this->reference_id;
	}


	/**
	 * @inheritDoc
	 */
	public function withReferenceId(ReferenceId $reference_id): ContextInterface {
		$clone = clone $this;
		$clone->reference_id = $reference_id;

		return $clone;
	}


	/**
	 * @inheritDoc
	 */
	public function withAdditionalData(Collection $collection): ContextInterface {
		$clone = clone $this;
		$clone->additional_data = $collection;

		return $clone;
	}


	/**
	 * @inheritDoc
	 */
	public function getAdditionalData(): Collection {
		return $this->additional_data;
	}


	/**
	 * @inheritDoc
	 */
	public function getUniqueContextIdentifier(): string {
		return $this->context_identifier;
	}
}
