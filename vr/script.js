function moverCamara(a, b, c){
    let animation = document.createElement('a-animation');
    animation.setAttribute("attribute","position");
    animation.setAttribute("dur", 300);
    animation.setAttribute("repeat", "0");
    animation.setAttribute("to",`${a} ${b} ${c}`);
    document.getElementById('camera').appendChild(animation);
}
function getVector(camera,targetObject) {  
    var entityPosition = new THREE.Vector3();
    targetObject.object3D.getWorldPosition(entityPosition);
    var cameraPosition = new THREE.Vector3();
    camera.object3D.getWorldPosition(cameraPosition);
    var vector = new THREE.Vector3(entityPosition.x, entityPosition.y, entityPosition.z); 
    vector.subVectors(cameraPosition, vector).add(cameraPosition);
    return vector;
}
function centerCamera(camera,vector) {
    camera.object3D.lookAt(vector);
    camera.object3D.updateMatrix();    
    var rotation = camera.getAttribute('rotation');
    camera.components['look-controls'].pitchObject.rotation.x = THREE.Math.degToRad(rotation.x);
    camera.components['look-controls'].yawObject.rotation.y = THREE.Math.degToRad(rotation.y);
}  
function mirarCuadro(id) {
    var cameraEl = document.getElementById('camera');
    cameraEl.setAttribute("look-controls", {enabled: false});
    let pointTarget = getVector(cameraEl, document.getElementById(id));
    centerCamera(cameraEl,pointTarget);  
    cameraEl.setAttribute("look-controls", {enabled: true});
}
function acercarse(a, b, c, id){
    mirarCuadro(id).then(moverCamara(a,b,c));
    
}