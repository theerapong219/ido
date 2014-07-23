/*==================================================
*  Author : Tirapant Tongpann
*  Created Date : 07/07/2011 11:02
*  Module : autocomplete
*  Description : autocomplete
*  Involve People : -
*  Last Updated : 07/07/2011 11:02
==================================================*/

/*==================================================
  :: STYLE AUTOCOMPLETE ::
====================================================
.autoresult{border:1px solid #CCC; border-bottom:0px; font-size:12px; font-family:arial; padding:0px; display:none; margin:0;}
.autoresult div {border-bottom:1px solid #CCC; padding:3px; cursor:pointer;}
.autoresult .namepart{color:#F00;}
.autoresult .unselected-0{background-color:#FFF;}
.autoresult .unselected-1{background-color:#ffffcc;}
.autoresult .selected{background-color:#0CF; color:#fff;}
*/

// global variables
var autoLoader = true;
var acListTotal = {};
var acListCurrent = {};
var acDelay = {};
var acURL = {};
var acSearchId = {};
var acResultsId = {};
var acSearchField = {};
var acResultsDiv = {};
var acStyle = {};
var acJson = {};

/*  AutoComplete('TextField', 'AutoTextField', url+'?Mode=AutoTextField&name=', ae.GetTextField, 1); */
function AutoComplete(field_id, key, get_url, Func, sty){
  acListTotal[key]   =  0;
  acListCurrent[key] = -1;
  acDelay[key]		  = 0;
  acSearchField[key] = null;
  acResultsDiv[key] = null;
  acJson[key] = {};

	// initialize vars
	acSearchId[key]  = "#" + field_id;
	acResultsId[key] = "#" + key;
	acURL[key] 		= get_url;
  acStyle[key] = sty;
	// create the results div
	$("body").append('<div id="' + key + '" class="autoresult"></div>');

	// register mostly used vars
	acSearchField[key]	= $(acSearchId[key]);
	acResultsDiv[key]	= $(acResultsId[key]);

	// on blur listener
	acSearchField[key].blur(function(){setTimeout(function(){clearAutoComplete(key)}, 200);});

	// on key up listener
	acSearchField[key].keyup(function (e) {
    // reposition div
    repositionResultsDiv(key);

		// get keyCode (window.event is for IE)
		var keyCode = e.keyCode || window.event.keyCode;
		var lastVal = acSearchField[key].val();

		// check an treat up and down arrows
		if(updownArrow(keyCode, key, Func)){
			return;
		}

		// check for an ENTER or ESC
		if(keyCode == 13 || keyCode == 27){
			clearAutoComplete(key);
			return;
		}

		// if is text, call with delay
		setTimeout(function () {autoComplete(lastVal, key, Func)}, acDelay[key]);
	});
}

// treat the auto-complete action (delayed function)
function autoComplete(lastValue, key, Func){
	// get the field value
	var part = acSearchField[key].val();

	// if it's empty clear the resuts box and return
	if(part == ''){
		clearAutoComplete(key);
		return;
	}

	// if it's equal the value from the time of the call, allow
	if(lastValue != part){
		return;
	}

  autoLoader = false;
	// get remote data as JSON
	$.getJSON(acURL[key] + part, function(json){
    autoLoader = true;
    acJson[key] = json;

		// get the total of results
		var ansLength = acListTotal[key] = json.result.length;

		// if there are results populate the results div
		if(ansLength > 0){

			var newData = '';

			// create a div for each result
      var code='';
      var name='';
      switch(acStyle[key]){
        case 1 :
          /* {"result":[{"code":"xxxxx", "name":"xxxxx"}]} */
          for(i=0; i<ansLength; i++) {
            name=json.result[i].name.split(part).join('<font class="namepart">'+part+'</font>');
            newData += '<div class="unselected-'+i%2+'" id="AutoText'+i+'">'+name+'</div>';
          }
        break;
        case 2 :
          /* {"result":[{"code":"xxxxx", "name":"xxxxx"}]} */
          for(i=0; i<ansLength; i++) {
            code=json.result[i].code.split(part).join('<font class="namepart">'+part+'</font>');
            name=json.result[i].name.split(part).join('<font class="namepart">'+part+'</font>');
            newData += '<div class="unselected-'+i%2+'" id="AutoText'+i+'">'+code+' - '+name+'</div>';
          }
        break;
        case 3 :
          /* {"result":[{"code":"xxxxx", "name":"xxxxx", "pic":"xxxxx"}]} */
          for(i=0; i<ansLength; i++) {
            name=json.result[i].name.split(part).join('<font class="namepart">'+part+'</font>');
            newData += '<div class="unselected-'+i%2+'" id="AutoText'+i+'"><img src="'+json.result[i].pic+'" width="25" height="25" align="absmiddle" /> '+name+'</div>';
          }
        break;
        default :
          for(i=0; i<ansLength; i++) {
            name=json.result[i].name.split(part).join('<font class="namepart">'+part+'</font>');
            newData += '<div class="unselected-'+i%2+'" id="AutoText'+i+'">'+name+'</div>';
          }
        break;
      }

			// update the results div
			acResultsDiv[key].html(newData);
			acResultsDiv[key].css("display","block");

			// for all divs in results
			var divs = $(acResultsId[key] + " > div");

			// on mouse over clean previous selected and set a new one
			divs.mouseover( function() {
				divs.each(function(){$(this).removeClass('selected');});
				$(this).addClass('selected');
			})

			// on click copy the result text to the search field and hide
			divs.click( function() {
        var id = $(this).attr('id').split('AutoText').join('');
        Func(json.result[id]);
				clearAutoComplete(key);
			});

		} else {
			clearAutoComplete(key);
		}
	});
}

