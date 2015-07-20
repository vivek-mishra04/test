<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>SocialNet</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<?php
include('config.inc');
// Inialize session
session_start();
// Check, if username session is NOT set then this page will jump to login page
 if (!isset($_SESSION['username'])) {
 header('Location: index.php');
 }
           $style="style.css";
           $sid=$_SESSION['sid'];
           $result = mysql_query("SELECT * FROM user WHERE (SID = '" . mysql_real_escape_string($sid) . "') ");
           $row = mysql_fetch_assoc($result);
          $style = "profiles/".$row["style"];
		   


?>

<link href="<?php echo $style; ?>" rel="stylesheet" type="text/css" />
<style type="text/css">
#apDiv1 {
	position: absolute;
	width: 398px;
	height: 33px;
	z-index: 1;
	left: 352px;
	top: 13px;
}
</style>
<script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="js/script.js"></script>
<script type="text/javascript" src="js/cufon-yui.js"></script>
<script type="text/javascript" src="js/arial.js"></script>
<script type="text/javascript" src="js/cuf_run.js"></script>
<script type="text/javascript" src="jquery-1.2.6.min.js"></script>
<script type="text/javascript" src="jquery.livequery.js"></script>
<link href="dependencies/screen.css" type="text/css" rel="stylesheet" />

<script src="jquery.elastic.js" type="text/javascript" charset="utf-8"></script>

<script src="jquery.watermarkinput.js" type="text/javascript"></script>

<script type="text/javascript">

	// <![CDATA[

	$(document).ready(function(){
-
		$('#shareButton').click(function(){

			var a = $("#watermark").val();
			if(a != "What's on your mind?")
			{
				$.post("posts.php?value="+a, {

				}, function(response){

					$('#posting').prepend($(response).fadeIn('slow'));
					$("#watermark").val("What's on your mind?");
				});
			}
		});


		$('.commentMark').livequery("focus", function(e){

			var parent  = $('.commentMark').parent();
			$(".commentBox").children(".commentMark").css('width','320px');
			$(".commentBox").children("a#SubmitComment").hide();
			$(".commentBox").children(".CommentImg").hide();

			var getID =  parent.attr('id').replace('record-','');
			$("#commentBox-"+getID).children("a#SubmitComment").show();
			$('.commentMark').css('width','300px');
			$("#commentBox-"+getID).children(".CommentImg").show();


		});

		//showCommentBox
		$('a.showCommentBox').livequery("click", function(e){

			var getpID =  $(this).attr('id').replace('post_id','');

			$("#commentBox-"+getpID).css('display','');
			$("#commentMark-"+getpID).focus();
			$("#commentBox-"+getpID).children("CommentImg").show();
			$("#commentBox-"+getpID).children("a#SubmitComment").show();
		});

		//SubmitComment
		$('a.comment').livequery("click", function(e){

			var getpID =  $(this).parent().attr('id').replace('commentBox-','');
			var comment_text = $("#commentMark-"+getpID).val();

			if(comment_text != "Write a comment...")
			{
				$.post("add_comment.php?comment_text="+comment_text+"&post_id="+getpID, {

				}, function(response){

					$('#CommentPosted'+getpID).append($(response).fadeIn('slow'));
					$("#commentMark-"+getpID).val("");
				});
			}

		});

		//more records show
		$('a.more_records').livequery("click", function(e){

			var next =  $('a.more_records').attr('id').replace('more_','');

			$.post("posts.php?show_more_post="+next, {

			}, function(response){
				$('#bottomMoreButton').remove();
				$('#posting').append($(response).fadeIn('slow'));

			});

		});

		//deleteComment
		$('a.c_delete').livequery("click", function(e){

			if(confirm('Are you sure you want to delete this comment?')==false)

			return false;

			e.preventDefault();
			var parent  = $('a.c_delete').parent();
			var c_id =  $(this).attr('id').replace('CID-','');

			$.ajax({

				type: 'get',

				url: 'delete_comment.php?c_id='+ c_id,

				data: '',

				beforeSend: function(){

				},

				success: function(){

					parent.fadeOut(200,function(){

						parent.remove();

					});

				}

			});
		});

		/// hover show remove button
		$('.friends_area').livequery("mouseenter", function(e){
			$(this).children("a.delete").show();
		});
		$('.friends_area').livequery("mouseleave", function(e){
			$('a.delete').hide();
		});
		/// hover show remove button


		$('a.delete').livequery("click", function(e){

		if(confirm('Are you sure you want to delete this post?')==false)

		return false;

		e.preventDefault();

		var parent  = $('a.delete').parent();

		var temp    = parent.attr('id').replace('record-','');

		var main_tr = $('#'+temp).parent();

			$.ajax({

				type: 'get',

				url: 'delete.php?id='+ parent.attr('id').replace('record-',''),

				data: '',

				beforeSend: function(){

				},

				success: function(){

					parent.fadeOut(200,function(){

						main_tr.remove();

					});

				}

			});

		});

		$('textarea').elastic();

		jQuery(function($){

		   $("#watermark").Watermark("What's on your mind?");
		   $(".commentMark").Watermark("Write a comment...");

		});

		jQuery(function($){

		   $("#watermark").Watermark("watermark","#369");
		   $(".commentMark").Watermark("watermark","#EEEEEE");

		});

		function UseData(){

		   $.Watermark.HideAll();

		   //Do Stuff

		   $.Watermark.ShowAll();

		}

	});

	// ]]>

