var inp = document.getElementsByName("phone__input")[0];

inp.onclick = function() {
    inp.value = "+";
}

var old = 0;

inp.onkeydown = function(event) {
    var curLen = inp.value.length;
    
    if(isNaN(event.key) && event.key !== 'Backspace') {
      event.preventDefault();
    }

    if (curLen < old){
      old--;
      return;
      }
    
    if (curLen == 2) 
    	inp.value = inp.value + "(";
      
    if (curLen == 6)
    	inp.value = inp.value + ")-";
      
     if (curLen == 11)
    	inp.value = inp.value + "-"; 
      
     if (curLen > 15)
    	inp.value = inp.value.substring(0, inp.value.length - 1);
      
     old++;
}
