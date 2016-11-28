console.log("Inside forum.js");
$(document).ready(function(){
	console.log("Loading the text editor..");
	window['forum'] = function forum()
	{
	$("textarea").sceditor({
		plugins: "bbcode",
		toolbarExclude: "table",
		emoticonsRoot: "./images/smilies/",
		emoticons:
		{
			dropdown:
			{
				":)": "smile-24.png",
				":D": "smile_big-24.png",
				":angel:": "angel-24.png",
				":cool:": "cool-24.png",
				":(": "sad-24.png",
				":'(": "crying-24.png",
				":O": "surprise-24.png",
				":P": "raspberry-24.png",
				";)": "wink-24.png"
			},
			more:
			{
				":$": "embarrassed-24.png",
				":monkey:": "monkey-24.png",
				":|": "plain-24.png",
				":devil:": "devilish-24.png"
			}
		},
		style: "/sceditor/themes/modern.min.css"
	});
	
	console.log("Quick topic handling JS..");
	var newtopic = $('#newtopic');
	console.log("Hiding the QT form..");
	newtopic.hide();
	$('#newtopic_link').click(function() {
		newtopic.show();
		return false;
	});
	}
	forum();
});