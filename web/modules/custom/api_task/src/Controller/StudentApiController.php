<?php

namespace Drupal\api_task\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * This class will be used to return data in the form of API.
 */
class StudentApiController extends ControllerBase {

  /**
   * Constructor for your class.
   */
  public function __construct(EntityTypeManagerInterface $entityTypeManager) {
    $this->entityTypeManager = $entityTypeManager;
  }

  /**
   * Container function.
   *
   * @param \Symfony\Component\DependencyInjection\ContainerInterface $container
   *   This is for dependency injection.
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('entity_type.manager')
    );
  }

  /**
   * Get all student details.
   */
  public function getAllStudentDetails() {
    $query = $this->entityTypeManager
      ->getStorage('user')
      ->getQuery()
      ->condition('roles', 'student')
      ->accessCheck(FALSE);

    if (!empty($stream)) {
      // Replace 'field_stream' with your field name.
      $query->condition('stream', $stream);
    }

    if (!empty($joiningYear)) {
      // Replace 'field_joining_year' with your field name.
      $query->condition('joining_year', $joiningYear);
    }

    $student_ids = $query->execute();

    $students = $this->entityTypeManager
      ->getStorage('user')
      ->loadMultiple($student_ids);

    return $students;
  }

  /**
   * Function to display all the details regarding students.
   */
  public function listStudents() {
    // Fetch and format student data here.
    $students = [];

    $all_students = $this->getAllStudentDetails();

    foreach ($all_students as $key => $student) {
      $students[$key]['Name'] = $student->get('name')->getValue();
      $students[$key]['Email'] = $student->getEmail();
      $students[$key]['Phone Number'] = $student->get('phoneNumber')->getValue();
      $students[$key]['Stream'] = $student->get('stream')->getValue();
      $students[$key]['Joining Year'] = $student->get('joining_year')->getValue();
      $students[$key]['Passing Year'] = $student->get('passing_year')->getValue();
    }

    return new JsonResponse($students);
  }

}
