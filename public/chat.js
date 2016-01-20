var POLLING_TIMEOUT = 3000;

function addEntryToChatHistory(id, message) {
	var element = document.createElement("li");
	element.dataset.entryid = id;
	element.className = "chat-entry";
	element.innerHTML = message;

	$("#chat-entries").prepend(element);
}

function prependChatHistory(entries) {
	$.each(entries, function(i, value) {
		addEntryToChatHistory(i, value);
	});
}

function prependChatHistorySince(mostRecentId) {
	$.ajax({
		url: "/since",
		type: "post",
		data: {
			"most_recent_id": mostRecentId,
		},
		dataType: "json",
		success: function(payload) {
			prependChatHistory(payload.entries);
			setTimeout(function() {
				updateChatHistory();
			}, POLLING_TIMEOUT);
		},
		error: function() {
			alert("Everything crashed. Please reload and hope for better times.");
		},
	});
}

function updateChatHistory() {
	var mostRecentId = $(".chat-entry").data("entryid");
	prependChatHistorySince(mostRecentId);
}

$(document).ready(function() {
	$.ajax({
		url: "/recent",
		type: "post",
		data: {},
		dataType: "json",
		success: function(payload) {
			prependChatHistory(payload.entries);
			setTimeout(function() {
				updateChatHistory();
			}, POLLING_TIMEOUT);
		},
		error: function() {
			alert("Everything crashed. Please reload and hope for better times.");
		},
	});

	$(document).on("submit", "#chat-form", function(e) {
		e.preventDefault();
		$.ajax({
			url: "/add",
			type: "post",
			data: {
				message: $("#chat-message").val(),
			},
			dataType: "json",
			success: function() {
				$("#chat-message").val("");
			},
			error: function() {
				alert("Something went wrong. Your message was not sent.");
			},
		});
	});
});

