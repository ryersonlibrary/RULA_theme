<?php

/**
 * @file
 * This is the template file for the pdf object
 *
 * @TODO: Add documentation about this file and the available variables
 */
?>

<div class="islandora-pdf-object islandora" vocab="http://schema.org/" prefix="dcterms: http://purl.org/dc/terms/" typeof="Article">
  <div class="islandora-pdf-content-wrapper clearfix">
    <?php if (isset($islandora_content)): ?>
      <div class="islandora-pdf-content col-md-7">
        <?php print $islandora_content; ?>
      <?php if (isset($islandora_download_link)): ?>
        <?php print $islandora_download_link; ?>
      <?php endif; ?>
      <!-- usage stats -->
      <?php if (module_exists('islandora_usage_stats')): ?>
      	<div class="islandora-usage-stats">
      	  <br />
		  <p>
			  Viewed: <span class="badge"><?php print $times_viewed ?></span>
			  Downloaded: <span class="badge"><?php print $times_downloaded ?></span>
		  </p>
	  	</div>
      <?php endif; ?>
      <!-- end usage stats -->
      <?php print $description; ?>
      <?php if($parent_collections): ?>
      	<div>
      	  <h2><?php print t('In collections'); ?></h2>
      		<ul>
      		  <?php foreach ($parent_collections as $collection): ?>
      			<li><?php print l($collection->label, "islandora/object/{$collection->id}"); ?></li>
      	  	  <?php endforeach; ?>
      		</ul>
		</div>
      <?php endif; ?>
      </div>

      <div class="islandora-pdf-metadata col-md-5 pull-right">
      <?php print $metadata; ?>
      </div>
    <?php endif; ?>
  </div>
</div>
