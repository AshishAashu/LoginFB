<html>
	<head>
		<title>LoginFB/G+</title>	
	</head>
	<body>
		<div>
			<form method="post">
				<button value="FB" name="submit" type="submit">FB Login</button>	
				<button value="G+" name="submit" type="submit">G+ Login</button>	
			</form>
		</div>
		<?php
			if($_SERVER['REQUEST_METHOD'] == 'POST'){
				//include('Facebook/Facebook.php');
				require_once './Facebook/autoload.php';
				$fb = new Facebook\Facebook([
  					'app_id' => '351276868705190', // Replace {app-id} with your app id
  					'app_secret' => '157afe86fd8ec31e75bd39f5f1c46124',
  					'default_graph_version' => 'v2.12',
  				]);

				$helper = $fb->getRedirectLoginHelper();

				try {
  					$accessToken = $helper->getAccessToken();
				} catch(Facebook\Exceptions\FacebookResponseException $e) {
  				// When Graph returns an error
  					echo 'Graph returned an error: ' . $e->getMessage();
  					exit;
				} catch(Facebook\Exceptions\FacebookSDKException $e) {
  				// When validation fails or other local issues
  					echo 'Facebook SDK returned an error: ' . $e->getMessage();
  					exit;
				}
				if (! isset($accessToken)) {
  					if ($helper->getError()) {
    				header('HTTP/1.0 401 Unauthorized');
    				echo "Error: " . $helper->getError() . "\n";
    				echo "Error Code: " . $helper->getErrorCode() . "\n";
				    echo "Error Reason: " . $helper->getErrorReason() . "\n";
				    echo "Error Description: " . $helper->getErrorDescription() . "\n";
  					} else {
    					header('HTTP/1.0 400 Bad Request');
    					echo 'Bad request';
					}		
  					exit;
				}
				
				// Logged in
				echo '<h3>Access Token</h3>';
				var_dump($accessToken->getValue());
		
				// The OAuth 2.0 client handler helps us manage access tokens
				$oAuth2Client = $fb->getOAuth2Client();

				// Get the access token metadata from /debug_token
				$tokenMetadata = $oAuth2Client->debugToken($accessToken);
				echo '<h3>Metadata</h3>';
				var_dump($tokenMetadata);
				
			}	
		?>
	</body>
</html>