var groups = false;
var users = false;

// Just incase we don't have a WYSIWYG editor enabled..
if (typeof editor_insert == 'function')
{
	function editor_insert(content, editorID)
	{
		if(typeof(editorID)!=='undefined') $("#" + editorID).append(content);
		else
		{
			for(var editor in editorList)
			{
				$("#" + editorList[editor]).append(content);
			}
		}
	}
}

$(function() {
	console.log("Loaded topic.js");
	window['topic'] = function topic()
	{
	console.log("Executing topic.js");
	if (typeof editor_init == 'function') editor_init('.texteditor');
	
	$(".quote").click(function(){
		var post = $(this).parents(".post-body");
		var pid = post.attr("id");
		pid = pid.replace('pid','');
		var quote = post.find(".post-content").text();
		//$("#quick-content").append("[quote pid="+pid+"]"+quote+"[/quote]");
		//$('textarea').sceditor('instance').insert("[quote pid="+pid+"]"+quote+"[/quote]");
		//$('.texteditor').sceditor('instance').insert("[quote pid="+pid+"]"+quote+"[/quote]");
		editor_insert("[quote pid="+pid+"]"+quote+"[/quote]");
		return false;
	});
	
	var selectedPosts = [];
	$('.postSelector').click(function() {
		var postIDRaw = $(this).attr('id');
		var postID = postIDRaw.split('_',3)[1];
		selectedPosts.push(postID);
	});
	$('.postModAction').click(function() {
		postIDs = {};
		for (var i = 0; i < selectedPosts.length; i++)
		{
			postIDs.selectedPosts[i] = -1;
			console.log(selectedPosts[i]);
		}
		$.ajax({
			data: postIDs
		});
		return false;
	});
	/*$('.topic_context_merge_posts').click(function(){
		
	});*/
	}
	topic();
});