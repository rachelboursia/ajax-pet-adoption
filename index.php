<!doctype html>
<html>
<head>
 
   <meta name="robots" content="noindex,nofollow">
   <title>AJAX Pet Adoption Agency</title>
   <style>
       #myForm div{
        margin-bottom:2%;
        }
   </style>
   <script src="https://code.jquery.com/jquery-latest.js"></script>
   
</head>
<body>
<h2>AJAX Pet Adoption Agency</h2>
<p>Choose below to pick a pet:</p>
<div id="output">
<form id="myForm" action="" method="get">
   <div id="pet_feels">
       <h3>Feels</h3>
       <p>Please choose how you would like your pet to feel:</p>
       <input type="radio" name="feels" value="fluffy" required="required">fluffy <br />
       <input type="radio" name="feels" value="scaly">scaly <br />
   </div>
   <div id="pet_likes">
       <h3>Likes</h3>
       <p>Please tell us what your pet will like:</p>
       <input type="radio" name="likes" value="petted" required="required">to be petted <br />
       <input type="radio" name="likes" value="ridden">to be ridden <br />
   </div>
    <div id="pet_eats">
       <h3>Eats</h3>
       <p>Please tell us what your pet likes to eat:</p>
       <input type="radio" name="eats" value="carrots" required="required">carrots <br />
       <input type="radio" name="eats" value="pets">other people's pets <br />
   </div>
      <div id="pet_name">
       <h3>Name</h3>
       <p>Type your pet's name:</p>
       <input type="text" id="name" name="name" value=" " />
   </div>
  
   <div><input type="submit" value="Submit it!" /></div>
</form>
</div>
<p><a href="index.php">RESET</a></p>
<script>
  
    function titleCase(str) {
				str = str.toLowerCase().split(' ');
				for (var i = 0; i < str.length; i++) {
					str[i] = str[i].charAt(0).toUpperCase() + str[i].slice(1); 
				}
				return str.join(' ');
      }
    $("document").ready(function(){
        
        //hide likes and eats 
        $('#pet_likes').hide();
        $('#pet_eats').hide();
        $('#pet_name').hide();
       //Click feels and shows likes 
        $('#pet_feels').click(function(e){
          $('#pet_likes').slideDown(200);
        });
           
       //Click likes and shows eats
        $('#pet_likes').click(function(e){
          $('#pet_eats').slideDown(200);
        });
       
      //Click eats and shows name
        $('#pet_eats').click(function(e){
          $('#pet_name').slideDown(200);
        });
      
        $('#myForm').submit(function(e){
            e.preventDefault();//no need to submit as you'll be doing AJAX on this page
            let feels = $("input[name=feels]:checked").val();
            let likes = $("input[name=likes]:checked").val();
            let eats = $("input[name=eats]:checked").val();
            let pet = "";
            let name = $("input[name=name]").val();
						name = titleCase(name);
            var output = "";
            //135
            if(feels == "fluffy" && likes == "petted" && eats == "carrots"){
             pet = "rabbit";
            }
           //136
            if(feels == "fluffy" && likes == "petted" && eats == "pets"){
              pet = 'bird';
            }
            //145
            if(feels == "fluffy" && likes == "ridden" && eats == "carrots"){
							pet = 'golden';
						}
           //146
            if(feels == "fluffy" && likes == "ridden" && eats == "pets"){
							pet = 'cat';
						}
           //235
           if(feels == "scaly" && likes == "petted" && eats == "carrots"){
              pet = 'pig';
            }
            //236
            if(feels == "scaly" && likes == "petted" && eats == "pets"){
              pet = 'hedgehog';
            }
            //245
            if(feels == "scaly" && likes == "ridden" && eats == "carrots"){
              pet = 'dane';
            }
            //246
           if(feels == "scaly" && likes == "ridden" && eats == "pets"){
             pet = "velociraptor";
            }
            output += `<p>Your pets name is ${name}.</p>`;
            output += `<p>Your pet is a ${pet}.</p>`;
            output += `<p>Your pet feels ${feels}.</p>`;
            output += `<p>Your pet likes to be ${likes}.</p>`;
            output += `<p>Your pet likes to eat ${eats}.</p>`;
            //alert(feels);
            $.get( "includes/get_pet.php", { critter: pet} )
             .done(function( data ) {
                //alert( "Data Loaded: " + data );
                //output submitted info and replace form 
                $('#output').html(data + output);
             
              })
              .fail(function(xhr, status, error) {
               //Ajax request failed.
               var errorMessage = xhr.status + ': ' + xhr.statusText
               alert('Error - ' + errorMessage);
              });
        });
    });
   </script>
</body>
</html>