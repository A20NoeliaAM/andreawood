
       
// create animation to change position
function moverCamara(a, b, c, id){
   let cameraEl = document.getElementById('camera'); 
/* 
    cameraEl.setAttribute('look-controls', {enabled: false}); */

    let animation = document.createElement('a-animation');
    animation.setAttribute("attribute","position");
    animation.setAttribute("dur", 300);
    animation.setAttribute("repeat", "0");
    animation.setAttribute("to",`${a} ${b} ${c}`);
    cameraEl.appendChild(animation);

    /* ver en servidor */
    /* cameraEl.setAttribute("look-at", id);
    
    cameraEl.setAttribute('look-controls', {enabled: true}); */
}


       

       