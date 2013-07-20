	<noscript>This site must have javascript enabled to function.</noscript>

<!--	<div id="share-area">-->
<!--		<p>Share List: <a href="#">URL GOES HERE</a><br />-->
<!--			<small>(Nobody but YOU will be able to edit this list)</small></p>-->
<!--	</div>-->

	<?php $newPosVal = null; ?>
	<?php if($List): ?>
		<ul id="edit-list" class="list">
			<?php foreach($List as $ListItem): ?>

				<li id="<?php echo $ListItem->id; ?>" rel="<?php echo $ListItem->pos; ?>" class=""><span id="<?php echo $ListItem->id; ?>"><?php echo $ListItem->text; ?></span></li>
				<?php $newPosVal = $ListItem->pos + 1; ?>

			<?php endforeach; ?>
		</ul>
	<?php else: ?>
		<p>There is nothing in this list.</p>
	<?php endif; ?>

	<form action="list/add" method="post" id="add-new">
		<div>
			<input id="new-list-item-text" name="new-list-item-text" type="text" />
<!--		    <input type="hidden" id="current-list" name="current-list" value="--><?php //echo $ListItem->list_id; ?><!--" />-->
			<input type="hidden" id="new-list-item-pos" name="new-list-item-pos" value="<?php echo $newPosVal; ?>" />
			<input id="add-new-submit" type="submit" value="+" class="button" />
		</div>
	</form>