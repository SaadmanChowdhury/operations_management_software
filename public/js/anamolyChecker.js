

//console.log(all_ancs);
function checkDesignAnomaly(path){
	var all_ancs = document.querySelectorAll(path);
	
	console.log(all_ancs);
	var isAnomaly=false;
	
	if (typeof all_ancs !== 'undefined') {
	    // the variable is defined
	    if(all_ancs.length>0){
	    	var initTop=all_ancs[0].offsetTop;
	       	for (var i = 0; i < all_ancs.length; i++) {
				 if(initTop!=all_ancs[i].offsetTop ){
				 	isAnomaly=true;
				 	break;
				 }
			}
	    }
	}
	
	return isAnomaly;

}

function showHideErrorModalBasedOnAlignments(){
    if(checkDesignAnomaly("body > div.page-container > div.d-flex > div > div > ul > a")){
        document.getElementById('id01').style.display='block';

		var shade=document.getElementById('background-shade-for-design-anomaly')
		
		shade.style.display = "block";;
		setTimeout(function () {
			shade.style.opacity = 0.3;
		}, 0);

		console.log(document.getElementById('background-shade-for-design-anomaly'));
		setTimeout(function(){

			if ( document.getElementById("id01").classList.contains('w3-modal') ){

				document.getElementById("id01").classList.remove("w3-modal");
				document.getElementById("id01").classList.add("w3-modal-an");
				
	
			}

		}, 100);

	
    }
    else{


		var shade=document.getElementById('background-shade-for-design-anomaly')
		
		shade.style.display = "none";;
		setTimeout(function () {
			shade.style.opacity = 0.0;
		}, 0);

		setTimeout(function(){

			if ( document.getElementById("id01").classList.contains('w3-modal-an') ){

				document.getElementById("id01").classList.remove("w3-modal-an");
				document.getElementById("id01").classList.add("w3-modal");
				
				//document.getElementById('id01').style.display='none';
			}

		}, 100);
       
    }
}

window.onresize = function(event){
    showHideErrorModalBasedOnAlignments();
}
window.onload =showHideErrorModalBasedOnAlignments();


