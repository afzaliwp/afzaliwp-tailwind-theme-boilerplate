<div class="post-head flex flex-col gap-10">
	<?php echo get_the_post_thumbnail() ?>
	<h1 class="text-2xl text-sky-900"><?php the_title() ?></h1>
	<div class="bg-white my-3 py-8 px-10 rounded-xl border border-gray-200 shadow-2xl">
		<?php the_content(); ?>
	</div>
</div>