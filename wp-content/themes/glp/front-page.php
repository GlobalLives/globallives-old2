<div class="tab-content">
	<?php while (have_posts()) : the_post(); ?>
	<article id="content_glp" <?php post_class('front-page tab-pane active'); ?>>
		<div class="page-content"><?php the_content(); ?></div>
	</article>
	<?php endwhile; ?>
	<?php $participants = get_posts(array( 'post_type' => 'participant', 'posts_per_page' => 10)); ?>
	<?php foreach ($participants as $participant) : ?>
		<?php $current_wp_post = get_post($participant->ID) ?>
		<article id="content_<?php echo $participant->ID; ?>" class="tab-pane">
			<div class="page-content">
				<h2><?php echo $participant->post_title; ?> &mdash; <span class="participant-location"><?php the_field($field_keys['participant_location'], $participant->ID); ?></span></h2>
				
				<div class="participant-meta row">
					<div class="span6 pull-left tinyDetails">
						<div class="row">
							<div class="span3">
								<b><?php _e('Occupation','glp'); ?>:</b> <?php the_field($field_keys['participant_occupation'], $participant->ID); ?><br>
								<?php if ($dob = get_field($field_keys['participant_dob'], $participant->ID)) : ?><b><?php _e('Date of Birth','glp'); ?>:</b> <?php echo $dob; ?><?php endif; ?>
							</div>
							<div class="span3">
								<b><?php _e('Religion','glp'); ?>:</b> <?php the_field($field_keys['participant_religion'], $participant->ID); ?><br>
								<b><?php _e('Income','glp'); ?>:</b> <?php 
								$incomes = get_field_object($field_keys['participant_income']); $income = get_field($field_keys['participant_income'], $participant->ID); echo $incomes['choices'][$income]; ?>
							</div>
							<div class="span6">
								<p><?php echo $participant->post_content; ?></p>
								<a href="<?php echo get_permalink($participant->ID); ?>" class="pull-right btn btn-inverse"><?php echo $participant->post_title; ?></a>
							</div>
						</div>
					</div><!-- .tinyDetails -->
					<img src="http://maps.googleapis.com/maps/api/staticmap?center=<?php the_field($field_keys['participant_latitude'],$participant->ID); ?>,<?php the_field($field_keys['participant_longitude'],$participant->ID); ?>&zoom=6&size=570x250&markers=color:red|<?php the_field($field_keys['participant_latitude'],$participant->ID); ?>,<?php the_field($field_keys['participant_longitude'],$participant->ID); ?>&maptype=roadmap&sensor=false&style=feature:all%7Celement:geometry%7Csaturation:-100" class="location" />
				</div><!-- .participant-meta -->
			</div>
		</article>
	<?php endforeach; ?>
	<div id="explore">
		<h4><?php _e('Explore the Collection','glp'); ?></h4>
		<a href="/explore/#gridview" class="btn btn-inverse"><i class="icon icon-th-large"></i> <?php _e('Grid View','glp'); ?></a>
		<a href="/explore/#mapview" class="btn btn-inverse"><i class="icon icon-globe"></i> <?php _e('Map View','glp'); ?></a>
	</div>
</div>