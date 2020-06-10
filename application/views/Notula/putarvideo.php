
<!DOCTYPE html>

<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Putar Video</title>
	<link rel="stylesheet" type="text/css" href="">
	
</head>

	<body >
		<div style="margin-right: auto; margin-left: auto;">
			<video autoplay="autoplay" style="width: 50%; max-width: 50%; margin-right: auto; margin-left: auto;" controls>
			<source src="<?php echo base_url().'uploads/video/'.$data[0]->pathvideo ?>" type="video/webm" />;
			</video>
		</div>			
	</body>
</html>