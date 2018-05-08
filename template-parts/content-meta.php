<?php
/**
 * Template part for displaying post meta.
 *
 * @package realistic
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>

<div class="entry-meta post-info">

	<span class="thecategory"><i class="material-icons">bookmark</i><?php realistic_entry_category(); ?></span>

	<span class="posted"><i class="material-icons">access_time</i><?php realistic_posted(); ?></span>

	<span class="theauthor"><i class="material-icons">person</i><?php realistic_entry_author(); ?></span>

	<span class="comments"><i class="material-icons">chat_bubble</i><?php realistic_entry_comments(); ?></span>

</div><!-- .entry-meta -->