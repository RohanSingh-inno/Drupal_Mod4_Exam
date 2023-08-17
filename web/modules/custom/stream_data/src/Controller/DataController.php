<?php

namespace Drupal\stream_data\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 *
 */
class DataController extends ControllerBase {

  /**
   *
   */
  public function staticContent() {
    return [
      '#markup' => '<h3>Science</h3>
                    <ol>
                      <li><a href="#">Maths</a></li>
                      <li><a href="#">Physics</a></li>
                      <li><a href="#">Chemistry</a></li>
                    </ol>
                    <h3>Commerce</h3>
                    <ol>
                      <li><a href="#">Accountants</a></li>
                      <li><a href="#">Business Studies</a></li>
                      <li><a href="#">Economics</a></li>
                    </ol>
                    <h3>Arts</h3>
                    <ol>
                      <li><a href="#">History</a></li>
                      <li><a href="#">Geograhy</a></li>
                      <li><a href="#">Social Science</a></li>
                    </ol>',
    ];
  }

}
