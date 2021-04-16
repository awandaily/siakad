
<button type="button" onclick="loadDoc()">Request data</button>
<p id="demo"></p>
<script>
	function loadDoc() {
	  var xhttp = new XMLHttpRequest();
	  xhttp.onreadystatechange = function() {
	    if (this.readyState == 4 && this.status == 200) {
	      document.getElementById("demo").innerHTML = this.responseText;
	    }
	  };
	  xhttp.open("POST", "https://onesignal.com/api/v1/notifications", true);
	  xhttp.setRequestHeader("Content-type", "application/json; charset=utf-8");
	  xhttp.setRequestHeader("Authorization", "Basic NGEwMGZmMjItY2NkNy0xMWUzLTk5ZDUtMDAwYzI5NDBlNjJj");
	  xhttp.send("app_id=cb3431e0-8c50-4ab2-a53c-bad81e7f719e&included_segments=All&data=foo&contents=en");
	}
</script>