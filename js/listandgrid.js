var MyBtn = document.getElementsByClassName("mybtn");
var index = 0 ;

function Button(n){
    CurrentShowButton(index = n);
}
function CurrentShowButton(n){
    for(var i = 0 ; i < MyBtn.length ; i++){
        MyBtn[i].className = MyBtn[i].className.replace(" Active","");
    }
    MyBtn[n].className +=" Active";
}

function List(){
    var Item = document.getElementById("get_product");
    var MyItem = document.getElementsByClassName("myItem");

    for(var i = 0 ; i < MyItem.length ; i++){
        MyItem[i].style.margin = "0px 0px 10px 0px";
    }
    Item.style.display = "block";
    
}
function Grid(){
    var Item = document.getElementById("get_product");
    var MyItem = document.getElementsByClassName("myItem");

    for(var i = 0 ; i < MyItem.length ; i++){
        MyItem[i].style.margin = "0px";
    }
    Item.style.display = "grid";

}