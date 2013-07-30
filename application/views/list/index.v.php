	<noscript><p class="message">You have Javascript disabled, making your list read-only. Please enable Javascript for full functionality.</p></noscript>

	<?php $noListResult = (!empty($List)) ? 'hide' : ''; ?>

	<p id="no-list" class="message <?php echo $noListResult; ?>">Your list is empty. Start by adding items.</p>
	<ul id="edit-list" class="list">
		<?php if(!empty($List)): ?>
			<?php foreach($List as $ListItem): ?>

				<?php $isDone = ($ListItem->done) ? 'crossout' : ''; ?>

				<li id="<?php echo Utils::cleanEcho($ListItem->id); ?>"
				    rel="<?php echo Utils::cleanEcho($ListItem->pos); ?>"
				    class="<?php echo $isDone; ?>">
					<span id="<?php echo Utils::cleanEcho($ListItem->id); ?>"><?php echo Utils::cleanEcho($ListItem->text); ?></span>
				</li>

			<?php endforeach; ?>
		<?php endif; ?>
	</ul>

	<input type="hidden" id="csrf_token" name="csrf_token" value="<?php echo $csrf_token; ?>" />
	<form id="form-add-new" class="hide" >
		<div>
			<input id="add-new-item-text" name="add-new-item-text" type="text" />
			<input id="add-new-submit" type="submit" value="+" class="button" />
		</div>
	</form>