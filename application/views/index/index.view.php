<div id="main">
	<noscript>This site must have javascript enabled to function.</noscript>


	<!-- IF LOGGED IN -->

	<div id="share-area">
		<p>Share List: <a href="#">URL GOES HERE</a><br />
			<small>(Nobody but YOU will be able to edit this list)</small></p>
	</div>

	<br />

	<ul id="edit-list" class="list">
		<li class="colorBlue">Walk the dog</li>
		<li class="colorBlue">Pick up dry cleaning</li>
		<li class="colorBlue">Milk</li>
	</ul>

	<form action="<?php echo PUBLIC_HTML; ?>list/add" method="post" id="add-new">
		<div>
			<input id="new-list-item-text" type="text" />
			<input id="add-new-submit" type="submit" value="Add" class="button" />
		</div>
	</form>

	<!-- ELSE IF PUBLIC LIST-->
	<!--
		<ul id="pub-list" class="list">
			<li class="colorBlue">Walk the dog</li>
			<li class="colorBlue">Pick up dry cleaning</li>
			<li class="colorBlue">Milk</li>
		</ul>
	-->

	<!-- ELSE IF LOGGED OUT -->

	<!-- END IF -->
</div>