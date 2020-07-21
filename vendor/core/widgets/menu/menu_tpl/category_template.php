<li>
	<a href="?category=<?=$id?>"><?=$category['title']?></a>
	<?php if(isset($category['childs'])): ?>
	<ul>
		<?php echo $this->categories_to_string($category['childs']); ?>
	</ul>
	<?php endif; ?>

</li>