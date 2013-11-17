<?php include "php/_header.php"; ?>
	<script src="js/jquery.min.js"></script>
	<script src="js/typeahead.min.js"></script>
	<script src="js/hogan-2.0.0.js"></script>
		<div class="speaker edit-speaker">
			<h3 class="heading">
				Different Speaker?
			</h3>
			<div class="select">
				<input id="typeaheadinput" class="typeahead" type="text" placeholder="Start typing MP name">
			</div>
			<div class="commit">
				<a id="submitmp">Save Speaker</a>
			</div>
		</div>
    <div class="edit-other">
      <h3 class="heading">
        Something Else Changed?
      </h3>
      <a id="submitdivision" class="division">Division Bell</a> 
      <a id="submitend" class="debate-end">End of Debate</a>
      <a id="submitvoting" class="voting">Voting</a>
    </div>
		<script type="text/javascript">
$('.edit-speaker .typeahead').typeahead([
  {
    name: 'mp-list',
    prefetch: 'js/mps_info.json',
    valueKey: 'name',
    template: '<div class="mp"><img src=".{{image}}"/><p class="name">{{name}}</p><p class="party">{{party}}</p><span id="mp_id" style="visibility:hidden">{{member_id}}</span></p></div>',
    engine: Hogan,
    limit: 10
  }
]);

</script>

<script type="text/javascript">
$("#submitmp").click(function(e)
{
	e.stopPropagation();
	var inp = document.getElementById('mp_id').innerHTML;
	var mpurl = "http://api.crowdnunciator.org.uk/push/"+inp;
	
    $.ajax({
       type: "GET",
       url: mpurl,
       success: function(msg){
         alert( "Updated!"); 
         window.location.replace("http://crowdnunciator.org.uk");
       },
       error: function(xhr, textStatus, errorThrown){  
          alert("Error!"); 
        } 
     });
});

$("#submitdivision").click(function(e)
{
  e.stopPropagation();
  
  var mpurl = "http://api.crowdnunciator.org.uk/push/99991";
  
    $.ajax({
       type: "GET",
       url: mpurl,
       success: function(msg){
         alert( "Updated!"); 
         window.location.replace("http://crowdnunciator.org.uk");
       },
       error: function(xhr, textStatus, errorThrown){  
          alert("Error!"); 
        } 
     });
});

$("#submitend").click(function(e)
{
  e.stopPropagation();
  var mpurl = "http://api.crowdnunciator.org.uk/push/99990";
  
    $.ajax({
       type: "GET",
       url: mpurl,
       success: function(msg){
         alert( "Updated!"); 
         window.location.replace("http://crowdnunciator.org.uk");
       },
       error: function(xhr, textStatus, errorThrown){  
          alert("Error!"); 
        } 
     });
});

$("#submitvoting").click(function(e)
{
  e.stopPropagation();
  var mpurl = "http://api.crowdnunciator.org.uk/push/99992";
  
    $.ajax({
       type: "GET",
       url: mpurl,
       success: function(msg){
         alert( "Updated!"); 
         window.location.replace("http://crowdnunciator.org.uk");
       },
       error: function(xhr, textStatus, errorThrown){  
          alert("Error!"); 
        } 
     });
});
</script>
<?php include "php/_footer.php"; ?>