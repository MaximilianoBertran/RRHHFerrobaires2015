// Como usar el toolTip?
// ---------------------
// Se crea un elemento, cualquiera (button, div, etc.) y se le agregan los eventos onmouseover y onmouseout:
//
// Ejemplo:
// --------
// <button alt="Nerv se la come." onmouseover="toolTip(this)" onmouseout="hideToolTip()">Boton</button>
//
// En onmouseover, tiene que ir toolTip(this). En mouseout,  hideToolTip(), tal cual se muestra en el ejemplo.
// El mensaje que se va a mostrar, se pasa mediante la etiqueta alt (en el ejemplo de arriba se muestra: "Nerv
// se la come.").

function toolTip(elemento){
	var x, y, ancho, alto;
	
	$('#contenidoToolTip').html('<center>' + $(elemento).attr('alt') + '</center>');
	
	ancho = $(elemento).width() / 2;
	alto = $(elemento).height() * 4 - $('#toolTip').height();
	
	x = $(elemento).position().left + ancho - $('#toolTip').width() / 2;
	y = $(elemento).position().top - alto - $('#toolTip').height() / 2;
	
	if (x < 0){
		//x = 0;
	}
	
	if (y < 0){
		//y = alto; -> a veces se bug
	}
	
	$('#toolTip').css('left', x);
	$('#toolTip').css('top', y);
	
	//$('#toolTip').fadeIn('fast');
	$('#toolTip').css('display', 'inline');
}

function hideToolTip(){
	//$('#toolTip').fadeOut('fast');
	$('#toolTip').css('display', 'none');
}