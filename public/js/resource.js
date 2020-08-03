	var ajax = new XMLHttpRequest();
        ajax.open('GET', 'log/message', true);
        ajax.onreadystatechange = function () {
            if (ajax.readyState == 4 && ajax.status == 200) {
                aler(ajax.responseText);
            }
        };
    var matchEnterdDate=0;
		window.onload =function(){
			var input = document.createElement('input');
			input.setAttribute('type','date');
			input.setAttribute('value', 'some text'); 
			if(input.value === "some text"){
				allDates = document.getElementsByClassName("xDateContainer");
				matchEnterdDate=1;
				for (var i = 0; i < allDates.length; i++) {
					allDates[i].style.opacity = "1";
				} 
			}
		}
	function setCorrect(xObj,xTraget){
			document.getElementById(xTraget).value=((xObj.value.split('-')[2]))+"-"+(xObj.value.split('-')[1])+"-"+(xObj.value.split('-')[0]);
	}