</script>
</head>

<body>
<div class="main">
<div class="main_resize">
    <div class="header">


      <h1 align="left"><a href="home.php"><span>iRGIT</span><small>Networking Site</small></a>   </h1>




        <div id="apDiv1" align="right">
        <form id="form1" name="form1" method="get" action="search/">

            <input type="text" width="500" height="30" name="search_key_word" id="search" />
            <input type="submit" name="search" id="search" value="Search" />
          </form>
        </div>

<hr width="100%">
  </div>
  
  
  
 <div class="menu_nav">
      <div class="clr"></div>
  </div>
<div i
class="clr"></div>

  <div class="content">
      <div class="content_bg">
        <div class="mainbar">

        <div align="center">

        <div class="UIComposer_Box">

        <form action="" method="post" name="postsForm">

       		<textarea class="input" id="watermark" name="watermark" style="height:20px" cols="60"></textarea>
        <br>

  		<input name="submit" type="button" value="Update" id="shareButton" style="float:left" class="smallbutton Detail" />
        <a href ="photos/">
        <input name="upload" type="button" value="Upload photos" align="left"/> </a>

        </form>
        </div>
        </div>

        <div id="posting" align="center">

    <br />
    <br/>




        <?php
	include('config.inc');
    include_once('posts.php');?>






        </div>



        </div>

        <div class="sidebar" "position:fixed">


          <div class="gadget">
            <div class="clr"></div>
            <ul class="sb_menu">
              <li class="active"><a href="home.php">Home</a></li>
              <li><a href="photos/">Photos</a></li>
              
              <li><a href="recommender/">Recommender</a></li>
              <li><a href="profiles/friends.php">Friend list</a></li>
              <li><a href="messages/">Messages</a></li>
              <li><a href="notices/">Notices</a></li>
            </ul>
          </div>



      <div class="clr"></div>


      <div class="gadget">
        <div class="clr"></div>

        <ul class="sb_menu">
          <li><br />
            <?php
           //$sid=$_SESSION['sid'];
		
		   $roll_no=$_SESSION['user_id'];
           $result = mysql_query("SELECT * FROM mymembers WHERE USER_ID = '".$roll_no."'");
		  // echo $result;
           $row = mysql_fetch_assoc($result);
           echo  "<p class=\"sidebar\">";
		  
		   
           echo $row["firstname"]." ".$row["lastname"];
           echo "</p><p>";
           $uid = $row["id"];
           echo "<a href=profiles/profile.php?id=".$uid."><img src=\"profiles/members/".$uid."/image01.jpg\" width=\"200\" height=\"200\"></a></p>";
          ?>
          <br />
          </div>

          </li>
        </ul>


        <div class="gadget">
          <div class="clr"></div>
          <ul class="sb_menu">
            <li><a href="MAR/">MAR</a></li>
            <li><a href="quiz/">Quiz</a></li>
            <li><a href="forum/">Forum</a></li>
            <li ><a href="profiles/edit_profile.php">Account settings</a></li>
            <li><a href="logout.php">Logout</a></li>
          </ul>
        </div>



      <div class="clr"></div>
    </div>


      <div class="clr"></div>
    </div>



  </div>
</div>
<div class="footer">
  <div class="footer_resize">
       <div class="clr"></div>
  </div>
</div>
<div align=center>This is a project by Vivek</div></body>
</html>