// clear auto complete box
function clearAutoComplete(key){
	acResultsDiv[key].html('');
	acResultsDiv[key].css("display","none");
}

// reposition the results div accordingly to the search field
function repositionResultsDiv(key){
	// get the field position
	var sf_pos    = acSearchField[key].offset();
	var sf_top    = sf_pos.top;
	var sf_left   = sf_pos.left;

	// get the field size
	var sf_height = acSearchField[key].height();
	var sf_width  = acSearchField[key].width();

  var mybrowser=navigator.userAgent;
  if(mybrowser.indexOf('MSIE')>0){
    acResultsDiv[key].css("position","absolute");
    acResultsDiv[key].css("left", sf_left - 0);
    acResultsDiv[key].css("top", sf_top + sf_height + 7);
    acResultsDiv[key].css("width", sf_width + 10);
  }else if(mybrowser.indexOf('Firefox')>0){
    acResultsDiv[key].css("position","absolute");
    acResultsDiv[key].css("left", sf_left - 0);
    acResultsDiv[key].css("top", sf_top + sf_height + 7);
    acResultsDiv[key].css("width", sf_width + 10);
  }else if(mybrowser.indexOf('Presto')>0){
    acResultsDiv[key].css("position","absolute");
    acResultsDiv[key].css("left", sf_left - 0);
    acResultsDiv[key].css("top", sf_top + sf_height + 7);
    acResultsDiv[key].css("width", sf_width + 10);
  }else if(mybrowser.indexOf('Chrome')>0){
    acResultsDiv[key].css("position","absolute");
    acResultsDiv[key].css("left", sf_left - 0);
    acResultsDiv[key].css("top", sf_top + sf_height + 7);
    acResultsDiv[key].css("width", sf_width + 10);
  }else{
    acResultsDiv[key].css("position","absolute");
    acResultsDiv[key].css("left", sf_left - 0);
    acResultsDiv[key].css("top", sf_top + sf_height + 7);
    acResultsDiv[key].css("width", sf_width + 10);
  }
}

// treat up and down key strokes defining the next selected element
function updownArrow(keyCode, key, Func) {
	if(keyCode == 40 || keyCode == 38){

		if(keyCode == 38){ // keyUp
			if(acListCurrent[key] == 0 || acListCurrent[key] == -1){
				acListCurrent[key] = acListTotal[key]-1;
			}else{
				acListCurrent[key]--;
			}
		} else { // keyDown
			if(acListCurrent[key] == acListTotal[key]-1){
				acListCurrent[key] = 0;
			}else {
				acListCurrent[key]++;
			}
		}

		// loop through each result div applying the correct style
		acResultsDiv[key].children().each(function(i){
			if(i==acListCurrent[key]){
        Func(acJson[key].result[i]);
				$(this).addClass('selected');
			} else {
				$(this).removeClass('selected');
			}
		});

		return true;
	} else {
		// reset
		acListCurrent[key] = -1;
		return false;
	}
}