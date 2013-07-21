$(function() {



	/** Functions **/
	function noListCheck(obj)
	{
		if( obj.children().length > 0 ) {
			$("#no-list").addClass("hide");
		} else {
			$("#no-list").removeClass("hide");
		}
	}


	/** UI STUFF **/

	var appendTabs = "<div class='delete'>-</div><div class='done'></div><div class='dragger'></div>";
	var editList = $("#edit-list");


	// Set up UI
	$('#edit-list li').append(appendTabs);
	noListCheck(editList);

	// Mark as done
	editList.on('click', '.done', function() {
		thisLI = $(this).parent();
		$.ajax({
			url     :   "list/update/done",
			type    :   "POST",
			data    :   "id=" + thisLI.attr("id")
		}).done(function( response ){
			if(!thisLI.hasClass("crossout")) {
				thisLI.addClass("crossout");
			} else {
				thisLI.removeClass("crossout");
			}
		});
	});


	// Make the list sortable
	$('#edit-list').sortable({
		handle	:	'.dragger',
		update	:	function(event, ui) {
			postData = $("#edit-list").sortable("serialize", {key : "id[]",expression : "(.+)"});
			$.ajax({
				url     :   "list/update/order",
				type    :   "POST",
				data    :   postData
			});
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
			$("#edit-list").append("<li id='" + response + "' rel='" + newPosVal + "' class=''><span id='" + response + "'>" + newListItemText + "</span>" + appendTabs);
			$("#new-list-item-text").val("");
			$("#new-list-item-pos").val(newPosVal + 1);
			noListCheck(editList);
		});
		return false;
	});


	// Edit a list item
		// TODO Edit list item function



	// Show the delete button
	editList.on("click", ".delete", function() {
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
				noListCheck(editList);
			});
		} else {
			el.addClass("click").html("?");
		}
	});


	// Hide the delete button
	editList.on("mouseout", ".delete", function() {
		el = $(this);
		if(el.hasClass("click")){
			el.removeClass("click").html("-");
		}
	});


});