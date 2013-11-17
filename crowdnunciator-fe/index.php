<?php include "php/_header.php"; ?>
	
<script src="js/jquery.min.js"></script>
		<div class="speaker">
			<h3 id="speakingnow" class="heading">
			</h3>
			<div id="profile" class="profile" style=""></div>
			<h1 id="mp" class="name"></h1>
			<div class="edit">
				<a href="change-speaker.php">Update</a>
			</div>
			<h2><span id="party"></span></h2>
			<h2><span id="duration"></span></h2>
		</div>
		<!--div class="topic">
			<h3 class="heading">
				Topic
			</h3>
			<h1 class="topic">Topic</h1>
			<div class="edit">
				<a href="">Edit</a>
			</div>
			<h2>
				Speaker previously voted <span class="vote">moderately for</span> topic
			</h2>
		</div-->
		<script>

    var $url = 'http://api.crowdnunciator.org.uk/annunciator';

    function getAnnunciator() {
        // Make ajax request
    $.ajax({
        
     url: $url,
     async:'false',
     dataType:'json',
     success: function(data) {

     		var $member_id = data.member_id;

     		if (!(($member_id=='99990') || ($member_id=='99991') || ($member_id=='99992'))) {
     			$('#duration').text('Has been speaking for '+data.minutes+' minutes');
     			$('#party').text(data.party+' MP for '+data.constituency);

     			$('#speakingnow').text('Speaker');
				$('#profile').css('background-image','url(".'+data.image+'")');
				$('#profile').css('background-size','100%');
				
 
     		} else {
     			$('#duration').text('');
     			$('#party').text('');
				$('#speakingnow').text('');
     			
				$('#profile').css('background-image','');
				$('#profile').css('background-size','');

     		}

            $('#mp').text(data.name);
			
			
        }});}
    </script>
  

    <script type="text/javascript">
      $(document).ready(function () {
          getAnnunciator();
          var interval = setInterval(function() {getAnnunciator(); }, 30000);
        });
    </script>   
<?php include "php/_footer.php"; ?>
