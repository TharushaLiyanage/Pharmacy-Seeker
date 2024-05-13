let dropdownBtn = document.getElementById("drop-text");
let list = document.getElementById("list");
let icon = document.getElementById("icon");
let span = document.getElementById("span");
let  input= document.getElementById("search-input");
let  dropdown_list_item = document.getElementById("dropdown_list_item");

dropdownBtn.onclick=function(){
    //rotate arrow icon
   if ( list.classList.contains('show')){
    icon.style.rotate="0deg";

   }else{
    icon.style.rotate="-180deg";
}
list.classList.toggle('show')
};
//hide dropdown when click outside
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