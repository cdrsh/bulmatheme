<?php
	//Comments form
	comment_form(array(
		"fields"=>array('author', 'email', 'url'),
		"class_submit"=>"button is-info",
		"title_reply"=>"",
		"label_submit"=>"Comment",
		"comment_field"=>
			"<p class=\"comment-form-comment\">
			<br>
			<textarea 
				class=\"textarea\" 
				id=\"comment\" 
				name=\"comment\" 
				cols=\"45\" 
				rows=\"8\" 
				aria-required=\"true\"
			></textarea>
			</p><br>"
	),get_the_ID());

	//Next/prev comments group
	the_comments_navigation();

	//Comments paginator
	paginate_comments_links();
?>

<hr>

<ul>
	<?php
		//Comments list
		wp_list_comments(array(
			//Get all comments without paginator
			//'per_page'=>9999,
			//'page'=>1,
			'avatar_size'=>16,
			'reply_text'=>'<button class="button is-info">Answer</button>',
			'login_text'=>'Only registered users can comment'
		));
	?>
</ul>

<?php
	//Prev comment link
	previous_comments_link("Previous comment");

	print("<br>");
	
	//Next comment link
	next_comments_link("Next comment");
?>