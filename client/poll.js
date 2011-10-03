var oXHR = null;
var iInterval = 1000;
var divNotification = null;

function checkComments() {
    if (!oXHR) {
    	alert('correct ');
        oXHR = zXmlHttp.createRequest();
    } else if (oXHR.readyState != 0) {
        oXHR.abort();
    }    

    var tid = qtabView.get('activeTab').id;
    var qtid = atabView.get('activeTab').id.split('_') ;
    var qid = qtid[0] ;
    var qtid = qtid[1] ;
	    
    oXHR.open('GET', 'http://www.cse.iitm.ac.in/~sagarmb/server.php?tid=' + tid + '&qid=' + qid + '&qtid=' + qtid, true);
    oXHR.onreadystatechange = function () {               
        
        if (oXHR.readyState == 4) {
            if (oXHR.status == 200) {

                var aData = oXHR.responseText;
                showNotification(aData);
            }
            setTimeout(checkComments, iInterval);        
        }
       };                      
     
    oXHR.send(null);       
}

function showNotification (msg) {
	alert("Got response") ;
	 // var refreshdiv = document.getElementById("refreshdiv");
	 // refreshdiv.innerHTML = msg; 
}

//if Ajax is enabled, assign event handlers and begin fetching
window.onload = function () {
    if (zXmlHttp.isSupported()) {
        alert('supported');
        checkComments();              
    }
};
