let dropdownBtn = document.getElementById("drop-text");
let list = document.getElementById("list");
let icon = document.getElementById("icon");
let span = document.getElementById("span");

dropdownBtn.onclick=function(){
    list.classList.toggle('show')
    icon.style.rotate="-180deg";
};
window.onclick = function(e){
    if(
        e.target.id !== "drop-text"&&
        e.target.id !== "span"&&
        e.target.id !== "icon"
    ){
        list.classList.remove('show')
        icon.style.rotate="0deg";
    }
}