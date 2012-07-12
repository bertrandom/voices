# Were my credentials compromised in the recent Yahoo Voices hack?

<http://voices.thatsaspicymeatball.com/>

Script to create JSON hashes of the compromised credentials and a web page to look them up.

## Creating the hashes

First, acquire `yahoo-disclosure.txt` from whatever source you can find it.

Next, strip out everything except the raw data:

	tail -453509 yahoo-disclosure.txt | head -n 453492 > emails.txt
	
Parse the data into JSON hash files:

	php parse.php
	
Created by Bertrand Fan on July 7, 2012