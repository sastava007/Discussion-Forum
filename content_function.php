<?php
	function dispcategories()
	{
		include ('dbconn.php');    //to set connection to the database
		
		$select = mysqli_query($con, "SELECT * FROM categories");
		$i=0;
		while ($row = mysqli_fetch_assoc($select))
		{
			echo "<div class='dropdown'>";
			echo "<button class='dropbtn'>".$row['category_title']."</button><br>";
			dispsubcategories($row['cat_id']);
			echo "</div><br>";
			$i=$i+1;
			if($i>5)
				break;
		}
	}
	
	function dispsubcategories($parent_id)
	{
		include ('dbconn.php');
		$select = mysqli_query($con, "SELECT cat_id, subcat_id, subcategory_title, subcategory_desc FROM categories, subcategories WHERE ($parent_id = categories.cat_id) AND ($parent_id = subcategories.parent_id)");
		while ($row = mysqli_fetch_assoc($select))
		{
			echo "<a href='topics.php?cid=".$row['cat_id']."&scid=".$row['subcat_id']."' style='text-decoration: none;color:white;'><div class='dropdown-content'>
				  ".$row['subcategory_title']."</div></a><br>";
		}
	}
	
	function getnumtopics($cat_id, $subcat_id)
	{
		include ('dbconn.php');
		$select = mysqli_query($con, "SELECT category_id, subcategory_id FROM topics WHERE ".$cat_id." = category_id 
									  AND ".$subcat_id." = subcategory_id");
		return mysqli_num_rows($select);
	}

	//TO DISPLAY LIST OF TOPICS THAT HAVE BEEN CREATED INSIDE CATEGORY AND SUBCATEGORY

	function disptopics($cid, $scid)
	{
		include ('dbconn.php');
		$select = mysqli_query($con, "SELECT topic_id, author, title, date_posted, views,subcategory_title,content,replies FROM
			categories,subcategories,topics WHERE ($cid = topics.category_id) AND ($scid = topics.subcategory_id) AND ($cid =categories.cat_id) AND ($scid = subcategories.subcat_id) ORDER BY date_posted DESC");
		if (mysqli_num_rows($select) != 0)
		{
			$print = mysqli_fetch_assoc($select);

			echo "<div class='subcategory_title' style='font-size:4vw;color:green;font-weight:bold;font-family:'Ubuntu''>".$print['subcategory_title']."</div><br>";
			$select = mysqli_query($con, "SELECT topic_id, author, title, date_posted, views,subcategory_title,content,replies FROM
			categories,subcategories,topics WHERE ($cid = topics.category_id) AND ($scid = topics.subcategory_id) AND ($cid =categories.cat_id) AND ($scid = subcategories.subcat_id) ORDER BY date_posted DESC");
			while ($row = mysqli_fetch_assoc($select))
			{
			 echo"<div classs='topic'>
					<div class='content1'>
						<div class='title'><a href='readtopic.php?cid=".$cid."&scid=".$scid."&tid=".$row['topic_id']."' style='text-decoration: none; color:white; hover:{font-style:underline;}'>".$row['title']."</a>
						</div>
							<br>
							<div class='details'>
							 <i class='fa fa-user-circle' style='font-size:1.1vw;color:'></i> ".$row['author']." 
							 <br>
							 <i class='fa fa-calendar' style='font-size:1.1vw;color:'></i> ".$row['date_posted']."<br>
							 <a href='readtopic.php?cid=".$cid."&scid=".$scid."&tid=".$row['topic_id']."' style='text-decoration: none;'><i class='fa fa-comments-o' id='replies' style='font-size:1.5vw; color:black;'></i></a>  ".$row['replies']."
							<i class='fa fa-bar-chart' style='font-size:1.1vw; margin-left:60vw;font-size:1.5vw;'></i> Views: ".$row['views']."
							</div>
					</div>
					<div class='content'>
						<div>".$row['content']."</div>
					</div>
				</div>
				<br>";

			}
		} 
		else
		{
			echo "<p>Add first topic in this Subcategory <a href='newtopic.php?cid=".$cid."&scid=".$scid."'>
				 Add the very first topic like a boss!</a></p>";
		}
	}

	// TO DISPLAY THE CONTENT STORED INSIDE EACH TOPIC
	function disptopic($cid, $scid, $tid)
	{
		include ('dbconn.php');
		$select = mysqli_query($con, "SELECT cat_id, subcat_id,views,topic_id, author, title, content, date_posted FROM 
									  categories, subcategories, topics WHERE ($cid = categories.cat_id) AND
									  ($scid = subcategories.subcat_id) AND ($tid = topics.topic_id)");
		$row = mysqli_fetch_assoc($select);
		echo ("
		<div class='content1'>
				<div class='title'> ".$row['title']."</div><br>
				<div class='details'>
							 <i class='fa fa-user-circle' style='font-size:1.1vw;color:'></i> ".$row['author']."<br> 
							 <i class='fa fa-calendar' style='font-size:1.1vw;color:'></i> ".$row['date_posted']."<br>
							<i class='fa fa-bar-chart' style='font-size:1.1vw;font-size:1.5vw;'></i> Views: ".$row['views']."
				</div>
		</div>
				<div class='content'> ".$row['content']." </div><br>");
								
	}

	function dispfeed()
	{
		include ('dbconn.php');
		$select = mysqli_query($con, "SELECT author,topic_id,category_id,subcategory_id, title, content, date_posted FROM 
									  topics ORDER BY topic_id DESC");
		$i=0;
		while ($row = mysqli_fetch_assoc($select))
		{
			echo"<div classs='topic'>
					<div class='content1'>
						<div class='title'><a href='readtopic.php?cid=".$row['category_id']."&scid=".$row['subcategory_id']."&tid=".$row['topic_id']."' style='text-decoration: none; color:white; hover:{font-style:underline;}'> ".$row['title']."</a> </div>
							<br>
							<div class='details'>
							 <i class='fa fa-user-circle' style='font-size:1.1vw;color:'></i> ".$row['author']."<br> <i class='fa fa-calendar' style='font-size:1.1vw;color:'></i> ".$row['date_posted']."
							</div>
					</div>
					<div class='content'>
						<div>".$row['content']."</div>
					</div>
				</div>
				<br>";
			$i=$i+1;
			if($i>4)
				break;
		}
	}
	function add_upvote($rid,$id)
	{
		static $i=0;
		include ('dbconn.php');
		if($i%2==0)
		{
			$query2=mysqli_query($con,"UPDATE users SET rating=rating+1 WHERE ID=".$id."");
			$query=mysqli_query($con,"UPDATE replies SET upvote=upvote+1 WHERE reply_id=".$rid." ");
		}
		else
		{
			echo("Working");
			$query2=mysqli_query($con,"UPDATE users SET rating=rating WHERE ID=".$id."");
			$query=mysqli_query($con,"UPDATE replies SET upvote=upvote-1 WHERE reply_id=".$rid." ");
		}
		 $i= $i+1;
	}
	
	function addview($cid, $scid, $tid)
	{
		include ('dbconn.php');
		$update = mysqli_query($con, "UPDATE topics SET views = views + 1 WHERE category_id = ".$cid." AND
									  subcategory_id = ".$scid." AND topic_id = ".$tid."");
	}
	
	function replylink($cid, $scid, $tid)
	{
		echo "<p><a href='replyto.php?cid=".$cid."&scid=".$scid."&tid=".$tid."'>Reply to this post</a></p>";
	}
	
	function replytopost($cid, $scid, $tid)
	{
		echo "<div class='content'>
				<form action='addreply.php?cid=".$cid."&scid=".$scid."&tid=".$tid."' method='POST'>
			  		<h2 style='text-align:center;'>Add Comment</h2>
			  		<textarea cols='80' rows='5' id='comment' name='comment' required style='height:15vw; width:30vw; align-items:center;'></textarea><br>
			  		<input type='submit' value='Submit'>
			  	</form>
			  	<br><br>
			  </div>";
	}
	
	function dispreplies($cid, $scid, $tid)
	{
		include ('dbconn.php');
		$select = mysqli_query($con, "SELECT replies.author, comment,ID,upvote,reply_id, replies.date_posted FROM categories, subcategories, 
									  topics, replies,users WHERE ($cid = replies.category_id) AND ($scid = replies.subcategory_id)
									  AND ($tid = replies.topic_id) AND ($cid = categories.cat_id) AND 
									  ($scid = subcategories.subcat_id) AND (username = replies.author) AND ($tid = topics.topic_id) ORDER BY reply_id ASC");

		//THIS WILL ONLY SHOW REPLIES IF THEY EXIST, WHICH MEANS IF n(REPLIES) >0
		 
		if (mysqli_num_rows($select) != 0)
		{
			echo "<div class='content5'>";
			$i=0;
			while ($row = mysqli_fetch_assoc($select))   
			{

				if($i%2==0)
					echo "<div style='background-color:#FBCD5C;'> ";
				echo " 
					<i class='fa fa-user-circle' style='font-size:1.1vw; padding-left: 0.8vw;'></i> ".$row['author']." <br>
					<i class='fa fa-calendar' style='font-size:1.1vw; padding-left: 0.8vw;'></i> ".$row['date_posted']."<br>
					".$row['comment']."<br><br>   
					<a href='add_upvote.php?rid=".$row['reply_id']."&cid=".$cid."&scid=".$scid."&tid=".$tid."&uid=".$row['ID']." ' onclick='disable()'> Upvote<i class='fa fa-arrow-up' id='upvote' style='font-size:1.4vw;'></i></a> ".$row['upvote']."";
					echo"<a href='deletereply.php?rid=".$row['reply_id']."&cid=".$cid."&scid=".$scid."&tid=".$tid."&uid=".$row['ID']."' style='text-align:right; color:black;text-decoration:none;'><i class='fa fa-trash' style='font-size:1.5vw; padding-left: 0.8vw;'></i>Delete</a>";
				if($i%2==0)
				echo "</div>";
				$i=$i +1;
			}
			echo "</div>";
		}

	}
	
	function countReplies($cid, $scid, $tid)
	{
		include ('dbconn.php');
		$select = mysqli_query($con, "SELECT category_id, subcategory_id, topic_id FROM replies WHERE ".$cid." = category_id AND 
									  ".$scid." = subcategory_id AND ".$tid." = topic_id");
		return mysqli_num_rows($select);
	}

	function leaderboard()
	{
		include ('dbconn.php');
		$i=0;
		$select=mysqli_query($con,"SELECT * from users ORDER BY rating DESC");
		while ($row=mysqli_fetch_assoc($select))
		{
			echo "<div style='display:flex;flex-direction:column;'>
			<div style='display:flex;flex-direction:row;'>
			<div style='width:80%; padding-left:0vw;'><i class='fa fa-trophy' style='font-size:1.4vw;color:white; '></i> ".$row['name']."</div>
			<div>".$row['rating']."</div>
			</div></div>";
			if($i==4)
				break;
			$i=$i+1;
		}
	}
	function pending_request()
	{
		include ('dbconn.php');
		$query=mysqli_query($con,"SELECT ID,name,username,email,phone FROM users where verified=0 ");
		echo("<div style='text-align:center;font-size:5vw;font-weight:bold;font-family:Ubuntu;color:white;'>Admin Page</div><br><br>

			<div style='text-align:center;font-size:3vw;font-weight:bold;font-family:Ubuntu;color:white;'>Pending Requests</div><br><br>");
		while($row=mysqli_fetch_assoc($query))
		{
			echo "<div>
			<center>
			<a href='verify.php?id=".$row['ID']."'>
			<div class='user' style='background-color:#e9164b;padding:1vw; width: 20vw; color:white; font-family:Ubuntu; '>Name: ".$row['name']." <br><br> Username ".$row['username']." <br><br> Email: ".$row['email']." <br><br> Phone: ".$row['phone']."</div><br><br>
			</a>
			</center>
			";
		}

	}

?>
