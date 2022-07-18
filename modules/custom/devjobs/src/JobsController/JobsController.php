<?php

namespace Drupal\devjobs\JobsController;

use Drupal\Core\Controller\ControllerBase;
use \Drupal\node\Entity\Node;
use \Drupal\file\Entity\File;
use Drupal\image\Entity\ImageStyle;

class JobsController extends ControllerBase {

  public function jobsContent() {

    $title = \Drupal::request()->query->get('title');
    $location = \Drupal::request()->query->get('location');
    $checkbox = \Drupal::request()->query->get('checkbox');

    $node_storage = \Drupal::entityTypeManager()->getStorage('node');

    $nids = $node_storage->getQuery()
    ->condition('status', 1)
    ->condition('type', 'job_card')
    ->execute();

    if (!empty($title) && empty($location) && empty($checkbox)) {
        $nids = $node_storage->getQuery()
        ->condition('status', 1)
        ->condition('type', 'job_card')
        ->condition('field_job_title', $title, 'CONTAINS')
        ->sort('nid', 'ASC')
        ->execute();
      } else if (!empty($title) && !empty($location) && empty($checkbox)) {
        $nids = $node_storage->getQuery()
        ->condition('status', 1)
        ->condition('type', 'job_card')
        ->condition('field_job_title', $title, 'CONTAINS')
        ->condition('field_country', $location, 'CONTAINS')
        ->sort('nid', 'ASC')
        ->execute();
      } else if (!empty($title) && !empty($location) && !empty($checkbox)) {
        $nids = $node_storage->getQuery()
        ->condition('status', 1)
        ->condition('type', 'job_card')
        ->condition('field_job_title', $title, 'CONTAINS')
        ->condition('field_country', $location, 'CONTAINS')
        ->condition('field_job_type', 'Full Time', '=')
        ->sort('nid', 'ASC')
        ->execute();
      } else if (empty($title) && empty($location) && !empty($checkbox)) {
        $nids = $node_storage->getQuery()
        ->condition('status', 1)
        ->condition('type', 'job_card')
        ->condition('field_job_type', 'Full Time', '=')
        ->sort('nid', 'ASC')
        ->execute();
      } else if (empty($title) && !empty($location) && !empty($checkbox)) {
        $nids = $node_storage->getQuery()
        ->condition('status', 1)
        ->condition('type', 'job_card')
        ->condition('field_country', $location, 'CONTAINS')
        ->condition('field_job_type', 'Full Time', '=')
        ->sort('nid', 'ASC')
        ->execute();
      } else if (!empty($title) && empty($location) && !empty($checkbox)) {
        $nids = $node_storage->getQuery()
        ->condition('status', 1)
        ->condition('type', 'job_card')
        ->condition('field_job_title', $title, 'CONTAINS')
        ->condition('field_job_type', 'Full Time', '=')
        ->sort('nid', 'ASC')
        ->execute();
      }

    $results = Node::loadMultiple($nids);
    $jobs = [];

    foreach ($results as $i => $result) {
      $fid = $result->field_card_image->getValue()[0]['target_id'] ?? null;
      // Load file.
      $file = File::load($fid);
      // Get origin image URI.
      $image_uri = $file->getFileUri();
      // Load image style "thumbnail".
      $style = ImageStyle::load('thumbnail');
      // Get URI.
      $uri = $style->buildUri($image_uri);
      // Get URL.
      $url = $style->buildUrl($image_uri);

      $jobs[] = [
        'id' => $i,
        'card_image' => $url,
        'time_ago' => $result->field_time_ago->value,
        'job_type' => $result->field_job_type->value,
        'job_title' => $result->field_job_title->value,
        'company_name' => $result->field_company_name->value,
        'country' => $result->field_country->value,
      ];
    }

    // $search_form = \Drupal::formBuilder()->getForm('Drupal\devjobs\FormController\FormController');

    return [
      // Theme hook name
      '#theme' => 'jobs',

      // Variables
      '#jobs' => $jobs,
      // '#form' => $search_form,
    ];

  }

}

?>