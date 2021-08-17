phar: 
	cd src/ && php --define phar.readonly=0 compile.php
	mv src/json-cli.phar json-cli
	chmod +x json-cli
