$(function() {


	/** Global Vars **/
	var csrf_token = $("#csrf_token").val();


	/** Functions **/

	function noListCheck(obj)
	{
		if( obj.children().length > 0 )
		{
			$("#no-list").addClass("hide");
		} else
		{
			$("#no-list").removeClass("hide");
		}
	}

	function notifier(msg, type)
	{
		var notifier = $("#notifier");
		var typeClass = "";
		if(type == "error")
		{
			typeClass = "error";
		}

		notifier.show();
		notifier.prepend("<p class='"+typeClass+"'>"+msg+"</p>");

		// The :gt() selector must be one less than the number you want...
		// so :gt(4) leaves 5 messages showing.
		notifier.children(":gt(4)").fadeOut({always:function(){$(this).remove();}});
	}




	/** UI STUFF **/

	var appendTabs = "<div class='delete'>-</div><div class='done'></div><div class='dragger'></div>";
	var editList = $("#edit-list");

	// Initialize UI
	$('#edit-list li').append(appendTabs);
	$('#form-add-new').removeClass("hide");

	// On notifier message click - close
	$("#notifier").on('click', 'p', function() {
		$(this).fadeOut({always:function(){$(this).remove();}});
	});

	// Hide the delete button
	editList.on("mouseout", ".delete", function() {
		el = $(this);
		if(el.hasClass("click")){
			el.removeClass("click").html("-");
		}
	});




	/** FUNCTIONALITY **/

	// Bind AJAX Sends with our CSRF Token
	$(document).ajaxSend(function(event, xhr, settings) {
		xhr.setRequestHeader("X-CSRF-Token", csrf_token);
	});


	// Mark as done
	editList.on('click', '.done', function() {
		thisLI = $(this).parent();
		$.ajax({
			url     :   "list/update/done",
			type    :   "POST",
			context :   thisLI,
			data    :   "id=" + thisLI.attr("id"),
			dataType:   "json"
		}).done(function( data ){                   // Response is error message
			if(!data.err) {
				if(!$(this).hasClass("crossout")) {
					$(this).addClass("crossout");
				} else {
					$(this).removeClass("crossout");
				}
			} else {
				notifier(data.message, "error");
			}
		});
	});

	// Make list item editable
	//$(".list li span").on('click', function() { $(this).hide(); });
	$(".list li span").editable('list/update/edit');

	// Make the list sortable
	editList.sortable({
		handle	:	'.dragger',
		update	:	function() {
			postData = editList.sortable("serialize", {key : "id[]",expression : "(.+)"});
			$.ajax({
				url     :   "list/update/order",
				type    :   "POST",
				data    :   postData,
				dataType:   "json"
			}).done(function(data) {
				if(data.err) {
					notifier( data.message, "error" );
					editList.sortable("cancel");
				}
			});
		},
		forcePlaceholderSize: true
	});


	// Add a new list item
	$("#form-add-new").submit(function(){
		var thisInput = $("#add-new-item-text");
		$.ajax({
			url     :   "list/add",
			type    :   "POST",
			data    :   "add-new-item-text=" +  thisInput.val(),
			dataType:   "json"
		}).done(function( data ){

//			var data = $.parseJSON( response );
			if( !data.err ) {
				editList.append("<li id='" + data.id + "' rel='" + data.newPos + "' class=''><span id='" + data.id + "'>" + data.text + "</span>" + appendTabs);
				thisInput.val("");
				noListCheck(editList);
		    } else {
				notifier( data.message, "error" );
			}
		});
		return false;
	});


	// On first click: Show the delete button
	// On second click: Perform item delete
	editList.on("click", ".delete", function() {
		el = $(this);
		if(el.hasClass("click")) {
			var row = $(this).parent();
			$.ajax({
				url    :  "list/delete",
				type   :  "POST",
				context:  row,
				data   :  "id=" + row.attr("id"),
				dataType:   "json"
			}).done( function(data) {
				if(data.err) {
					notifier( data.message, "error" );
				} else {
					$(this).remove();
					noListCheck(editList);
				}
			});
		} else {
			el.addClass("click").html("?");
		}
	});

});