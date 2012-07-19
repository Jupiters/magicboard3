
$(document).ready(function(){
	$("a.bookmark").click(function(e){
		var url = this.href;
		var title = this.title;
	    if(document.all && window.external) { // ie
	        window.external.AddFavorite(url, title);
	    } else if(window.sidebar) { // firefox
	        window.sidebar.addPanel(title, url, "");
	    } else if(window.opera && window.print) { // opera
	        var elem = document.createElement('a');
	        elem.setAttribute('href',url);
	        elem.setAttribute('title',title);
	        elem.setAttribute('rel','sidebar');
	        elem.click(); // this.title=document.title;
	    } else {
			alert('Your browser does not support this bookmark action');
	    }
		return false;
	});
});
