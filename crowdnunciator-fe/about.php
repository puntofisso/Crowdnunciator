<?php include "php/_header.php"; ?>

<div class="about">
	<h3 class="heading">About Crowdnunciator</h3>
	<p>
		Crowdnunciator crowdsources the Parliament Annunciator.<br/>
		It allows political geeks who watch debates on TV to enter the current speaker or the current status of the debate.<br/>
		The system then uses the <i>wisdom of the crowd</i> to decide what status to save.<br/>
		Crowdnunciator displays the result on the main page and allows developer to use its data by means of an API.
	</p>
	<h3 class="heading">API</h3>
	<h4 class="call">http://api.crowdnunciator.org.uk/annunciator</h4>
	<p>
		It returns the current annunciator status in a JSON format.
	</p>
	<pre>
{
	member_id: "40208",
	party: "Labour",
	constituency: "Doncaster North",
	name: "Edward Miliband",
	image: "/images/mps/11545.jpeg",
	minutes: 1
}
	</pre>
	<h4 class="call">http://api.crowdnunciator.org.uk/history</h4>
	<p>
		It returns the full history of annunciator statuses in a JSON format.
	</p>
	<pre>
[
	{
		member_id: "40253",
		party: "Conservative",
		constituency: "Esher and Walton",
		name: "Dominic Raab",
		image: "/images/mps/24815.jpeg",
		timestamp: "2013-11-15 11:12:13",
		minutes: 45
	},
	{
		member_id: "40250",
		party: "Conservative",
		constituency: "Epsom and Ewell",
		name: "Chris Grayling",
		image: "/images/mps/10920.jpg",
		timestamp: "2013-11-15 11:07:23",
		minutes: 50
	},
	{
		member_id: "40665",
		party: "Conservative",
		constituency: "Witney",
		name: "David Cameron",
		image: "/images/mps/10777.jpg",
		timestamp: "2013-11-12 20:37:38",
		minutes: 3799
	}
]
	</pre>
	<h3 class="heading">The Future?</h3>
	<p>
		We plan to make Crowdnunciator a real service and add new features like topics and searches. We also want to extend it to all of the activities of the Parliament, including the House of Lords and the Committees.
	</p>
	<h3 class="heading">Credits</h3>
	<p>
		We would like to thank <a href="http://www.theyworkforyou.com">TheyWorkForYou.com</a> for the personal details and pictures of MPs.
	</p>
</div>

<?php include "php/_footer.php"; ?>