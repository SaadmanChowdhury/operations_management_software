

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
        document.getElementById('id01').style.display='block'
    }
    else{
        document.getElementById('id01').style.display='none'
    }
}

window.onresize = function(event){
    showHideErrorModalBasedOnAlignments();
}
window.onload =showHideErrorModalBasedOnAlignments();


