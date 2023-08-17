<?php

namespace Drupal\notice_data;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface defining a notice data entity type.
 */
interface NoticeDataInterface extends ContentEntityInterface, EntityOwnerInterface, EntityChangedInterface {

}
