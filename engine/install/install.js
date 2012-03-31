<script type="text/javascript">
if(window.addEventListener){
	window.addEventListener('load', psyProgressBar, false);
}else {
	window.attachEvent('onload', psyProgressBar);
}
function psyProgressBar(){
	var el = document.getElementsByTagName('*');
	var progressBarArr = [];
	var reProgressBar = /\bpsyProgressBar\b/g;
	var reProgressLine = /\bpsyProgressBar__line\b/g;
	var reProgressText = /\bpsyProgressBar__text\b/g;
	for(var i = 0; i < el.length; i++){
		if(reProgressBar.test(el[i].className)){
			var obj = {};
			var elProgress = el[i].getElementsByTagName('*');
			for(var j = 0; j < elProgress.length; j++){
				if(reProgressLine.test(elProgress[j].className)){
					obj['progress__line'] = elProgress[j];
				}
				if(reProgressText.test(elProgress[j].className)){
						obj['progress__text'] = elProgress[j];
				}
			}
			progressBarArr.push(obj);				
		}
	}

for(var i = 0; i < progressBarArr.length; i++){
	var value = 0;
	var valueMax = 100;
	var textTeg;
	var progress__line;
	if(progressBarArr[i].progress__line){
		value = parseInt(progressBarArr[i].progress__line.getAttribute('value')) || 0;
		valueMax = parseInt(progressBarArr[i].progress__line.getAttribute('max')) || 100;
				
		progress__line = progressBarArr[i].progress__line;
	}else { continue;}
	if(progressBarArr[i].progress__line && progressBarArr[i].progress__text){
		textTeg = progressBarArr[i].progress__text;
	}else {
		var span = document.createElement('span');
		document.body.appendChild(span);
		span.style.display = 'none';
		textTeg = span;
	}	
					
	lineTime(textTeg,progress__line,valueMax)
}
function lineTime(textTeg,progress__line,valueMax){
			var num = 0;
			var nums = 0;
			try{
				if(HTMLProgressElement){
					var step = 100/valueMax;
					var progress = 0;
					var set = setInterval(function(){
						num = num+step ;
						progress = parseInt(num)
						nums ++;
						
						progress__line.value = nums;
						textTeg.innerHTML = progress + '%'
						if(nums >= valueMax){
							
							textTeg.innerHTML = 100 + '%'
							progress__line.value = 100;
							clearInterval(set);
							return;
						}
					},20)
				}
			}
			catch(e){
				
				var div = document.createElement('div');
				progress__line.parentNode.appendChild(div);
				div.className = 'noSupportProgress';
				var step = progress__line.parentNode.offsetWidth / valueMax;
				var procent = 100/valueMax;
				//alert(procent)
				var procentStep = 0; 
				var num = 0;
				var progress = 0;
				var set = setInterval(function(){
					num += step;
					
					nums ++;
					procentStep = procentStep+procent;
					progress = parseInt(procentStep);
					div.style.width = num + "px" ;
					textTeg.innerHTML = progress + '%'
					//alert(p + " : " + num + " : " + procent)
					if(nums + 1 >= valueMax){
							textTeg.innerHTML = 100 + '%'
							progress__line.value = 100;
							div.style.width = progress__line.parentNode.offsetWidth + "px" ;
							clearInterval(set);
							return;
					}
				},20)		

			}
		}	
}

</script>