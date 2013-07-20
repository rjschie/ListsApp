$(function() {


	/** UI STUFF **/

	var appendTabs = "<div class='deletebutton'>-</div><div class='donetab'></div>";
	var editList = $("#edit-list");

	// Apend UI stuff to each <li>
	$('#edit-list li').append(appendTabs);    // TODO

	// Mark as done
	editList.on('click', '.donetab', function() {
		// If not crossed out
		if(!$(this).parent().hasClass("crossout")) {
			$(this).siblings(".strikethrough").css({width: "0px"});
			$(this).parent().addClass("crossout");
			$(this).siblings(".strikethrough").animate({width: "613px"}, 300);

			// TODO implement "done" update on database

		} else {
			$(this).parent().removeClass("crossout");

			// TODO implement "done" update on database

		}
	});

	// Make the list sortable
	$('#edit-list').sortable({
		handle	:	'span',
		update	:	function(event, ui) {
			// TODO Save list order to database
		},
		forcePlaceholderSize: true
	});



	/** FUNCTIONALITY **/

	// Add a new list item
	$("#add-new").submit(function(){
		newListItemText = $("#new-list-item-text").val();
		newPosVal = parseInt($("#new-list-item-pos").val());
		$.ajax({
			url     :   "list/add",
			type    :   "POST",
			data    :   "new-list-item-text=" + newListItemText + "&new-list-item-pos=" + newPosVal
		}).done(function( response ){
			$("#edit-list").append("<li id='" + response + "' rel='" + newPosVal + "' class='colorBlue'><span id='" + response + "'>" + newListItemText + "</span>" + appendTabs);
//			$("#edit-list").append("<li id='5' rel='" + newPosVal + "' class='colorBlue'><span id='5'>" + newListItemText + "</span>" + appendTabs);
			$("#new-list-item-text").val("");
			$("#new-list-item-pos").val(newPosVal + 1);
		});
		return false;
	});


	// Edit a list item
		// TODO



	// Show the delete button
		// TODO implement second click delete
	editList.on("click", ".deletebutton", function() {
		el = $(this);
		if(el.hasClass("click")) {
			var row = $(this).parent();
			$.ajax({
				url    :  "list/delete",
				type   :  "POST",
				data   :  "id=" + $(row).attr("id")
			}).done( function() {
				itemPos = $("#new-list-item-pos");
				curVal = itemPos.val() - 1;
					itemPos.val( curVal );
				$(row).remove();
			});
		} else {
			el.addClass("click").html("?");
		}
	});

	// Hide the delete button
	editList.on("mouseout", ".deletebutton", function() {
		el = $(this);
		if(el.hasClass("click")){
			el.removeClass("click").html("-");
		}
	});


	// DEPRECATED Function  -  Delete a list item
//	$("#edit-list").on('click', '.deletebutton', function() {
//		var row = $(this).parent();
//		$.ajax({
//			url    :  "list/delete",
//			type   :  "POST",
//			data   :  "id=" + $(row).attr("id")
//		}).done( function() {
//			curVal = $("#new-list-item-pos").val() - 1;
//			$("#new-list-item-pos").val( curVal );
//			$(row).remove();
//		});
//	});
});