<?php
/**
* Template Name: page-test
*
*/

get_header();
?>
<br><br><br><br><br><br>
<h1>TESSST</h1>
  <div>
    <button id="test">Test simple</button>
    <button id="testtoken">Test token</button>
    <button id="goodLogin">Good Login</button>
    <button id="badLogin">Bad Login</button>
    <button id="logout">Logout</button>
</div>
<br><br><br><br><br><br><br><br><br><br><br><br>

<script>
    var apiHost = 'http://newcitizen:81/jjj.php';



jQuery(document).ready(function() {
    jQuery('#testtoken').click(function() {
    
    
    	console.log( "i got token ??? " + localStorage.token);
    
      jQuery.ajax({
        type: 'GET',
        //url: '/api/profile',
        url: apiHost,
        dataType: "json",
        data: {
          reqtok: "profile"
        },
        
        
        beforeSend: function(xhr) {
          if (localStorage.token) {
            xhr.setRequestHeader('Xauthorization', 'Bearer ' + localStorage.token);
          }
        },
        
        /*
        headers: {
        'Xauthorization':'Bearer ' + localStorage.token,
    	},
    	*/
        success: function(data) {
        	//var d= JSON.parse(data);
          console.log(' TOKKEN name'+ data.name+' role '+data.role);
        },
        error: function() {
          console.log("NO TOKKEN");
        }
      });
    });
    jQuery('#test').click(function() {
    
    
    	console.log( "i got token ? " + localStorage.token);
    
      jQuery.ajax({
        type: 'GET',
        //url: '/api/profile',
        url: apiHost,
        dataType: "json",
        data: {
          req: "profile"
        },
        /*
        beforeSend: function(xhr) {
          if (localStorage.token) {
            xhr.setRequestHeader('Authorization', 'Bearer ' + localStorage.token);
          }
        },*/
        success: function(data) {
        	//var d= JSON.parse(data);
          console.log(data+' Hello ' + data.name + '! You have successfully accessed to /api/profile.');
        },
        error: function() {
          console.log("Sorry, you are not logged in.");
        }
      });
    });
    jQuery('#goodLogin').click(function() {
      jQuery.ajax({
        type: "POST",
       // url: "/login",
        url: apiHost,
        data: {
          username: "josev",
          password: "foo"
        },
        dataType: "json",
        success: function(data) {
          localStorage.token = data.token;
          console.log(data + 'Got a token from the server! Token: ' + data.token);
        },
        error: function() {
          console.log("Login Failed");
        }
      });
    });
    jQuery('#badLogin').click(function() {
      jQuery.ajax({
        type: "POST",
       // url: "/login",
        url: apiHost,
        data: {
          username: "john.doe",
          password: "foobarfoobar"
        },
        success: function(data) {
          console.log("ERROR: it is not supposed to alert.");
        },
        error: function() {
          console.log("Login Failed");
        }
      });
    });
    jQuery('#logout').click(function() {
      localStorage.clear();
    });
  });



</script>
<?php get_footer(); ?>
