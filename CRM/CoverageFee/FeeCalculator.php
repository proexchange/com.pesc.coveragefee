<?php

/**
 * @package CoverageFee
 */
class CRM_CoverageFee_FeeCalculator {
  protected $entity;
  protected $entity_id;

  /**
   * Constructor.
   *
   * @param string $entity
   * @param int $entity_id
   */
  public function __construct($entity, $entity_id) {
    $this->entity = $entity;
    $this->entity_id = $entity_id; 
  }

  /**
   * Check if the coverage fee field should be shown.
   */
  public function bShowCoverageFeeField() {
    // @TODO: check if page is configured to show coverage fee
    return TRUE;
  }
}
