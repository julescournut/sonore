<?php

namespace Drupal\brand_filter\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'BrandFilterBlock' block.
 *
 * @Block(
 *  id = "brand_filter_block",
 *  admin_label = @Translation("Brand Filter block"),
 * )
 */
class BrandFilter extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    $connection = \Drupal::database();


    // dump($_GET['q']);die;

    // $getBrands = $connection->query("SELECT DISTINCT ttfd.tid, ttfd.name FROM {taxonomy_term_field_data} AS ttfd
    //                                 JOIN {node__field_marque} AS nfm ON ttfd.tid = nfm.field_marque_target_id
    //                                 JOIN {node__field_categorie} AS nfc ON nfm.entity_id = nfc.entity_id
    //                                 AND nfc.field_categorie_target_id = 1
    //                                 WHERE ttfd.vid = 'marque'");

    $getCounts = $connection->query("SELECT ttfd.tid, COUNT(ttfd.tid) AS count FROM {taxonomy_term_field_data} AS ttfd
                                    JOIN {node__field_marque} AS nfm ON ttfd.tid = nfm.field_marque_target_id
                                    WHERE ttfd.vid = 'marque'
                                    GROUP BY ttfd.tid");
	$counts = $getCounts->fetchAll();
    $getBrands = $connection->query("SELECT DISTINCT tid, name FROM {taxonomy_term_field_data}
                                    WHERE vid = 'marque'");
	$brands = $getBrands->fetchAll();

    foreach ($brands as $brand) {
        $count = 0;
        foreach ($counts as $count) {
            if ($count->tid == $brand->tid) {
                $brand->count = $count->count;
            }
        }
    }

    // dump($counts);dump($brands);die;

	$block = [
    '#theme' => 'brand_filter',
    '#title' => 'Marques',
    '#attributes' => [
        'class' => ['brand-filter'],
        'id' => 'brand-filter-block',
      ],
    '#brands'  => $brands,
    ];

    return $block;
  }

}
