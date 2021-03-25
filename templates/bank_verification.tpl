{block name='style'}
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{$url_path}css/bank_verification.css" />
	<link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />
	
	
	<script src="{$url_path}/criipto_assets/jwt-decode.jsv=1.0"></script>
	<script src="{$url_path}/criipto_assets/easyid.js?v=1.0"></script>
	
	
{/block}



{block name="content"}
   
        <div class="headers"id="getFixed">
            <div class="headers-inner">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 padding-1">
                    <div class="logo-text">
                        <a href="#"><img class="img-responsive" src="{$url_path}images/bank_verification/logo.png"></a>
                        <!--<h3>Demo Bank</h3> -->
                    </div>
                </div>
            </div>
        </div> <!-- headers -->

        <div class="boxes-section">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 padding">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 box-1">
                    <div class="box-inner">
                        <img class="img-responsive" src="{$url_path}images/bank_verification/ComputerPetrol.png">
                        <h4>BankID on same Device</h4>
                        <p>Click here if your BankID resides on this device.</p>
                        <a href="#" class="login-btn" onClick="signNow('same');">Log in</a>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 box-2">
                    <div class="box-inner">
                        <img class="img-responsive" src="{$url_path}images/bank_verification/MobilePetrol.png">
                        <h4>BankID on other mobile device</h4>
                        <p>If your BankID resides on a different mobile device, click on Log in and scan the QR code with your device.</p>
                        <a href="#" class="login-btn"  onClick="signNow('other');">Log in</a>
                    </div>
                </div>
            </div>
        </div>
		
		<input type="hidden" name="text_to_send" id="text_to_send" value="{$text_to_send}"/>
		<input type="hidden" name="acrn_value" id="acrn_value" value="{$acrn_value}"/>
		<input type="hidden" name="ssn" id="ssn" value="{$ssn}"/>
		<input type="hidden" name="back_url" id="back_url" value="{$back_url}"/>
		<input type="hidden" name="criipto_domain" id="criipto_domain" value="{$criipto_domain}"/>
		<input type="hidden" name="criipto_client_id" id="criipto_client_id" value="{$criipto_client_id}"/>
	
{/block}

{block name="script"}
	<script type="text/javascript">
		function signNow(varification_type) 
		{
		
			if(varification_type == 'same')
			{
				var signMethod = "urn:grn:authn:se:bankid:same-device";
			}else{
				var signMethod = "urn:grn:authn:se:bankid:another-device";
			}
			
			var text_to_send 	= $('#text_to_send').val();
			var acrn_value 		= $('#acrn_value').val();
			var ssn 			= $('#ssn').val();
			var back_url 		= $('#back_url').val();
			var criipto_domain 		= $('#criipto_domain').val();
			var criipto_client_id 		= $('#criipto_client_id').val();
			
			
			console.log("start response1212");
			console.log(acrn_value);
			console.log(text_to_send);
				
			
		//	var domain = "time2viewse.criipto.id"; // E.g. "mytenant.grean.id"
		//	var clientID = "urn:auth0:dev-crd91lc1"; //  E.g. "urn:easyid:mycompany:app7"
			
			var domain = criipto_domain; 
			var clientID = criipto_client_id; 
			var easyID = new EasyID(domain, clientID,ssn,back_url,signMethod);
				
				
				
				const options = {
					signMethod: signMethod,
					iframeID: "signhere",
					ssn: ssn,
					back_url:back_url
				};
				// Supply a callback function to have the result delivered right here in front end ...
				
				/* 
				easyID.sign(text_to_send, options, function (err, response) {
					if (!err) {
						doSomethingWithSignature(response);  
					}else
					{
						
					}
				});
				*/
				
				easyID.sign(text_to_send, options,back_url);
		}
		
		function doSomethingWithSignature(response) {
            var token = jwt_decode(response);
            console.log("start response");
            console.log(token);
            var signedText = token.signtext;
			
			var tokenEvidence = window.atob(token.evidence);
          
           
			$.ajax({
			  type: "POST",
			  url: "{$url_path}sign_back_url.php",
			  data: {  "evidence" : tokenEvidence,
						"owner_name":token.name,
						"ssn":token.ssn,
						"signtext":token.signtext,
						"ocspResponse":token.ocspResponse},
			  cache: false,
			  success: function(data){
				// $("#resultarea").text(data);
				 
				window.location.href = data;
			  }
			});
		   
           
        }
	</script>
	
{/block}