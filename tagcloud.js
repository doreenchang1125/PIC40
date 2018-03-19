function makeCloud(){
	var s = document.getElementById("tags");
	var fill = s.value;
	var ar = fill.split(" ");
	ar = ar.sort();
	//alert(ar);
	freq = Array();
	uniq = Array();	
	uniq[0] = ar[0];
	var count = 1;
	for (var i = 1; i < ar.length; i++){
		if (ar[i] == ar[i-1]){
			count++;
		}
		else{
			uniq.push(ar[i]);
			freq.push(count);
			count = 1;
		}
	}
	freq.push(count);
	//alert(uniq);
	//alert(freq);

	createDiv();
	setSize();

	var newdiv = document.getElementsByTagName("div");
	var divel = newdiv[0];
	divel.parentNode.replaceChild(newnode,divel);
	for (var i = 0; i < spans.length; i++){
		spans[i].onclick = alertfreq;
	}
}

function alertfreq(){
	var occur;
	for (var i = 0; i < uniq.length; i++){
		if (this.innerHTML == (uniq[i] + " ")){
			occur = freq[i];
		}
	}
	alert(this.innerHTML + ": " + occur + " occurences");
}
/*
function searchfreq(object){
	for (var i = 0; i < uniq.length; i++){
		if (object.innerHTML == (uniq[i] + " ")){
			return freq[i];
		}
	}
}
*/
function max(){
	var max = 1;
	for (var i = 0; i < freq.length; i++){
		if(freq[i] > max){
			max = freq[i];
		}
	}
	return max;
}

function createDiv(){
	newnode = document.createElement("div");
	for (var i = 0; i < uniq.length; i++){
		var spanel = document.createElement("span");
		spanel.innerHTML = uniq[i] + " ";
		newnode.appendChild(spanel);
	}
	newnode.style.border = ".1em solid silver";
	newnode.style.background = "blue";
	newnode.style.color = "silver";
	newnode.style.fontFamily = "serif";
	newnode.style.fontSize = "x-large";
	newnode.style.display = "inline-block";
}

function setSize(){
	spans = newnode.childNodes;
	var maxnum = max();
	for (var i = 0; i < spans.length; i++){
		spans[i].style.fontSize = Math.round((freq[i]/maxnum) * 20) + 15 + "pt";
	}
}

function saveCloud(){
	cookie_cont = document.getElementById("tags");
	var cont = cookie_cont.value
	document.cookie = "tags =" + cont; 

	alert(document.cookie);

}

function loadCloud(){
	var cookies = document.cookie;
	var cookie_ar = document.cookie.split(";");
	var cookie = cookie_ar[cookie_ar.length-1];
	var cookie_data_array = cookie.split("=");
	var cookie_value = cookie_data_array[1];
	var texts = document.getElementById("tags");
	texts.value = cookie_value;
}

function clearArea(){
	var texts = document.getElementById("tags");
	texts.value = "";
}